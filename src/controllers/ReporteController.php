<?php
require_once '../config/db.php';
require_once '../models/Reporte.php';
require_once '../vendor/phpmailer/PHPMailerAutoload.php';

class ReporteController {
    private $reporteModel;

    public function __construct($db) {
        $this->reporteModel = new Reporte($db);
    }

    public function crearNuevoReporte() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario_id = $_POST['usuario_id'];
            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];

            if ($this->reporteModel->crearReporte($usuario_id, $titulo, $descripcion)) {
                echo json_encode(["message" => "Reporte creado exitosamente."]);
            } else {
                echo json_encode(["message" => "Error al crear el reporte."]);
            }
        }
    }

    public function actualizarEstadoReporte() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $reporte_id = $_POST['reporte_id'];
            $estado = $_POST['estado'];

            if ($this->reporteModel->actualizarEstado($reporte_id, $estado)) {
                $reporte = $this->reporteModel->obtenerReportePorId($reporte_id);
                $this->enviarNotificacion($reporte);
                echo json_encode(["message" => "Estado actualizado exitosamente."]);
            } else {
                echo json_encode(["message" => "Error al actualizar el estado."]);
            }
        }
    }

    public function enviarNotificacion($reporte) {
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com';  // Servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'tu_correo@example.com';  // Correo del remitente
        $mail->Password = 'tu_password';  // Contraseña del correo
        $mail->SMTPSecure = 'tl

