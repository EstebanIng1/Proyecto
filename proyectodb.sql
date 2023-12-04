-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-10-2023 a las 04:44:14
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectodb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colegios`
--

CREATE TABLE `colegios` (
  `id_colegios` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `total_estudiantes` int(11) NOT NULL,
  `tipo_de_colegio` varchar(50) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `logo` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `colegios`
--

INSERT INTO `colegios` (`id_colegios`, `nombre`, `total_estudiantes`, `tipo_de_colegio`, `direccion`, `logo`) VALUES
(120, 'INSTITUTO INTEGRADO DE SOACHA', 770, 'NO OFICIAL', 'INSTITUTO INTEGRADO DE SOACHA', 'logos/COLEGIO_LOGO_DASD.png'),
(121, 'INSTITUCION EDUCATIVA CAZUCA', 1234, 'OFICIAL', 'CAZUCA', 'logos/COLEGIO_LOGO_ARLEY_2.png'),
(122, 'INSTITUCION EDUCATIVA SAN MATEO', 890, 'OFICIAL', 'SAN MATEO SOACHA', 'logos/R.png'),
(125, 'INSTITUCION EDUCATIVA GENERAL SANTANDER', 630, 'OFICIAL', 'GENERAL SANTANDER', 'logos/COLEGIO_LOGO_LEYDER.png'),
(126, 'COLEGIO MIGUEL DE CERVANTES', 360, 'NO OFICIAL', 'MIGUEL DE CERVANTES', 'logos/COLEGIO_LOGO_TONY.png'),
(127, 'INSTITUCION EDUCATIVA LAS VILLAS', 790, 'NO OFICIAL', 'LAS VILLAS', 'logos/COLEGIO_LOGO_SOFIA.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colegios_icfes_prom_cienciasn`
--

CREATE TABLE `colegios_icfes_prom_cienciasn` (
  `id` int(11) NOT NULL,
  `id_colegios` int(11) DEFAULT NULL,
  `promedio_ciencias_naturales` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `colegios_icfes_prom_cienciasn`
--

INSERT INTO `colegios_icfes_prom_cienciasn` (`id`, `id_colegios`, `promedio_ciencias_naturales`) VALUES
(4, 120, 40),
(5, 122, 70),
(6, 126, 67),
(7, 127, 38),
(8, 121, 30),
(9, 125, 36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colegios_icfes_prom_global`
--

CREATE TABLE `colegios_icfes_prom_global` (
  `id` int(11) NOT NULL,
  `id_colegios` int(11) DEFAULT NULL,
  `tipo_de_colegio` varchar(50) NOT NULL,
  `promedio_global` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `colegios_icfes_prom_global`
--

INSERT INTO `colegios_icfes_prom_global` (`id`, `id_colegios`, `tipo_de_colegio`, `promedio_global`) VALUES
(4, 120, '', 350),
(5, 122, '', 290),
(6, 126, '', 320),
(7, 127, '', 310),
(8, 121, '', 270),
(9, 125, '', 250);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colegios_icfes_prom_ingles`
--

CREATE TABLE `colegios_icfes_prom_ingles` (
  `id` int(11) NOT NULL,
  `id_colegios` int(11) DEFAULT NULL,
  `promedio_ingles` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `colegios_icfes_prom_ingles`
--

INSERT INTO `colegios_icfes_prom_ingles` (`id`, `id_colegios`, `promedio_ingles`) VALUES
(4, 120, 20),
(5, 122, 45),
(6, 126, 20),
(7, 127, 80),
(8, 121, 50),
(9, 125, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colegios_icfes_prom_lectura`
--

CREATE TABLE `colegios_icfes_prom_lectura` (
  `id` int(11) NOT NULL,
  `id_colegios` int(11) DEFAULT NULL,
  `promedio_lectura` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `colegios_icfes_prom_lectura`
--

INSERT INTO `colegios_icfes_prom_lectura` (`id`, `id_colegios`, `promedio_lectura`) VALUES
(4, 120, 80),
(5, 122, 90),
(6, 126, 39),
(7, 127, 60),
(8, 121, 70),
(9, 125, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colegios_icfes_prom_matematicas`
--

CREATE TABLE `colegios_icfes_prom_matematicas` (
  `id` int(11) NOT NULL,
  `id_colegios` int(11) DEFAULT NULL,
  `promedio_matematicas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `colegios_icfes_prom_matematicas`
--

INSERT INTO `colegios_icfes_prom_matematicas` (`id`, `id_colegios`, `promedio_matematicas`) VALUES
(4, 120, 70),
(5, 122, 40),
(6, 126, 80),
(7, 127, 70),
(8, 121, 80),
(9, 125, 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colegios_icfes_prom_sociales`
--

CREATE TABLE `colegios_icfes_prom_sociales` (
  `id` int(11) NOT NULL,
  `id_colegios` int(11) DEFAULT NULL,
  `promedio_ciencias_sociales` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `colegios_icfes_prom_sociales`
--

INSERT INTO `colegios_icfes_prom_sociales` (`id`, `id_colegios`, `promedio_ciencias_sociales`) VALUES
(4, 120, 100),
(5, 122, 80),
(6, 126, 70),
(7, 127, 46),
(8, 121, 40),
(9, 125, 60);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coordenadas`
--

CREATE TABLE `coordenadas` (
  `id` int(11) NOT NULL,
  `id_colegios` int(11) DEFAULT NULL,
  `latitud` decimal(9,6) DEFAULT NULL,
  `longitud` decimal(9,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornada_completa`
--

CREATE TABLE `jornada_completa` (
  `id` int(11) NOT NULL,
  `id_colegios` int(11) DEFAULT NULL,
  `estudiantes_completa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `jornada_completa`
--

INSERT INTO `jornada_completa` (`id`, `id_colegios`, `estudiantes_completa`) VALUES
(57, 120, 120),
(58, 122, 890),
(59, 126, 360);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornada_completa_5_años`
--

CREATE TABLE `jornada_completa_5_años` (
  `id` int(11) NOT NULL,
  `id_colegios` int(11) DEFAULT NULL,
  `completa_2021` int(11) DEFAULT NULL,
  `completa_2020` int(11) DEFAULT NULL,
  `completa_2019` int(11) DEFAULT NULL,
  `completa_2018` int(11) DEFAULT NULL,
  `completa_2017` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `jornada_completa_5_años`
--

INSERT INTO `jornada_completa_5_años` (`id`, `id_colegios`, `completa_2021`, `completa_2020`, `completa_2019`, `completa_2018`, `completa_2017`) VALUES
(1, 120, 1, 2, 3, 4, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornada_manana`
--

CREATE TABLE `jornada_manana` (
  `id` int(11) NOT NULL,
  `id_colegios` int(11) DEFAULT NULL,
  `estudiantes_manana` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `jornada_manana`
--

INSERT INTO `jornada_manana` (`id`, `id_colegios`, `estudiantes_manana`) VALUES
(62, 120, 430),
(63, 121, 730),
(64, 125, 330),
(65, 127, 370);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornada_manana_5_años`
--

CREATE TABLE `jornada_manana_5_años` (
  `id` int(11) NOT NULL,
  `id_colegios` int(11) DEFAULT NULL,
  `manana_2021` int(11) DEFAULT NULL,
  `manana_2020` int(11) DEFAULT NULL,
  `manana_2019` int(11) DEFAULT NULL,
  `manana_2018` int(11) DEFAULT NULL,
  `manana_2017` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `jornada_manana_5_años`
--

INSERT INTO `jornada_manana_5_años` (`id`, `id_colegios`, `manana_2021`, `manana_2020`, `manana_2019`, `manana_2018`, `manana_2017`) VALUES
(1, 120, 100, 200, 300, 400, 500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornada_noche`
--

CREATE TABLE `jornada_noche` (
  `id` int(11) NOT NULL,
  `id_colegios` int(11) DEFAULT NULL,
  `estudiantes_noche` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `jornada_noche`
--

INSERT INTO `jornada_noche` (`id`, `id_colegios`, `estudiantes_noche`) VALUES
(43, 127, 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornada_noche_5_años`
--

CREATE TABLE `jornada_noche_5_años` (
  `id` int(11) NOT NULL,
  `id_colegios` int(11) DEFAULT NULL,
  `noche_2021` int(11) DEFAULT NULL,
  `noche_2020` int(11) DEFAULT NULL,
  `noche_2019` int(11) DEFAULT NULL,
  `noche_2018` int(11) DEFAULT NULL,
  `noche_2017` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `jornada_noche_5_años`
--

INSERT INTO `jornada_noche_5_años` (`id`, `id_colegios`, `noche_2021`, `noche_2020`, `noche_2019`, `noche_2018`, `noche_2017`) VALUES
(1, 120, 15, 25, 35, 45, 55);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornada_sabatina`
--

CREATE TABLE `jornada_sabatina` (
  `id` int(11) NOT NULL,
  `id_colegios` int(11) DEFAULT NULL,
  `estudiantes_sabatina` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornada_sabatina_5_años`
--

CREATE TABLE `jornada_sabatina_5_años` (
  `id` int(11) NOT NULL,
  `id_colegios` int(11) DEFAULT NULL,
  `sabatina_2021` int(11) DEFAULT NULL,
  `sabatina_2020` int(11) DEFAULT NULL,
  `sabatina_2019` int(11) DEFAULT NULL,
  `sabatina_2018` int(11) DEFAULT NULL,
  `sabatina_2017` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `jornada_sabatina_5_años`
--

INSERT INTO `jornada_sabatina_5_años` (`id`, `id_colegios`, `sabatina_2021`, `sabatina_2020`, `sabatina_2019`, `sabatina_2018`, `sabatina_2017`) VALUES
(1, 120, 11, 22, 33, 44, 55);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornada_tarde`
--

CREATE TABLE `jornada_tarde` (
  `id` int(11) NOT NULL,
  `id_colegios` int(11) DEFAULT NULL,
  `estudiantes_tarde` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `jornada_tarde`
--

INSERT INTO `jornada_tarde` (`id`, `id_colegios`, `estudiantes_tarde`) VALUES
(56, 120, 350),
(57, 121, 540),
(58, 125, 300),
(59, 127, 300);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornada_tarde_5_años`
--

CREATE TABLE `jornada_tarde_5_años` (
  `id` int(11) NOT NULL,
  `id_colegios` int(11) DEFAULT NULL,
  `tarde_2021` int(11) DEFAULT NULL,
  `tarde_2020` int(11) DEFAULT NULL,
  `tarde_2019` int(11) DEFAULT NULL,
  `tarde_2018` int(11) DEFAULT NULL,
  `tarde_2017` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `jornada_tarde_5_años`
--

INSERT INTO `jornada_tarde_5_años` (`id`, `id_colegios`, `tarde_2021`, `tarde_2020`, `tarde_2019`, `tarde_2018`, `tarde_2017`) VALUES
(1, 120, 1, 2, 3, 4, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `total_estudiantes_5_años`
--

CREATE TABLE `total_estudiantes_5_años` (
  `id` int(11) NOT NULL,
  `id_colegios` int(11) DEFAULT NULL,
  `total_2021` int(11) DEFAULT NULL,
  `total_2020` int(11) DEFAULT NULL,
  `total_2019` int(11) DEFAULT NULL,
  `total_2018` int(11) DEFAULT NULL,
  `total_2017` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `total_estudiantes_5_años`
--

INSERT INTO `total_estudiantes_5_años` (`id`, `id_colegios`, `total_2021`, `total_2020`, `total_2019`, `total_2018`, `total_2017`) VALUES
(2, 120, 100, 20, 300, 400, 500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `contraseña` varchar(100) DEFAULT NULL,
  `cedula` varchar(15) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `foto_de_perfil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `correo`, `contraseña`, `cedula`, `telefono`, `foto_de_perfil`) VALUES
(1, 'William Arley Gómez Serrato', 'arleyg@gmail.com', 'admin', '1003482560', '3133616992', '../logos-perfil/R.png'),
(2, 'sotelo', 'sotelo@gmail.com', 'sotelo', '1234567', '3134567890', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `colegios`
--
ALTER TABLE `colegios`
  ADD PRIMARY KEY (`id_colegios`);

--
-- Indices de la tabla `colegios_icfes_prom_cienciasn`
--
ALTER TABLE `colegios_icfes_prom_cienciasn`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_colegios` (`id_colegios`);

--
-- Indices de la tabla `colegios_icfes_prom_global`
--
ALTER TABLE `colegios_icfes_prom_global`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_colegios` (`id_colegios`);

--
-- Indices de la tabla `colegios_icfes_prom_ingles`
--
ALTER TABLE `colegios_icfes_prom_ingles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_colegios` (`id_colegios`);

--
-- Indices de la tabla `colegios_icfes_prom_lectura`
--
ALTER TABLE `colegios_icfes_prom_lectura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_colegios` (`id_colegios`);

--
-- Indices de la tabla `colegios_icfes_prom_matematicas`
--
ALTER TABLE `colegios_icfes_prom_matematicas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_colegios` (`id_colegios`);

--
-- Indices de la tabla `colegios_icfes_prom_sociales`
--
ALTER TABLE `colegios_icfes_prom_sociales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_colegios` (`id_colegios`);

--
-- Indices de la tabla `coordenadas`
--
ALTER TABLE `coordenadas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_colegios` (`id_colegios`);

--
-- Indices de la tabla `jornada_completa`
--
ALTER TABLE `jornada_completa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_colegios` (`id_colegios`);

--
-- Indices de la tabla `jornada_completa_5_años`
--
ALTER TABLE `jornada_completa_5_años`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_colegios` (`id_colegios`);

--
-- Indices de la tabla `jornada_manana`
--
ALTER TABLE `jornada_manana`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_colegios` (`id_colegios`);

--
-- Indices de la tabla `jornada_manana_5_años`
--
ALTER TABLE `jornada_manana_5_años`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_colegios` (`id_colegios`);

--
-- Indices de la tabla `jornada_noche`
--
ALTER TABLE `jornada_noche`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_colegios` (`id_colegios`);

--
-- Indices de la tabla `jornada_noche_5_años`
--
ALTER TABLE `jornada_noche_5_años`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_colegios` (`id_colegios`);

--
-- Indices de la tabla `jornada_sabatina`
--
ALTER TABLE `jornada_sabatina`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_colegios` (`id_colegios`);

--
-- Indices de la tabla `jornada_sabatina_5_años`
--
ALTER TABLE `jornada_sabatina_5_años`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_colegios` (`id_colegios`);

--
-- Indices de la tabla `jornada_tarde`
--
ALTER TABLE `jornada_tarde`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_colegios` (`id_colegios`);

--
-- Indices de la tabla `jornada_tarde_5_años`
--
ALTER TABLE `jornada_tarde_5_años`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_colegios` (`id_colegios`);

--
-- Indices de la tabla `total_estudiantes_5_años`
--
ALTER TABLE `total_estudiantes_5_años`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_colegios` (`id_colegios`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `colegios`
--
ALTER TABLE `colegios`
  MODIFY `id_colegios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT de la tabla `colegios_icfes_prom_cienciasn`
--
ALTER TABLE `colegios_icfes_prom_cienciasn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `colegios_icfes_prom_global`
--
ALTER TABLE `colegios_icfes_prom_global`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `colegios_icfes_prom_ingles`
--
ALTER TABLE `colegios_icfes_prom_ingles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `colegios_icfes_prom_lectura`
--
ALTER TABLE `colegios_icfes_prom_lectura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `colegios_icfes_prom_matematicas`
--
ALTER TABLE `colegios_icfes_prom_matematicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `colegios_icfes_prom_sociales`
--
ALTER TABLE `colegios_icfes_prom_sociales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `coordenadas`
--
ALTER TABLE `coordenadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `jornada_completa`
--
ALTER TABLE `jornada_completa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `jornada_completa_5_años`
--
ALTER TABLE `jornada_completa_5_años`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `jornada_manana`
--
ALTER TABLE `jornada_manana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `jornada_manana_5_años`
--
ALTER TABLE `jornada_manana_5_años`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `jornada_noche`
--
ALTER TABLE `jornada_noche`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `jornada_noche_5_años`
--
ALTER TABLE `jornada_noche_5_años`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `jornada_sabatina`
--
ALTER TABLE `jornada_sabatina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `jornada_sabatina_5_años`
--
ALTER TABLE `jornada_sabatina_5_años`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `jornada_tarde`
--
ALTER TABLE `jornada_tarde`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `jornada_tarde_5_años`
--
ALTER TABLE `jornada_tarde_5_años`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `total_estudiantes_5_años`
--
ALTER TABLE `total_estudiantes_5_años`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `colegios_icfes_prom_cienciasn`
--
ALTER TABLE `colegios_icfes_prom_cienciasn`
  ADD CONSTRAINT `colegios_icfes_prom_cienciasn_ibfk_1` FOREIGN KEY (`id_colegios`) REFERENCES `colegios` (`id_colegios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `colegios_icfes_prom_global`
--
ALTER TABLE `colegios_icfes_prom_global`
  ADD CONSTRAINT `colegios_icfes_prom_global_ibfk_1` FOREIGN KEY (`id_colegios`) REFERENCES `colegios` (`id_colegios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `colegios_icfes_prom_ingles`
--
ALTER TABLE `colegios_icfes_prom_ingles`
  ADD CONSTRAINT `colegios_icfes_prom_ingles_ibfk_1` FOREIGN KEY (`id_colegios`) REFERENCES `colegios` (`id_colegios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `colegios_icfes_prom_lectura`
--
ALTER TABLE `colegios_icfes_prom_lectura`
  ADD CONSTRAINT `colegios_icfes_prom_lectura_ibfk_1` FOREIGN KEY (`id_colegios`) REFERENCES `colegios` (`id_colegios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `colegios_icfes_prom_matematicas`
--
ALTER TABLE `colegios_icfes_prom_matematicas`
  ADD CONSTRAINT `colegios_icfes_prom_matematicas_ibfk_1` FOREIGN KEY (`id_colegios`) REFERENCES `colegios` (`id_colegios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `colegios_icfes_prom_sociales`
--
ALTER TABLE `colegios_icfes_prom_sociales`
  ADD CONSTRAINT `colegios_icfes_prom_sociales_ibfk_1` FOREIGN KEY (`id_colegios`) REFERENCES `colegios` (`id_colegios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `coordenadas`
--
ALTER TABLE `coordenadas`
  ADD CONSTRAINT `coordenadas_ibfk_1` FOREIGN KEY (`id_colegios`) REFERENCES `colegios` (`id_colegios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `jornada_completa`
--
ALTER TABLE `jornada_completa`
  ADD CONSTRAINT `jornada_completa_ibfk_1` FOREIGN KEY (`id_colegios`) REFERENCES `colegios` (`id_colegios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `jornada_completa_5_años`
--
ALTER TABLE `jornada_completa_5_años`
  ADD CONSTRAINT `jornada_completa_5_años_ibfk_1` FOREIGN KEY (`id_colegios`) REFERENCES `colegios` (`id_colegios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `jornada_manana`
--
ALTER TABLE `jornada_manana`
  ADD CONSTRAINT `jornada_manana_ibfk_1` FOREIGN KEY (`id_colegios`) REFERENCES `colegios` (`id_colegios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `jornada_manana_5_años`
--
ALTER TABLE `jornada_manana_5_años`
  ADD CONSTRAINT `jornada_manana_5_años_ibfk_1` FOREIGN KEY (`id_colegios`) REFERENCES `colegios` (`id_colegios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `jornada_noche`
--
ALTER TABLE `jornada_noche`
  ADD CONSTRAINT `jornada_noche_ibfk_1` FOREIGN KEY (`id_colegios`) REFERENCES `colegios` (`id_colegios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `jornada_noche_5_años`
--
ALTER TABLE `jornada_noche_5_años`
  ADD CONSTRAINT `jornada_noche_5_años_ibfk_1` FOREIGN KEY (`id_colegios`) REFERENCES `colegios` (`id_colegios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `jornada_sabatina`
--
ALTER TABLE `jornada_sabatina`
  ADD CONSTRAINT `jornada_sabatina_ibfk_1` FOREIGN KEY (`id_colegios`) REFERENCES `colegios` (`id_colegios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `jornada_sabatina_5_años`
--
ALTER TABLE `jornada_sabatina_5_años`
  ADD CONSTRAINT `jornada_sabatina_5_años_ibfk_1` FOREIGN KEY (`id_colegios`) REFERENCES `colegios` (`id_colegios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `jornada_tarde`
--
ALTER TABLE `jornada_tarde`
  ADD CONSTRAINT `jornada_tarde_ibfk_1` FOREIGN KEY (`id_colegios`) REFERENCES `colegios` (`id_colegios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `jornada_tarde_5_años`
--
ALTER TABLE `jornada_tarde_5_años`
  ADD CONSTRAINT `jornada_tarde_5_años_ibfk_1` FOREIGN KEY (`id_colegios`) REFERENCES `colegios` (`id_colegios`) ON DELETE CASCADE;

--
-- Filtros para la tabla `total_estudiantes_5_años`
--
ALTER TABLE `total_estudiantes_5_años`
  ADD CONSTRAINT `total_estudiantes_5_años_ibfk_1` FOREIGN KEY (`id_colegios`) REFERENCES `colegios` (`id_colegios`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
