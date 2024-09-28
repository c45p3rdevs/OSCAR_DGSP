<?php
class Reporte {
    private $con;

    public function __construct($db) {
        $this->con = $db;
    }

    public function crearReporte($usuario_id, $titulo, $descripcion) {
        $stmt = $this->con->prepare("INSERT INTO reportes (usuario_id, titulo, descripcion, estado) VALUES (?, ?, ?, 'Pendiente')");
        $stmt->bind_param("iss", $usuario_id, $titulo, $descripcion);
        return $stmt->execute();
    }

    public function actualizarEstado($reporte_id, $estado) {
        $stmt = $this->con->prepare("UPDATE reportes SET estado = ? WHERE id = ?");
        $stmt->bind_param("si", $estado, $reporte_id);
        return $stmt->execute();
    }

    public function obtenerReportes() {
        $result = $this->con->query("SELECT * FROM reportes");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerReportePorId($id) {
        $stmt = $this->con->prepare("SELECT * FROM reportes WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>
