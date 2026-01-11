-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-01-2026 a las 05:13:25
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
-- Base de datos: `login_register_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `metodo_pago` varchar(50) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `id_usuario`, `metodo_pago`, `fecha`) VALUES
(1, 5, 'Efectivo', '2025-12-18 02:00:24'),
(2, 2, 'Tarjeta', '2026-01-04 23:48:34'),
(3, 3, 'Tarjeta', '2026-01-10 01:26:44'),
(4, 3, 'Tarjeta', '2026-01-10 03:02:27'),
(5, 3, 'Efectivo', '2026-01-10 03:21:38'),
(6, 3, 'Tarjeta', '2026-01-10 03:25:36'),
(7, 3, 'Tarjeta', '2026-01-10 05:35:05'),
(8, 3, 'Tarjeta', '2026-01-10 05:35:09'),
(9, 3, 'Tarjeta', '2026-01-10 05:37:06'),
(10, 3, 'Tarjeta', '2026-01-10 05:38:06'),
(11, 3, 'Tarjeta', '2026-01-10 05:44:24'),
(12, 3, 'Tarjeta', '2026-01-10 05:55:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `producto` varchar(100) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`id`, `id_compra`, `producto`, `precio`, `cantidad`, `imagen`) VALUES
(1, 1, 'BOX ENGASSE', 15000.00, 2, 'boxengasse.png'),
(2, 2, 'SKIN GLAM', 18000.00, 1, 'skinglam.png'),
(3, 3, 'MIDDLESTEEL', 42800.00, 1, 'middlesteel.png'),
(4, 4, 'SIR BLUE', 32000.00, 12, 'sirblue.png'),
(5, 5, 'ROLEX DAY', 13000.00, 3, 'rolexday.jpg'),
(6, 6, 'BOX ENGASSE', 15000.00, 1, 'boxengasse.png'),
(7, 7, 'LA NIGHT', 18000.00, 1, 'lanight.png'),
(8, 8, 'LA NIGHT', 18000.00, 1, 'lanight.png'),
(9, 9, 'LA NIGHT', 18000.00, 1, 'lanight.png'),
(10, 10, 'LA NIGHT', 18000.00, 1, 'lanight.png'),
(11, 11, 'LA NIGHT', 18000.00, 1, 'lanight.png'),
(12, 12, 'LA NIGHT', 18000.00, 1, 'lanight.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `piezas` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `piezas`, `precio`, `imagen`) VALUES
(1, 'Box Engasse', 11, 1900000.00, 'boxengasse.png'),
(3, 'Knock Nap', 8, 35000.00, 'knocknap.png'),
(4, 'La Night', 6, 18000.00, 'lanight.png'),
(6, 'Skin Glam', 15, 18000.00, 'skinglam.png'),
(7, 'Midimix', 4, 54000.00, 'midimix.png'),
(8, 'Sir Blue', 0, 3200000.00, 'sirblue.png'),
(9, 'Middlesteel', 6, 42800.00, 'middlesteel.png'),
(10, 'Rolex Day', 0, 13000.00, 'rolexday.jpg'),
(11, 'English Horse', 9, 2500000.00, 'englishrose.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(150) NOT NULL,
  `rol` enum('cliente','admin') NOT NULL DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_completo`, `correo`, `usuario`, `contrasena`, `rol`) VALUES
(1, 'Jireth Palacios', 'jireth.palacios@gmail.com', 'GIGI', 'f7161fc61d6f3446c40b3ec1291c60504a503d1dfbcb4bda4ee9987e176f185444486311d26cc5cdc5eeea27445354e10907be2aa71ac4eb315c7dc119c405eb', 'cliente'),
(2, 'Eliot Morales', 'momu1686@gmail.com', 'ELOTES', 'af23db32fec0cceaa3b88551fd274097fe402cebaab2fc973fb875cc6cf7efe05c0e22399ea0ba905bc84803d1ff88e7dd21fba0e4817505091a9494d1e5e74d', 'cliente'),
(3, 'Quetzal Palacios', 'quetzal2002@gmail.com', 'QUESO', '8ad15bb6eafa65a93bd104c041217164ba20a81f0de03f6fd8f6676c3c6264f4a7feafbaffc01e49389b0005b7d93c311aafce173c756b2839788ef27fa6d50f', 'cliente'),
(5, 'Guadalupe Mendoza', 'gmenram@gmail.com', 'LUPE', 'f3fc1c63fa8ba39af2e72c33093c2b904eb62e5cbc900c30627ae6228924cd4b5b1aea0d04c643f922c5e957e65ae29f10e42e9b473b838255be3b3efb0c2f64', 'cliente'),
(6, 'Administrador', 'admin@gmail.com', 'ADMINISTRADOR', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_compra` (`id_compra`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `detalle_compra_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compras` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
