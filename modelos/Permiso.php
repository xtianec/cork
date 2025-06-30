<?php
require_once __DIR__.'/../config/Conexion.php';
require_once 'Audit.php';

class Permiso
{
    public function listar(): array
    {
        return ejecutarConsultaArray(
          "SELECT p.id,p.modulo_id,m.nombre AS modulo,p.accion,
                  COALESCE(p.is_active,0) estado
             FROM permiso p
             JOIN modulo m ON m.id=p.modulo_id
         ORDER BY p.id DESC");
    }

    public function mostrar(int $id): ?array
    {
        return ejecutarConsultaSimpleFila(
          "SELECT id,modulo_id,accion,COALESCE(is_active,0) estado
             FROM permiso WHERE id=?",[$id]) ?: null;
    }

    public function insertar(array $d): bool
    {
        $ok = ejecutarConsulta(
          "INSERT INTO permiso(modulo_id,accion,is_active,created_at)
           VALUES (?,?,?,NOW())",
          [$d['modulo_id'],$d['accion'],$d['estado']]
        );
        if($ok) Audit::log('permiso',$GLOBALS['conexion']->insert_id,'CREATE',$d);
        return $ok;
    }

    public function editar(int $id,array $d): bool
    {
        $set = isset($d['accion'])
              ? "modulo_id=?,accion=?,is_active=?" : "is_active=?";
        $params = isset($d['accion'])
                ? [$d['modulo_id'],$d['accion'],$d['estado'],$id]
                : [$d['estado'],$id];
        $ok = ejecutarConsulta(
          "UPDATE permiso SET $set, updated_at=NOW() WHERE id=?", $params);
        if($ok) Audit::log('permiso',$id,'UPDATE',$d);
        return $ok;
    }

    public function cambiarEstado(int $id,int $estado): bool
    {
        return $this->editar($id,['estado'=>$estado]);
    }

    public function eliminar(int $id): bool
    {
        $ok = ejecutarConsulta("DELETE FROM permiso WHERE id=?",[$id]);
        if($ok) Audit::log('permiso',$id,'DELETE');
        return $ok;
    }
}
