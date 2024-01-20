-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-01-2024 a las 03:29:20
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `baloncesto2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240119184754', '2024-01-19 21:42:05', 574),
('DoctrineMigrations\\Version20240120002825', '2024-01-20 01:29:59', 62);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id` int(11) NOT NULL,
  `zona_id` int(11) NOT NULL,
  `nombre_equipo` varchar(40) NOT NULL,
  `presupuesto` int(11) NOT NULL,
  `fecha_fundacion` date NOT NULL,
  `titulos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id`, `zona_id`, `nombre_equipo`, `presupuesto`, `fecha_fundacion`, `titulos`) VALUES
(1, 3, 'Real Madrid', 25000000, '2023-10-30', 8),
(2, 4, 'Denver Nuggetstos', 844500005, '1968-09-17', 1),
(3, 1, 'Portland Trailblazers', 79150000, '1971-08-12', 1),
(4, 1, 'Utah Jazz', 87450000, '1974-07-22', 0),
(5, 1, 'Oklahoma City Thunder', 62450000, '2008-09-02', 0),
(6, 1, 'Minesotta Timberwolves', 75430000, '1968-09-14', 0),
(7, 2, 'Los Angeles Lakers', 92450000, '1951-09-03', 15),
(8, 2, 'Phoenix Suns', 89176000, '1967-08-12', 1),
(9, 2, 'Golden State Warriors', 66450000, '1970-07-22', 0),
(10, 2, 'Los Angeles Clippers', 82320000, '1967-08-02', 0),
(11, 2, 'Sacramento Kings', 69930000, '1964-07-23', 1),
(12, 3, 'San Antonio Spurs', 87320000, '1971-09-13', 4),
(13, 3, 'Houston Rockets', 79546000, '1972-08-21', 2),
(14, 3, 'Dallas Mavericks', 88430000, '1973-07-22', 0),
(15, 3, 'New Orleans Hornets', 80100000, '1974-08-23', 0),
(16, 3, 'Memphis Grizzlies', 70230000, '1975-07-24', 0),
(17, 4, 'Boston Celtics', 96320000, '1949-07-13', 18),
(18, 4, 'Philadelphia Sixers', 84566000, '1962-08-02', 1),
(19, 4, 'New Jersey Nets', 78640000, '1968-08-03', 0),
(20, 4, 'Toronto Raptors', 69860000, '1999-08-04', 0),
(21, 4, 'New York Knicks', 98240000, '1961-08-05', 2),
(22, 6, 'Cleveland Cavaliers', 96090000, '1970-08-11', 0),
(23, 6, 'Chicago Bulls', 82466000, '1971-09-12', 6),
(24, 6, 'Detroit Pistons', 89840000, '1968-07-13', 4),
(25, 6, 'Indiana Pacers', 77250000, '1978-07-14', 0),
(26, 6, 'Milwaukee Bucks', 70200000, '1981-07-15', 0),
(27, 5, 'Orlando Magic', 89650000, '2001-06-07', 0),
(28, 5, 'Atlanta Hawks', 80476000, '1964-08-07', 0),
(29, 5, 'Miami Heat', 79870000, '1988-08-09', 1),
(30, 5, 'Charlotte Bobcats', 65490000, '2004-09-08', 0),
(31, 5, 'Washington Wizards', 85410000, '1997-08-10', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `id` int(11) NOT NULL,
  `equipo_id` int(11) NOT NULL,
  `nombre_jugador` varchar(40) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `estatura` int(11) NOT NULL,
  `posicion` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`id`, `equipo_id`, `nombre_jugador`, `fecha_nacimiento`, `estatura`, `posicion`) VALUES
(1, 1, 'Denver', '2023-11-01', 15, 'Alero'),
(2, 2, 'Brandon Roy', '1989-02-04', 198, 'Alero'),
(3, 2, 'Andre Miller', '1984-12-24', 188, 'Base'),
(4, 2, 'Greg Oden', '1986-12-19', 213, 'Pivot'),
(5, 3, 'Andrei Kirilenko', '1985-03-01', 206, 'Alero'),
(6, 3, 'Kosta Koufos', '1983-07-22', 215, 'Pivot'),
(7, 4, 'James Harden', '1989-03-15', 196, 'Escolta'),
(8, 4, 'Jeff Green', '1988-03-03', 205, 'Alero'),
(9, 4, 'Ethan Thomas', '1984-11-17', 208, 'Ala-pivot'),
(10, 5, 'Wayne Ellington', '1981-04-23', 193, 'Base'),
(11, 5, 'Damien Wilkins', '1980-08-11', 198, 'Alero'),
(12, 5, 'Mark Blount', '1983-10-13', 215, 'Pivot'),
(13, 6, 'Manolo GIL', '2023-11-22', 170, 'Alero'),
(14, 7, 'Dereck Fisher', '1979-03-17', 192, 'Base'),
(15, 7, 'Kobe Bryant', '1981-11-13', 198, 'Escolta'),
(16, 7, 'Pau Gassol', '1982-08-16', 216, 'Ala-pivot'),
(17, 8, 'Steve Nash', '1977-09-01', 191, 'Base'),
(18, 8, 'Jason Richardson', '1979-04-08', 198, 'Alero'),
(19, 8, 'Channing Frye', '1988-01-31', 211, 'Ala-pivot'),
(20, 9, 'Monta Ellis', '1979-07-07', 190, 'Base'),
(21, 9, 'Anthony Randolph', '1982-12-13', 208, 'Alero'),
(22, 9, 'Brandan Wright', '1980-09-13', 208, 'Pivot'),
(23, 10, 'Bobby Brown', '1987-11-06', 178, 'Base'),
(24, 10, 'Ricky Davis', '1987-11-15', 201, 'Alero'),
(25, 10, 'Brandan Wright', '1980-09-13', 208, 'Pivot'),
(26, 11, 'Sergio Rodriguez', '1988-06-11', 191, 'Base'),
(27, 11, 'Tyreke Evans', '1989-08-13', 198, 'Alero'),
(28, 11, 'Spencer Hawes', '1984-10-22', 216, 'Pivot'),
(29, 12, 'Manu Ginobilli', '1982-04-17', 198, 'Escolta'),
(30, 12, 'Michael Finley', '1973-02-04', 201, 'Alero'),
(31, 12, 'Tim Duncan', '1975-01-25', 211, 'Ala-pivot'),
(32, 13, 'Aaron Brooks', '1986-05-02', 183, 'Base'),
(33, 13, 'Tracy McGrady', '1980-12-07', 203, 'Alero'),
(34, 13, 'Yao Ming', '1984-09-12', 229, 'Pivot'),
(35, 14, 'Jason Kidd', '1975-10-02', 193, 'Base'),
(36, 14, 'Shawn Marion', '1977-09-05', 201, 'Alero'),
(37, 14, 'Dirk Nowitzki', '1981-05-15', 213, 'Ala-pivot'),
(38, 15, 'Chris Paul', '1988-12-11', 183, 'Base'),
(39, 15, 'Peja Stojakovic', '1979-02-01', 208, 'Alero'),
(40, 15, 'Aaron Grey', '1991-11-17', 212, 'Pivot'),
(41, 16, 'Mike Conley', '1977-08-16', 185, 'Base'),
(42, 16, 'Rudy Gay', '1988-12-04', 203, 'Alero'),
(43, 16, 'Marc Gassol', '1986-01-13', 216, 'Pivot'),
(44, 17, 'Ray Allen', '1981-02-11', 196, 'Escolta'),
(45, 17, 'Paul Pierce', '1983-07-15', 201, 'Alero'),
(46, 17, 'Kevin Garnett', '1978-12-19', 211, 'Ala-pivot'),
(47, 18, 'Willie Green', '1989-10-13', 191, 'Base'),
(48, 18, 'Elton Brand', '1983-09-13', 206, 'Alero'),
(49, 18, 'Samuel Dalembert', '1988-01-14', 211, 'Pivot'),
(50, 19, 'Devin Harris', '1987-12-19', 191, 'Base'),
(51, 19, 'Trenton Hassell', '1975-02-01', 196, 'Alero'),
(52, 19, 'Brook Lopez', '1990-03-17', 213, 'Pivot'),
(53, 20, 'Jose Manuel Calderon', '1981-03-31', 192, 'Base'),
(54, 20, 'Andrea Bargnani', '1987-08-17', 213, 'Alero'),
(55, 20, 'Chris Bosh', '1984-12-03', 208, 'Alero'),
(56, 21, 'Nate Robinson', '1981-03-31', 175, 'Base'),
(57, 21, 'Marcus Landry', '1982-08-16', 201, 'Alero'),
(58, 21, 'Eddy Curry', '1975-11-07', 213, 'Pivot'),
(59, 22, 'Delonte West', '1988-03-16', 192, 'Base'),
(60, 22, 'Lebron James', '1986-12-15', 203, 'Alero'),
(61, 22, 'Saquille O?neal', '1974-03-19', 216, 'Pivot'),
(62, 23, 'Jannero Pargo', '1984-11-15', 185, 'Base'),
(63, 23, 'Luol Deng', '1986-10-17', 206, 'Alero'),
(64, 23, 'Jerome James', '1984-10-29', 216, 'Pivot'),
(65, 24, 'Rodney Stuckey', '1990-10-05', 196, 'Base'),
(66, 24, 'Tayshaun Prince', '1984-03-19', 205, 'Alero'),
(67, 24, 'Ben Wallace', '1977-04-24', 206, 'Pivot'),
(68, 25, 'Travis Diener', '1987-03-25', 185, 'Base'),
(69, 25, 'Solomon Jones', '1988-07-29', 208, 'Alero'),
(70, 25, 'Roy Hibbert', '1989-07-14', 218, 'Pivot'),
(71, 26, 'Luke Ridnour', '1989-10-15', 188, 'Base'),
(72, 26, 'Ersan Ilyasova', '1988-04-17', 208, 'Alero'),
(73, 26, 'Francisco Elson', '1979-09-23', 211, 'Ala-pivot'),
(74, 27, 'Jason Williams', '1983-11-25', 185, 'Base'),
(75, 27, 'Vince Carter', '1980-10-21', 198, 'Escolta'),
(76, 27, 'Dwight Howard', '1987-01-06', 211, 'Pivot'),
(77, 28, 'Mike Bibby', '1979-04-21', 188, 'Base'),
(78, 28, 'Marvin Williams', '1986-11-21', 206, 'Alero'),
(79, 28, 'Jason Collins', '1988-06-01', 213, 'Pivot'),
(80, 29, 'Mario Chalmers', '1986-12-22', 185, 'Base'),
(81, 29, 'Dwyane Wade', '1981-07-11', 193, 'Escolta'),
(82, 29, 'Jamal Magloire', '1984-05-13', 211, 'Pivot'),
(83, 30, 'Gerald Henderson', '1988-12-12', 196, 'Base'),
(84, 30, 'Gerald Wallace', '1980-11-24', 201, 'Alero'),
(85, 30, 'Desagana Diop', '1985-05-23', 213, 'Pivot'),
(86, 31, 'Gilbert Arenas', '1983-01-01', 193, 'Base'),
(87, 31, 'Mike Miller', '1982-10-13', 203, 'Escolta'),
(88, 31, 'Brendan Haywood', '1989-07-24', 214, 'Pivot');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidos`
--

CREATE TABLE `partidos` (
  `id` int(11) NOT NULL,
  `cod_equipo1_id` int(11) NOT NULL,
  `cod_equipo2_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `puntos_equipo1` int(11) NOT NULL,
  `puntos_equipo2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `partidos`
--

INSERT INTO `partidos` (`id`, `cod_equipo1_id`, `cod_equipo2_id`, `fecha`, `puntos_equipo1`, `puntos_equipo2`) VALUES
(17, 24, 22, '2017-11-27', 15, 117),
(18, 22, 18, '2017-11-01', 95, 93),
(19, 5, 14, '2017-11-01', 99, 106),
(20, 10, 22, '2017-11-01', 89, 106),
(21, 7, 9, '2017-11-02', 106, 95),
(22, 14, 9, '2017-11-02', 82, 91),
(23, 3, 4, '2017-11-02', 92, 78),
(24, 5, 8, '2017-11-02', 102, 85),
(25, 10, 2, '2017-11-02', 64, 84),
(26, 7, 3, '2017-11-02', 104, 86),
(27, 23, 12, '2017-11-02', 114, 107),
(28, 12, 5, '2017-11-02', 94, 79),
(29, 10, 22, '2017-11-13', 101, 102),
(30, 5, 14, '2017-11-13', 88, 100),
(31, 10, 22, '2017-11-13', 113, 120),
(32, 7, 3, '2017-11-13', 88, 73);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`) VALUES
(2, 'usuario', '[\"ROLE_USER\"]', '$2y$13$EqiN8QmfQ3wwHGX34zvPi.PA82BLaZhdhXUgKz5zmLg6LZJEWG37e');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

CREATE TABLE `zonas` (
  `id` int(11) NOT NULL,
  `nombre_zona` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `zonas`
--

INSERT INTO `zonas` (`id`, `nombre_zona`) VALUES
(1, 'North Westo'),
(2, 'Pacific'),
(3, 'South West'),
(4, 'Altantic'),
(5, 'North West HAM'),
(6, 'South East');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8C188AD0104EA8FC` (`zona_id`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_CF491B7623BFBED` (`equipo_id`);

--
-- Indices de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indices de la tabla `partidos`
--
ALTER TABLE `partidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8C926FF623C94210` (`cod_equipo1_id`),
  ADD KEY `IDX_8C926FF6317CEDFE` (`cod_equipo2_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- Indices de la tabla `zonas`
--
ALTER TABLE `zonas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `partidos`
--
ALTER TABLE `partidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `zonas`
--
ALTER TABLE `zonas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD CONSTRAINT `FK_8C188AD0104EA8FC` FOREIGN KEY (`zona_id`) REFERENCES `zonas` (`id`);

--
-- Filtros para la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD CONSTRAINT `FK_CF491B7623BFBED` FOREIGN KEY (`equipo_id`) REFERENCES `equipos` (`id`);

--
-- Filtros para la tabla `partidos`
--
ALTER TABLE `partidos`
  ADD CONSTRAINT `FK_8C926FF623C94210` FOREIGN KEY (`cod_equipo1_id`) REFERENCES `equipos` (`id`),
  ADD CONSTRAINT `FK_8C926FF6317CEDFE` FOREIGN KEY (`cod_equipo2_id`) REFERENCES `equipos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
