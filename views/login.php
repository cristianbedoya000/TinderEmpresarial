<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <div class="container" id="Register" style="display: none;">
        <h1>Registrar Usuario</h1>
        <form action="../controllers/sesion.php" method="POST" enctype="multipart/form-data">
            <div class="input-group">
                <i class="fa-solid fa-image"></i>
                <input type="file" id="imagen" name="imagen" required><br>
            </div>
            <div class="input-group">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="nombre" id="nombre" placeholder="Ingrese nombre" required><br>
            </div>
            <div class="input-group">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="correo" id="correo" placeholder="Ingrese correo" required><br>
            </div>
            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="contraseña" id="contraseña" placeholder="Ingrese contraseña" required><br>
            </div>
            <div class="input-group">
                <i class="fa-solid fa-industry"></i>
                <input type="text" name="industria" id="industria" placeholder="Industria" required><br>
            </div>
            <div class="input-group">
                <i class="fa-solid fa-quote-left"></i>
                <input type="text" name="descripción" id="descripción" placeholder="Descripción" required><br>
            </div>
            <div class="input-group">
                <i class="fa-solid fa-map"></i>
                <select name="pais" id="pais" required>
                    <option value="">Seleccione un país</option>
                    <option value="Estados Unidos">Estados Unidos</option>
                    <option value="China">China</option>
                    <option value="India">India</option>
                    <option value="Alemania">Alemania</option>
                    <option value="Reino Unido">Reino Unido</option>
                    <option value="Francia">Francia</option>
                    <option value="Japón">Japón</option>
                    <option value="Brasil">Brasil</option>
                    <option value="Canadá">Canadá</option>
                    <option value="Italia">Italia</option>
                    <option value="Rusia">Rusia</option>
                    <option value="Corea del Sur">Corea del Sur</option>
                    <option value="México">México</option>
                    <option value="Indonesia">Indonesia</option>
                    <option value="Australia">Australia</option>
                    <option value="España">España</option>
                    <option value="Arabia Saudita">Arabia Saudita</option>
                    <option value="Sudáfrica">Sudáfrica</option>
                    <option value="Turquía">Turquía</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Colombia">Colombia</option>
                    <option value="Chile">Chile</option>
                    <option value="Emiratos Árabes Unidos">Emiratos Árabes Unidos</option>
                    <option value="Egipto">Egipto</option>
                    <option value="Nigeria">Nigeria</option>
                    <option value="Vietnam">Vietnam</option>
                    <option value="Tailandia">Tailandia</option>
                    <option value="Países Bajos">Países Bajos</option>
                    <option value="Suiza">Suiza</option>
                    <option value="Singapur">Singapur</option>
                    <option value="Suecia">Suecia</option>
                </select>
            </div>
            <div class="input-group">
                <i class="fa-solid fa-city"></i>
                <select name="ciudad" id="ciudad" required>
                    <option value="">Seleccione una ciudad</option>
                </select>
            </div>
            <div class="input-group">
                <i class="fa-solid fa-location-dot"></i>
                <input type="text" name="direccion" id="direccion" placeholder="Dirección específica" required><br>
            </div>
            <div class="input-group">
                <i class="fa-solid fa-heart"></i>
                <select name="intereses" id="intereses">
                    <option value="Alianza">Alianza</option>
                    <option value="Invertir">Invertir</option>
                    <option value="Ambos">Ambos</option>
                </select>
            </div>
            <button type="submit" class="btn" name="Register" value="Registrarse">Registrarse</button>
        </form>
        <div>
            <p>Ya tienes una cuenta?</p>
            <button class="btn-or" id="LoginBtn">Iniciar Sesion</button>
        </div>
    </div>

    <div class="container" id="Login">
        <h1>Iniciar Sesion</h1>
        <form action="../controllers/sesion.php" method="POST">
            <div class="input-group">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="correo" id="correo" placeholder="Ingrese correo" required><br>
            </div>
            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="contraseña" id="contraseña" placeholder="Ingrese contraseña" required><br>
            </div>
            <button type="submit" class="btn" name="Login" value="Login">Iniciar Sesion</button>
        </form>
        <div>
            <p>Necesitas una cuenta?</p>
            <button class="btn-or" id="RegisterBtn">Registrarse</button>
        </div>
    </div>
    <script src="../js/ciudades.js"></script>
    <script src="../js/form-login.js"></script>
    
</body>
</html>