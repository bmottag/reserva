-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-04-2018 a las 16:54:57
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `reserva`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_horas`
--

CREATE TABLE `param_horas` (
  `id_hora` int(1) NOT NULL,
  `hora` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_horas`
--

INSERT INTO `param_horas` (`id_hora`, `hora`) VALUES
(1, '12:00 AM'),
(2, '12:30 AM'),
(3, '1:00 AM'),
(4, '1:30 AM'),
(5, '2:00 AM'),
(6, '2:30 AM'),
(7, '3:00 AM'),
(8, '3:30 AM'),
(9, '4:00 AM'),
(10, '4:30 AM'),
(11, '5:00 AM'),
(12, '5:30 AM'),
(13, '6:00 AM'),
(14, '6:30 AM'),
(15, '7:00 AM'),
(16, '7:30 AM'),
(17, '8:00 AM'),
(18, '8:30 AM'),
(19, '9:00 AM'),
(20, '9:30 AM'),
(21, '10:00 AM'),
(22, '10:30 AM'),
(23, '11:00 AM'),
(24, '11:30 AM'),
(25, '12:00 PM'),
(26, '12:30 PM'),
(27, '1:00 PM'),
(28, '1:30 PM'),
(29, '2:00 PM'),
(30, '2:30 PM'),
(31, '3:00 PM'),
(32, '3:30 PM'),
(33, '4:00 PM'),
(34, '4:30 PM'),
(35, '5:00 PM'),
(36, '5:30 PM'),
(37, '6:00 PM'),
(38, '6:30 PM'),
(39, '7:00 PM'),
(40, '7:30 PM'),
(41, '8:00 PM'),
(42, '8:30 PM'),
(43, '9:00 PM'),
(44, '9:30 PM'),
(45, '10:00 PM'),
(46, '10:30 PM'),
(47, '11:00 PM'),
(48, '11:30 PM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_rol`
--

CREATE TABLE `param_rol` (
  `id_rol` int(1) NOT NULL,
  `rol_name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_rol`
--

INSERT INTO `param_rol` (`id_rol`, `rol_name`, `description`) VALUES
(1, 'ADMINISTRADOR', 'Con acceso a todo el sistema'),
(2, 'DIRECTIVO', 'Puede hacer reserva de las salas y modificar las reservas o separaciones. Adicional debe autorizar la reserva de la sala fines de semana (Sábados,  domingos y festivos) y en horarios a los anteriormente mencionados.'),
(3, 'GESTOR', 'El cual puede hacer reserva de las salas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_tipificacion`
--

CREATE TABLE `param_tipificacion` (
  `id_tipificacion` int(1) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `tipificacion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_tipificacion`
--

INSERT INTO `param_tipificacion` (`id_tipificacion`, `usuario`, `tipificacion`) VALUES
(1, 'GESTOR', 'VALIDACIONES'),
(2, 'GESTOR', 'REVISION DE CORRECCIÓN DE ESTILO'),
(3, 'GESTOR', 'OTROS'),
(4, 'ADMON', 'ARMADOS'),
(5, 'ADMON', 'OJO FRESCO'),
(6, 'ADMON', 'OTROS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `id_solicitud` int(10) NOT NULL,
  `fk_id_user` int(10) NOT NULL,
  `fecha_apartado` date NOT NULL,
  `numero_computadores` int(1) NOT NULL,
  `fk_id_hora_inicial` int(1) NOT NULL,
  `fk_id_hora_final` int(1) NOT NULL,
  `fecha_solicitud` datetime NOT NULL,
  `numero_items` tinyint(1) NOT NULL,
  `grupo_items` varchar(100) NOT NULL,
  `fk_id_tipificacion` int(1) NOT NULL,
  `estado_solicitud` tinyint(1) NOT NULL COMMENT '1:Activa;2Inactiva'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`id_solicitud`, `fk_id_user`, `fecha_apartado`, `numero_computadores`, `fk_id_hora_inicial`, `fk_id_hora_final`, `fecha_solicitud`, `numero_items`, `grupo_items`, `fk_id_tipificacion`, `estado_solicitud`) VALUES
(1, 1, '2018-04-15', 3, 17, 19, '2018-04-15 16:46:54', 5, 'NO SE QUE SE COLOCA ACA', 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id_user` int(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `log_user` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `fk_id_rol` int(1) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `movil` varchar(12) NOT NULL,
  `password` varchar(50) NOT NULL,
  `state` int(1) NOT NULL DEFAULT '0' COMMENT '0: newUser; 1:active; 2:inactive',
  `photo` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_user`, `first_name`, `last_name`, `log_user`, `email`, `fk_id_rol`, `birthdate`, `movil`, `password`, `state`, `photo`, `address`) VALUES
(1, 'BENJAMIN', 'MOTTA', 'bmottag', 'benmotta@gmail.com', 1, '2018-03-19', '4033089921', '25f9e794323b453885f5181f1b624d0b', 1, '', ''),
(2, 'JORGE', 'LOZANO', 'jlozano', 'jlozano@gmail.com', 1, '2018-04-01', '3015505382', 'e10adc3949ba59abbe56e057f20f883e', 2, '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `param_horas`
--
ALTER TABLE `param_horas`
  ADD PRIMARY KEY (`id_hora`);

--
-- Indices de la tabla `param_rol`
--
ALTER TABLE `param_rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `param_tipificacion`
--
ALTER TABLE `param_tipificacion`
  ADD PRIMARY KEY (`id_tipificacion`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`id_solicitud`),
  ADD KEY `fk_id_user` (`fk_id_user`),
  ADD KEY `fk_id_tipificacion` (`fk_id_tipificacion`),
  ADD KEY `fk_id_hora_inicial` (`fk_id_hora_inicial`),
  ADD KEY `fk_id_hora_final` (`fk_id_hora_final`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `log_user` (`log_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_id_rol` (`fk_id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `param_horas`
--
ALTER TABLE `param_horas`
  MODIFY `id_hora` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT de la tabla `param_rol`
--
ALTER TABLE `param_rol`
  MODIFY `id_rol` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `param_tipificacion`
--
ALTER TABLE `param_tipificacion`
  MODIFY `id_tipificacion` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `id_solicitud` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `solicitud_ibfk_2` FOREIGN KEY (`fk_id_tipificacion`) REFERENCES `param_tipificacion` (`id_tipificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `solicitud_ibfk_3` FOREIGN KEY (`fk_id_hora_inicial`) REFERENCES `param_horas` (`id_hora`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitud_ibfk_4` FOREIGN KEY (`fk_id_hora_final`) REFERENCES `param_horas` (`id_hora`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
