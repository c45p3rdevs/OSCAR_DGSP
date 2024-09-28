<?php
require_once '../src/controllers/ReporteController.php';
$reporteController = new ReporteController($con);
$reportes = $reporteController->listarReportes();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estado de Reportes</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h1>Estado de Reportes</h1>
    <table id="reportes-table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Fecha de Creación</th>
                <th>Actualizar Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reportes as $reporte): ?>
                <tr data-reporte-id="<?php echo $reporte['id']; ?>">
                    <td><?php echo $reporte['titulo']; ?></td>
                    <td><?php echo $reporte['descripcion']; ?></td>
                    <td class="estado"><?php echo $reporte['estado']; ?></td>
                    <td><?php echo $reporte['fecha_creacion']; ?></td>
                    <td>
                        <select class="estado-select">
                            <option value="Pendiente" <?php if ($reporte['estado'] == 'Pendiente') echo 'selected'; ?>>Pendiente</option>
                            <option value="En Proceso" <?php if ($reporte['estado'] == 'En Proceso') echo 'selected'; ?>>En Proceso</option>
                            <option value="Completado" <?php if ($reporte['estado'] == 'Completado') echo 'selected'; ?>>Completado</option>
                            <option value="Error" <?php if ($reporte['estado'] == 'Error') echo 'selected'; ?>>Error</option>
                        </select>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
    $(document).ready(function() {
        $('.estado-select').on('change', function() {
            var estado = $(this).val();
            var reporteId = $(this).closest('tr').data('reporte-id');
            
            $.ajax({
                url: '/src/controllers/ReporteController.php',
                type: 'POST',
                data: {
                    reporte_id: reporteId,
                    estado: estado,
                    action: 'actualizarEstado'
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    alert(data.message);
                    $('tr[data-reporte-id="' + reporteId + '"] .estado').text(estado);
                },
                error: function() {
                    alert('Error al actualizar el estado.');
                }
            });
        });
    });
    </script>
</body>
</html>

