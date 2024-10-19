-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-10-2024 a las 17:21:01
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `concesionaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id_marca` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id_marca`, `nombre`, `imagen`) VALUES
(8, 'Mercedes Benz', 'img/vehiculos/6712a39d90a24.jpg'),
(9, 'Volkswagen ', 'img/vehiculos/6712a3a687cf4.jpg'),
(10, 'Ford', 'img/vehiculos/6712a3f5242e5.jpg'),
(11, 'Fiat', 'img/vehiculos/6712a3fe90a65.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `nombre_usuario` varchar(150) NOT NULL,
  `contraseña` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `nombre_usuario`, `contraseña`) VALUES
(1, 'Matias', 'matias@gmail.com', '$2y$10$7eBjz3TM3rzE.khsQ06jR.2Ni.h4IffFLRnIuxHWWCzTfK0Chnlzq'),
(2, 'Martiniano', 'martu@gmail.com', '$2y$10$zPJYcNBHjv6DupbdA5vGZuBJuNsB1oc3iv7Z6OQZf5zcELimY2y/O'),
(3, 'Teo', 'teo@gmail.com', '$2y$10$tmZsfjEcPpoXGPeWZRKvzuL4CuWJwkW73hX1Oi9uCqzUwYSYJKmIS'),
(4, 'Aprobame (porfavor)', 'webadmin', '$2y$10$Eld/iGLil0x4AGYCnBIE3udrOBBGOMqy.CIY8xP8Q/nFTU1fFHqEC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id_vehiculo` int(11) NOT NULL,
  `modelo` varchar(150) NOT NULL,
  `marca` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id_vehiculo`, `modelo`, `marca`, `descripcion`, `imagen`) VALUES
(26, 'Ranger', 10, 'Es una camioneta 4x4. color blanco', 'img/vehiculos/6713ca8858a78.jpg'),
(27, 'Saveiro', 9, 'Es una camioneta chiquita pero muy fachera. De color roja', 'img/vehiculos/6713c7e2d44ee.jpg'),
(28, 'Cronos', 11, 'Es el auto mas vendido en 2023', 'img/vehiculos/6712a4bf610ee.jpg'),
(30, 'Clase A', 8, 'Es una locura de auto', 'img/vehiculos/6712a51dca76f.jpg'),
(31, 'Ka', 10, 'Auto chiquititititittitop', 'img/vehiculos/6713ce4daaf62.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`nombre_usuario`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id_vehiculo`),
  ADD KEY `marca` (`marca`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id_vehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `vehiculos_ibfk_1` FOREIGN KEY (`marca`) REFERENCES `marcas` (`id_marca`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
