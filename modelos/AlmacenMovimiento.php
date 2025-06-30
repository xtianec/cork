<?php
require_once __DIR__ . '/../config/Conexion.php';

class AlmacenMovimiento
{
    /**
     * Actualiza el stock del artículo aplicando el signo correspondiente.
     * @param int  $articulo_id
     * @param float $cantidad
     * @param int  $tipo_movimiento_id
     * @param bool $invert Invierte el efecto del movimiento
     */
    private function ajustarStock(int $articulo_id, float $cantidad, int $tipo_movimiento_id, bool $invert = false): void
    {
        $ingreso = in_array((int)$tipo_movimiento_id, [1, 3]);
        $signo   = $ingreso ? 1 : -1;
        if ($invert) $signo *= -1;

        ejecutarConsulta(
            "UPDATE articulo SET stock_actual = stock_actual + (? * ?) WHERE id = ?",
            [$cantidad, $signo, $articulo_id]
        );
    }

    public function insertar($data)
    {
        $sql = "INSERT INTO almacen_movimiento (articulo_id, tipo_movimiento_id, fecha, cantidad, precio_unitario, referencia, usuario_id, created_at, updated_at)
                VALUES (?,?,?,?,?,?,?,NOW(),NOW())";

        $ok = ejecutarConsulta($sql, [
            $data['articulo_id'],
            $data['tipo_movimiento_id'],
            $data['fecha'],
            $data['cantidad'],
            $data['precio_unitario'],
            $data['referencia'],
            $data['usuario_id']
        ]);

        if ($ok) {
            $this->ajustarStock(
                (int)$data['articulo_id'],
                (float)$data['cantidad'],
                (int)$data['tipo_movimiento_id']
            );
        }

        return $ok;
    }

    public function mostrar($id)
    {
        return ejecutarConsultaSimpleFila("SELECT * FROM almacen_movimiento WHERE id = ?", [$id]);
    }

    public function editar($id, $data)
    {
        $anterior = $this->mostrar($id);
        if (!$anterior) return false;
        $this->ajustarStock(
            (int)$anterior['articulo_id'],
            (float)$anterior['cantidad'],
            (int)$anterior['tipo_movimiento_id'],
            true
        );

        $sql = "UPDATE almacen_movimiento SET articulo_id=?, tipo_movimiento_id=?, fecha=?, cantidad=?, precio_unitario=?, referencia=?, updated_at=NOW() WHERE id=?";
        $ok = ejecutarConsulta($sql, [
            $data['articulo_id'],
            $data['tipo_movimiento_id'],
            $data['fecha'],
            $data['cantidad'],
            $data['precio_unitario'],
            $data['referencia'],
            $id
        ]);

        if ($ok) {
            $this->ajustarStock(
                (int)$data['articulo_id'],
                (float)$data['cantidad'],
                (int)$data['tipo_movimiento_id']
            );
        }

        return $ok;
    }

    public function eliminar($id)
    {
        $registro = $this->mostrar($id);
        if (!$registro) return false;

        $this->ajustarStock(
            (int)$registro['articulo_id'],
            (float)$registro['cantidad'],
            (int)$registro['tipo_movimiento_id'],
            true
        );

        return ejecutarConsulta("DELETE FROM almacen_movimiento WHERE id=?", [$id]);
    }

    public function listar()
    {
        return ejecutarConsulta("SELECT m.id, DATE_FORMAT(m.fecha,'%Y-%m-%d %H:%i') fecha, a.codigo articulo, t.nombre tipo_movimiento, 
            IF(t.nombre IN ('Ingreso','Devolucion'),m.cantidad,0) entrada, 
            IF(t.nombre='Salida',m.cantidad,0) salida,
            m.precio_unitario, m.referencia
            FROM almacen_movimiento m
            LEFT JOIN articulo a ON a.id=m.articulo_id
            LEFT JOIN tipo_movimiento_almacen t ON t.id=m.tipo_movimiento_id
            ORDER BY m.fecha DESC, m.id DESC");
    }

    public function kardex(int $articulo_id)
    {
        return ejecutarConsulta(
            "SELECT id,
                DATE_FORMAT(fecha,'%Y-%m-%d %H:%i:%s') AS fecha,
                tipo_movimiento,
                entrada,
                salida,
                saldo
         FROM vw_kardex
         WHERE articulo_id = ?
         ORDER BY fecha ASC, id ASC",
            [$articulo_id]
        );
    }

    public function registrarSalidaVenta(array $d): bool
    {
        return $this->insertar([
            'articulo_id'        => $d['articulo_id'],
            'tipo_movimiento_id' => 2,                     // 2 = Salida/Venta
            'fecha'              => date('Y-m-d H:i:s'),
            'cantidad'           => $d['cantidad'],
            'precio_unitario'    => $d['precio_unitario'],
            'referencia'         => $d['referencia'],
            'usuario_id'         => $d['usuario_id']
        ]);
    }
    public function inventario()
    {
        // ¡SIN salto de línea antes de SELECT!
        $sql = "SELECT
              COALESCE(l.nombre ,'-') AS linea,
              COALESCE(sl.nombre,'-') AS sublinea,
              COALESCE(m.nombre ,'-') AS marca,
              CONCAT(a.codigo,' - ',a.nombre) AS articulo,
              a.stock_actual
            FROM articulo a
            LEFT JOIN linea     l  ON l.id  = a.linea_id
            LEFT JOIN sublinea  sl ON sl.id = a.sublinea_id
            LEFT JOIN marca     m  ON m.id  = a.marca_id
            ORDER BY l.nombre, sl.nombre, m.nombre, a.nombre";

        return ejecutarConsulta($sql);   // mysqli_result | false
    }
    public function validarSalida(int $articulo_id, float $cantidad): array
    {
        $row = ejecutarConsultaSimpleFila(
            "SELECT stock_actual FROM articulo WHERE id = ?",
            [$articulo_id]
        );

        if (!$row) {
            return ['ok' => false, 'msg' => 'Artículo no existe'];
        }

        $stock = (float)$row['stock_actual'];

        if ($stock <= 0) {
            return ['ok' => false, 'msg' => 'Sin stock disponible'];
        }

        if ($cantidad > $stock) {
            $faltan = $cantidad - $stock;
            return [
                'ok' => false,
                'msg' => "Faltan $faltan unidades para completar la salida"
            ];
        }

        return ['ok' => true];
    }
}
