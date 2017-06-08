-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-06-2017 a las 14:51:54
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
  `web` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `twitter` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `instagram` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `facebook` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
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
(2, 'Burger King', '50692009D', 'Plaza de España, 10', '38.915985', '-6.346243', '924485460', 'bk@info.com', 'Burger King, también conocida como BK,1 es una cadena de establecimientos de comida rápida estadounidense con sede central en Miami (Florida), presente a nivel internacional y especializada principalmente en la elaboración de hamburguesas.', 'www.burgerking.es', 'BurgerKing', 'burgerking', 'burgerkingespana', 'burger_logo.png', 0, 0, '2017-06-06', 3, 7, 24),
(4, 'McDonalds', '50692009D', 'Avenida Reina Sofía s/n', '38.909709', '-6.344191', '924371567', 'info.mcdonalds@gmail.com', 'Veterana cadena de comida rápida famosa por sus hamburguesas, patatas fritas y bebidas, con opción de menús.', 'www.mcdonalds.es', '@MCDonalds', '', 'McDonaldsSpain', 'logo_mcdonald.jpg', 0, 0, '2017-06-06', 3, 7, 24),
(5, 'Telepizza', 'B61670972', 'Plaza de España, 13', '38.916047', '-6.346691', '924252525', 'info.telepizza@gmail.com', 'Telepizza es una cadena multinacional de origen español de pizzerías con presencia en varios países.', 'www.telepizza.es', 'telepizza', 'telepizza', 'telepizza', 'logo_telepizza.jpg', 0, 0, '2017-06-06', 3, 7, 24),
(7, 'La Sureña de Mérida', '90159420H', 'Calle Delgado Valencia, 11', '38.917944', '-6.343148', '902197494', 'lasurena.merida@gmail.com', 'La franquicia de Cervecería La Sureña ofrece una manera distinta de entender el tiempo de ocio. Ha sabido conquistar a los consumidores y a los emprendedores de media España. Además, supone una muy buena inversión para aquellos que buscan emprender un negocio y, por supuesto, para desarrollar un negocio rentable y de éxito. Se ha consolidado en el territorio español con más de 100 locales abiertos.', 'http://lasurena.es', '', 'cervecerialasurena', 'La-Sureña', 'la-surena-restalia-logo.png', 0, 0, '2017-06-06', 3, 7, 24),
(8, 'La Piel del Oso', '71233123F', 'Calle Bartolome Torres Naharro, 7', '38.909709', '-6.337628', '924317739', 'lapieldeloso@gmail.com', 'Bar con decoración ecléctica, cafés y tés de calidad, repostería casera, cañas y vinos acompañados de tapa cortesía del Sr. Oso.\r\n', '', '', '', 'lapieldeloso.merida', 'logo_pieldeloso.jpg', 0, 0, '2017-06-06', 3, 7, 26),
(12, 'dsadasd', '71233123F', 'Plaza de España, 10', '38.915985', '-6.346243', '924317739', 'burger35@gmail.com', 'sadasdds', '', '', '', '', 'logo_grande-Pizza-Bull.jpg', 0, 0, '2017-06-06', 3, 9, 20),
(13, 'Prueba', '71233123F', 'John Lennon, 36', '38.914553', '-6.345130', '924317739', 'pedrosm1991@gmail.com', 'Prueba de concierto', '', '', '', '', 'logo_stones.png', 0, 0, '2017-06-07', 3, 10, 32);

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
(9, 'Comercio Local', 'fa-shopping-cart'),
(10, 'Eventos', 'fa-calendar'),
(11, 'Turismo', 'fa-camera-retro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `titulo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `comentario` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `valoracion` int(1) NOT NULL,
  `fecha_comentario` date NOT NULL,
  `anuncio_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `titulo`, `comentario`, `valoracion`, `fecha_comentario`, `anuncio_id`, `usuario_id`) VALUES
(33, 'Prueba de comentario', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tatio', 3, '2017-06-08', 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `id_fav` int(11) NOT NULL,
  `anuncio_ïd` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `favoritos`
--

INSERT INTO `favoritos` (`id_fav`, `anuncio_ïd`, `usuario_id`) VALUES
(1, 16, 3);

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
(31, 'Ópticas', 8),
(32, 'Festivales y Conciertos', 10),
(33, 'Exposiciones, Talleres y Actividades', 10),
(34, 'Monumentos y Museos', 11),
(35, 'Alojamiento', 11);

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
(17, 'Ricardo Calamardo', 'ricardonull', 'ricardocalamardo@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2017-06-07 09:48:30'),
(18, 'Tus Worten Marcelo', 'tusworten', 'tusworten@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2017-06-07 09:58:50'),
(19, 'asdasd', 'asdsd', 'sad@sad', '356a192b7913b04c54574d18c28d46e6395428ab', '2017-06-07 10:03:52'),
(20, 'Oscar Default Moreno', 'oscardo', 'oscardo@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2017-06-07 10:10:47'),
(21, 'asd sad asd', 'asde', '123213|@3123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2017-06-07 11:25:11'),
(22, 'asd sad asd', 'asdasdsd', 'asd@as', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2017-06-07 11:31:56');

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
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id_fav`);

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
  MODIFY `id_anuncio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id_fav` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
