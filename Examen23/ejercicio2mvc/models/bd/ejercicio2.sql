-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 07-12-2023 a las 00:49:01
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
-- Base de datos: `ejercicio2`
--
CREATE DATABASE IF NOT EXISTS `ejercicio2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ejercicio2`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `cod_curso` int(11) NOT NULL,
  `desc_curso` varchar(75) NOT NULL,
  `nivel_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`cod_curso`, `desc_curso`, `nivel_curso`) VALUES
(1, '1º ESO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo_docente`
--

CREATE TABLE `equipo_docente` (
  `curso_equipo` int(11) NOT NULL,
  `profesor_equipo` int(11) NOT NULL,
  `materia_equipo` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipo_docente`
--

INSERT INTO `equipo_docente` (`curso_equipo`, `profesor_equipo`, `materia_equipo`) VALUES
(1, 1, 'TIC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_educativo`
--

CREATE TABLE `nivel_educativo` (
  `cod_nivel` int(11) NOT NULL,
  `desc_nivel` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `nivel_educativo`
--

INSERT INTO `nivel_educativo` (`cod_nivel`, `desc_nivel`) VALUES
(1, 'ESO'),
(2, 'FP Básica'),
(3, 'FP Grado Medio'),
(4, 'FP Grado Superior'),
(5, 'Bachillerato');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `cod_profesor` int(11) NOT NULL,
  `nombre_profesor` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`cod_profesor`, `nombre_profesor`) VALUES
(1, 'Juan A Lopez Soro');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`cod_curso`),
  ADD KEY `fk_curso_nivel_educativo` (`nivel_curso`);

--
-- Indices de la tabla `equipo_docente`
--
ALTER TABLE `equipo_docente`
  ADD PRIMARY KEY (`curso_equipo`,`profesor_equipo`),
  ADD KEY `fk_equipo_profesor` (`profesor_equipo`);

--
-- Indices de la tabla `nivel_educativo`
--
ALTER TABLE `nivel_educativo`
  ADD PRIMARY KEY (`cod_nivel`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`cod_profesor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `cod_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `nivel_educativo`
--
ALTER TABLE `nivel_educativo`
  MODIFY `cod_nivel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `cod_profesor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `fk_curso_nivel_educativo` FOREIGN KEY (`nivel_curso`) REFERENCES `nivel_educativo` (`cod_nivel`);

--
-- Filtros para la tabla `equipo_docente`
--
ALTER TABLE `equipo_docente`
  ADD CONSTRAINT `fk_equipo_curso` FOREIGN KEY (`curso_equipo`) REFERENCES `curso` (`cod_curso`),
  ADD CONSTRAINT `fk_equipo_profesor` FOREIGN KEY (`profesor_equipo`) REFERENCES `profesor` (`cod_profesor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
