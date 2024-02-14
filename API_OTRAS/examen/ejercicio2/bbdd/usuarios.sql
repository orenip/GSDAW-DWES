use fct;

--
-- Estructura de tabla para la tabla `usuarios`
-- Tabla que se utiliza para la autentificación
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `disponible` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
-- Usuario: prueba
-- Password: prueba
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `token`, `nombre`, `disponible`) VALUES
(100, 'prueba', '655e786674d9d3e77bc05ed1de37b4b6bc89f788829f9f3c679e7687b410c89b', '', 'Usuario de Prueba', 1);