<?php
require_once __DIR__ . '/../config/Conexion.php';

class PlanServicio
{
    public function insertar($descripcion)
    {
        $descripcion = limpiarCadena($descripcion);
        $plan_id     = $this->generarId();
        $sql = "INSERT INTO planes_servicio (plan_id, plan_desc) VALUES (?, ?)";
        return ejecutarConsulta($sql, [$plan_id, $descripcion]);
    }

    private function generarId()
    {
        $sql  = "SELECT MAX(plan_id) AS max_id FROM planes_servicio";
        $resp = ejecutarConsultaSimpleFila($sql);
        $max  = $resp['max_id'] ?? null;

        // Si no existe ningún registro empezamos desde 'A'
        if (!$max) {
            return 'A';
        }

        // Permitir IDs alfabéticos de hasta dos caracteres (A..Z, AA..ZZ)
        $alphabet = range('A', 'Z');
        $chars    = str_split($max);
        $carry    = true;
        for ($i = count($chars) - 1; $i >= 0 && $carry; $i--) {
            $pos = array_search($chars[$i], $alphabet, true);
            if ($pos === false) {
                $chars[$i] = 'A';
                $carry     = false;
            } elseif ($pos === 25) { // Z
                $chars[$i] = 'A';
                $carry     = true;
            } else {
                $chars[$i] = $alphabet[$pos + 1];
                $carry     = false;
            }
        }
        if ($carry) {
            array_unshift($chars, 'A');
        }

        // Limitar a 2 caracteres para evitar claves largas
        return substr(implode('', $chars), -2);
    }

    public function editar($plan_id, $descripcion)
    {
        $plan_id     = limpiarCadena($plan_id);
        $descripcion = limpiarCadena($descripcion);
        $sql = "UPDATE planes_servicio SET plan_desc = ? WHERE plan_id = ?";
        return ejecutarConsulta($sql, [$descripcion, $plan_id]);
    }

    public function eliminar($plan_id)
    {
        $plan_id = limpiarCadena($plan_id);
        $sql = "DELETE FROM planes_servicio WHERE plan_id = ?";
        return ejecutarConsulta($sql, [$plan_id]);
    }

    public function mostrar($plan_id)
    {
        $plan_id = limpiarCadena($plan_id);
        $sql = "SELECT plan_id, plan_desc FROM planes_servicio WHERE plan_id = ?";
        return ejecutarConsultaSimpleFila($sql, [$plan_id]);
    }

    public function listar()
    {
        $sql = "SELECT plan_id, plan_desc FROM planes_servicio ORDER BY plan_id";
        return ejecutarConsulta($sql);
    }

    public function listarCombo()
    {
        $sql = "SELECT plan_id, plan_desc FROM planes_servicio ORDER BY plan_id";
        return ejecutarConsultaArray($sql);
    }
}
?>
