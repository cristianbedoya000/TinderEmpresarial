<?php
$data = json_decode(file_get_contents("php://input"), true);
file_put_contents("debug.txt", print_r($data, true), FILE_APPEND);


header('Content-Type: application/json');
include '../includes/conexion.php';

$data = json_decode(file_get_contents("php://input"), true);
if (!$data) {
    echo json_encode(["status" => "error", "message" => "No se recibieron datos en la solicitud."]);
    exit();
}
$idEmisor = $data['idEmisor'] ?? null;
$idReceptor = $data['clienteId'] ?? null;
$accion = $data['accion'] ?? null;

// Validación
if (!$idEmisor || !$idReceptor || !$accion) {
    echo json_encode(["status" => "error", "message" => "Datos incompletos"]);
    exit();
}

if ($accion === "like") {
    // Verificar si ya existe este like (opcional para evitar duplicados)
    $checkSql = "SELECT * FROM likes WHERE id_emisor = ? AND id_receptor = ?";
    $stmtCheck = $conexion->prepare($checkSql);
    $stmtCheck->bind_param("ii", $idEmisor, $idReceptor);
    $stmtCheck->execute();
    $checkResult = $stmtCheck->get_result();

    if ($checkResult->num_rows === 0) {
        // Registrar like
        $insertSql = "INSERT INTO likes (id_emisor, id_receptor, fecha) VALUES (?, ?, NOW())";
        $stmtInsert = $conexion->prepare($insertSql);
        $stmtInsert->bind_param("ii", $idEmisor, $idReceptor);
        $stmtInsert->execute();
        $stmtInsert->close();
    }

    $stmtCheck->close();

    // Verificar si hay match (el receptor también dio like al emisor)
    $matchSql = "SELECT id FROM likes WHERE id_emisor = ? AND id_receptor = ?";
    $stmtMatch = $conexion->prepare($matchSql);
    $stmtMatch->bind_param("ii", $idReceptor, $idEmisor);
    $stmtMatch->execute();
    $matchResult = $stmtMatch->get_result();

    if ($matchResult->num_rows > 0) {
        echo json_encode(["status" => "match", "message" => "¡Es un match!"]);
    } else {
        echo json_encode(["status" => "success", "message" => "Like registrado"]);
    }

    $stmtMatch->close();
    $conexion->close();
    exit();
}

if ($accion === "dislike") {
    // Solo un mensaje, no guardamos nada por ahora
    echo json_encode(["status" => "success", "message" => "Usuario ignorado"]);
    exit();
}

// Acción desconocida
echo json_encode(["status" => "error", "message" => "Acción no válida"]);
$conexion->close();
?>
