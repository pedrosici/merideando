-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-06-2017 a las 23:25:22
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
  `web` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `twitter` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `instagram` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `facebook` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `valor_medio` int(1) NOT NULL,
  `fecha` date NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `subcategoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `anuncios`
--

INSERT INTO `anuncios` (`id_anuncio`, `razon_soc`, `cif`, `direccion`, `latitud`, `longitud`, `telefono`, `email`, `descripcion`, `web`, `twitter`, `instagram`, `facebook`, `imagen`, `valor_medio`, `fecha`, `usuario_id`, `categoria_id`, `subcategoria_id`) VALUES
(34, 'Concesionario Seat', 'E123456789', 'Carretera Nacional V,  km 340', '38.924873', '-6.325448', '924110757', 'info@seat.com', 'SEAT, S.A. es una empresa española de automóviles fundada por el extinto Instituto Nacional de Industria el 9 de mayo de 1950. Las siglas S.E.A.T provienen del acrónimo de \"Sociedad Española de Automóviles de Turismo\" con que fue bautizada originalmente.', 'www.seat.es', 'seatofficial', 'seatmid', 'seatgedautocar', 'logo_seat.png', 3, '2017-06-20', 31, 2, 4),
(35, 'Talleres ANCA', 'E123456789', 'Calle Tarraco, 9', '38.911011', '-6.353913', '924372701', 'talleresanca@gmail.com', 'Electricidad del automóvil. Mecánica en general. Carga de aire acondicionado.\r\nPide presupuesto sin compromiso.', '', '', '', '', 'photo.jpg', 4, '2017-06-20', 31, 2, 2),
(36, 'Carglass Mérida', 'E123456789', 'Av. María Auxiliadora, 1', '38.925118', '-6.326556', '902555920', 'info@carglass.com', 'En Carglass® somos expertos en la reparación y sustitución de lunas de automóvil. Encuentra tu centro Carglass® más cercano y pide cita.', 'www.carglass.es', 'carglasses', 'carglass_es', 'CARGLASS.ES', 'Carglass_logo.svg.png', 3, '2017-06-20', 31, 2, 2),
(37, 'Autoescuela Martín', '49006269P', 'Don benito, 2', '38.911734', '-6.337425', '924300604', 'autoescuelamartin@gmail.com', 'En Autoescuela Martín trabajamos cada día en ofrecerte el mejor servicio, \r\nnos esforzamos al máximo para conseguir que nuestros clientes queden plenamente satisfechos.', 'www.autoescuelamartin.net', '', '', 'Autoescuela-Martin', 'martin.jpg', 4, '2017-06-20', 32, 2, 3),
(38, 'Autoescuela Trajano', '49006269P', 'Plaza Santa Clara, 5', '38.917299', '-6.346642', '924317455', 'autotrajano@gmail.com', 'Autoescuela TRAJANO es una autoescuela que imparte cursos intensivos de fines de semana, cursos de moto, cursos ADR y cursos CAP.', 'www.autoescuelatrajano.com', 'aetrajano', '', 'autoescuelaTRAJANO', 'trajano.png', 4, '2017-06-20', 32, 2, 3),
(39, 'Enterprise Rent-a-Car', '98808975D', 'Carretera Madrid Lisboa Km 342,7', '38.904552', '-6.359688', '924301613', 'rentacar@gmail.com', 'Reserva online tu coche o furgoneta en Enterprise España. Puedes alquilar cualquier vehículo en una de nuestras muchas sucursales en toda Europa.', 'www.enterprise.es/es/home.html', 'enterprise', 'enterpriserentacar_c', 'enterpriserentacar', 'logo-enterprise.png', 0, '2017-06-20', 33, 2, 1),
(40, 'Avis Mérida', '98808975D', 'Avenida de la Libertad, 0', '38.913637', '-6.356885', '924370035', 'info.avis@avis.com', 'Alquiler de coches en España, Europa y resto del mundo. Encuentra nuestras ofertas, promociones y descuentos al reservar tu coche de alquiler con Avis.', 'www.avis.es', 'avis_spain', 'avisusa', 'AvisSpain', 'AVIS_logo_2012.png', 0, '2017-06-20', 33, 2, 1),
(41, 'Zbitt Mérida', '81532560K', 'San Francisco, 7', '38.917838', '-6.344907', '924330993', 'zbitt.merida@gmail.com', 'Comercios de informática y nuevas tecnologías. Somos la cadena de tiendas de informática que más crece. Pídenos soluciones y consigue resultados.', 'zbittmerida.com', 'zbittmerida', '', 'zbittmerida', 'nosotros.jpg', 4, '2017-06-20', 34, 3, 5),
(42, 'Jiga Informática', '81532560K', 'Calle Oviedo, 2', '38.912380', '-6.339820', '924302315', 'jiga@gmail.com', 'En Jiga Informática te ofrecemos un servicio de calidad y atención personalizada dentro del mundo de la informática.\r\n\r\nTe ofrecemos todo lo necesario para tu equipo informático, además te lo configuramos a medida para que el ordenador se adapte a las necesidades de nuestros clientes.', 'www.jigainformatica.com/', 'jigainformatica', '', 'Jiga-Informática-Mérida-483000065212679', 'jiga.jpg', 4, '2017-06-20', 34, 3, 5),
(43, 'Worten Mérida', '93939068F', 'Parque Comercial La Hereda, Avenida Reina Sofia, s/n', '38.907126', '-6.352347', '902026620', 'worten@gmail.com', 'Ven a Worten y descubre las mejores ofertas en Electrodomésticos, Móviles, Ordenadores y mucho más al mejor precio. Tecnología para todos.', 'www.worten.es', 'wortenes', '', 'WortenES', 'logo-worten.jpg', 0, '2017-06-20', 35, 3, 5),
(44, 'InterFilm Fotográfos', '50438671Q', 'Jose Ramon Melida, 14', '38.917738', '-6.342251', '924387060', 'interfilm@gmail.com', 'Estudio de fotografía en Mérida. Ofrecemos desde el trabajo mas tradicional hasta las ultimas tendencias en fotografía social, boda, moda, retrato, artística, etc.', 'interfilmmerida.com', '', '', 'interfilmmerida', 'logo_2.png', 0, '2017-06-20', 36, 3, 7),
(45, 'Zama Fotógrafos', '37237268S', 'Jacinto Benavente Y Martinez, 4', '38.909588', '-6.341150', '924180502', 'zamafotografos@gmail.com', 'En Zama Fotógrafos tenemos la suerte de decir que trabajamos en lo que más nos gusta, nos apasiona fotografiar.\r\nEsta pasión hace que disfrutemos cada proyecto como si fuese el primero, el único, por que así es para nosotros.', 'www.zamafotografos.com', '', '', 'zamafotografos', 'zama_logo.jpg', 5, '2017-06-20', 36, 3, 7),
(46, 'Consulting Mérida', '44446803Q', 'Escultor Morato, 19', '38.915650', '-6.333850', '924301256', 'consulting.merida@consulting.com', 'Desde 1995 Consulting Mérida está presente en nuestra ciudad, prestando un servicio integral de asesoría y gestión, con un equipo joven y cualificado cuya principal vocación es garantizar la máxima calidad e inmediatez en todas las consultas y gestiones que precise. La respuesta a la confianza depositada es inmediata y se traduce, desde el primer día, en una atención personalizada, ágil y sincera que aporta valor añadido a todos nuestros clientes.', 'www.consultingmerida.com', '', '', 'Consulting-Mérida-173858976052479', 'consulting-merida.jpg', 0, '2017-06-20', 36, 3, 8),
(47, 'Grupo SIMAL Asesores', '43333430G', 'Comarca de las Hurdes, 1, Portal 6', '38.920850', '-6.368080', '924318552', 'simalasesores@gmail.com', 'RUPO SIMAL Asesores nace en julio de 2004 como resultado de la integración de un equipo de profesionales que, asociados, forman el primer despacho multidisciplinar de la región.\r\n\r\nGRUPO SIMAL es, desde el principio, una asesoría de vanguardia cuya actividad ha estado centrada en ofrecer a las empresas el servicio más integral, completo, profundo y actualizado, evitando así descentralizar toda su documentación administrativa.', 'www.gruposimal.com', 'GrupoSimal', '', 'GrupoSimal', 'grupo_simal.png', 0, '2017-06-20', 37, 3, 8),
(48, 'J Naharro Consultores', '69963634A', 'Los Maestros, 18', '38.915090', '-6.343831', '648008758', 'jnaharro@gmail.com', 'Asesoría de empresas formada por un equipo de asesores y abogados de empresas con una alta cualificación y comprometidos con su trabajo y con las necesidades del cliente.\r\nTenemos soluciones para cualquiera de sus necesidades. Nuestro amplio abanico de servicios nos permite abarcar diferentes áreas fiscal, laboral, contable, abogados, consultoría empresarial y ofrecer al cliente una rápida y total atención.\r\n', 'www.jnaharro.asesoriaweb.com', 'jnaharro', '', 'jnaharro', 'jnaharro.jpg', 4, '2017-06-20', 37, 3, 8),
(49, 'ExtreNatura', '20611751W', 'Manos Albas, 2', '0.000000', '0.000000', '924302614', 'extrenatura@gmail.com', 'En Extrenatura apostamos por la responsabilidad social corporativa para hacer de ella una ventaja competitiva y mejorar el trato con nuestros clientes, la integración de los trabajadores y el cuidado del medio ambiente.', 'www.extrenatura.es', 'ExtreNatura', '', 'ExtreaturaMedioambiente', 'logo-extrenatura.png', 0, '2017-06-20', 37, 3, 10),
(50, 'Cinesa El Foro', '41391884A', 'Avda Portugal s/n', '0.000000', '0.000000', '645590102', 'cinesa@cinesa.com', 'Cines 3D, IMAX®, iSENS y DOLBY CINEMA™ en España: cartelera de estrenos y horarios de las mejores películas, trailers, compra de entradas, eventos, ...', 'www.cinesa.es', 'cinesa', '', 'cinesa.es', 'cinesa.png', 0, '2017-06-20', 38, 4, 13),
(51, 'Festival Internacional de Teatro Clásico de Mérida', '41391884A', 'Sta. Julia, 5', '0.000000', '0.000000', '924009480', 'teatroromano@gmail.com', 'El Festival Internacional de Teatro Clásico de Mérida es un festival de teatro clásico que se celebra cada año en Mérida, España, durante los meses de julio y agosto en el Teatro Romano de Mérida', 'www.festivaldemerida.es', 'festival_merida', '', 'FestivalMerida', 'teatro.jpg', 0, '2017-06-20', 38, 4, 13),
(52, 'Ciudad Deportiva Mérida', '41391884A', 'Camino Viñas Viejas, s/n', '38.916716', '-6.371891', '924123820', 'enjoywellnes@gmail.com', 'Ciudad Deportiva de Mérida , unas instalaciones concebidas para la práctica de los deportes en Mérida, Badajoz. Ofrecemos múltiples actividades dirigidas con instructores siempre al día.', 'www.ciudaddeportivademerida.com', 'cdportivame', '', 'enjoymerida', 'enjoywellness.jpg', 0, '2017-06-20', 38, 4, 11),
(53, 'Stabia Centro Deportivo', '41391884A', 'Calle Ebanistas', '38.906598', '-6.365287', '924370132', 'stabia@gmail.com', 'ESTÉTICA. Stabia Estética le ofrece:- Tratamientos faciales- Tratamientos Corporales- Depilaciones corporales y faciales. FITNESS-SPINNING. Más información en nuestra web.', 'www.stabia.es', '', '', 'stabia.centrodeportivo', 'stabia-logo.jpg', 0, '2017-06-20', 38, 4, 11),
(54, 'Sportium Mérida', '41391884A', 'Calle Comarca de la Vera, 1', '0.000000', '0.000000', '924312622', 'sportium@sportium.com', 'Sportium, apuestas deportivas, apuestas en vivo, casino, bingo, poker, …. Máquinas de Bingo con premios de hasta 24.000 euros. Máquinas tragaperras tipo B..etc Más info en la web.', 'www.sportium.com', 'sportium', '', 'Apuestas-Sportium', 'Logo-Sportium.jpg', 0, '2017-06-20', 38, 4, 12),
(55, 'Academia Empro', '98475538A', 'Marquesa de Pinares, 6', '38.920366', '-6.344068', '924300504', 'empro@gmail.com', 'Desde 1994, la ACADEMIA ENPRO viene desarrollando su actividad en sus dos vertientes, la formación y la gestión de servicios.  Durante todo este tiempo, las demandas de nuestros clientes han ido perfilando nuestra cartera de servicios.', 'www.academiaempro.com', '', '', '', 'logoEnpro.jpg', 0, '2017-06-20', 24, 5, 15),
(56, 'Codere Mérida', '56848187F', 'Avenida Juan Pablo II, 4', '38.925448', '-6.321644', '924348107', 'codere@codere.es', 'En Codere Apuestas tú eliges la forma de apostar, ya sea en cualquiera de nuestros locales o desde donde tú quieras a través de tu dispositivo móvil.', 'www.codere.es', 'codereapuestas', '', 'grupocodere', 'codere.jpg', 0, '2017-06-20', 24, 4, 12),
(57, 'LST Deporte y Salud', '56848187F', 'Calle Miguel Ángel Blanco, s/n', '38.911255', '-6.342173', '924330983', 'lst@gmail.com', 'Disfrute de las mejores instalaciones deportivas de Mérida. Combinación de tecnología y diseño para mejorar tu salud.', 'http://www.lstdeporteysalud.es/', '', '', 'lstweb', 'lst.jpg', 0, '2017-06-20', 24, 4, 11),
(58, 'Escuela de Idiomas Santa Eulalia', '56848187F', 'Santa Eulalia, 19', '38.916953', '-6.344928', '924301960', 'escuelainglessanta@gmail.com', 'INGLÉS y ALEMÁN. Todas las edades y niveles, desde los tres años\r\nCambridge ESOL Exam Preparation Centre (University of Cambridge)\r\nMetodología experimentada y apoyo multimedia\r\nAula virtual\r\nCursos para empresas\r\nCursos de verano en Irlanda\r\nClases para temas específicos\r\nEspañol para extranjeros\r\nPreparación para otros exámenes\r\nClases particulares', 'escueladeidiomassantaeulalia.com/', '', '', 'eisantaeulalia', 'SANTA-EULALIA.jpg', 0, '2017-06-20', 24, 5, 15),
(59, 'Laoctava, Centro de Música', '56848187F', 'Oviedo, 7', '38.913050', '-6.343950', '924985140', 'laoctva@gmail.com', 'laoctava, centro de música creativa, es un centro de creación musical formado por la escuela de música del mismo nombre, por laoctava estudio de grabación, espacio dedicado a la creación y producción musical y lacreativa producciones artísticas, sección encargada de las artes escénicas y audiovisuales dentro de la empresa.', 'laoctava.net', 'laoctavacmc', '', '', 'laoctava.jpg', 0, '2017-06-20', 24, 5, 16),
(60, 'Escuela de Música Pilar Vizcaino', '56848187F', 'Adriano, 20', '38.899595', '-80.282851', '667216793', 'pvizcaino@gmail.com', 'e invitamos a que nos acompañes durante el curso 2017/2018 y llenes de música tus días. Desde el día 1 de Junio tenemos abierto el plazo de matrícula. ¡Os esperamos!\r\n\r\n*Música con tu bebé *Musicoterapia *Música en familia *Música y movimiento *Armonía, análisis y lenguaje musical *Piano *Guitarra clásica y eléctrica *Trompeta *Trombón*Batería y percusión *Clarinete *Saxofón *Combo *Coro *Canto *Escolanía *Violín *Viola *Violonchelo *Acordeón', 'http://escuelapilarvizcaino.com/', '', '', 'escuelapilarvizcaino', 'escuelaartes.png', 0, '2017-06-20', 24, 5, 15),
(61, 'Café Joplin', '56848187F', 'Romero Leal, 3', '38.915736', '-6.345719', '607680787', 'joplin@gmail.com', 'Restaurante con comida Armenia en Mérida y además, adaptada a nuestros sabores y paladares, todo un lujo en la ciudad.', '', '', '', 'CafeJoplin', 'cafejoplin.jpg', 0, '2017-06-20', 24, 7, 26),
(62, 'Café Pub La Galería', '56848187F', 'Viñeros, 14', '0.000000', '0.000000', '924319756', 'lagaleria@gmail.com', 'Cada noche, cada día, tu lugar: La Galería.\r\nVen a solas o en compaía, tu lugar: La Galería.\r\nVengas triste o sonrias, tu local...', '', '', '', 'CafePubLaGaleria', 'lagaleria.jpg', 0, '2017-06-20', 24, 7, 26),
(63, 'La Piel del Oso', '56848187F', 'Bartolomé Torres Naharro, 7', '0.000000', '0.000000', '924317739', 'lapieldeloso@gmail.com', 'Bar con decoración ecléctica, cafés y tés de calidad, repostería casera, cañas y vinos acompañados de tapa cortesía del Sr. Oso', '', '', 'lapieldeloso', 'lapieldeloso.merida', 'lapieldeloso.jpg', 0, '2017-06-20', 24, 7, 26),
(64, 'La Taberna de Sole', '56848187F', 'John Lennon, 27', '38.914192', '-6.344669', '661308437', 'latabernadesole@gmail.com', 'Recetas extremeñas, productos ecológicos y setas de temporada en un bar con menús para celíacos y diabéticos.', 'latabernadesole.com', '', '', '', 'latabernadesole.jpg', 0, '2017-06-20', 24, 7, 24),
(65, 'Diversis GastroPub', '56848187F', 'San Juan Macías, 12', '38.916671', '-6.347458', '659492961', 'diversis@gmail.com', 'Tu lugar de ocio', '', '', '', 'diversisgastropub', 'diversis.jpg', 0, '2017-06-20', 24, 7, 25),
(66, 'Peluquería Cuca Bautista', '56848187F', 'Berzocana, 4', '38.916599', '-6.343796', '924330468', 'bautista@gmail.com', 'Peluquería para bodas, comuniones y todo tipo de eventos. La mejor calidad-precio!', '', '', '', 'cucabautistapeluqueria.estilista', 'cucabautista.jpg', 0, '2017-06-20', 24, 8, 29);

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
(51, 'Profesionales de primera', 'La experiencia buena, volver&iacute;a a llevar a reparar mi coche sin ninguna duda.', 4, '2017-06-20', 36, 32),
(52, 'La mejor autoescuela de M&eacute;rida', 'Gracias al profesor de pr&aacute;cticas, consegu&iacute; sacarme el carnet a la primera. Lo recomiendo 100%', 5, '2017-06-20', 37, 33),
(53, 'Cumple sin m&aacute;s', 'El taller tiene buena pinta, el problema es que revent&eacute; la rueda y no ten&iacute;an el mismo modelo, parec&iacute;an algo pasotas.', 2, '2017-06-20', 35, 33),
(55, 'Buena autoescuela, buenos precios', 'Autoescuela con precios competitivos, ambiente agradable.', 4, '2017-06-20', 38, 34),
(56, 'Trato prepotente', 'No me atendieron correctamente. No volver&eacute; a ir nunca m&aacute;s.', 1, '2017-06-20', 36, 34),
(57, 'Buen servicio', 'Ten&iacute;a la placa base estropeada y en 2 d&iacute;as lo ten&iacute;a listo. El precio asequible.', 4, '2017-06-20', 42, 35),
(58, 'Buena experiencia con el carnet de moto', 'Decid&iacute; sacarme aqu&iacute; el carnet de moto y no me arrepiento. Todo genial!', 3, '2017-06-20', 37, 35),
(59, 'Buena tienda de inform&aacute;tica', 'Tienen de todo, arreglan m&oacute;viles tambi&eacute;n. Me compr&eacute; el portatil all&iacute; y muy contento.', 4, '2017-06-20', 41, 36),
(60, 'Genial para pasar ITV', 'Llev&eacute; el coche y en media hora estaba listo. Trato Genial.', 5, '2017-06-20', 35, 36),
(61, 'Cumplen con lo que prometen', 'Me dijeron que me arreglar&iacute;an la impresora (estaba atascada) y as&iacute; ha sido, han tardado una semana pero al menos no he tenido que comprarme otra.', 3, '2017-06-20', 42, 36),
(62, 'Profesionales de calidad', 'Nos hicimos all&iacute; mi marido y yo las fotos de nuestra boda y quedaron de maravilla. Calidad garantizada!', 5, '2017-06-20', 45, 37),
(63, 'Buena asesor&iacute;a', 'Fui a hablar con ellos por un tema jur&iacute;dico y me quedo claro como actuar, buenos profesionales.', 4, '2017-06-20', 48, 37);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `id_fav` int(11) NOT NULL,
  `anuncio_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `favoritos`
--

INSERT INTO `favoritos` (`id_fav`, `anuncio_id`, `usuario_id`) VALUES
(5, 34, 32),
(6, 36, 32),
(7, 36, 32),
(8, 36, 33),
(9, 42, 35);

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
(7, 'Fotografía', 3),
(8, 'Gestorías', 3),
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
(1, 'Administrador de Merideando', 'admin', 'admin@merideando.com', '5f6955d227a320c7f1f6c7da2a6d96a851a8118f', '2017-06-20 10:15:22'),
(24, 'Pedro Sicilia Marcelo', 'pedrosici', 'pedrosm1991@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2017-06-20 10:21:12'),
(25, 'María Sánchez Saavedra', 'mariass92', 'mariass92@hotmail.com', '16e91edfc7fb39f9af535a9a8ffb95b263f23772', '2017-06-20 10:22:05'),
(26, 'Julián Torres Viñuela', 'jmvp90', 'julymvp@gmail.com', '8d47448be94cea3efae0f6c268c4d5e9cfdfe5ce', '2017-06-20 10:25:13'),
(27, 'Aroa Bohoyo Romero', 'aboyi91', 'aroamerida@gmail.com', '140833838e604df6b0be65aa2e8b890ef55745d1', '2017-06-20 10:26:14'),
(29, 'Ángeles Marcelo Pino', 'chipepe', 'chiquimarcelo@gmail.com', 'b9fe7d17a3270cda3664a6983f58a50345cb38cb', '2017-06-20 10:47:42'),
(30, 'Pedro Sicilia Vázquez', 'pedrobio', 'pedrobio.sfera@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2017-06-20 10:48:13'),
(31, 'David Siruela Martínez', 'dsiruela92', 'davizsiruela@gmail.com', '5f6955d227a320c7f1f6c7da2a6d96a851a8118f', '2017-06-20 10:49:01'),
(32, 'Diego García Jurado', 'diegogj', 'diegogj@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2017-06-20 13:09:33'),
(33, 'Ramón García Expósito', 'ramongex', 'ramongex88@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2017-06-20 13:40:56'),
(34, 'Juanra Sicilia Pozo', 'jramonsp', 'jramon@gmail.com', 'c16f721be3cef8c71fcdbd31979485ea85e2407c', '2017-06-20 13:53:33'),
(35, 'Magdalena Pozo Sicilia', 'magdapozo', 'magdapozonegro@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2017-06-20 14:06:22'),
(36, 'Nieves Sicilia Pozo', 'nievesici', 'nievestia@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2017-06-20 14:12:48'),
(37, 'Angeles Vazquez Mondragón', 'angelesvm', 'angelota@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2017-06-20 16:03:58'),
(38, 'Ricardo Marcelo Velázquez', 'ricarmarc', 'ricardomrg@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2017-06-20 16:35:09');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id_anuncio`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `fk_subcategorias_anuncios_idx` (`subcategoria_id`);

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
  ADD KEY `id_anuncio` (`anuncio_id`),
  ADD KEY `fk_usuarios_comentarios_idx` (`usuario_id`);

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id_fav`),
  ADD KEY `fk_anuncios_favoritos_idx` (`anuncio_id`),
  ADD KEY `fk_usuarios_favoritos_idx` (`usuario_id`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id_subcategoria`),
  ADD KEY `fk_categorias_subcategorias_idx` (`categoria_id`);

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
  MODIFY `id_anuncio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id_fav` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD CONSTRAINT `fk_categorias_anuncios` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_subcategorias_anuncios` FOREIGN KEY (`subcategoria_id`) REFERENCES `subcategorias` (`id_subcategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_anuncios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `fk_anuncios_comentarios` FOREIGN KEY (`anuncio_id`) REFERENCES `anuncios` (`id_anuncio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuarios_comentarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `fk_anuncios_favoritos` FOREIGN KEY (`anuncio_id`) REFERENCES `anuncios` (`id_anuncio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuarios_favoritos` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `fk_categorias_subcategorias` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
