-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-01-2017 a las 20:55:36
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `passctrl`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso`
--

CREATE TABLE `ingreso` (
  `id` int(255) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` varchar(20) NOT NULL,
  `idModulo` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `idModulo` int(255) NOT NULL,
  `usuario` varchar(40) NOT NULL,
  `modulo` varchar(20) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `pass_admin` varchar(20) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`idModulo`, `usuario`, `modulo`, `codigo`, `pass_admin`, `estado`, `fecha`) VALUES
(1, 'juan.sotomayor.ch@gmail.com', '1', 'RB1001', '2222', 'ON', '2016-05-05 15:36:19'),
(2, 'x', 'x', 'x', 'x', 'x', '2016-05-05 15:36:53'),
(3, 'x', 'x', 'x', 'x', 'x', '2016-05-05 15:37:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(255) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `apellido` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `estadoKEY` int(255) NOT NULL,
  `codigoKEY` varchar(40) NOT NULL,
  `nivel` int(10) NOT NULL,
  `idModulo` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `password`, `estadoKEY`, `codigoKEY`, `nivel`, `idModulo`) VALUES
(1, 'juan', 'sotomayor', 'juan.sotomayor.ch@gmail.com', 'eb18fdfe147a5a1b2e249bdc13520245', 1, 'b7e8f7e1166c6c27d61a35f8771b45da852ccfe0', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_modulos`
--

CREATE TABLE `usuarios_modulos` (
  `id` int(255) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `sexo` varchar(20) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(20) NOT NULL,
  `idModulo` int(255) NOT NULL,
  `acceso` int(255) NOT NULL,
  `biometria` int(255) NOT NULL,
  `rfid` int(255) NOT NULL,
  `nfc` int(255) NOT NULL,
  `code_biometria` varchar(40) NOT NULL,
  `code_rfid` varchar(40) NOT NULL,
  `code_nfc` varchar(40) NOT NULL,
  `RUT` varchar(20) NOT NULL,
  `empresa` varchar(30) NOT NULL,
  `cargo` varchar(30) NOT NULL,
  `fecha_act` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `imagen` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`idModulo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios_modulos`
--
ALTER TABLE `usuarios_modulos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `idModulo` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuarios_modulos`
--
ALTER TABLE `usuarios_modulos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
