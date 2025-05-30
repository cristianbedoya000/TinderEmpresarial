CREATE TABLE clientes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    imagen VARCHAR(255),
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    industria VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    pais VARCHAR(50) NOT NULL,
    ciudad VARCHAR(50) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    intereses ENUM('Alianza', 'Invertir', 'Ambos') NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

likes (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_emisor INT,
  id_receptor INT,
  fecha DATETIME,
  FOREIGN KEY (id_emisor) REFERENCES clientes(id),
  FOREIGN KEY (id_receptor) REFERENCES clientes(id)
);

matches (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_cliente1 INT,
  id_cliente2 INT,
  fecha DATETIME
);

mensajes (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_match INT,
  emisor INT,
  mensaje TEXT,
  fecha DATETIME
);
