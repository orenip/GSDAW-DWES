-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 15-02-2024 a las 22:36:54
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ej1inmobiliaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmueble`
--

CREATE TABLE `inmueble` (
  `id` int(11) NOT NULL COMMENT 'Identificador del inmueble',
  `inm_referencia` varchar(8) NOT NULL COMMENT 'Referencia del inmueble',
  `inm_descripcion` varchar(100) NOT NULL COMMENT 'Descripción del inmueble',
  `inm_habitaciones` int(11) NOT NULL COMMENT 'Número de habitaciones del inmueble',
  `inm_precio` int(11) NOT NULL COMMENT 'Precio del inmueble en euros.',
  `inm_promocion` int(11) NOT NULL COMMENT 'Promoción a la que pertenece el inmueble'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inmueble`
--

INSERT INTO `inmueble` (`id`, `inm_referencia`, `inm_descripcion`, `inm_habitaciones`, `inm_precio`, `inm_promocion`) VALUES
(1, 'INM00101', 'Duplex adosado con garaje y piscina comunitaria', 4, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promocion`
--

CREATE TABLE `promocion` (
  `id` int(11) NOT NULL COMMENT 'Identificador de la promoción',
  `pro_nombre` varchar(100) NOT NULL COMMENT 'Nombre de la promoción',
  `pro_lon` float DEFAULT NULL COMMENT 'Longitud (coordenadas) de la promoción',
  `pro_lat` float DEFAULT NULL COMMENT 'Latitud (coordenadas) de la promoción'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `promocion`
--

INSERT INTO `promocion` (`id`, `pro_nombre`, `pro_lon`, `pro_lat`) VALUES
(1, 'Urbanización Entre Jardines', 38.1608, -1.20538);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `inmueble`
--
ALTER TABLE `inmueble`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_referencia_inmueble` (`inm_referencia`),
  ADD KEY `fk_inmueble_promocion` (`inm_promocion`);

--
-- Indices de la tabla `promocion`
--
ALTER TABLE `promocion`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `inmueble`
--
ALTER TABLE `inmueble`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del inmueble', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `promocion`
--
ALTER TABLE `promocion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la promoción', AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inmueble`
--
ALTER TABLE `inmueble`
  ADD CONSTRAINT `fk_inmueble_promocion` FOREIGN KEY (`inm_promocion`) REFERENCES `promocion` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
