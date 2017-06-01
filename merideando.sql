-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-05-2017 a las 00:07:17
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
  `latitud` decimal(9,6) NOT NULL,
  `longitud` decimal(9,6) NOT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `web` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `twitter` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `instagram` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `facebook` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `likes` int(5) NOT NULL,
  `hates` int(5) NOT NULL,
  `fecha` date NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `subcategoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `anuncios`
--

INSERT INTO `anuncios` (`id_anuncio`, `razon_soc`, `cif`, `direccion`, `latitud`, `longitud`, `telefono`, `email`, `descripcion`, `web`, `twitter`, `instagram`, `facebook`, `imagen`, `likes`, `hates`, `fecha`, `usuario_id`, `categoria_id`, `subcategoria_id`) VALUES
(16, 'Pizzería Galileo', 'E123456789', 'John Lennon, 34', '38.914582', '-6.345157', '924 31 55 055', 'info@galileo.com', 'Restaurante italiano situado en el centro de Mérida. Ofrecemos pizzas, pastas, carnes y ensaladas. Tenemos servicio a domicilio.', 'www.galileo.com', 'galileo', 'galileo', 'galileofb', 'galileo.jpg', 0, 0, '2017-03-26', 3, 9, 0),
(17, 'sda', 'sad', 'Plaza de España, 10', '38.915985', '-6.346243', 'sad', 'bk@gmail.com', 'dsad', '', '', '', '', 'flag_eng.png', 0, 0, '2017-05-28', 3, 9, 0),
(18, 'sad', 'dasd', 'Plaza de España, 10', '38.915985', '-6.346243', 'assad', 'asdasd', 'sad', '', '', '', '', 'logo_stones.png', 0, 0, '2017-05-29', 3, 7, 25);

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
(7, 'Comer y Beber', 'fa-cutlery'),
(8, 'Salud y Belleza', 'fa-medkit'),
(9, 'Comercio Local', 'fa-shopping-cart');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `comentario` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `nick` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_comentario` date NOT NULL,
  `anuncio_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `comentario`, `nick`, `fecha_comentario`, `anuncio_id`) VALUES
(19, 'Prueba de comentario', 'Pedro', '2017-05-10', 16),
(20, 'Prueba de comentario', 'Juan', '2017-05-10', 16),
(21, 'Muy rico todo', 'Maria', '2017-05-10', 16),
(22, 'Asquerosa comida', 'Paco', '2017-05-10', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE `subcategorias` (
  `id_subcategoria` int(11) NOT NULL,
  `nombre_subcat` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`id_subcategoria`, `nombre_subcat`, `categoria_id`) VALUES
(1, 'Alquiler de Vehículos', 2),
(2, 'Talleres y Lavado', 2),
(3, 'Autoescuela', 2),
(4, 'Concesionario', 2),
(5, 'Tecnología', 3),
(6, 'Suministros', 3),
(7, 'Fotografía', 3),
(8, 'Gestorías', 3),
(9, 'Seguridad', 3),
(10, 'Medioambiente', 3),
(11, 'Centros Deportivos', 4),
(12, 'Juegos y Apuestas', 4),
(13, 'Cine y Teatro', 4),
(15, 'Academias y Escuelas', 5),
(16, 'Música y Artes', 5),
(17, 'Alimentación', 9),
(18, 'Moda y Complementos', 9),
(19, 'Hogar y Decoración', 9),
(20, 'Joyerías y Relojerías', 9),
(21, 'Tecnología y Electrodomésticos', 9),
(22, 'Librerías y Papelerías', 9),
(24, 'Bares y Restaurantes', 7),
(25, 'Pubs y Discotecas', 7),
(26, 'Cafeterías y Teterías', 7),
(27, 'Balnearios ', 8),
(28, 'Clínicas Dentales', 8),
(29, 'Peluquería y Estética', 8),
(30, 'Farmacias', 8),
(31, 'Ópticas', 8);

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
(4, 'Pedro Sicilia Marcelo', 'admin', 'pedrosm1991@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2017-02-21 17:59:58'),
(5, 'Paco García', 'pacog', 'paco@gmail.com', '5f6955d227a320c7f1f6c7da2a6d96a851a8118f', '2017-05-23 22:52:56'),
(6, 'Lionel Messi', 'tusworten', 'messi@gmail.com', 'b58e6693e0ba007ce2f9e152c4cf19dd5cdbbad6', '2017-05-23 23:06:30');

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
  ADD KEY `id_anuncio` (`anuncio_id`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id_subcategoria`);

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
  MODIFY `id_anuncio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
