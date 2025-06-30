<?php
require_once __DIR__.'/../config/Conexion.php';
require_once 'Audit.php';

class Rol
{
    /* ── helpers de unicidad ── */
    private function nameExists(string $n,int $ignore=0): bool
    {
        return (bool) ejecutarConsultaSimpleFila(
            "SELECT id FROM rol
             WHERE nombre=? AND id<>? AND deleted_at IS NULL",
            [$n,$ignore]);
    }

    /* ── CRUD ── */

    public function listar(): array
    {
        return ejecutarConsultaArray(
          "SELECT id,nombre,COALESCE(is_active,0) estado,deleted_at
             FROM rol WHERE deleted_at IS NULL
         ORDER BY id DESC");
    }

    public function mostrar(int $id): ?array
    {
        return ejecutarConsultaSimpleFila(
          "SELECT id,nombre,COALESCE(is_active,0) estado
             FROM rol WHERE id=?",[$id]) ?: null;
    }

    public function insertar(array $d): bool
    {
        if($this->nameExists($d['nombre'])) return false;

        $ok = ejecutarConsulta(
          "INSERT INTO rol(nombre,is_active,created_at)
           VALUES (?,?,NOW())",
          [$d['nombre'],$d['estado']]
        );
        if($ok) Audit::log('rol',$GLOBALS['conexion']->insert_id,'CREATE',$d);
        return $ok;
    }

    public function editar(int $id,array $d): bool
    {
        if(isset($d['nombre']) && $this->nameExists($d['nombre'],$id)) return false;

        $set = isset($d['nombre']) ? "nombre=?,is_active=?" : "is_active=?";
        $params = isset($d['nombre'])
                ? [$d['nombre'],$d['estado'],$id]
                : [$d['estado'],$id];
        $ok = ejecutarConsulta("UPDATE rol SET $set, updated_at=NOW() WHERE id=?",$params);
        if($ok) Audit::log('rol',$id,'UPDATE',$d);
        return $ok;
    }

    public function cambiarEstado(int $id,int $estado): bool
    {
        return $this->editar($id,['estado'=>$estado]);
    }

    /* soft-delete */
    public function trash(int $id): bool
    {
        $ok = ejecutarConsulta("UPDATE rol SET deleted_at=NOW() WHERE id=?",[$id]);
        if($ok) Audit::log('rol',$id,'DELETE');
        return $ok;
    }
    public function restore(int $id): bool
    {
        $ok = ejecutarConsulta("UPDATE rol SET deleted_at=NULL WHERE id=?",[$id]);
        if($ok) Audit::log('rol',$id,'RESTORE');
        return $ok;
    }
}
