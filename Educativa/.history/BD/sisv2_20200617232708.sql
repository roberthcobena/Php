-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-06-2020 a las 07:17:17
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sisv2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id_admin` varchar(10) NOT NULL,
  `ad_nombre` varchar(50) NOT NULL,
  `ad_apellido` varchar(50) NOT NULL,
  `ad_cargo` varchar(50) NOT NULL,
  `id_usuario` varchar(10) NOT NULL,
  `ad_estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id_admin`, `ad_nombre`, `ad_apellido`, `ad_cargo`, `id_usuario`, `ad_estado`) VALUES
('37mlhowaec', 'manuel vicente', 'mora merelo', 'Director(a)', '37mlhowaec', 1),
('72adminMOR', 'emanuel yasmanny', 'mora pizarro', '-------', '72adminMOR', 1),
('8py52jtxrw', 'karla ariana', 'flores torres', 'Docente', '8py52jtxrw', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `alum_id` varchar(10) NOT NULL,
  `alum_nombres` varchar(50) NOT NULL,
  `alum_apellidos` varchar(50) NOT NULL,
  `alum_seccion` varchar(10) NOT NULL,
  `alum_jornada` varchar(20) NOT NULL,
  `id_usuario` varchar(10) NOT NULL,
  `alum_estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`alum_id`, `alum_nombres`, `alum_apellidos`, `alum_seccion`, `alum_jornada`, `id_usuario`, `alum_estado`) VALUES
('ce4twj9hfu', 'teddy tairon', 'tumbaco ortiz', '7mo B', 'Matutina', 'ce4twj9hfu', 1),
('e0ztoq7bsd', 'jean marc', 'campoverde lara', '7mo B', 'Vespertina', 'e0ztoq7bsd', 0),
('gs0l5yx8wq', 'karla ariana', 'flores torres', '7mo B', 'Matutina', 'gs0l5yx8wq', 1),
('hkao5stzm9', 'tanya anabel', 'vazques pizarro', '7mo B', 'Matutina', 'hkao5stzm9', 0),
('VcloOdmMLE', 'yasmanny', 'mora', '7mo A', 'Matutina', 'VcloOdmMLE', 0),
('yvexrf69hp', 'donovan evander', 'campoverde pizarro', '7mo A', 'Vespertina', 'yvexrf69hp', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE `calificacion` (
  `id_noda` int(3) NOT NULL,
  `alum_id` varchar(10) NOT NULL,
  `id_taller` int(11) NOT NULL,
  `nota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id_docente` varchar(10) NOT NULL,
  `doc_nombres` varchar(50) NOT NULL,
  `doc_apellidos` varchar(50) NOT NULL,
  `doc_titulo` varchar(50) NOT NULL,
  `doc_jornada` varchar(50) NOT NULL,
  `id_usuario` varchar(10) NOT NULL,
  `doc_estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id_docente`, `doc_nombres`, `doc_apellidos`, `doc_titulo`, `doc_jornada`, `id_usuario`, `doc_estado`) VALUES
('0gkm1fxi83', 'tanya anabel', 'vazques pizarro', 'PH', 'Vespertina', '0gkm1fxi83', 1),
('bcq8lefxoh', 'felicita germania', 'pizarro ronquillo', 'Licenciado(a)', 'Matutina', 'bcq8lefxoh', 1),
('gtmvufxo8e', 'manuel vicente', 'mora merelo', 'Licenciado(a)', 'Matutina', 'gtmvufxo8e', 1),
('h7o6vbtmk1', 'CHartlles MIguel', 'Perez Espinoza', 'Master', 'Vespertina', 'h7o6vbtmk1', 0),
('q2yo0c6upn', 'tanya anabel', 'vazques pizarro', 'Licenciado(a)', 'Matutina', 'q2yo0c6upn', 1),
('scgli3nt8j', 'tanya anabel', 'vazques pizarro', 'Licenciado(a)', 'Vespertina', 'scgli3nt8j', 1),
('txl1ocuzmy', 'tanya anabel', 'vazques pizarro', 'Licenciado(a)', 'Vespertina', 'txl1ocuzmy', 1),
('w5qmcdtg2u', 'laura margarita', 'pizarro ronquillo', 'Master', 'Matutina', 'w5qmcdtg2u', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id_pregunta` int(3) NOT NULL,
  `id_tema` int(3) NOT NULL,
  `pregunta` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `id_respuesta` int(3) NOT NULL,
  `id_pregunta` int(3) NOT NULL,
  `respuesta` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `taller`
--

CREATE TABLE `taller` (
  `id_taller` int(3) NOT NULL,
  `id_unidad` int(3) NOT NULL,
  `id_tema` int(3) NOT NULL,
  `id_pregunta` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tema`
--

CREATE TABLE `tema` (
  `id_tema` int(3) NOT NULL,
  `Id_unidad` int(3) NOT NULL,
  `te_nombre` int(50) NOT NULL,
  `te_descripcion` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad`
--

CREATE TABLE `unidad` (
  `id_unidad` int(3) NOT NULL,
  `uni_nombre` varchar(20) NOT NULL,
  `uni_descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` varchar(10) NOT NULL,
  `u_usuario` varchar(50) NOT NULL,
  `u_contra` varchar(12) NOT NULL,
  `u_tipo` varchar(20) NOT NULL,
  `u_estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `u_usuario`, `u_contra`, `u_tipo`, `u_estado`) VALUES
('0gkm1fxi83', 'tanyavaz', '123', 'docente', 1),
('37mlhowaec', 'moraVM', '123', 'admin', 1),
('72adminMOR', 'adminmora', 'mora', 'admin', 1),
('7ceo69frl1', 'moraVM', '123', 'admin', 1),
('8py52jtxrw', 'ariulove', '1234', 'admin', 0),
('bcq8lefxoh', 'feliger', '123', 'docente', 1),
('ce4twj9hfu', 'tttumbaco', 'tumba', 'alumno', 1),
('ch7n3tgxiz', 'moraVM', '123', 'admin', 1),
('e0ztoq7bsd', 'jccampoverde', 'campo', 'alumno', 0),
('gs0l5yx8wq', 'kfflores', 'flores', 'alumno', 1),
('gtmvufxo8e', 'Mvmerelo', 'mora123', 'docente', 1),
('h7o6vbtmk1', 'cperez', '1234', 'docente', 0),
('hkao5stzm9', 'tvvazques', '123', 'alumno', 0),
('q2yo0c6upn', 'tanyavaz', '123', 'docente', 1),
('scgli3nt8j', 'tanyavaz', '123', 'docente', 1),
('txl1ocuzmy', 'tanyavaz', '123', 'docente', 1),
('VcloOdmMLE', 'ymora', '123456', 'alumno', 0),
('w5qmcdtg2u', 'LMargarita', '123', 'docente', 1),
('yvexrf69hp', 'dccampoverde', 'tonipa', 'alumno', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`alum_id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD PRIMARY KEY (`id_noda`),
  ADD KEY `id_alumno` (`alum_id`),
  ADD KEY `id_taller` (`id_taller`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id_docente`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id_pregunta`),
  ADD KEY `id_tema` (`id_tema`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`id_respuesta`),
  ADD KEY `id_pregunta` (`id_pregunta`);

--
-- Indices de la tabla `taller`
--
ALTER TABLE `taller`
  ADD PRIMARY KEY (`id_taller`),
  ADD KEY `id_unidad` (`id_unidad`),
  ADD KEY `id_tema` (`id_tema`),
  ADD KEY `id_pregunta` (`id_pregunta`);

--
-- Indices de la tabla `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`id_tema`),
  ADD KEY `Id_unidad` (`Id_unidad`);

--
-- Indices de la tabla `unidad`
--
ALTER TABLE `unidad`
  ADD PRIMARY KEY (`id_unidad`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  MODIFY `id_noda` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id_pregunta` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `id_respuesta` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `taller`
--
ALTER TABLE `taller`
  MODIFY `id_taller` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `unidad`
--
ALTER TABLE `unidad`
  MODIFY `id_unidad` int(3) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD CONSTRAINT `calificacion_ibfk_1` FOREIGN KEY (`alum_id`) REFERENCES `alumnos` (`alum_id`),
  ADD CONSTRAINT `calificacion_ibfk_2` FOREIGN KEY (`id_taller`) REFERENCES `taller` (`id_taller`);

--
-- Filtros para la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD CONSTRAINT `docentes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `pregunta_ibfk_1` FOREIGN KEY (`id_tema`) REFERENCES `tema` (`id_tema`),
  ADD CONSTRAINT `pregunta_ibfk_2` FOREIGN KEY (`id_pregunta`) REFERENCES `taller` (`id_pregunta`);

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `respuesta_ibfk_1` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`id_pregunta`);

--
-- Filtros para la tabla `taller`
--
ALTER TABLE `taller`
  ADD CONSTRAINT `taller_ibfk_2` FOREIGN KEY (`id_unidad`) REFERENCES `unidad` (`id_unidad`),
  ADD CONSTRAINT `taller_ibfk_3` FOREIGN KEY (`id_tema`) REFERENCES `tema` (`id_tema`);

--
-- Filtros para la tabla `tema`
--
ALTER TABLE `tema`
  ADD CONSTRAINT `tema_ibfk_1` FOREIGN KEY (`Id_unidad`) REFERENCES `unidad` (`id_unidad`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
