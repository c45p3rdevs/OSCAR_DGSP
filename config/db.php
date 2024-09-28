<?php
$host = "localhost";
$db = "sistema_reportes";
$user = "root";
$pass = "";

$con = new mysqli($host, $user, $pass, $db);

if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
}
?>
