-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-10-2023 a las 04:34:22
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `registro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE `datos` (
  `id` int(7) NOT NULL,
  `rut` varchar(20) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL,
  `region` varchar(20) NOT NULL,
  `comuna` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `id_comuna` int(11) NOT NULL,
  `comuna` varchar(64) NOT NULL,
  `region_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`id_comuna`, `comuna`, `region_id`) VALUES
(1, 'Arica', 1),
(2, 'Parinacota', 1),
(3, 'Iquique', 2),
(4, 'El Tamarugal', 2),
(5, 'Tocopilla', 3),
(6, 'El Loa', 3),
(7, 'Antofagasta', 3),
(8, 'Chañaral', 4),
(9, 'Copiapó', 4),
(10, 'Huasco', 4),
(11, 'Elqui', 5),
(12, 'Limarí', 5),
(13, 'Choapa', 5),
(14, 'Petorca', 6),
(15, 'Los Andes', 6),
(16, 'San Felipe de Aconcagua', 6),
(17, 'Quillota', 6),
(18, 'Valparaiso', 6),
(19, 'San Antonio', 6),
(20, 'Isla de Pascua', 6),
(21, 'Marga Marga', 6),
(22, 'Chacabuco', 7),
(23, 'Santiago', 7),
(24, 'Cordillera', 7),
(25, 'Maipo', 7),
(26, 'Melipilla', 7),
(27, 'Talagante', 7),
(28, 'Cachapoal', 8),
(29, 'Colchagua', 8),
(30, 'Cardenal Caro', 8),
(31, 'Curicó', 9),
(32, 'Talca', 9),
(33, 'Linares', 9),
(34, 'Cauquenes', 9),
(35, 'Diguillín', 10),
(36, 'Itata', 10),
(37, 'Punilla', 10),
(38, 'Bio Bío', 11),
(39, 'Concepción', 11),
(40, 'Arauco', 11),
(41, 'Malleco', 12),
(42, 'Cautín', 12),
(43, 'Valdivia', 13),
(44, 'Ranco', 13),
(45, 'Osorno', 14),
(46, 'Llanquihue', 14),
(47, 'Chiloé', 14),
(48, 'Palena', 14),
(49, 'Coyhaique', 15),
(50, 'Aysén', 15),
(51, 'General Carrera', 15),
(52, 'Capitán Prat', 15),
(53, 'Última Esperanza', 16),
(54, 'Magallanes', 16),
(55, 'Tierra del Fuego', 16),
(56, 'Antártica Chilena', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region`
--

CREATE TABLE `region` (
  `id_region` int(11) NOT NULL,
  `nombre_region` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `region`
--

INSERT INTO `region` (`id_region`, `nombre_region`) VALUES
(1, 'Región de Arica y Parinacota'),
(2, 'Región de Tarapacá'),
(3, 'Región de Antofagasta'),
(4, 'Región de Atacama'),
(5, 'Región de Coquimbo'),
(6, 'Región de Valparaíso'),
(7, 'Región Metropolitana'),
(8, 'Región de O\'Higgins'),
(9, 'Región del Maule'),
(10, 'Región de Ñuble'),
(11, 'Región del Biobío'),
(12, 'Región de La Araucania'),
(13, 'Región de Los Ríos'),
(14, 'Región de Los Lagos'),
(15, 'Región de Aysén'),
(16, 'Región de Magallanes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(50) NOT NULL,
  `nombre_usu` varchar(50) NOT NULL,
  `apellido_usu` varchar(50) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `rut_usu` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `region_usu` varchar(20) NOT NULL,
  `comuna_usu` varchar(20) NOT NULL,
  `respuesta_ent` varchar(20) NOT NULL,
  `candidato` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usu`, `apellido_usu`, `alias`, `rut_usu`, `email`, `region_usu`, `comuna_usu`, `respuesta_ent`, `candidato`) VALUES
(1, 'Juan', 'Pérez', 'juani23', '12345678-9', 'juan@example.com', 'Región Metropolitana', 'Santiago', ' Redes', 'Amigo'),
(2, 'María', 'López', 'mary12', '98765432-1', 'maria@example.com', 'Región de Valparaíso', 'Viña del Mar', 'Web', 'Redes'),
(3, 'Pedro', 'Gómez', 'pedrito42', '45678901-8', 'pedro@example.com', 'Región del Maule', 'Talca', 'Tv', 'Redes'),
(78, 'Michael', 'Marin', 'saya2023', '20408365-7', 'mich.marinp@gmail.co', 'Región de Valparaíso', 'Los Andes', 'TV, Redes Sociales', 'María');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datos`
--
ALTER TABLE `datos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id_comuna`);

--
-- Indices de la tabla `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id_region`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `datos`
--
ALTER TABLE `datos`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id_comuna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `region`
--
ALTER TABLE `region`
  MODIFY `id_region` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
