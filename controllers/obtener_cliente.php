<?php 
header("content-Type: application/json");

include '../includes/conexion.php';
session_start();

if (!$conexion) {
    die(json_encode(["error" => "Conexión fallida"]));
}

$sql = "SELECT id, imagen, nombre, industria, pais, ciudad, intereses FROM clientes ORDER BY RAND() LIMIT 1";
$result = $conexion->query($sql);

if ($result && $result->num_rows > 0) {
    $cliente = $result->fetch_assoc();

    $respuesta = [
        "cliente" => $cliente,
        "usuario_actual" =>isset($_SESSION['id']) ? $_SESSION['id'] : null
    ];
    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(["error" => "No se encontraron clientes"]);
}

$conexion->close();

?>