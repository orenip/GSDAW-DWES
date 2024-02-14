START TRANSACTION;

-- FILEPATH: /C:/xampp/htdocs/DWES/dwes06 - API REST/apirestcrud/bbdd/almacen.sql

CREATE DATABASE IF NOT EXISTS almacen;

-- Use the almacen database
USE almacen;

-- Create the articulo table
CREATE TABLE IF NOT EXISTS articulo (
  art_id INT AUTO_INCREMENT PRIMARY KEY,
  art_nombre VARCHAR(50),
  art_categoria INT,
  art_cantidad INT
);

-- Create the categoria table
CREATE TABLE IF NOT EXISTS categoria (
  cat_id INT AUTO_INCREMENT PRIMARY KEY,
  cat_nombre VARCHAR(50)
);

-- Add foreign key constraint to the articulo table
ALTER TABLE articulo
ADD CONSTRAINT fk_articulo_categoria
FOREIGN KEY (art_categoria)
REFERENCES categoria(cat_id);

-- Insert some data into the categoria table
INSERT INTO categoria (cat_nombre)
VALUES ('Electrodomésticos'),
       ('Informática'),
       ('Móviles'),
       ('Televisores'),
       ('Videojuegos'),
       ('Cámaras');

-- Insert some data into the articulo table
INSERT INTO articulo (art_nombre, art_categoria, art_cantidad)
VALUES ('Lavadora', 1, 10),
       ('Frigorífico', 1, 5),
       ('Lavavajillas', 1, 2),
       ('Ordenador sobremesa', 2, 20),
       ('Ordenador portátil', 2, 15),
       ('SmartPhone', 3, 30),
       ('Televisor plano', 4, 10),
       ('PlayStation 5', 5, 20),
       ('Xbox', 5, 15),
       ('Cámara 50MP', 6, 10);

-- COMMIT the transaction
COMMIT;
