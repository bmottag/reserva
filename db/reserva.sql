-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-03-2018 a las 17:25:20
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
-- Estructura de tabla para la tabla `computadores`
--

CREATE TABLE `computadores` (
  `id_computador` int(10) NOT NULL,
  `computador_nombre` varchar(200) NOT NULL,
  `computador_descripcion` text NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1' COMMENT '1:Activo; 2:Inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `computadores`
--

INSERT INTO `computadores` (`id_computador`, `computador_nombre`, `computador_descripcion`, `estado`) VALUES
(1, 'Equipo 1', 'Computador principal', 1),
(2, 'Equipo 2', 'Descripcion del equipo de computo', 1);

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
  `fk_id_computador` int(10) NOT NULL,
  `fecha_apartado` date NOT NULL,
  `hora_inicio` varchar(10) NOT NULL,
  `hora_final` varchar(10) NOT NULL,
  `fecha_solicitud` datetime NOT NULL,
  `numero_items` tinyint(1) NOT NULL,
  `grupo_items` varchar(100) NOT NULL,
  `fk_id_tipificacion` int(1) NOT NULL,
  `estado_solicitud` tinyint(1) NOT NULL COMMENT '1:Activa;2Inactiva'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Benjamin', 'Motta', 'bmottag', 'benmotta@gmail.com', 1, '2018-03-19', '4033089921', '25f9e794323b453885f5181f1b624d0b', 1, '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `computadores`
--
ALTER TABLE `computadores`
  ADD PRIMARY KEY (`id_computador`);

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
  ADD KEY `fk_id_computador` (`fk_id_computador`),
  ADD KEY `fk_id_tipificacion` (`fk_id_tipificacion`);

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
-- AUTO_INCREMENT de la tabla `computadores`
--
ALTER TABLE `computadores`
  MODIFY `id_computador` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `id_solicitud` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `solicitud_ibfk_1` FOREIGN KEY (`fk_id_computador`) REFERENCES `computadores` (`id_computador`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `solicitud_ibfk_2` FOREIGN KEY (`fk_id_tipificacion`) REFERENCES `param_tipificacion` (`id_tipificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
