<?php
require_once __DIR__ . '/../config/Conexion.php';

class GuiaRemisionElectronica {
  
  public function insertar($data) {
    $sql = "INSERT INTO guia_remision_electronica 
      (serie, numero, fecha_emision, cliente_id, direccion_partida, direccion_llegada, motivo_traslado, modalidad_traslado, transportista_ruc, placa_vehiculo)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    return ejecutarConsulta_retornarID($sql, [
      $data['serie'], $data['numero'], $data['fecha_emision'], $data['cliente_id'], 
      $data['direccion_partida'], $data['direccion_llegada'], 
      $data['motivo_traslado'], $data['modalidad_traslado'], 
      $data['transportista_ruc'], $data['placa_vehiculo']
    ]);
  }

  public function listar() {
    $sql = "SELECT g.*, c.nombre cliente FROM guia_remision_electronica g JOIN cliente c ON g.cliente_id = c.id ORDER BY g.id DESC";
    return ejecutarConsultaArray($sql);
  }

  public function mostrar($id) {
    $sql = "SELECT * FROM guia_remision_electronica WHERE id=?";
    return ejecutarConsultaSimpleFila($sql, [$id]);
  }

  public function eliminar($id) {
    $sql = "DELETE FROM guia_remision_electronica WHERE id=?";
    return ejecutarConsulta($sql, [$id]);
  }
}