-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-06-2018 a las 03:20:27
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
-- Estructura de tabla para la tabla `log_solicitud`
--

CREATE TABLE `log_solicitud` (
  `id_log_solicitud` int(10) NOT NULL,
  `fk_id_user` int(10) NOT NULL,
  `fecha_apartado` date NOT NULL,
  `numero_computadores` int(1) NOT NULL,
  `fk_id_hora_inicial` int(1) NOT NULL,
  `fk_id_hora_final` int(1) NOT NULL,
  `fecha_solicitud` datetime NOT NULL,
  `numero_items` tinyint(1) NOT NULL,
  `fk_codigo_examen` int(2) NOT NULL,
  `fk_id_prueba` int(10) NOT NULL,
  `cual` varchar(150) NOT NULL,
  `cual_prueba` varchar(150) NOT NULL,
  `fk_id_tipificacion` int(1) NOT NULL,
  `estado_solicitud` tinyint(1) NOT NULL COMMENT '1:Activa;2Inactiva',
  `fk_id_solicitud` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_generales`
--

CREATE TABLE `param_generales` (
  `id_generales` int(1) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `valor` int(1) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_generales`
--

INSERT INTO `param_generales` (`id_generales`, `nombre`, `valor`, `descripcion`) VALUES
(1, 'Hora inicial', 19, 'Hora inicial para el formulario de reserva. Es el ID de la tabla param horas. Este se usa para los usuario ID 3 GESTOR.'),
(2, 'Hora final', 39, 'Hora final para el formulario de reserva. Es el ID de la tabla param horas. Este se usa para los usuario ID 3 GESTOR.'),
(3, 'Numero computadores', 12, 'Es el número de computadores maximo que se usa para las reservas.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_horas`
--

CREATE TABLE `param_horas` (
  `id_hora` int(1) NOT NULL,
  `hora` varchar(10) NOT NULL,
  `formato_24` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_horas`
--

INSERT INTO `param_horas` (`id_hora`, `hora`, `formato_24`) VALUES
(1, '12:00 AM', '00:00'),
(2, '12:30 AM', '00:30'),
(3, '1:00 AM', '01:00'),
(4, '1:30 AM', '01:30'),
(5, '2:00 AM', '02:00'),
(6, '2:30 AM', '02:30'),
(7, '3:00 AM', '03:00'),
(8, '3:30 AM', '03:30'),
(9, '4:00 AM', '04:00'),
(10, '4:30 AM', '04:30'),
(11, '5:00 AM', '05:00'),
(12, '5:30 AM', '05:30'),
(13, '6:00 AM', '06:00'),
(14, '6:30 AM', '06:30'),
(15, '7:00 AM', '07:00'),
(16, '7:30 AM', '07:30'),
(17, '8:00 AM', '08:00'),
(18, '8:30 AM', '08:30'),
(19, '9:00 AM', '09:00'),
(20, '9:30 AM', '09:30'),
(21, '10:00 AM', '10:00'),
(22, '10:30 AM', '10:30'),
(23, '11:00 AM', '11:00'),
(24, '11:30 AM', '11:30'),
(25, '12:00 PM', '12:00'),
(26, '12:30 PM', '12:30'),
(27, '1:00 PM', '13:00'),
(28, '1:30 PM', '13:30'),
(29, '2:00 PM', '14:00'),
(30, '2:30 PM', '14:30'),
(31, '3:00 PM', '15:00'),
(32, '3:30 PM', '15:30'),
(33, '4:00 PM', '16:00'),
(34, '4:30 PM', '16:30'),
(35, '5:00 PM', '17:00'),
(36, '5:30 PM', '17:30'),
(37, '6:00 PM', '18:00'),
(38, '6:30 PM', '18:30'),
(39, '7:00 PM', '19:00'),
(40, '7:30 PM', '19:30'),
(41, '8:00 PM', '20:00'),
(42, '8:30 PM', '20:30'),
(43, '9:00 PM', '21:00'),
(44, '9:30 PM', '21:30'),
(45, '10:00 PM', '22:00'),
(46, '10:30 PM', '22:30'),
(47, '11:00 PM', '23:00'),
(48, '11:30 PM', '23:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `param_prueba`
--

CREATE TABLE `param_prueba` (
  `id_prueba` int(10) NOT NULL,
  `codigo_examen` int(2) NOT NULL,
  `examen` varchar(100) NOT NULL,
  `codigo_prueba` varchar(50) NOT NULL,
  `prueba` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `param_prueba`
--

INSERT INTO `param_prueba` (`id_prueba`, `codigo_examen`, `examen`, `codigo_prueba`, `prueba`) VALUES
(1, 121, 'Saber TyT', '5003', 'Mantenimiento e instalación de software y hardware'),
(2, 121, 'Saber TyT', '3002', 'Ensamblaje, mantenimiento y operación de maquinaria y equipos'),
(3, 121, 'Saber TyT', '005T', 'Razonamiento cuantitativo'),
(4, 121, 'Saber TyT', '004T', 'Lectura crítica'),
(5, 121, 'Saber TyT', '001T', 'Competencias Ciudadanas '),
(6, 121, 'Saber TyT', '304T', 'Promoción de la salud y prevención de la enfermedad'),
(7, 122, 'Saber Pro', 'ENSE', 'Enseñar'),
(8, 122, 'Saber Pro', 'FORM', 'Formar'),
(9, 122, 'Saber Pro', 'EVAL', 'Evaluar'),
(10, 122, 'Saber Pro', '1003', 'Gestión financiera'),
(11, 122, 'Saber Pro', '4003', 'Investigación en ciencias sociales '),
(12, 122, 'Saber Pro', '8001', 'Diseño de procesos industriales'),
(13, 122, 'Saber Pro', '9004', 'Producción agrícola'),
(14, 122, 'Saber Pro', '1001', 'Análisis de problemáticas psicológicas'),
(15, 122, 'Saber Pro', '1005', 'Producción pecuaria'),
(16, 122, 'Saber Pro', '2001', 'Análisis económico'),
(17, 122, 'Saber Pro', '3004', 'Promoción de la salud y prevención de la enfermedad'),
(18, 122, 'Saber Pro', '4001', 'Atención en salud '),
(19, 122, 'Saber Pro', '4005', 'Investigación jurídica'),
(20, 122, 'Saber Pro', '5002', 'Formulación de proyectos de ingeniería'),
(21, 122, 'Saber Pro', '6002', 'Fundamentación en diagnóstico y tratamiento médicos'),
(22, 122, 'Saber Pro', '9002', 'Formulación, evaluación y gestión de proyectos'),
(23, 122, 'Saber Pro', '9010', 'Salud y bienestar animal '),
(24, 122, 'Saber Pro', '1002', 'Diseño de sistemas mecánicos'),
(25, 122, 'Saber Pro', '2611', 'Diseño de sistemas productivos y logísticos'),
(26, 122, 'Saber Pro', '2912', 'Diseño de obras de infraestructura'),
(27, 122, 'Saber Pro', '8006', 'Diseño de sistemas de manejo del impacto ambiental'),
(28, 122, 'Saber Pro', '9001', 'Diseño de sistemas de control'),
(29, 122, 'Saber Pro', '0005', 'Razonamiento cuantitativo'),
(30, 122, 'Saber Pro', '2005', 'Comunicación jurídica'),
(31, 122, 'Saber Pro', '3005', 'Gestión del conflicto'),
(32, 122, 'Saber Pro', '7002', 'Generación de artefactos'),
(33, 122, 'Saber Pro', '8002', 'Gestión de organizaciones'),
(34, 122, 'Saber Pro', '1004', 'Pensamiento científico química'),
(35, 122, 'Saber Pro', '1103', 'Pensamiento científico núcleo común'),
(36, 122, 'Saber Pro', '6003', 'Pensamiento científico ciencias biológicas'),
(37, 122, 'Saber Pro', '7003', 'Pensamiento científico ciencias de la tierra'),
(38, 122, 'Saber Pro', '8003', 'Pensamiento científico ciencias físicas'),
(39, 122, 'Saber Pro', '9003', 'Pensamiento científico matemáticas y estadística'),
(40, 122, 'Saber Pro', '4011', 'Diagnóstico y tratamiento en salud oral'),
(41, 122, 'Saber Pro', '8005', 'Diseño de sistemas, procesos y productos agroindustriales'),
(42, 122, 'Saber Pro', '3003', 'Intervención en procesos sociales'),
(43, 122, 'Saber Pro', '2911', 'Diseño de software'),
(44, 122, 'Saber Pro', '3001', 'Estudio proyectual'),
(45, 122, 'Saber Pro', '5001', 'Cuidado de enfermería en los ámbitos clínico y comunitario'),
(46, 122, 'Saber Pro', '001P', 'Competencias Ciudadanas'),
(47, 122, 'Saber Pro', '2004', 'Procesos comunicativos'),
(48, 122, 'Saber Pro', '2003', 'Información y control contable'),
(49, 122, 'Saber Pro', '004P', 'Lectura crítica'),
(50, 123, 'Saber 3°', '003L', 'Lenguaje'),
(51, 123, 'Saber 3°', '003M', 'Matemáticas'),
(52, 125, 'Saber 5°', '005C', 'Ciencias naturales'),
(53, 125, 'Saber 5°', '005M', 'Matemáticas'),
(54, 125, 'Saber 5°', '005L', 'Lenguaje'),
(55, 125, 'Saber 5°', '005D', 'Competencias Ciudadanas'),
(56, 127, 'Saber 7°', '007L', 'Lenguaje'),
(57, 127, 'Saber 7°', '007M', 'Matemáticas'),
(58, 127, 'Saber 7°', '007C', 'Ciencias naturales'),
(59, 128, 'Saber 11°', '0004', 'Lectura crítica'),
(60, 128, 'Saber 11°', '011M', 'Matemáticas'),
(61, 128, 'Saber 11°', '0083', 'Ciencias naturales'),
(62, 128, 'Saber 11°', '001S', 'Competencias Ciudadanas'),
(63, 128, 'Saber 11°', '002S', 'Sociales '),
(64, 128, 'Saber 11°', '005S', 'Razonamiento cuantitativo'),
(65, 129, 'Saber 9°', '009C', 'Ciencias naturales'),
(66, 129, 'Saber 9°', '009M', 'Matemáticas'),
(67, 129, 'Saber 9°', '009L', 'Lenguaje'),
(68, 129, 'Saber 9°', '009D', 'Competencias Ciudadanas'),
(69, 998, 'Otro', '9998', 'Otro');

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
(6, 'ADMON', 'OTROS'),
(7, 'ADMON', 'PRUEBAS RE PRUEBAS');

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
  `fk_codigo_examen` int(2) NOT NULL,
  `fk_id_prueba` int(10) NOT NULL,
  `cual` varchar(150) NOT NULL,
  `cual_prueba` varchar(150) NOT NULL,
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
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `log_solicitud`
--
ALTER TABLE `log_solicitud`
  ADD PRIMARY KEY (`id_log_solicitud`),
  ADD KEY `fk_id_user` (`fk_id_user`),
  ADD KEY `fk_id_hora_inicial` (`fk_id_hora_inicial`),
  ADD KEY `fk_id_hora_final` (`fk_id_hora_final`),
  ADD KEY `fk_id_tipificacion` (`fk_id_tipificacion`),
  ADD KEY `fk_id_solicitud` (`fk_id_solicitud`),
  ADD KEY `fk_codigo_examen` (`fk_codigo_examen`),
  ADD KEY `fk_id_prueba` (`fk_id_prueba`);

--
-- Indices de la tabla `param_generales`
--
ALTER TABLE `param_generales`
  ADD PRIMARY KEY (`id_generales`);

--
-- Indices de la tabla `param_horas`
--
ALTER TABLE `param_horas`
  ADD PRIMARY KEY (`id_hora`);

--
-- Indices de la tabla `param_prueba`
--
ALTER TABLE `param_prueba`
  ADD PRIMARY KEY (`id_prueba`),
  ADD KEY `codigo_examen` (`codigo_examen`);

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
  ADD KEY `fk_id_hora_final` (`fk_id_hora_final`),
  ADD KEY `fk_id_prueba` (`fk_id_prueba`),
  ADD KEY `fk_codigo_examen` (`fk_codigo_examen`);

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
-- AUTO_INCREMENT de la tabla `log_solicitud`
--
ALTER TABLE `log_solicitud`
  MODIFY `id_log_solicitud` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `param_generales`
--
ALTER TABLE `param_generales`
  MODIFY `id_generales` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `param_horas`
--
ALTER TABLE `param_horas`
  MODIFY `id_hora` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT de la tabla `param_prueba`
--
ALTER TABLE `param_prueba`
  MODIFY `id_prueba` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT de la tabla `param_rol`
--
ALTER TABLE `param_rol`
  MODIFY `id_rol` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `param_tipificacion`
--
ALTER TABLE `param_tipificacion`
  MODIFY `id_tipificacion` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `id_solicitud` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `log_solicitud`
--
ALTER TABLE `log_solicitud`
  ADD CONSTRAINT `log_solicitud_ibfk_1` FOREIGN KEY (`fk_id_solicitud`) REFERENCES `solicitud` (`id_solicitud`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `log_solicitud_ibfk_2` FOREIGN KEY (`fk_id_prueba`) REFERENCES `param_prueba` (`id_prueba`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `log_solicitud_ibfk_3` FOREIGN KEY (`fk_id_hora_inicial`) REFERENCES `param_horas` (`id_hora`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `log_solicitud_ibfk_4` FOREIGN KEY (`fk_id_hora_final`) REFERENCES `param_horas` (`id_hora`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `solicitud_ibfk_2` FOREIGN KEY (`fk_id_tipificacion`) REFERENCES `param_tipificacion` (`id_tipificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `solicitud_ibfk_3` FOREIGN KEY (`fk_id_hora_inicial`) REFERENCES `param_horas` (`id_hora`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitud_ibfk_4` FOREIGN KEY (`fk_id_hora_final`) REFERENCES `param_horas` (`id_hora`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitud_ibfk_5` FOREIGN KEY (`fk_id_prueba`) REFERENCES `param_prueba` (`id_prueba`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
