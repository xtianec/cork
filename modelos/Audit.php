<?php
require_once __DIR__.'/../config/Conexion.php';

class Audit
{
    public static function log(string $tabla,int $id,string $accion,array $det=[]): void
    {
        $uid = $_SESSION['user_id'] ?? null;
        ejecutarConsulta(
          "INSERT INTO audit_log(tabla,registro_id,accion,user_id,detalle)
           VALUES (?,?,?,?,?)",
          [$tabla,$id,$accion,$uid, json_encode($det,JSON_UNESCAPED_UNICODE)]
        );
    }
}
