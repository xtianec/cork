<?php
require_once __DIR__.'/../config/Conexion.php';
require_once __DIR__.'/AlmacenMovimiento.php';

class ComprobanteElectronico
{
    /*------------ helpers privados -----------*/
    private function nextSerieNum(string $tipo): array
    {
        $row = ejecutarConsultaSimpleFila(
            "SELECT id, serie, ultimo_numero
               FROM serie_comprobante
              WHERE tipo_comprobante=? FOR UPDATE",
            [$tipo]
        );
        if (!$row)  throw new Exception("Serie no configurada para $tipo");

        $nuevo = $row['ultimo_numero'] + 1;
        ejecutarConsulta("UPDATE serie_comprobante SET ultimo_numero=? WHERE id=?",
                         [$nuevo,$row['id']]);
        return [$row['serie'],$nuevo];
    }

    /*------------ CRUD -------------*/
    public function insertar(array $cab, array $det): int
    {
        global $conexion;
        $conexion->begin_transaction();

        $alm = new AlmacenMovimiento();

        try {
            /* 1. cliente */
            $cli = ejecutarConsultaSimpleFila(
                "SELECT id, razon_social FROM cliente WHERE ruc=?",
                [$cab['cliente_ruc']]
            );
            if (!$cli) throw new Exception('Cliente no existe');

            /* 2. totales */
            $sub = 0;
            foreach ($det as &$d) {
                $d['subtotal'] = round($d['cantidad']*$d['precio_unitario'],2);
                $sub += $d['subtotal'];
            }
            $igv   = round($sub*0.18,2);
            $total = $sub + $igv;

            /* 3. serie y correlativo */
            [$serie,$numero] = $this->nextSerieNum($cab['tipo_comprobante']);

            /* 4. cabecera */
            $compId = ejecutarConsulta_retornarID(
                "INSERT INTO comprobante_electronico
                   (tipo_comprobante,serie,numero,
                    cliente_id,cliente_ruc,
                    moneda,subtotal,igv,total)
                 VALUES (?,?,?,?,?,?,?,?,?)",
                [$cab['tipo_comprobante'],$serie,$numero,
                 $cli['id'],$cab['cliente_ruc'],
                 $cab['moneda'],$sub,$igv,$total]
            );

            /* 5. detalles + rebaja de stock */
            foreach ($det as $d) {

                /*‒ validar stock */
                $info = ejecutarConsultaSimpleFila(
                         "SELECT stock_actual FROM articulo WHERE id=?",
                         [$d['articulo_id']]
                       );
                if (($info['stock_actual'] ?? 0) < $d['cantidad'])
                    throw new Exception('Stock insuficiente');

                ejecutarConsulta(
                    "INSERT INTO detalle_comprobante
                       (comprobante_id,articulo_id,cantidad,
                        precio_unitario,subtotal,igv,total)
                     VALUES (?,?,?,?,?,?,?)",
                    [$compId,$d['articulo_id'],$d['cantidad'],
                     $d['precio_unitario'],$d['subtotal'],
                     round($d['subtotal']*0.18,2),
                     round($d['subtotal']*1.18,2)]
                );

                /*‒ movimiento de salida */
                $alm->registrarSalidaVenta([
                    'articulo_id'   => $d['articulo_id'],
                    'cantidad'      => $d['cantidad'],
                    'precio_unitario'=> $d['precio_unitario'],
                    'referencia'    => "$serie-$numero",
                    'usuario_id'    => $_SESSION['user_id'] ?? 1
                ]);
            }

            $conexion->commit();
            return $compId;

        } catch (Exception $e){
            $conexion->rollback();
            logError($e->getMessage());
            return 0;
        }
    }

    public function anular(int $id): bool
    {
        return ejecutarConsulta(
           "UPDATE comprobante_electronico
               SET estado='Anulado',
                   observaciones='Anulado por usuario',
                   updated_at=NOW()
             WHERE id=?", [$id]
        );
    }

    public function listar(): array
    {
        return ejecutarConsultaArray(
            "SELECT ce.*,
                    c.razon_social
               FROM comprobante_electronico ce
          INNER JOIN cliente c ON c.id = ce.cliente_id
           ORDER BY ce.id DESC"
        );
    }
}
