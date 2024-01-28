-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS almacen;

-- Conectar o seleccionar la base de datos
USE almacen;

-- Crear la tabla "categoria"
CREATE TABLE categoria (
    cat_id INT AUTO_INCREMENT PRIMARY KEY,
    cat_nombre VARCHAR(50)
);
-- Crear la tabla "articulo"
CREATE TABLE articulo (
    art_id INT AUTO_INCREMENT PRIMARY KEY,
    art_nombre VARCHAR(50),
    art_categoria INT,
    art_cantidad INT,
    FOREIGN KEY (art_categoria) REFERENCES categoria(cat_id)
);

-- Insertar algunas categorías de ejemplo en la tabla "categoria"
INSERT INTO categoria (cat_nombre) VALUES
    ('Alimentación'),
    ('Electrónica'),
    ('Ropa');

-- Crear el usuario si no existe
CREATE USER IF NOT EXISTS 'super'@'localhost' IDENTIFIED BY '123456';

-- Otorgar todos los privilegios a la base de datos 'almacen' al usuario 'super'
GRANT ALL PRIVILEGES ON almacen.* TO 'super'@'localhost';

-- Actualizar los privilegios
FLUSH PRIVILEGES;
