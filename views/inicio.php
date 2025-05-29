<?php
session_start();
    if (isset($_SESSION['nombre'])) {
        echo "<h3>Bienvenido, " . $_SESSION['nombre'] . "!</h3>";
    } else {
        echo "<h3>No has iniciado sesión.</h3>";
    }
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
    <link rel="stylesheet" href="../styles/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
</head>
<body>  

<?php include '../includes/navbar.php'?>

<div class="inicio-container">
  <div class="shadow">
    <main>
      <section>
        <div class="white-bkg"></div>

        <header>
          <img src="" alt="Tinder Logo" />
        </header>

        <div class="cards">
        </div>
        <footer>
          <button class="is-undo" aria-label="undo"></button>
          <button class="is-remove is-big" aria-label="remove"></button>
          <button class="is-star" aria-label="star"></button>
          <button class="is-fav is-big" aria-label="fav"></button>
          <button class="is-zap" aria-label="zap"></button>
        </footer>
      </section>
    </main>
  </div>
</div>
    
    
    <script src="../js/swipe.js"></script>
</body>
</html>