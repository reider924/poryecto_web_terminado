-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2023 a las 22:11:31
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
-- Base de datos: `repair`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `identificacion` varchar(45) DEFAULT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `contraseña` varchar(45) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `administrador` int(11) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `identificacion`, `usuario`, `contraseña`, `nombre`, `correo`, `direccion`, `telefono`, `administrador`, `estado`, `fecha`) VALUES
(1, '123456', 'valen', '', 'Valentir3na duque gonzalez', 'valen@gmail.com', 'CRA 45 # 3f3f', '301543434', 1, 'activo', '2023-03-29 19:53:34'),
(2, '1234', 'prueba', 'prueba', 'asd', 'valentina.duque01@unicatolica.edu.co', 'asd', '123', 0, 'inactivo', '2023-03-29 19:53:34'),
(3, '10021352', 'er', '', 'ert', 'valen@gmail.com', 'ert', '23445', 0, 'activo', '2023-03-30 13:51:52'),
(4, '159', 'prueba2', 'prueba2', 'PRUEBA', 'prueba@gmail.com', 'sdfd', '1234567', 0, 'activo', '2023-03-30 18:53:57'),
(5, '123456789', 'prueba_clase', 'prueba_clase', 'PRUEBA', 'valen@gmail.com', 'SDFSD', '234234', 0, 'activo', '2023-03-30 19:18:48'),
(6, '1193098', 'reider924', 'asdfg', 'na', 'valentina.duque01@unicatolica.edu.co', 'asd', '3300181722', 0, 'activo', '2023-04-13 19:11:36'),
(7, '123456', 'reider924', 'prueba', 'reider', 'valentina.duque01@unicatolica.edu.co', 'asd', '123456789', 0, 'activo', '2023-04-13 19:13:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lavadoras`
--

CREATE TABLE `lavadoras` (
  `id` int(11) NOT NULL,
  `marca` varchar(45) DEFAULT NULL,
  `modelo` varchar(45) DEFAULT NULL,
  `referencia` varchar(45) DEFAULT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `estado` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `lavadoras`
--

INSERT INTO `lavadoras` (`id`, `marca`, `modelo`, `referencia`, `id_cliente`, `fecha`, `estado`) VALUES
(1, '2323', 'PRUEBA', 'wew', 4, '2023-04-19', 'activo'),
(2, 'PRUEBA', 'PRUEBA', 'PRUEBA', 2, '2023-04-19', 'activo'),
(3, 'PRUEBA', 'PRUEBA', 'PRUEBA', 3, '2023-04-19', 'activo'),
(4, 'PRUEBA', 'PRUEBA', 'PRUEBA', 4, '2023-04-19', 'activo'),
(5, 'PRUEBA', 'PRUEBA', 'PRUEBA', 1, '2023-04-19', 'activo'),
(6, 'PRUEBA', 'PRUEBA', 'PRUEBA', 1, '2023-04-19', 'activo'),
(7, 'PRUEBA', 'PRUEBA', 'PRUEBA', 2, '2023-04-19', 'activo'),
(8, '123213123', 'PRUEBA', 'PRUEBA', 1, '2023-04-19', 'activo'),
(9, 'PRUEBA88', 'PRUEBA88', '88', 1, '2023-04-19', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden`
--

CREATE TABLE `orden` (
  `id` int(11) NOT NULL,
  `id_lavadora` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `servicio` varchar(45) DEFAULT NULL,
  `nombre_cliente` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `observaciones` varchar(45) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `fecha_programacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repuestos`
--

CREATE TABLE `repuestos` (
  `id` int(11) NOT NULL,
  `id_lavadora` int(11) DEFAULT NULL,
  `modelo` varchar(45) DEFAULT NULL,
  `especificacion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `lavadoras`
--
ALTER TABLE `lavadoras`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `repuestos`
--
ALTER TABLE `repuestos`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `lavadoras`
--
ALTER TABLE `lavadoras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `orden`
--
ALTER TABLE `orden`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `repuestos`
--
ALTER TABLE `repuestos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
