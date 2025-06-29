<?php
include '../includes/conexion.php';
session_start();

if (isset($_POST['Register'])) {

    /*
    // Recoger datos del formulario
    $fotoperfil = isset($_FILES['imagen']['name']) ? $_FILES['imagen']['name'] : null;*/
 // Obtener el nombre del archivo subido
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = $_POST['contraseña'];
    $industria = $_POST['industria'];
    $descripcion = !empty($_POST['descripcion']) ? $_POST['descripcion'] : 
    $pais = $_POST['pais'];
    $ciudad = $_POST['ciudad'];
    $direccion = $_POST['direccion'];
    $intereses = $_POST['intereses'];
    

    // Validación de contraseña: mínimo 8 caracteres, una mayúscula y un carácter especial
    if (!preg_match("/^(?=.*[A-Z])(?=.*\W).{8,}$/", $password)) {
        echo "<script>alert('La contraseña debe tener al menos 8 caracteres, una letra mayúscula y un carácter especial.');</script>";
        exit();
    }

    // Hash de la contraseña para mayor seguridad
    $contraseñaHash = password_hash($password, PASSWORD_DEFAULT);

    // Verificar si el correo ya está registrado con consulta preparada
    $checkEmail = "SELECT 1 FROM clientes WHERE correo = ?";
    $stmt = $conexion->prepare($checkEmail);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('¡Email ya registrado!');</script>";
        exit();
    }

    if (!isset($_FILES['imagen']) || $_FILES['imagen']['error'] != 0) {
        echo "<script>alert('Es obligatorio subir una imagen.');</script>";
        exit();
    }

    $directorioDestino = "../uploads/";

    if (!is_dir($directorioDestino)) {
        mkdir($directorioDestino, 0777, true); // Crear la carpeta si no existe
    }

    // Mover la imagen a una carpeta segura antes de guardarla en la base de datos
    $fotoperfil = basename($_FILES['imagen']['name']);
    $rutaImagen = $directorioDestino . $fotoperfil;

    if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
        echo "<script>alert('Error al mover la imagen');</script>";
        exit();
    }

    echo "<script>console.log('Imagen subida correctamente: " . $rutaImagen . "');</script>";

    // Insertar usuario en la base de datos con consulta preparada
    $insertQuery = "INSERT INTO clientes (imagen, nombre, correo, contraseña, industria, descripcion, pais, ciudad, direccion, intereses) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($insertQuery);
    $stmt->bind_param("ssssssssss", $rutaImagen, $nombre, $correo, $contraseñaHash, $industria, $descripcion, $pais, $ciudad, $direccion, $intereses);

    if (!$stmt->execute()) {
        die("Error en la inserción: " . $stmt->error);
    }
    echo "<script>console.log('Ruta guardada en la base de datos: " . $rutaImagen . "');</script>";
    header("Location: ../views/Inicio.php");
    exit();
}

if(isset($_POST['Login'])){
    $correo = $_POST['correo'];
    $password = $_POST['contraseña'];

    $sql="SELECT id, imagen, nombre, correo, contraseña, industria, descripcion, pais, ciudad, direccion, intereses FROM clientes WHERE correo = ?";
    $stmt=$conexion->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result-> num_rows > 0){
        $row = $result->fetch_assoc();

        if(password_verify($password, $row['contraseña'])){
            session_regenerate_id();


            $_SESSION['id'] = $row['id'];
            $_SESSION['imagen'] = $row['imagen'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['correo'] = $row['correo'];
            $_SESSION['industria'] = $row['industria'];
            $_SESSION['descripcion'] = $row['descripcion'];
            $_SESSION['pais'] = $row['pais'];
            $_SESSION['ciudad'] = $row['ciudad'];
            $_SESSION['direccion'] = $row['direccion'];
            $_SESSION['intereses'] = $row['intereses'];

            header("Location: ../views/inicio.php");
            exit();
        
        } else {

        echo "<script>alert('¡Contraseña incorrecta!');</script>";
        }
    } else {

        echo "<script>alert('¡Usuario No Encontrado!');</script>";
    }

    $stmt->close();
    $conexion->close();

}

?>
