<?php
require_once __DIR__ . '/../config/Conexion.php';
require_once __DIR__ . '/../modelos/PlantillaHoras.php';
header('Content-Type: application/json; charset=utf-8');

$ph = new PlantillaHoras();

switch ($_GET['op']) {
    case 'listar':
        $rspta = $ph->listar();
        $data  = [];
        while ($reg = $rspta->fetch_object()) {
            $data[] = [
                $reg->id,
                $reg->horas,
                htmlspecialchars($reg->descripcion)
            ];
        }
        echo json_encode(["data" => $data]);
        break;

    case 'select':
        $rspta = $ph->select();
        while ($reg = $rspta->fetch_object()) {
            echo "<option value=\"{$reg->id}\">{$reg->horas} h</option>";
        }
        break;
}
