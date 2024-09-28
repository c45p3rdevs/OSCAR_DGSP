<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Reporte</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <h1>Crear Nuevo Reporte</h1>
    <form action="/src/controllers/ReporteController.php" method="POST">
        <input type="hidden" name="usuario_id" value="1"> <!-- Usuario predefinido -->
        <label for="titulo">Título del Reporte:</label>
        <input type="text" name="titulo" id="titulo" required>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" required></textarea>

        <button type="submit">Crear Reporte</button>
    </form>
</body>
</html>
