-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 19-02-2023 a las 18:17:38
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
-- Base de datos: `apirestdwes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `player`
-- Tabla con los datos de los jugadores con los que trabaja la API
--

CREATE TABLE `player` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `player_name` varchar(60) NOT NULL,
  `player_mins` float(3,1) DEFAULT NULL,
  `player_pts` float(3,1) DEFAULT NULL,
  `player_asist` float(3,1) DEFAULT NULL,
  `player_reb` float(3,1) DEFAULT NULL,
  `player_tap` float(3,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `player`
--

INSERT INTO `player` (`id`, `player_name`, `player_mins`, `player_pts`, `player_asist`, `player_reb`, `player_tap`) VALUES
(1, 'Magic Johnson', 32.0, 21.0, 13.0, 8.0, 2.0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
-- Tabla que se utiliza para la autentificación
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `disponible` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
-- Usuario: prueba
-- Password: prueba
--

INSERT INTO `usuario` (`id`, `username`, `password`, `token`, `nombres`, `disponible`) VALUES
(100, 'prueba', '655e786674d9d3e77bc05ed1de37b4b6bc89f788829f9f3c679e7687b410c89b', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2NzY4MjE5OTQsImRhdGEiOnsiaWQiOiIxMDAiLCJub21icmVzIjoiVXN1YXJpbyBkZSBQcnVlYmEifX0.FkZ6NkKu9pLhkDHNjDPhLh4Lt-6Y9yb4r4hqZAhuRcE', 'Usuario de Prueba', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `player`
--
ALTER TABLE `player`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
