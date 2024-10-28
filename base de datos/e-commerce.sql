-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2024 a las 22:16:18
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `e-commerce`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `codped` int(11) NOT NULL,
  `codusu` int(11) NOT NULL,
  `codpro` int(11) NOT NULL,
  `fecped` datetime NOT NULL,
  `estado` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`codped`, `codusu`, `codpro`, `fecped`, `estado`, `cantidad`) VALUES
(1, 1, 32, '2023-12-11 13:23:26', 2, 1),
(2, 1, 29, '2023-12-11 13:23:46', 1, 1),
(3, 5, 28, '2023-12-11 16:19:59', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `codpro` int(11) NOT NULL,
  `nompro` varchar(50) DEFAULT NULL,
  `despro` varchar(100) DEFAULT NULL,
  `prepro` decimal(6,2) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `Img_prod` varchar(100) DEFAULT NULL,
  `catpro` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`codpro`, `nompro`, `despro`, `prepro`, `estado`, `Img_prod`, `catpro`) VALUES
(28, 'reloj', 'Relojes de pulsera', '19.99', 1, 'relojes.png', 'Accesorios'),
(29, 'computador', 'Computadores portatiles', '159.99', 1, 'compu.png', 'Ordenadores'),
(30, 'impresora', 'Impresoras de oficina', '29.99', 1, 'impresora.png', 'Impresoras'),
(31, 'tablet', 'Tablets', '199.99', 1, 'tablet.png', 'Tablets'),
(32, 'smartphone', 'Smartphones', '299.99', 1, 'smartphone.png', 'Smartphones'),
(36, 'mouse', 'Mouse inalambrico', '19.99', 1, 'mouse.png', 'Accesorios'),
(42, 'computador', 'Computadores portatiles', '159.99', 1, 'compu.png', 'Ordenadores'),
(43, 'impresora', 'Impresoras de oficina', '29.99', 1, 'impresora.png', 'Impresoras'),
(44, 'tablet', 'Tablets', '199.99', 1, 'tablet.png', 'Tablets'),
(45, 'smartphone', 'Smartphones', '299.99', 1, 'smartphone.png', 'Smartphones'),
(46, 'mouse', 'Mouse inalambrico', '19.99', 1, 'mouse.png', 'Accesorios'),
(47, 'impresora', 'Impresoras de oficina', '29.99', 1, 'impresora.png', 'Impresoras'),
(48, 'tablet', 'Tablets', '199.99', 1, 'tablet.png', 'Tablets'),
(49, 'smartphone', 'Smartphones', '299.99', 1, 'smartphone.png', 'Smartphones'),
(50, 'mouse', 'Mouse inalambrico', '19.99', 1, 'mouse.png', 'Accesorios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `codusu` int(11) NOT NULL,
  `nomusu` varchar(50) DEFAULT NULL,
  `apeusu` varchar(50) DEFAULT NULL,
  `emausu` varchar(128) DEFAULT NULL,
  `pasusu` varchar(32) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`codusu`, `nomusu`, `apeusu`, `emausu`, `pasusu`, `estado`) VALUES
(3, NULL, NULL, NULL, 'd41d8cd98f00b204e9800998ecf8427e', 0),
(4, 'user', 'demo', 'correo@gmail.com', '1234', 1),
(5, 'usuario', 'demo', 'correo2@gmail.com', '123456', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`codped`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codpro`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codusu`),
  ADD UNIQUE KEY `emausu` (`emausu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `codped` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `codpro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `codusu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
