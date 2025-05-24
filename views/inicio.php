<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    
    <title>Document</title>

</head>
<body>
    <h2>hola</h2>
    <?php
    if (isset($_SESSION['nombre'])) {
        echo "<h3>Bienvenido, " . $_SESSION['nombre'] . "!</h3>";
    } else {
        echo "<h3>No has iniciado sesión.</h3>";
    }
    ?>
    
</body>
</html>