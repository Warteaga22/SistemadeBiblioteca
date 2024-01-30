-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2023 a las 02:21:34
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca_infocenter`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `id_autores` int(11) NOT NULL,
  `nombre_autor` varchar(40) NOT NULL,
  `apellidos_autor` varchar(50) NOT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `genero` varchar(1) DEFAULT 'M',
  `nacionalidad` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `autores`
--

INSERT INTO `autores` (`id_autores`, `nombre_autor`, `apellidos_autor`, `fechanacimiento`, `descripcion`, `genero`, `nacionalidad`) VALUES
(1, 'Gabriel', 'Garcia Marquez', '1927-03-06', '', 'M', 'Colombiana'),
(2, 'Juan', 'Rulfo', '1917-05-16', '', 'M', 'Mexicana'),
(3, 'Octavio', 'Paz', '1914-03-31', '', 'M', 'Mexicana'),
(4, 'Carolina', 'Sanin Paz', '1973-04-28', '', 'F', 'Colombiana'),
(5, 'Pilar', 'Quintana', '1972-03-06', '', 'F', 'Colombiana'),
(6, 'Isabel', 'Allende', '1942-08-02', '', 'F', 'Peruana');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_prestamo`
--

CREATE TABLE `detalle_prestamo` (
  `id_detalle` int(11) NOT NULL,
  `id_prestamo` int(11) DEFAULT NULL,
  `id_libro` int(11) DEFAULT NULL,
  `cantidad` int(3) DEFAULT NULL,
  `estado` varchar(15) DEFAULT NULL,
  `observaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id_estudiante` int(11) NOT NULL,
  `nro_documento` varchar(15) NOT NULL,
  `nombres` varchar(40) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `grado` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id_estudiante`, `nro_documento`, `nombres`, `apellidos`, `direccion`, `telefono`, `email`, `fechanacimiento`, `grado`) VALUES
(1, '1025880721', 'Santiago', 'Duque Jaramillo', 'Carrea 80 42 -145', '6045759657', 'santiduque@gmail.com', '2010-11-25', 6),
(2, '1025880722', 'Daniela', 'Rodriguez Botero', 'Carrea 80 42 -60', '6045759618', 'danielarodriguez@gmail.com', '2010-05-25', 6),
(3, '1025881452', 'Luisa', 'Arango Mejia', 'Carrea 50 42 -60', '6045759785', 'luisaarango@gmail.com', '2009-05-25', 8),
(4, '1025814752', 'David', 'Restrepo Noreña', 'Cicular 3 66B -60', '6045751485', 'davidresptrepo@gmail.com', '2008-10-25', 9),
(5, '1025808741', 'Simon', 'Jaramillo Cano', 'Carrea 81 76 -60', '6045759843', 'simonjaramillo@gmail.com', '2010-10-01', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id_libro` int(11) NOT NULL,
  `titulo` varchar(120) NOT NULL,
  `genero` varchar(50) DEFAULT NULL,
  `num_paginas` int(3) DEFAULT NULL,
  `editorial` varchar(50) DEFAULT NULL,
  `fecha_publicacion` date DEFAULT NULL,
  `ISBN` varchar(13) DEFAULT NULL,
  `Dewey` varchar(15) DEFAULT NULL,
  `cantidad` int(3) DEFAULT NULL,
  `disponible` int(3) DEFAULT NULL,
  `id_autores` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id_libro`, `titulo`, `genero`, `num_paginas`, `editorial`, `fecha_publicacion`, `ISBN`, `Dewey`, `cantidad`, `disponible`, `id_autores`) VALUES
(1, 'El amor en los tiempos del colera', 'Novela', 490, 'Oveja Negra', '1985-06-25', '78996321541', '8608961', 3, 3, 1),
(2, 'El gallo de oro', 'Novela', 134, 'Ediciones Era', '1980-06-25', '78996321553', '8608962', 2, 2, 2),
(3, 'Bajo tu clara sombra y otros poemas sobre España', 'Poemas', 47, 'Ediciones Españolas', '1937-06-25', '78996321564', '8608963', 1, 1, 3),
(4, 'Todo en otra parte', 'Novela', 271, 'ebooks Patagonia', '2012-06-25', '9789568992170', '8608964', 2, 2, 4),
(5, 'Coleccionistas de polvos raros', 'Novela', 238, 'Grupo Editorial Norma', '2007-01-18', '78996321580', '8608965', 3, 3, 5),
(6, 'Voioleta', 'Novela', 150, 'Plaza & Janes', '2022-06-18', '78996321592', '8608966', 3, 3, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id_prestamo` int(11) NOT NULL,
  `fecha_prestamo` date NOT NULL,
  `fecha_limite` date NOT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `cantidad` int(3) DEFAULT NULL,
  `estado` varchar(15) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_estudiante` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`) VALUES
(1, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `direccion` varchar(70) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `ciudad` varchar(70) DEFAULT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `clave` varchar(70) NOT NULL,
  `id_rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellidos`, `direccion`, `telefono`, `email`, `ciudad`, `fechanacimiento`, `clave`, `id_rol`) VALUES
(1, 'Juan Carlos', 'Acevedo Cano', 'Carrea 74 53 -145', '6045297458', 'juancacevedo@gmail.com', 'Medellin', '1990-02-03', '12345', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`id_autores`);

--
-- Indices de la tabla `detalle_prestamo`
--
ALTER TABLE `detalle_prestamo`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_prestamo` (`id_prestamo`),
  ADD KEY `id_libro` (`id_libro`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id_estudiante`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id_libro`),
  ADD KEY `id_autores` (`id_autores`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id_prestamo`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_estudiante` (`id_estudiante`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autores`
--
ALTER TABLE `autores`
  MODIFY `id_autores` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_prestamo`
--
ALTER TABLE `detalle_prestamo`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id_estudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id_prestamo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_prestamo`
--
ALTER TABLE `detalle_prestamo`
  ADD CONSTRAINT `detalle_prestamo_ibfk_1` FOREIGN KEY (`id_prestamo`) REFERENCES `prestamos` (`id_prestamo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_prestamo_ibfk_2` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`id_autores`) REFERENCES `autores` (`id_autores`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prestamos_ibfk_2` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes` (`id_estudiante`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
