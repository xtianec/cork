<?php
require_once __DIR__.'/../config/Conexion.php';
require_once 'Audit.php';

class Modulo
{
    /* ────────── CRUD ────────── */

    public function listar(): array
    {
        return ejecutarConsultaArray(
          "SELECT id,nombre,ruta,COALESCE(is_active,0) AS estado
             FROM modulo
         ORDER BY id DESC");
    }

    public function mostrar(int $id): ?array
    {
        return ejecutarConsultaSimpleFila(
          "SELECT id,nombre,ruta,COALESCE(is_active,0) AS estado
             FROM modulo WHERE id=?",[$id]) ?: null;
    }

    public function insertar(array $d): bool
    {
        $ok = ejecutarConsulta(
          "INSERT INTO modulo(nombre,ruta,is_active,created_at)
           VALUES (?,?,?,NOW())",
          [$d['nombre'],$d['ruta'],$d['estado']]
        );
        if($ok) Audit::log('modulo',$GLOBALS['conexion']->insert_id,'CREATE',$d);
        return $ok;
    }

    public function editar(int $id,array $d): bool
    {
        $set = isset($d['nombre']) ? "nombre=?,ruta=?,is_active=?" : "is_active=?";
        $sql = "UPDATE modulo SET $set, updated_at=NOW() WHERE id=?";
        $params = isset($d['nombre'])
                ? [$d['nombre'],$d['ruta'],$d['estado'],$id]
                : [$d['estado'],$id];
        $ok = ejecutarConsulta($sql,$params);
        if($ok) Audit::log('modulo',$id,'UPDATE',$d);
        return $ok;
    }

    public function cambiarEstado(int $id,int $estado): bool
    {
        return $this->editar($id,['estado'=>$estado]);
    }

    public function eliminar(int $id): bool
    {
        $ok = ejecutarConsulta("DELETE FROM modulo WHERE id=?",[$id]);
        if($ok) Audit::log('modulo',$id,'DELETE');
        return $ok;
    }
}
