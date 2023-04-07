-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-04-2023 a las 06:20:14
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `votaciones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `candidatos`
--

CREATE TABLE `candidatos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `candidatos`
--

INSERT INTO `candidatos` (`id`, `nombre`, `created_at`) VALUES
(1, 'Candidato 1', '2023-04-05 21:10:12'),
(2, 'Candidato 2', '2023-04-05 21:10:12'),
(3, 'Candidato 3', '2023-04-05 21:10:12'),
(4, 'Candidato 4', '2023-04-05 21:10:12'),
(5, 'Candidato 5', '2023-04-05 21:10:12'),
(6, 'Candidato 6', '2023-04-05 21:10:12'),
(7, 'Candidato 7', '2023-04-05 21:10:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `como_conociste`
--

CREATE TABLE `como_conociste` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `como_conociste`
--

INSERT INTO `como_conociste` (`id`, `descripcion`, `created_at`) VALUES
(1, 'Web', '2023-04-05 21:10:14'),
(2, 'TV', '2023-04-05 21:10:14'),
(3, 'Redes Sociales', '2023-04-05 21:10:14'),
(4, 'Amigo', '2023-04-05 21:10:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `como_conociste_votantes`
--

CREATE TABLE `como_conociste_votantes` (
  `id` int(11) NOT NULL,
  `como_conociste_id` int(11) NOT NULL,
  `votante_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunas`
--

CREATE TABLE `comunas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `region_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comunas`
--

INSERT INTO `comunas` (`id`, `nombre`, `region_id`) VALUES
(1, 'Arica', 1),
(2, 'Camarones', 1),
(3, 'General Lagos', 1),
(4, 'Putre', 1),
(5, 'Alto Hospicio', 2),
(6, 'Iquique', 2),
(7, 'Camiña', 2),
(8, 'Colchane', 2),
(9, 'Huara', 2),
(10, 'Pica', 2),
(11, 'Pozo Almonte', 2),
(12, 'Tocopilla', 3),
(13, 'María Elena', 3),
(14, 'Calama', 3),
(15, 'Ollague', 3),
(16, 'San Pedro de Atacama', 3),
(17, 'Antofagasta', 3),
(18, 'Mejillones', 3),
(19, 'Sierra Gorda', 3),
(20, 'Taltal', 3),
(21, 'Chañaral', 4),
(22, 'Diego de Almagro', 4),
(23, 'Copiapó', 4),
(24, 'Caldera', 4),
(25, 'Tierra Amarilla', 4),
(26, 'Vallenar', 4),
(27, 'Alto del Carmen', 4),
(28, 'Freirina', 4),
(29, 'Huasco', 4),
(30, 'La Serena', 5),
(31, 'Coquimbo', 5),
(32, 'Andacollo', 5),
(33, 'La Higuera', 5),
(34, 'Paihuano', 5),
(35, 'Vicuña', 5),
(36, 'Ovalle', 5),
(37, 'Combarbalá', 5),
(38, 'Monte Patria', 5),
(39, 'Punitaqui', 5),
(40, 'Río Hurtado', 5),
(41, 'Illapel', 5),
(42, 'Canela', 5),
(43, 'Los Vilos', 5),
(44, 'Salamanca', 5),
(45, 'La Ligua', 6),
(46, 'Cabildo', 6),
(47, 'Zapallar', 6),
(48, 'Papudo', 6),
(49, 'Petorca', 6),
(50, 'Los Andes', 6),
(51, 'San Esteban', 6),
(52, 'Calle Larga', 6),
(53, 'Rinconada', 6),
(54, 'San Felipe', 6),
(55, 'Llaillay', 6),
(56, 'Putaendo', 6),
(57, 'Santa María', 6),
(58, 'Catemu', 6),
(59, 'Panquehue', 6),
(60, 'Quillota', 6),
(61, 'La Cruz', 6),
(62, 'La Calera', 6),
(63, 'Nogales', 6),
(64, 'Hijuelas', 6),
(65, 'Valparaíso', 6),
(66, 'Viña del Mar', 6),
(67, 'Concón', 6),
(68, 'Quintero', 6),
(69, 'Puchuncaví', 6),
(70, 'Casablanca', 6),
(71, 'Juan Fernández', 6),
(72, 'San Antonio', 6),
(73, 'Cartagena', 6),
(74, 'El Tabo', 6),
(75, 'El Quisco', 6),
(76, 'Algarrobo', 6),
(77, 'Santo Domingo', 6),
(78, 'Isla de Pascua', 6),
(79, 'Quilpué', 6),
(80, 'Limache', 6),
(81, 'Olmué', 6),
(82, 'Villa Alemana', 6),
(83, 'Colina', 7),
(84, 'Lampa', 7),
(85, 'Tiltil', 7),
(86, 'Santiago', 7),
(87, 'Vitacura', 7),
(88, 'San Ramón', 7),
(89, 'San Miguel', 7),
(90, 'San Joaquín', 7),
(91, 'Renca', 7),
(92, 'Recoleta', 7),
(93, 'Quinta Normal', 7),
(94, 'Quilicura', 7),
(95, 'Pudahuel', 7),
(96, 'Providencia', 7),
(97, 'Peñalolén', 7),
(98, 'Pedro Aguirre Cerda', 7),
(99, 'Ñuñoa', 7),
(100, 'Maipú', 7),
(101, 'Macul', 7),
(102, 'Lo Prado', 7),
(103, 'Lo Espejo', 7),
(104, 'Lo Barnechea', 7),
(105, 'Las Condes', 7),
(106, 'La Reina', 7),
(107, 'La Pintana', 7),
(108, 'La Granja', 7),
(109, 'La Florida', 7),
(110, 'La Cisterna', 7),
(111, 'Independencia', 7),
(112, 'Huechuraba', 7),
(113, 'Estación Central', 7),
(114, 'El Bosque', 7),
(115, 'Conchalí', 7),
(116, 'Cerro Navia', 7),
(117, 'Cerrillos', 7),
(118, 'Puente Alto', 7),
(119, 'San José de Maipo', 7),
(120, 'Pirque', 7),
(121, 'San Bernardo', 7),
(122, 'Buin', 7),
(123, 'Paine', 7),
(124, 'Calera de Tango', 7),
(125, 'Melipilla', 7),
(126, 'Alhué', 7),
(127, 'Curacaví', 7),
(128, 'María Pinto', 7),
(129, 'San Pedro', 7),
(130, 'Isla de Maipo', 7),
(131, 'El Monte', 7),
(132, 'Padre Hurtado', 7),
(133, 'Peñaflor', 7),
(134, 'Talagante', 7),
(135, 'Codegua', 8),
(136, 'Coínco', 8),
(137, 'Coltauco', 8),
(138, 'Doñihue', 8),
(139, 'Graneros', 8),
(140, 'Las Cabras', 8),
(141, 'Machalí', 8),
(142, 'Malloa', 8),
(143, 'Mostazal', 8),
(144, 'Olivar', 8),
(145, 'Peumo', 8),
(146, 'Pichidegua', 8),
(147, 'Quinta de Tilcoco', 8),
(148, 'Rancagua', 8),
(149, 'Rengo', 8),
(150, 'Requínoa', 8),
(151, 'San Vicente de Tagua Tagua', 8),
(152, 'Chépica', 8),
(153, 'Chimbarongo', 8),
(154, 'Lolol', 8),
(155, 'Nancagua', 8),
(156, 'Palmilla', 8),
(157, 'Peralillo', 8),
(158, 'Placilla', 8),
(159, 'Pumanque', 8),
(160, 'San Fernando', 8),
(161, 'Santa Cruz', 8),
(162, 'La Estrella', 8),
(163, 'Litueche', 8),
(164, 'Marchigüe', 8),
(165, 'Navidad', 8),
(166, 'Paredones', 8),
(167, 'Pichilemu', 8),
(168, 'Curicó', 9),
(169, 'Hualañé', 9),
(170, 'Licantén', 9),
(171, 'Molina', 9),
(172, 'Rauco', 9),
(173, 'Romeral', 9),
(174, 'Sagrada Familia', 9),
(175, 'Teno', 9),
(176, 'Vichuquén', 9),
(177, 'Talca', 9),
(178, 'San Clemente', 9),
(179, 'Pelarco', 9),
(180, 'Pencahue', 9),
(181, 'Maule', 9),
(182, 'San Rafael', 9),
(183, 'Curepto', 9),
(184, 'Constitución', 9),
(185, 'Empedrado', 9),
(186, 'Río Claro', 9),
(187, 'Linares', 9),
(188, 'San Javier', 9),
(189, 'Parral', 9),
(190, 'Villa Alegre', 9),
(191, 'Longaví', 9),
(192, 'Colbún', 9),
(193, 'Retiro', 9),
(194, 'Yerbas Buenas', 9),
(195, 'Cauquenes', 9),
(196, 'Chanco', 9),
(197, 'Pelluhue', 9),
(198, 'Bulnes', 10),
(199, 'Chillán', 10),
(200, 'Chillán Viejo', 10),
(201, 'El Carmen', 10),
(202, 'Pemuco', 10),
(203, 'Pinto', 10),
(204, 'Quillón', 10),
(205, 'San Ignacio', 10),
(206, 'Yungay', 10),
(207, 'Cobquecura', 10),
(208, 'Coelemu', 10),
(209, 'Ninhue', 10),
(210, 'Portezuelo', 10),
(211, 'Quirihue', 10),
(212, 'Ránquil', 10),
(213, 'Treguaco', 10),
(214, 'San Carlos', 10),
(215, 'Coihueco', 10),
(216, 'San Nicolás', 10),
(217, 'Ñiquén', 10),
(218, 'San Fabián', 10),
(219, 'Alto Biobío', 11),
(220, 'Antuco', 11),
(221, 'Cabrero', 11),
(222, 'Laja', 11),
(223, 'Los Ángeles', 11),
(224, 'Mulchén', 11),
(225, 'Nacimiento', 11),
(226, 'Negrete', 11),
(227, 'Quilaco', 11),
(228, 'Quilleco', 11),
(229, 'San Rosendo', 11),
(230, 'Santa Bárbara', 11),
(231, 'Tucapel', 11),
(232, 'Yumbel', 11),
(233, 'Concepción', 11),
(234, 'Coronel', 11),
(235, 'Chiguayante', 11),
(236, 'Florida', 11),
(237, 'Hualpén', 11),
(238, 'Hualqui', 11),
(239, 'Lota', 11),
(240, 'Penco', 11),
(241, 'San Pedro de La Paz', 11),
(242, 'Santa Juana', 11),
(243, 'Talcahuano', 11),
(244, 'Tomé', 11),
(245, 'Arauco', 11),
(246, 'Cañete', 11),
(247, 'Contulmo', 11),
(248, 'Curanilahue', 11),
(249, 'Lebu', 11),
(250, 'Los Álamos', 11),
(251, 'Tirúa', 11),
(252, 'Angol', 12),
(253, 'Collipulli', 12),
(254, 'Curacautín', 12),
(255, 'Ercilla', 12),
(256, 'Lonquimay', 12),
(257, 'Los Sauces', 12),
(258, 'Lumaco', 12),
(259, 'Purén', 12),
(260, 'Renaico', 12),
(261, 'Traiguén', 12),
(262, 'Victoria', 12),
(263, 'Temuco', 12),
(264, 'Carahue', 12),
(265, 'Cholchol', 12),
(266, 'Cunco', 12),
(267, 'Curarrehue', 12),
(268, 'Freire', 12),
(269, 'Galvarino', 12),
(270, 'Gorbea', 12),
(271, 'Lautaro', 12),
(272, 'Loncoche', 12),
(273, 'Melipeuco', 12),
(274, 'Nueva Imperial', 12),
(275, 'Padre Las Casas', 12),
(276, 'Perquenco', 12),
(277, 'Pitrufquén', 12),
(278, 'Pucón', 12),
(279, 'Saavedra', 12),
(280, 'Teodoro Schmidt', 12),
(281, 'Toltén', 12),
(282, 'Vilcún', 12),
(283, 'Villarrica', 12),
(284, 'Valdivia', 13),
(285, 'Corral', 13),
(286, 'Lanco', 13),
(287, 'Los Lagos', 13),
(288, 'Máfil', 13),
(289, 'Mariquina', 13),
(290, 'Paillaco', 13),
(291, 'Panguipulli', 13),
(292, 'La Unión', 13),
(293, 'Futrono', 13),
(294, 'Lago Ranco', 13),
(295, 'Río Bueno', 13),
(296, 'Osorno', 14),
(297, 'Puerto Octay', 14),
(298, 'Purranque', 14),
(299, 'Puyehue', 14),
(300, 'Río Negro', 14),
(301, 'San Juan de la Costa', 14),
(302, 'San Pablo', 14),
(303, 'Calbuco', 14),
(304, 'Cochamó', 14),
(305, 'Fresia', 14),
(306, 'Frutillar', 14),
(307, 'Llanquihue', 14),
(308, 'Los Muermos', 14),
(309, 'Maullín', 14),
(310, 'Puerto Montt', 14),
(311, 'Puerto Varas', 14),
(312, 'Ancud', 14),
(313, 'Castro', 14),
(314, 'Chonchi', 14),
(315, 'Curaco de Vélez', 14),
(316, 'Dalcahue', 14),
(317, 'Puqueldón', 14),
(318, 'Queilén', 14),
(319, 'Quellón', 14),
(320, 'Quemchi', 14),
(321, 'Quinchao', 14),
(322, 'Chaitén', 14),
(323, 'Futaleufú', 14),
(324, 'Hualaihué', 14),
(325, 'Palena', 14),
(326, 'Lago Verde', 15),
(327, 'Coihaique', 15),
(328, 'Aysén', 15),
(329, 'Cisnes', 15),
(330, 'Guaitecas', 15),
(331, 'Río Ibáñez', 15),
(332, 'Chile Chico', 15),
(333, 'Cochrane', 15),
(334, 'O\'Higgins', 15),
(335, 'Tortel', 15),
(336, 'Natales', 16),
(337, 'Torres del Paine', 16),
(338, 'Laguna Blanca', 16),
(339, 'Punta Arenas', 16),
(340, 'Río Verde', 16),
(341, 'San Gregorio', 16),
(342, 'Porvenir', 16),
(343, 'Primavera', 16),
(344, 'Timaukel', 16),
(345, 'Cabo de Hornos', 16),
(346, 'Antártica', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regiones`
--

CREATE TABLE `regiones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `ordinal` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `regiones`
--

INSERT INTO `regiones` (`id`, `nombre`, `ordinal`) VALUES
(1, 'Arica y Parinacota', 'XV'),
(2, 'Tarapacá', 'I'),
(3, 'Antofagasta', 'II'),
(4, 'Atacama', 'III'),
(5, 'Coquimbo', 'IV'),
(6, 'Valparaisoo', 'V'),
(7, 'Metropolitana de Santiago', 'RM'),
(8, 'Libertador General Bernardo O\'Higgins', 'VI'),
(9, 'Maule', 'VII'),
(10, 'Ñuble', 'XVI'),
(11, 'Biobío', 'VIII'),
(12, 'La Araucanía', 'IX'),
(13, 'Los Ríoss', 'XIV'),
(14, 'Los Lagos', 'X'),
(15, 'Aysén del General Carlos Ibáñez del Campo', 'XI'),
(16, 'Magallanes y de la Antártica Chilena', 'XII');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votaciones`
--

CREATE TABLE `votaciones` (
  `id` int(11) NOT NULL,
  `votante_id` int(11) NOT NULL,
  `candidato_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votantes`
--

CREATE TABLE `votantes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `rut` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `region_id` int(11) NOT NULL,
  `comuna_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `candidatos`
--
ALTER TABLE `candidatos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `como_conociste`
--
ALTER TABLE `como_conociste`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `como_conociste_votantes`
--
ALTER TABLE `como_conociste_votantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `como_conociste_id` (`como_conociste_id`) USING BTREE,
  ADD KEY `votante_id` (`votante_id`) USING BTREE;

--
-- Indices de la tabla `comunas`
--
ALTER TABLE `comunas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region_id` (`region_id`);

--
-- Indices de la tabla `regiones`
--
ALTER TABLE `regiones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `votaciones`
--
ALTER TABLE `votaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_votante` (`votante_id`),
  ADD KEY `id_candidato` (`candidato_id`);

--
-- Indices de la tabla `votantes`
--
ALTER TABLE `votantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region_id` (`region_id`),
  ADD KEY `comuna_id` (`comuna_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `candidatos`
--
ALTER TABLE `candidatos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `como_conociste`
--
ALTER TABLE `como_conociste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `como_conociste_votantes`
--
ALTER TABLE `como_conociste_votantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `comunas`
--
ALTER TABLE `comunas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=347;

--
-- AUTO_INCREMENT de la tabla `regiones`
--
ALTER TABLE `regiones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `votaciones`
--
ALTER TABLE `votaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `votantes`
--
ALTER TABLE `votantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `como_conociste_votantes`
--
ALTER TABLE `como_conociste_votantes`
  ADD CONSTRAINT `como_conociste_votantes_ibfk_1` FOREIGN KEY (`como_conociste_id`) REFERENCES `como_conociste` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `como_conociste_votantes_ibfk_2` FOREIGN KEY (`votante_id`) REFERENCES `votantes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comunas`
--
ALTER TABLE `comunas`
  ADD CONSTRAINT `comunas_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regiones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `votaciones`
--
ALTER TABLE `votaciones`
  ADD CONSTRAINT `votaciones_ibfk_1` FOREIGN KEY (`votante_id`) REFERENCES `votantes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `votaciones_ibfk_2` FOREIGN KEY (`candidato_id`) REFERENCES `candidatos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `votantes`
--
ALTER TABLE `votantes`
  ADD CONSTRAINT `votantes_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regiones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `votantes_ibfk_2` FOREIGN KEY (`comuna_id`) REFERENCES `comunas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
