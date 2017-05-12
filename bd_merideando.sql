-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-05-2017 a las 14:43:29
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

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
  `latitud` decimal(9,6) NOT NULL DEFAULT '0.000000',
  `longitud` decimal(9,6) NOT NULL DEFAULT '0.000000',
  `telefono` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `web` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `twitter` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `instagram` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `facebook` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `likes` int(5) NOT NULL DEFAULT '0',
  `hates` int(5) NOT NULL DEFAULT '0',
  `fecha` date NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `anuncios`
--

INSERT INTO `anuncios` (`id_anuncio`, `razon_soc`, `cif`, `direccion`, `latitud`, `longitud`, `telefono`, `email`, `descripcion`, `web`, `twitter`, `instagram`, `facebook`, `imagen`, `likes`, `hates`, `fecha`, `usuario_id`, `categoria_id`) VALUES
(40, 'Burger King', '21323123', 'Plaza de España, 10', '38.915985', '-6.346243', '924 57 72 77', 'bk@info.com', 'Burger King, también conocida como BK,1 es una cadena de establecimientos de comida rápida estadounidense con sede central en Miami (Florida), presente a nivel internacional y especializada principalmente en la elaboración de hamburguesas.', 'www.burgerking.es', 'BurgerKing', 'burgerking', 'burgerkingespana', 'burger-king-logo.png', 0, 0, '2017-05-12', 3, 7),
(41, 'Pirron Sport', '4274324892', 'Juan Pablo Forner, 9', '38.917053', '-6.345682', '924 31 84 14', 'pirronsport@gmail.com', '\"Calidad y estilo en el deporte\". Última tendencia y tecnología en textíl y calzado deportivo.Venta de equipamiento a clubes,centros deportivos y escolares', 'www.pirronsport.es', '', '', 'pirron.sport', 'logo.png', 0, 0, '2017-05-12', 3, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_cat` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `icono` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_cat`, `icono`) VALUES
(2, 'Motor', 'fa-car'),
(3, 'Profesionales y Empresas', 'fa-briefcase'),
(4, 'Deportes y Ocio', 'fa-futbol-o'),
(5, 'Formación', 'fa-leanpub'),
(6, 'Moda y Complementos', 'fa-shopping-bag'),
(7, 'Comer y Beber', 'fa-cutlery'),
(8, 'Salud y Belleza', 'fa-medkit'),
(9, 'Comercio Local', 'fa-shopping-cart');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `comentario` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nick` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_comentario` date NOT NULL,
  `anuncio_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `comentario`, `nick`, `fecha_comentario`, `anuncio_id`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 'Pedro', '2017-05-11', 22),
(2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 'Juan', '2017-05-11', 22),
(3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 'Maria', '2017-05-11', 22),
(4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 'Paco', '2017-05-11', 22),
(5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 'Raquel', '2017-05-11', 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
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
  ADD KEY `fk_anuncios_comentarios` (`anuncio_id`);

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
  MODIFY `id_anuncio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
