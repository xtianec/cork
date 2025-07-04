<?php
require_once __DIR__ . '/../config/Conexion.php';

class Articulo
{
    public function insertar(array $data, string $imagenPath, array $partes)
    {
        $parteId = $this->savePartes($partes);
        $sql = "INSERT INTO articulo
            (codigo, numero_parte, nombre, descripcion,
             marca_id, linea_id, sublinea_id, unidad_medida_id, parte_id,
             stock_minimo, stock_maximo,
             precio_costo, precio_venta,
             stock_actual, imagen, estado, created_at, updated_at)
          VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,1,NOW(),NOW())";
        $params = [
            limpiarCadena($data['codigo']),
            limpiarCadena($data['numero_parte']),
            limpiarCadena($data['nombre']),
            limpiarCadena($data['descripcion']),
            limpiarCadena($data['marca_id']),
            limpiarCadena($data['linea_id']),
            limpiarCadena($data['sublinea_id'] ?: 0),
            limpiarCadena($data['unidad_medida_id']),
            $parteId,
            limpiarCadena($data['stock_minimo']),
            limpiarCadena($data['stock_maximo']),
            limpiarCadena($data['precio_costo']),
            limpiarCadena($data['precio_venta']),
            limpiarCadena($data['stock_minimo']),  // stock_actual = stock_minimo
            limpiarCadena($imagenPath),
        ];
        return ejecutarConsulta($sql, $params);
    }

    public function editar(array $data, ?string $imagenPath = null, array $partes = [])
    {
        $setImg = $imagenPath ? ", imagen = ?" : "";
        $sql = "UPDATE articulo SET
            codigo           = ?,
            numero_parte     = ?,
            nombre           = ?,
            descripcion      = ?,
            marca_id         = ?,
            linea_id         = ?,
            sublinea_id      = ?,
            unidad_medida_id = ?,
            parte_id         = ?,
            stock_minimo     = ?,
            stock_maximo     = ?,
            precio_costo     = ?,
            precio_venta     = ?
            {$setImg},
            updated_at       = NOW()
          WHERE id = ?";
        $params = [
            limpiarCadena($data['codigo']),
            limpiarCadena($data['numero_parte']),
            limpiarCadena($data['nombre']),
            limpiarCadena($data['descripcion']),
            limpiarCadena($data['marca_id']),
            limpiarCadena($data['linea_id']),
            limpiarCadena($data['sublinea_id'] ?: 0),
            limpiarCadena($data['unidad_medida_id']),
            $this->savePartes($partes, $data['parte_id'] ?? null),
            limpiarCadena($data['stock_minimo']),
            limpiarCadena($data['stock_maximo']),
            limpiarCadena($data['precio_costo']),
            limpiarCadena($data['precio_venta']),
        ];
        if ($imagenPath) {
            $params[] = limpiarCadena($imagenPath);
        }
        $params[] = limpiarCadena($data['id']);
        return ejecutarConsulta($sql, $params);
    }

    public function desactivar(int $id)
    {
        return ejecutarConsulta(
            "UPDATE articulo SET estado=0, updated_at=NOW() WHERE id=?",
            [limpiarCadena($id)]
        );
    }

    public function activar(int $id)
    {
        return ejecutarConsulta(
            "UPDATE articulo SET estado=1, updated_at=NOW() WHERE id=?",
            [limpiarCadena($id)]
        );
    }

    public function mostrar(int $id)
    {
        return ejecutarConsultaSimpleFila(
            "SELECT * FROM articulo WHERE id=?",
            [limpiarCadena($id)]
        );
    }

    public function listar()
    {
        $sql = <<<SQL
SELECT
  a.id,
  a.codigo,
  a.numero_parte,
  a.nombre,
  m.nombre               AS marca,
  l.nombre               AS linea,
  COALESCE(s.nombre,'')  AS sublinea,
  u.nombre               AS unidad_medida,
  a.stock_actual,
  a.precio_venta,
  IF(a.estado = 1,
     '<span class="badge badge-success">Activo</span>',
     '<span class="badge badge-danger">Inactivo</span>'
  ) AS estado,
  CONCAT(
    '<button class="btn btn-sm btn-primary btn-edit" data-id="', a.id, '">✎</button> ',
    CASE
      WHEN a.estado = 1 THEN
        CONCAT(
          '<button class="btn btn-sm btn-danger btn-deactivate" ',
          'data-id="', a.id, '">✖</button>'
        )
      ELSE
        CONCAT(
          '<button class="btn btn-sm btn-success btn-activate" ',
          'data-id="', a.id, '">✔</button>'
        )
    END
  ) AS acciones,
  a.imagen
FROM articulo        a
JOIN marca           m ON m.id = a.marca_id
JOIN linea           l ON l.id = a.linea_id
LEFT JOIN sublinea   s ON s.id = a.sublinea_id
JOIN unidad_medida   u ON u.id = a.unidad_medida_id
ORDER BY a.id DESC

SQL;

        $rs = ejecutarConsulta($sql);

        if ($rs === false) {
            // Para tu log de errores PHP:
            error_log("Articulo::listar() falló: " . mysqli_error($GLOBALS['conexion']));
        }

        return $rs;
    }
    public function listarConStock(string $term = ''): array
    {
        $like = '%' . $term . '%';
        return ejecutarConsultaArray(
            "SELECT id,
                CONCAT(codigo,' – ',nombre,' (',stock_actual,')') AS text
         FROM articulo
         WHERE estado=1
           AND stock_actual>0
           AND (codigo LIKE ? OR nombre LIKE ?)
         LIMIT 20",
            [$like, $like]
        );
    }


    /* modelos/Articulo.php  (añade al final)  */
    /*  🔄  REEMPLAZA TODO EL MÉTODO POR ESTE  */
    /* listado con límite y offset */
    public function buscarSelect2(
        string $q      = '',
        int    $linea  = 0,
        int    $sub    = 0,
        int    $marca  = 0,
        int    $limit  = 20,
        int    $offset = 0
    ): array {

        $sql = "SELECT id,
                   CONCAT(codigo,' - ',nombre) AS text
            FROM   articulo
            WHERE  estado = 1
              AND (codigo LIKE ? OR nombre LIKE ?)
              AND (? = 0 OR linea_id    = ?)
              AND (? = 0 OR sublinea_id = ?)
              AND (? = 0 OR marca_id    = ?)
            LIMIT  $limit OFFSET $offset";

        return ejecutarConsultaArray($sql, [
            "%$q%",
            "%$q%",
            $linea,
            $linea,
            $sub,
            $sub,
            $marca,
            $marca
        ]);
    }


    /* --- dentro de Articulo ------------------------------------------ */
    public function info(int $id): ?array
    {
        return ejecutarConsultaSimpleFila(
            "SELECT stock_actual,
                precio_venta,
                precio_costo                 -- 👈  NUEVO
           FROM articulo
          WHERE id = ?",
            [$id]
        );
    }
    /* cuántos hay en total (para paginación) */
    public function contarSelect2(
        string $q = '',
        int $linea = 0,
        int $sub = 0,
        int $marca = 0
    ): int {
        $row = ejecutarConsultaSimpleFila(
            "SELECT COUNT(*) total
           FROM articulo
          WHERE estado = 1
            AND (codigo LIKE ? OR nombre LIKE ?)
            AND (? = 0 OR linea_id    = ?)
            AND (? = 0 OR sublinea_id = ?)
            AND (? = 0 OR marca_id    = ?)",
            ["%$q%", "%$q%", $linea, $linea, $sub, $sub, $marca, $marca]
        );
        return (int)($row['total'] ?? 0);
    }

    private function savePartes(array $partes, ?int $id = null): ?int
    {
        $campos = [];
        $placeholders = [];
        $params = [];
        for ($i = 1; $i <= 30; $i++) {
            $campos[] = "parte{$i}";
            $placeholders[] = '?';
            if (isset($partes[$i - 1]) && trim($partes[$i - 1]) !== '') {
                $params[] = limpiarCadena($partes[$i - 1]);
            } else {
                $params[] = null;
            }
        }
        if ($id) {
            $set = array_map(fn($c) => "$c=?", $campos);
            $sql = "UPDATE parte SET " . implode(',', $set) . ", updated_at=NOW() WHERE id=?";
            $params[] = $id;
            return ejecutarConsulta($sql, $params) ? $id : null;
        }
        $sql = "INSERT INTO parte(" . implode(',', $campos) . ",created_at,updated_at) VALUES(" . implode(',', $placeholders) . ",NOW(),NOW())";
        return ejecutarConsulta_retornarID($sql, $params);
    }

    public function obtenerPartes(int $id): array
    {
        if (!$id) return [];
        $row = ejecutarConsultaSimpleFila("SELECT * FROM parte WHERE id=?", [$id]);
        if (!$row) return [];
        $res = [];
        for ($i = 1; $i <= 30; $i++) {
            $k = 'parte' . $i;
            if (!empty($row[$k])) $res[] = $row[$k];
        }
        return $res;
    }
}
