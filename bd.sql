-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-03-2017 a las 18:09:47
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `merideando`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncios`
--

CREATE TABLE `anuncios` (
  `id_anuncio` int(11) NOT NULL,
  `razon_soc` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `cif` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `total_votos` int(20) NOT NULL,
  `num_votos` int(20) NOT NULL,
  `fecha` date NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `anuncios`
--

INSERT INTO `anuncios` (`id_anuncio`, `razon_soc`, `cif`, `direccion`, `telefono`, `email`, `descripcion`, `imagen`, `total_votos`, `num_votos`, `fecha`, `usuario_id`, `categoria_id`) VALUES
(9, 'PizzerÃ­a Galileo', 'G123456789', 'Calle Jonh Lennon, 28', '924 31 55 05', 'galileo@gmail.com', 'Restaurante italiano situado en el centro de MÃ©rida. Ofrecemos pizzas, pastas, carnes y ensaladas. Tenemos servicio a domicilio.', '', 0, 0, '2017-02-21', 4, 7),
(10, 'Inmobiliaria Domus', 'G987654321', 'Calle Almendralejo, NÂº 20', '924 30 45 44', 'domus@gmail.com', 'Disponemos de una amplia oferta inmobiliaria de Viviendas Nuevas y 2Âª Mano, Chalets y Fincas por toda la provincia, Alquileres y Traspasos, todo ello con las mejores garantias econÃ³micas del mercado hasta el 100% de un credito o una hipoteca para que usted pueda adquirirlos. ', '', 0, 0, '2017-02-21', 4, 3),
(14, 'Sportium AbadÃ­as', 'K987654321', 'Ronda de los EmÃ©ritos 13', '924310005', 'info@sportium.com', 'Sportium, apuestas deportivas, apuestas en vivo, casino, bingo, poker, â€¦.\r\nMÃ¡quinas de Bingo con premios de hasta 24.000 euros.\r\nMÃ¡quinas tragaperras tipo B con premios de hasta 1.000 euros.\r\nRuleta.\r\nSportium: casa oficial de apuestas de la LFP\r\n', 'logo-sportium.es_.jpg', 0, 0, '2017-03-21', 3, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_cat` varchar(50) NOT NULL,
  `icono` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_cat`, `icono`) VALUES
(2, 'Motor', ''),
(3, 'Inmobiliaria', ''),
(4, 'Deportes', ''),
(5, 'Formación', ''),
(6, 'Moda y Complementos', ''),
(7, 'Hostelería', ''),
(8, 'Aficiones y Ocio', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `comentario` int(11) NOT NULL,
  `nick` int(11) NOT NULL,
  `fecha_comentario` date NOT NULL,
  `id_anuncio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha_creacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `email`, `password`, `fecha_creacion`) VALUES
(3, 'Pedro Sicilia', 'pedrosici', 'pedro@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2017-01-30 17:26:31'),
(4, 'Pedro Sicilia Marcelo', 'admin', 'pedrosm1991@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2017-02-21 17:59:58');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id_anuncio`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_anuncio` (`id_anuncio`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `id_anuncio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD CONSTRAINT `anuncios_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `anuncios_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_anuncio`) REFERENCES `anuncios` (`id_anuncio`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
