-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-03-2015 a las 23:30:28
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `practica2ev`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
`id` int(11) NOT NULL,
  `cod_interno` varchar(45) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Código interno con el que se identifica en la organización',
  `nombre` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descripcion` varchar(250) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `anuncio` longtext COLLATE utf8_spanish2_ci,
  `visible` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Se puede ocultar por temas de gestión'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `cod_interno`, `nombre`, `descripcion`, `anuncio`, `visible`) VALUES
(1, 'cat_ps4', 'ps4', 'Nueva consola de Sony', '<h1>PlayStation 4</h1>\r\n<p>Todos los juegos de la nueva consola de Sony</p>\r\n    ', 1),
(2, 'cat_ps3', 'ps3', 'La anterior consola de Sony', '<h1>PlayStation 3</h1>\r\n<p>Todos los juegos de la anterior consola de Sony</p>', 1),
(3, 'cat_xbox_one', 'xbox one', 'La nueva generación de consolas de Microsoft', '<h1>Xbox one</h1>\r\n<p>Todos los juegos de la nueva consola de Microsoft</p>', 1),
(4, 'cat_xbox_360', 'xbox 360', 'La anterior consola de Microsoft', '<h1>Xbox 360</h1>\r\n<p>Todos los juegos de la anterior consola de Microsoft</p>', 1),
(5, 'cat_wii', 'wii', 'Consola Wii', '<h1>Nintendo Wii</h1>\r\n<p>Todos los juegos de la anterior consola de Nintendo</p>', 1),
(6, 'cat_wii_u', 'wii u', 'Consola Wii U', '<h1>Nintendo Wii U</h1>\r\n<p>Todos los juegos de la consola Nintendo Wii U</p>', 1),
(7, 'cat_3ds', '3ds', 'Consola Nintendo 3DS', '<h1>Nintendo 3DS</h1>\r\n<p>Aquí están todos los juegos de Nintendo 3DS</p>', 1),
(8, 'cat_ps_vita', 'ps vita', 'Consola PS Vita', '<h1>PS Vita</h1>\r\n<p>Todos los juegos de la portatil de Sony</p>', 1),
(9, 'cat_pc', 'pc', 'pc', '<h1>PC</h1>\r\n<p>Juegos para PC</p>', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
`id` int(11) NOT NULL,
  `usuario` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `password` varchar(250) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '1' COMMENT 'Para controlar si los usuarios se han dado de baja',
  `email` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apellidos` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `dni` varchar(9) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cod_postal` varchar(15) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `provincia_id` char(2) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `usuario`, `password`, `activo`, `email`, `nombre`, `apellidos`, `dni`, `direccion`, `cod_postal`, `provincia_id`) VALUES
(4, 'usuario', 'f8032d5cae3de20fcec887f395ec9a6a', 1, 'jloborod@gmail.com', 'usuario', 'usuario', '48921540b', 'asdasda', '21004', '02'),
(5, 'node', '36c4536996ca5615dcf9911f068786dc', 1, 'node@gmail.com', 'node', 'node', '48921540b', 'C/ Node', '21005', '06'),
(6, 'joki', '11395b0f8c08d37074d8a67d9da57da7', 1, 'jloborod@gmail.com', 'Joaquin', 'Lobo Rodriguez', '48921540b', 'C/ Focha 47', '21043', '21'),
(7, 'lobo', '1b554a52643788461c4c51c68a23cbc5', 1, 'jloborod3@gmail.com', 'Joaquin', 'Lobo', '48921540b', 'C/ Forest 67', '21548', '21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_pedido`
--

CREATE TABLE IF NOT EXISTS `linea_pedido` (
`id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `precio_venta` decimal(5,3) NOT NULL,
  `descuento` decimal(5,3) DEFAULT NULL,
  `iva` decimal(5,3) NOT NULL,
  `cantidad` int(11) NOT NULL COMMENT 'Por si en el pedido hay varias unidades de un producto'
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `linea_pedido`
--

INSERT INTO `linea_pedido` (`id`, `pedido_id`, `producto_id`, `precio_venta`, `descuento`, `iva`, `cantidad`) VALUES
(3, 7, 3, '66.000', NULL, '21.000', 3),
(4, 7, 5, '66.000', NULL, '21.000', 1),
(5, 8, 10, '66.000', '55.000', '21.000', 1),
(6, 8, 11, '69.000', '4.000', '21.000', 1),
(7, 9, 3, '66.000', NULL, '21.000', 1),
(8, 9, 7, '64.000', '5.000', '21.000', 1),
(9, 10, 45, '30.900', '10.000', '21.000', 1),
(10, 10, 44, '39.900', '8.000', '21.000', 1),
(11, 11, 5, '66.000', NULL, '21.000', 2),
(12, 12, 5, '66.000', NULL, '21.000', 1),
(13, 12, 3, '66.000', NULL, '21.000', 1),
(14, 13, 7, '64.000', '5.000', '21.000', 1),
(15, 14, 3, '66.000', NULL, '21.000', 1),
(16, 14, 7, '64.000', '5.000', '21.000', 1),
(17, 15, 45, '30.900', '10.000', '21.000', 1),
(18, 16, 8, '40.000', '7.000', '21.000', 1),
(19, 16, 9, '64.000', '5.000', '21.000', 1),
(20, 16, 7, '64.000', '5.000', '21.000', 1),
(21, 17, 26, '59.900', '5.000', '21.000', 1),
(22, 17, 24, '56.900', '7.000', '21.000', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
`id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `estado` char(1) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'P',
  `nombre` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `apellidos` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `dni` varchar(9) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `cod_postal` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `provincia` char(2) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_pedido` datetime NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `importe` decimal(5,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id`, `cliente_id`, `estado`, `nombre`, `apellidos`, `dni`, `direccion`, `cod_postal`, `provincia`, `fecha_pedido`, `email`, `cantidad`, `importe`) VALUES
(7, 5, 'P', 'node', 'node', '48921540b', 'C/ Node', '21005', '06', '2015-03-09 00:00:00', 'node@gmail.com', 4, '100.00'),
(8, 5, 'P', 'node', 'node', '48921540b', 'C/ Node', '21005', '06', '2015-03-09 00:00:00', 'node@gmail.com', 2, '100.00'),
(9, 5, 'P', 'node', 'node', '48921540b', 'C/ Node', '21005', '06', '2015-03-09 00:00:00', 'node@gmail.com', 2, '100.00'),
(10, 5, 'P', 'node', 'node', '48921540b', 'C/ Node', '21005', '06', '2015-03-09 00:00:00', 'node@gmail.com', 2, '70.80'),
(11, 5, 'P', 'node', 'node', '48921540b', 'C/ Node', '21005', '06', '2015-03-09 00:00:00', 'node@gmail.com', 2, '132.00'),
(12, 6, 'P', 'Joaquin', 'Lobo Rodriguez', '48921540b', 'C/ Focha 47', '21045', '21', '2015-03-09 00:00:00', 'jloborod@gmail.com', 2, '132.00'),
(13, 6, 'E', 'Joaquin', 'Lobo Rodriguez', '48921540b', 'C/ Focha 47', '21045', '21', '2015-03-09 00:00:00', 'jloborod@gmail.com', 1, '64.00'),
(14, 4, 'P', 'usuario', 'usuario', '48921540b', 'asdasda', '21004', '02', '2015-03-09 00:00:00', 'jloborod@gmail.com', 2, '130.00'),
(15, 6, 'P', 'Joaquin', 'Lobo Rodriguez', '48921540b', 'C/ Focha 47', '21043', '21', '2015-03-09 00:00:00', 'jloborod@gmail.com', 1, '30.90'),
(16, 6, 'P', 'Joaquin', 'Lobo Rodriguez', '48921540b', 'C/ Focha 47', '21043', '21', '2015-03-09 00:00:00', 'jloborod@gmail.com', 3, '168.00'),
(17, 6, 'P', 'Joaquin', 'Lobo Rodriguez', '48921540b', 'C/ Focha 47', '21043', '21', '2015-03-09 00:00:00', 'jloborod@gmail.com', 2, '116.80');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
`id` int(11) NOT NULL,
  `cod_interno` varchar(45) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Código interno con el que se identifica en la organización',
  `nombre` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `categoria_id` int(11) NOT NULL,
  `precio_venta` decimal(7,2) DEFAULT NULL,
  `descuento` int(11) DEFAULT NULL,
  `imagen` varchar(256) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `iva` decimal(5,3) DEFAULT '21.000',
  `descripcion` varchar(250) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `anuncio` longtext COLLATE utf8_spanish2_ci,
  `destacado` tinyint(1) DEFAULT '0' COMMENT 'Productos destacados sin fecha',
  `fecha_ini_dest` datetime DEFAULT NULL COMMENT 'Para productos destacados en un rango de fechas',
  `fecha_fin_dest` datetime DEFAULT NULL COMMENT 'Productos destacados para un rango de fechas',
  `visible` tinyint(1) DEFAULT '1' COMMENT 'Se puede ocultar por temas de gestión',
  `stock` int(11) DEFAULT NULL COMMENT 'Número de unidades del producto'
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `producto`
--
INSERT INTO `producto` (`id`, `cod_interno`, `nombre`, `categoria_id`, `precio_venta`, `descuento`, `imagen`, `iva`, `descripcion`, `anuncio`, `destacado`, `fecha_ini_dest`, `fecha_fin_dest`, `visible`, `stock`) VALUES
(1, 'game_dying_light_ps4', 'Dying Light', 1, '66.00', NULL, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201408/21/00197578501708____1__600x600.jpg', '21.000', 'Descripción Dying Light', NULL, 0, NULL, NULL, 1, 10),
(2, 'game_far_cry_4_ps4', 'Far Cry 4', 1, '66.00', NULL, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201406/10/00197578501179____1__600x600.jpg', '21.000', 'Descripción Far Cry', NULL, 0, NULL, NULL, 1, 15),
(3, 'game_the_order_1886_ps4', 'The Order 1886', 1, '66.00', NULL, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201410/15/00197578502003____8__600x600.jpg', '21.000', 'Descripción The Order 1886', NULL, 1, NULL, NULL, 1, 14),
(4, 'game_fifa_15_ps4', 'Fifa 15', 1, '66.00', NULL, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201408/20/00197578501088____8__600x600.jpg', '21.000', 'Descripción Fifa 15', NULL, 0, NULL, NULL, 1, 5),
(5, 'game_sombras_mordor_ps4', 'La Tierra Media: Sombras de Mordor', 1, '66.00', NULL, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201409/26/00197578500890____13__600x600.jpg', '21.000', 'Descripción Sombras de Mordor', NULL, 1, NULL, NULL, 1, 16),
(6, 'game_destiny_ps4', 'Destiny', 1, '69.00', 40, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA01/201312/11/00197578500445____1__600x600.jpg', '21.000', 'Descripción Destiny', NULL, 0, NULL, NULL, 1, 3),
(7, 'game_halo_master_chief_collection_xbox_one', 'Halo: The Master Chief Collection', 3, '64.00', 5, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201407/03/00197579500907____1__600x600.jpg', '21.000', 'Descripción Halo The Master Chef Collection', NULL, 1, NULL, NULL, 1, 1),
(8, 'game_dead_or_alive_5_xbox_one', 'Dead or Alive 5: Last Round', 3, '40.00', 7, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201412/23/00197579501988____1__600x600.jpg', '21.000', 'Descripción Dead or Alive 5: Last Round', NULL, 0, NULL, NULL, 1, 19),
(9, 'game_forza_horizon_2_xbox_one', 'Forza Horizon 2', 3, '64.00', 5, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201407/03/00197579500881____1__600x600.jpg', '21.000', 'Descripción Forza Horizon 2', NULL, 0, NULL, NULL, 1, 14),
(10, 'game_forza_motorsport_5_xbox_one', 'Forza Motorsport 5', 3, '66.00', 55, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA01/201311/20/00197579500097____1__600x600.jpg', '21.000', 'Descripción Forza Motorsport 5', NULL, 1, NULL, NULL, 1, 2),
(11, 'game_evil_within_xbox_one', 'Evil Within', 3, '69.00', 4, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201406/05/00197579500725____1__600x600.jpg', '21.000', 'Descripción Evil Within', NULL, 1, NULL, NULL, 1, 6),
(12, 'game_tomb_raider_de_xbox_one', 'Tomb Raider Definitive Edition', 3, '59.00', 5, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA01/201401/09/00197579500410____1__600x600.jpg', '21.000', 'Tomb Raider Definitive Edition', NULL, 0, NULL, NULL, 1, 12),
(13, 'game_sniper_elite_3_xbox_one', 'Sniper Elite 3', 3, '40.00', 7, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201403/10/00197579500535____6__600x600.jpg', '21.000', 'Descripción Sniper Elite III', NULL, 1, NULL, NULL, 1, 2),
(14, 'game_starcraft2_heart_of_swarm_pc ', 'Starcraft II: Heart Of The Swarm', 9, '20.90', 14, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/IMAGENES02/201301/18/00197560507721____1__600x600.jpg', '21.000', 'Descripción Starcraft II: Heart Of The Swarm', NULL, 0, NULL, NULL, 1, 20),
(15, 'game_sid_meier_civilization_v_pc ', 'Sid Meier Civilization V: Beyond Earth', 9, '48.90', 6, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201405/19/00197560510592____1__600x600.jpg', '21.000', 'Descripción Sid Meier Civilization V: Beyond Earth', NULL, 1, NULL, NULL, 1, 10),
(16, 'game_warlords_of_draenor_pc', 'World Of Warcraft: Warlords Of Draenor', 9, '41.90', 7, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201408/20/00197560510436____7__600x600.jpg', '21.000', 'Descripción World Of Warcraft: Warlords of Draenor', NULL, 1, NULL, NULL, 1, 30),
(17, 'game_lord_of_fallen_pc', 'Lords Of The Fallen Edición Limitada', 9, '35.90', 8, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201408/28/00197560511095____1__600x600.jpg', '21.000', 'Descripción Lords Of The Fallen Edición Limitada', NULL, 1, NULL, NULL, 1, 8),
(18, 'game_diablo_3_pc', 'Diablo III', 9, '44.90', 7, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA01/201305/03/00128617770723____8__600x600.jpg', NULL, 'Descripción Diablo III', NULL, 0, NULL, NULL, 1, 20),
(19, 'game_last_of_us_remasterizado_ps4', 'The Last Of Us Remasterizado', 1, '49.90', 6, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201404/25/00197578500973____1__600x600.jpg', '21.000', 'The Last Of Us Remasterizado', NULL, NULL, '2015-03-07 00:00:00', '2015-03-14 00:00:00', 1, 12),
(20, 'game_bloodborne_ps4', 'Bloodborne', 1, '69.90', 4, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201412/11/00197578502029____9__600x600.jpg', '21.000', 'Descripción Bloodborne', NULL, 1, NULL, NULL, 1, 16),
(21, 'game_infamous_second_son_ps4', 'Infamous Second Son', 1, '40.00', 7, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201402/14/00197578500486____12__600x600.jpg', '21.000', 'Descripción Infamous Second Son', NULL, 0, NULL, NULL, 1, 4),
(22, 'game_batman_arkham_knight_ps4', 'Batman: Arkham Knight', 1, '69.90', 4, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201403/14/00197578500825____1__600x600.jpg', '21.000', 'Descripción Batman: Arkham Knight', NULL, 1, NULL, NULL, 1, 20),
(23, 'game_mario_party_10_wii_u', 'Mario Party 10', 6, '42.90', 7, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201502/25/00197577502491____1__600x600.jpg', '21.000', 'Descripción Mario Party 10', NULL, 1, NULL, NULL, 1, 15),
(24, 'game_the_wind_waker_hd_wii_u', 'The Legend Of Zelda: The Wind Waker Hd', 6, '56.90', 7, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA01/201310/07/00197577501675____1__600x600.jpg', '21.000', 'Descripción The Legend Of Zelda: The Wind Waker Hd', NULL, 1, NULL, NULL, 1, 4),
(26, 'game_super_smash_bros_wii_u', 'Super Smash Bros', 6, '59.90', 5, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201410/22/00197577502400____3__600x600.jpg', '21.000', 'Descripción Super Smash Bros', NULL, 1, NULL, NULL, 1, 5),
(28, 'game_super_mario_3d_world_wii_u', 'Super Mario 3d World', 6, '59.90', 5, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA01/201311/20/00197577501725____3__600x600.jpg', '21.000', 'Descripción Super Mario 3d World', NULL, 0, NULL, NULL, 1, 15),
(29, 'game_captain_toad_treasure_tracker_wii_u', 'Captain Toad: Treasure Tracker', 6, '42.90', 7, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201410/20/00197577502442____1__600x600.jpg', '21.000', 'Descripción Captain Toad: Treasure Tracker', NULL, 0, NULL, NULL, 1, 7),
(30, 'game_wii_party_u_wii_u', 'Wii Party U', 6, '49.90', 6, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201410/15/00197577502376____1__600x600.jpg', '21.000', 'Descripción Wii Party U', NULL, 0, NULL, NULL, 1, 6),
(31, 'game_just_dance_2014_wii_u', 'Just Dance 2014', 6, '29.90', 10, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA01/201309/26/00197577501774____1__600x600.jpg', '21.000', 'Descripción Just Dance 2014', NULL, 1, NULL, NULL, 1, 6),
(32, 'game_disney_epic_mickey_2_wii_u', 'Disney Epic Mickey 2', 6, '59.90', 25, 'http://sgfm.elcorteingles.es/SGFM/00/79/2/97577500792/97577500792000g01011.jpg', '21.000', 'Descripción Disney Epic Mickey 2: El Retorno De Dos Héroes', NULL, 0, '2015-03-07 09:00:00', '2015-03-14 08:00:00', 1, 20),
(33, 'game_monster_hunter_4_ultimate_3ds', 'Monster Hunter 4: Ultimate', 7, '46.90', 6, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201501/21/00197571529623____1__600x600.jpg', '21.000', 'Descripción Monster Hunter 4: Ultimate', NULL, 1, NULL, NULL, 1, NULL),
(34, 'game_big_hero_6_3ds', 'Big Hero 6: Batalla En La Bahía', 7, '39.90', 8, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201412/16/00197571529490____1__600x600.jpg', '21.000', 'Descripción Big Hero 6: Batalla En La Bahía', NULL, 1, NULL, NULL, 1, 12),
(35, 'game_bob_esponja_el_heroe_3ds', 'Bob Esponja, El Héroe', 7, '29.90', 10, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201501/15/00197571529615____1__600x600.jpg', '21.000', 'Descripción Bob Esponja, El Héroe', NULL, 0, NULL, NULL, 1, 12),
(36, 'game_universo_en_peligro_3ds', 'Lego Marvel Super Heroes: Universo En Peligro', 7, '20.90', 14, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA01/201307/23/00197571527817____2__600x600.jpg', '21.000', 'Descripción Lego Marvel Super Heroes: Universo En Peligro', NULL, 1, NULL, NULL, 1, 6),
(37, 'game_tomodachi_life_3ds', 'Tomodachi Life', 7, '42.90', 7, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201405/14/00197571528864____1__600x600.jpg', '21.000', 'Descripción Tomodachi Life', NULL, 1, NULL, NULL, 1, 9),
(38, 'game_minecraft_vita_edition_ps_vita', 'Minecraft Playstation Vita Edition', 8, '20.90', 14, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201406/10/00197576502161____1__600x600.jpg', '21.000', 'Descripción Minecraft Playstation Vita Edition', NULL, 1, NULL, NULL, 1, 16),
(39, 'game_invizimals_la_resistencia_ps_vita', 'Invizimals: La Resistencia', 8, '30.90', 10, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201407/09/00197576502211____1__600x600.jpg', '21.000', 'Descripción Invizimals: La Resistencia', NULL, 1, NULL, NULL, 1, 14),
(40, 'game_dynasty_warriors_8_ps_vita', 'Dynasty Warriors 8 Xtreme Legends Complete Ed', 8, '39.90', 8, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201402/27/00197576501916____1__600x600.jpg', '21.000', 'Descripción Dynasty Warriors 8 Xtreme Legends Complete Edition', NULL, 0, NULL, NULL, 1, 12),
(41, 'game_the_muppets_ps_vita', 'The Muppets Aventuras De Película', 8, '29.90', 10, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201410/06/00197576502344____1__600x600.jpg', '21.000', 'Descripción The Muppets Aventuras De Película', NULL, 1, NULL, NULL, 1, 11),
(42, 'game_lego_batman_3_ps_vita', 'Lego Batman 3: Más Allá De Gotham', 8, '42.90', 7, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201409/26/00197576502153____8__600x600.jpg', '21.000', 'Descripción Lego Batman 3: Más Allá De Gotham', NULL, 0, NULL, NULL, 1, 16),
(43, 'game_undead_and_undressed_ps_vita', 'Akiba''S Trip: Undead & Undressed', 8, '41.90', 7, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201410/14/00197576502286____1__600x600.jpg', '21.000', 'Descripción Akiba''S Trip: Undead & Undressed', NULL, 0, '2015-03-07 08:00:00', '2015-03-14 00:00:00', 1, 12),
(44, 'game_battle_of_z_ps_vita', 'Dragon Ball Z: Battle Of Z', 8, '39.90', 8, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA01/201309/26/00197576501668____1__600x600.jpg', '21.000', 'Descripción Dragon Ball Z: Battle Of Z', NULL, 1, NULL, NULL, 1, 9),
(45, 'game_pets_ps_vita', 'Playstation Pets', 8, '30.90', 10, 'http://sgfm.elcorteingles.es/SGFM/dctm/MEDIA02/CONTENIDOS/201406/03/00197576502112____1__600x600.jpg', '21.000', 'Descripción Playstation Pets', NULL, 1, NULL, NULL, 1, 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE IF NOT EXISTS `provincia` (
  `id` char(2) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`id`, `nombre`) VALUES
('01', 'Alava'),
('02', 'Albacete'),
('03', 'Alicante'),
('04', 'Almera'),
('05', 'Avila'),
('06', 'Badajoz'),
('07', 'Balears (Illes)'),
('08', 'Barcelona'),
('09', 'Burgos'),
('10', 'Cáceres'),
('11', 'Cádiz'),
('12', 'Castellón'),
('13', 'Ciudad Real'),
('14', 'Córdoba'),
('15', 'Coruña (A)'),
('16', 'Cuenca'),
('17', 'Girona'),
('18', 'Granada'),
('19', 'Guadalajara'),
('20', 'Guipzcoa'),
('21', 'Huelva'),
('22', 'Huesca'),
('23', 'Jaén'),
('24', 'León'),
('25', 'Lleida'),
('26', 'Rioja (La)'),
('27', 'Lugo'),
('28', 'Madrid'),
('29', 'Málaga'),
('30', 'Murcia'),
('31', 'Navarra'),
('32', 'Ourense'),
('33', 'Asturias'),
('34', 'Palencia'),
('35', 'Palmas (Las)'),
('36', 'Pontevedra'),
('37', 'Salamanca'),
('38', 'Santa Cruz de Tenerife'),
('39', 'Cantabria'),
('40', 'Segovia'),
('41', 'Sevilla'),
('42', 'Soria'),
('43', 'Tarragona'),
('44', 'Teruel'),
('45', 'Toledo'),
('46', 'Valencia'),
('47', 'Valladolid'),
('48', 'Vizcaya'),
('49', 'Zamora'),
('50', 'Zaragoza'),
('51', 'Ceuta'),
('52', 'Melilla');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_cliente_provincia1_idx` (`provincia_id`);

--
-- Indices de la tabla `linea_pedido`
--
ALTER TABLE `linea_pedido`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_pedido_has_producto_producto1_idx` (`producto_id`), ADD KEY `fk_pedido_has_producto_pedido_idx` (`pedido_id`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_pedido_cliente1_idx` (`cliente_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_producto_categoria1_idx` (`categoria_id`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `linea_pedido`
--
ALTER TABLE `linea_pedido`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
ADD CONSTRAINT `fk_cliente_provincia1` FOREIGN KEY (`provincia_id`) REFERENCES `provincia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `linea_pedido`
--
ALTER TABLE `linea_pedido`
ADD CONSTRAINT `fk_pedido_has_producto_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_pedido_has_producto_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
ADD CONSTRAINT `fk_pedido_cliente1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
ADD CONSTRAINT `fk_producto_categoria1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
