-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2020 a las 16:38:08
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
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
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `alum_id` int(11) NOT NULL,
  `alum_usu` int(11) NOT NULL,
  `alum_seccion` int(11) NOT NULL,
  `alum_estado` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`alum_id`, `alum_usu`, `alum_seccion`, `alum_estado`) VALUES
(1, 14, 1, 1),
(12, 14, 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_taller`
--

CREATE TABLE `alumno_taller` (
  `id_altall` int(11) NOT NULL,
  `id_taller` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `ini_taller` datetime DEFAULT NULL,
  `fin_taller` datetime DEFAULT NULL,
  `prom_taller` varchar(11) COLLATE utf8_spanish_ci DEFAULT NULL,
  `est_taller` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `alumno_taller`
--

INSERT INTO `alumno_taller` (`id_altall`, `id_taller`, `id_alumno`, `ini_taller`, `fin_taller`, `prom_taller`, `est_taller`) VALUES
(1, 1, 14, '2020-06-25 15:09:45', '2020-06-25 14:09:45', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id_cargo` int(11) NOT NULL,
  `nom_cargo` varchar(200) CHARACTER SET utf8 NOT NULL,
  `des_cargo` varchar(200) CHARACTER SET utf8 NOT NULL,
  `est_cargo` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id_cargo`, `nom_cargo`, `des_cargo`, `est_cargo`) VALUES
(1, 'Director', 'Director de la unidad educativa', 1),
(2, 'Docente', 'Docente de la unidad educativa', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL,
  `cod_curso` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `nom_curso` varchar(200) CHARACTER SET utf8 NOT NULL,
  `sec_curso` varchar(200) CHARACTER SET utf8 NOT NULL,
  `jornada` int(11) NOT NULL,
  `est_curso` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id_curso`, `cod_curso`, `nom_curso`, `sec_curso`, `jornada`, `est_curso`) VALUES
(1, 'CUR-4568-2020', 'Séptimo (7)', 'A', 1, 1),
(2, 'CUR-4588-2020', '7mo', 'B', 2, 1),
(4, 'CUR-9568-2020', '7mo', 'A', 2, 1),
(6, 'CUR-6949-2020', '8 vo', 'A', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_usuarios`
--

CREATE TABLE `datos_usuarios` (
  `id_dat_user` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nomb_user` varchar(200) CHARACTER SET utf8 NOT NULL,
  `apell_user` varchar(200) CHARACTER SET utf8 NOT NULL,
  `telf_user` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `correo_user` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `esta_user` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `datos_usuarios`
--

INSERT INTO `datos_usuarios` (`id_dat_user`, `id_usuario`, `nomb_user`, `apell_user`, `telf_user`, `correo_user`, `esta_user`) VALUES
(1, 1, 'Yasmanny', 'Mora', '', '', 1),
(2, 4, 'Roberth', 'Cobeña', '', '', 1),
(3, 14, 'Genesis', 'Zambrano', '', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id_docente` int(10) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `doc_titulo` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `doc_cargo` int(11) NOT NULL,
  `doc_estado` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id_docente`, `id_usuario`, `doc_titulo`, `doc_cargo`, `doc_estado`) VALUES
(1, 2, 'Master', 1, 1),
(9, 4, 'Ingeniero', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doc_curso`
--

CREATE TABLE `doc_curso` (
  `id_doc_cur` int(11) NOT NULL,
  `id_docente` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `est_doc_cur` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `doc_curso`
--

INSERT INTO `doc_curso` (`id_doc_cur`, `id_docente`, `id_curso`, `est_doc_cur`) VALUES
(1, 9, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornadas`
--

CREATE TABLE `jornadas` (
  `id_seccion` int(11) NOT NULL,
  `nom_seccion` varchar(200) CHARACTER SET utf8 NOT NULL,
  `est_seccion` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `jornadas`
--

INSERT INTO `jornadas` (`id_seccion`, `nom_seccion`, `est_seccion`) VALUES
(1, 'Matutina', 1),
(2, 'Vespertina', 1),
(3, 'Nocturna', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id_pregunta` int(11) NOT NULL,
  `id_taller` int(11) NOT NULL,
  `des_pregunta` text CHARACTER SET latin1 NOT NULL,
  `opc_1` text CHARACTER SET latin1 NOT NULL,
  `opc_2` text CHARACTER SET latin1 NOT NULL,
  `opc_3` text CHARACTER SET latin1 NOT NULL,
  `opc_4` text CHARACTER SET latin1 NOT NULL,
  `opc_correcta` int(11) NOT NULL,
  `est_pregu` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id_pregunta`, `id_taller`, `des_pregunta`, `opc_1`, `opc_2`, `opc_3`, `opc_4`, `opc_correcta`, `est_pregu`) VALUES
(1, 1, 'Pregunta 1', 'A', 'B', 'C', 'D', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `id_respuesta` int(3) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_pregunta` int(3) NOT NULL,
  `resp_alumno` varchar(50) CHARACTER SET latin1 NOT NULL,
  `est_resp` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`id_respuesta`, `id_alumno`, `id_pregunta`, `resp_alumno`, `est_resp`) VALUES
(1, 1, 1, '2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `taller`
--

CREATE TABLE `taller` (
  `id_taller` int(11) NOT NULL,
  `tema_taller` int(11) NOT NULL,
  `curs_taller` int(11) NOT NULL,
  `nom_taller` varchar(200) CHARACTER SET latin1 NOT NULL,
  `inicio_t` datetime NOT NULL,
  `fin_t` datetime NOT NULL,
  `esta_taller` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `taller`
--

INSERT INTO `taller` (`id_taller`, `tema_taller`, `curs_taller`, `nom_taller`, `inicio_t`, `fin_t`, `esta_taller`) VALUES
(1, 1, 1, 'Taller 1', '2020-06-25 15:02:34', '2020-06-30 15:02:51', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tema`
--

CREATE TABLE `tema` (
  `id_tema` int(11) NOT NULL,
  `Id_unidad` int(11) NOT NULL,
  `te_nombre` varchar(200) CHARACTER SET latin1 NOT NULL,
  `te_descripcion` text CHARACTER SET latin1 DEFAULT NULL,
  `tem_estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tema`
--

INSERT INTO `tema` (`id_tema`, `Id_unidad`, `te_nombre`, `te_descripcion`, `tem_estado`) VALUES
(1, 1, 'Tema 1 sobre el cuerpo humano', NULL, 1),
(2, 2, 'Tema 1 sobre el reino animal', NULL, 1),
(3, 3, 'Tema 1 sobre el reino vegetal', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `nombre_tipo` varchar(200) CHARACTER SET utf8 NOT NULL,
  `estado_tipo` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `nombre_tipo`, `estado_tipo`) VALUES
(1, 'Administador', 1),
(2, 'Docente', 1),
(3, 'Estudiante', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad`
--

CREATE TABLE `unidad` (
  `id_unidad` int(11) NOT NULL,
  `uni_nombre` varchar(200) CHARACTER SET latin1 NOT NULL,
  `uni_descripcion` text CHARACTER SET latin1 DEFAULT NULL,
  `url_img` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `uni_est` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `unidad`
--

INSERT INTO `unidad` (`id_unidad`, `uni_nombre`, `uni_descripcion`, `url_img`, `uni_est`) VALUES
(1, 'El cuerpo humano', 'Todo lo relacionado al campo Antropológico', '../recursos/img/cuerpo.png', 1),
(2, 'El reino animal', 'Todo lo relacionado con Zoología', '../recursos/img/animales.png', 1),
(3, 'El reino plantae', 'Todo lo relacionado con Botánica', '../recursos/img/plantas.png', 1),
(5, 'asdad', 'asdad', '../recursos/img/1593120933_visa.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `u_usuario` varchar(50) CHARACTER SET latin1 NOT NULL,
  `u_contra` varchar(12) CHARACTER SET latin1 NOT NULL,
  `u_tipo` int(11) NOT NULL,
  `u_estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `u_usuario`, `u_contra`, `u_tipo`, `u_estado`) VALUES
(1, 'jmora', 'admin', 1, 1),
(2, 'MGonzalez', '1234', 2, 1),
(4, 'rcobeña', '1234', 2, 1),
(14, 'gzambrano', '1234', 3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`alum_id`),
  ADD KEY `curso` (`alum_seccion`),
  ADD KEY `alum_usu` (`alum_usu`);

--
-- Indices de la tabla `alumno_taller`
--
ALTER TABLE `alumno_taller`
  ADD PRIMARY KEY (`id_altall`),
  ADD KEY `talleres` (`id_taller`),
  ADD KEY `alumnos` (`id_alumno`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`),
  ADD KEY `seccion` (`jornada`);

--
-- Indices de la tabla `datos_usuarios`
--
ALTER TABLE `datos_usuarios`
  ADD PRIMARY KEY (`id_dat_user`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id_docente`),
  ADD KEY `usuario` (`id_usuario`),
  ADD KEY `cargo` (`doc_cargo`);

--
-- Indices de la tabla `doc_curso`
--
ALTER TABLE `doc_curso`
  ADD PRIMARY KEY (`id_doc_cur`),
  ADD KEY `docente` (`id_docente`),
  ADD KEY `cursodoc` (`id_curso`);

--
-- Indices de la tabla `jornadas`
--
ALTER TABLE `jornadas`
  ADD PRIMARY KEY (`id_seccion`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id_pregunta`),
  ADD KEY `taller` (`id_taller`);

--
-- Indices de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD PRIMARY KEY (`id_respuesta`),
  ADD KEY `id_pregunta` (`id_pregunta`),
  ADD KEY `alumno` (`id_alumno`);

--
-- Indices de la tabla `taller`
--
ALTER TABLE `taller`
  ADD PRIMARY KEY (`id_taller`),
  ADD KEY `idcurso` (`curs_taller`),
  ADD KEY `tema` (`tema_taller`);

--
-- Indices de la tabla `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`id_tema`),
  ADD KEY `Id_unidad` (`Id_unidad`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indices de la tabla `unidad`
--
ALTER TABLE `unidad`
  ADD PRIMARY KEY (`id_unidad`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `tipo_usuario` (`u_tipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `alum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `alumno_taller`
--
ALTER TABLE `alumno_taller`
  MODIFY `id_altall` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `datos_usuarios`
--
ALTER TABLE `datos_usuarios`
  MODIFY `id_dat_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id_docente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `doc_curso`
--
ALTER TABLE `doc_curso`
  MODIFY `id_doc_cur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `jornadas`
--
ALTER TABLE `jornadas`
  MODIFY `id_seccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `id_respuesta` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `taller`
--
ALTER TABLE `taller`
  MODIFY `id_taller` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tema`
--
ALTER TABLE `tema`
  MODIFY `id_tema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `unidad`
--
ALTER TABLE `unidad`
  MODIFY `id_unidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `curso` FOREIGN KEY (`alum_seccion`) REFERENCES `cursos` (`id_curso`),
  ADD CONSTRAINT `idusuario` FOREIGN KEY (`alum_usu`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `alumno_taller`
--
ALTER TABLE `alumno_taller`
  ADD CONSTRAINT `alumnos` FOREIGN KEY (`id_alumno`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `talleres` FOREIGN KEY (`id_taller`) REFERENCES `taller` (`id_taller`);

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `seccion` FOREIGN KEY (`jornada`) REFERENCES `jornadas` (`id_seccion`);

--
-- Filtros para la tabla `datos_usuarios`
--
ALTER TABLE `datos_usuarios`
  ADD CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD CONSTRAINT `cargo` FOREIGN KEY (`doc_cargo`) REFERENCES `cargos` (`id_cargo`),
  ADD CONSTRAINT `usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `doc_curso`
--
ALTER TABLE `doc_curso`
  ADD CONSTRAINT `cursodoc` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`),
  ADD CONSTRAINT `docente` FOREIGN KEY (`id_docente`) REFERENCES `docentes` (`id_docente`);

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `taller` FOREIGN KEY (`id_taller`) REFERENCES `taller` (`id_taller`);

--
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `alumno` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`alum_id`),
  ADD CONSTRAINT `respuesta_ibfk_1` FOREIGN KEY (`id_pregunta`) REFERENCES `pregunta` (`id_pregunta`);

--
-- Filtros para la tabla `taller`
--
ALTER TABLE `taller`
  ADD CONSTRAINT `idcurso` FOREIGN KEY (`curs_taller`) REFERENCES `cursos` (`id_curso`),
  ADD CONSTRAINT `tema` FOREIGN KEY (`tema_taller`) REFERENCES `tema` (`id_tema`);

--
-- Filtros para la tabla `tema`
--
ALTER TABLE `tema`
  ADD CONSTRAINT `tema_ibfk_1` FOREIGN KEY (`Id_unidad`) REFERENCES `unidad` (`id_unidad`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `tipo_usuario` FOREIGN KEY (`u_tipo`) REFERENCES `tipo_usuario` (`id_tipo_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
