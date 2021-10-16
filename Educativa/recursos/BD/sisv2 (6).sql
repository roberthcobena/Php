-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-03-2021 a las 17:18:13
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
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `alum_id` int(11) NOT NULL,
  `alum_usu` int(11) NOT NULL,
  `alum_seccion` int(11) NOT NULL,
  `alum_estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`alum_id`, `alum_usu`, `alum_seccion`, `alum_estado`) VALUES
(2, 259, 1, 1),
(3, 265, 1, 1),
(4, 266, 1, 1),
(5, 267, 1, 1),
(6, 268, 1, 1),
(7, 269, 1, 1),
(8, 270, 3, 1),
(9, 271, 3, 1),
(10, 272, 3, 1),
(11, 273, 3, 1),
(12, 274, 3, 1);

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
  `est_taller` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `alumno_taller`
--

INSERT INTO `alumno_taller` (`id_altall`, `id_taller`, `id_alumno`, `ini_taller`, `fin_taller`, `prom_taller`, `est_taller`) VALUES
(5, 1, 259, '2021-02-14 20:12:14', '2021-02-14 20:12:35', '1', 2),
(4, 2, 259, '2021-02-14 04:55:24', '2021-02-14 04:56:02', '6', 2),
(6, 1, 265, '2021-02-20 05:53:14', '2021-02-20 05:53:39', '0', 2),
(7, 2, 265, '2021-02-20 05:53:44', '2021-02-20 05:53:55', '6', 2),
(8, 2, 266, '2021-02-20 05:56:56', '2021-02-20 05:57:04', '2', 2),
(9, 1, 266, '2021-02-20 05:57:11', '2021-02-20 05:58:05', '7', 2),
(10, 1, 267, '2021-02-20 06:00:11', '2021-02-20 06:00:28', '4', 2),
(11, 2, 267, '2021-02-20 06:00:33', '2021-02-20 06:00:45', '2', 2),
(12, 1, 268, '2021-02-20 06:03:03', '2021-02-20 06:03:18', '5', 2),
(13, 2, 268, '2021-02-20 06:03:24', '2021-02-20 06:03:33', '4', 2),
(14, 2, 269, '2021-02-20 06:05:28', '2021-02-20 06:05:35', '0', 2),
(15, 1, 269, '2021-02-20 06:05:40', '2021-02-20 06:06:02', '6', 2),
(16, 6, 270, '2021-02-20 16:04:46', '2021-02-20 16:04:59', '6', 2),
(17, 5, 270, '2021-02-20 16:05:26', '2021-02-20 16:05:39', '2', 2),
(18, 4, 270, '2021-02-20 16:06:04', '2021-02-20 16:06:11', '0', 2),
(19, 6, 271, '2021-02-20 16:29:10', '2021-02-20 16:29:22', '0', 2),
(20, 5, 271, '2021-02-20 16:30:07', '2021-02-20 16:30:21', '0', 2),
(21, 4, 271, '2021-02-20 16:30:38', '2021-02-20 16:31:03', '2', 2),
(22, 6, 272, '2021-02-20 17:14:29', '2021-02-20 17:14:35', '4', 2),
(23, 5, 272, '2021-02-20 17:14:40', '2021-02-20 17:14:47', '2', 2),
(24, 4, 272, '2021-02-20 17:15:02', '2021-02-20 17:15:09', '0', 2),
(25, 6, 273, '2021-02-20 17:22:57', '2021-02-20 17:23:07', '0', 2),
(26, 5, 273, '2021-02-20 17:26:14', '2021-02-20 17:26:22', '4', 2),
(27, 4, 273, '2021-02-20 17:26:28', '2021-02-20 17:26:37', '6', 2),
(28, 6, 274, '2021-02-20 18:24:46', '2021-02-20 18:24:59', '2', 2),
(29, 5, 274, '2021-02-20 18:25:06', '2021-02-20 18:25:13', '2', 2),
(30, 4, 274, '2021-02-20 18:25:18', '2021-02-20 18:25:30', '0', 2),
(31, 8, 259, '2021-02-22 17:42:20', '2021-02-22 17:42:42', '10', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anios_lectivos`
--

CREATE TABLE `anios_lectivos` (
  `id` int(11) NOT NULL,
  `anio` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `desde` date NOT NULL,
  `hasta` date NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `anios_lectivos`
--

INSERT INTO `anios_lectivos` (`id`, `anio`, `desde`, `hasta`, `estado`) VALUES
(1, '2021', '2021-01-01', '2021-12-31', 1),
(4, '2020', '2020-01-01', '2020-12-31', 3),
(5, '2022', '2022-01-03', '2022-12-31', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id_cargo` int(11) NOT NULL,
  `nom_cargo` varchar(200) CHARACTER SET utf8 NOT NULL,
  `des_cargo` varchar(200) CHARACTER SET utf8 NOT NULL,
  `est_cargo` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
  `an_lec` int(11) NOT NULL,
  `est_curso` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id_curso`, `cod_curso`, `nom_curso`, `sec_curso`, `jornada`, `an_lec`, `est_curso`) VALUES
(1, 'CUR-6022-2021', '7(mo)', 'A', 1, 1, 1),
(2, 'CUR-2887-2021', '7(mo)', 'B', 1, 1, 1),
(3, 'CUR-8724-2020', '7(mo)', 'A', 1, 4, 3),
(4, 'CUR-7082-2021', '7(mo)', 'C', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_usuarios`
--

CREATE TABLE `datos_usuarios` (
  `id_dat_user` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `ced_user` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `nomb_user` varchar(200) CHARACTER SET utf8 NOT NULL,
  `apell_user` varchar(200) CHARACTER SET utf8 NOT NULL,
  `telf_user` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `correo_user` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `esta_user` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `datos_usuarios`
--

INSERT INTO `datos_usuarios` (`id_dat_user`, `id_usuario`, `ced_user`, `nomb_user`, `apell_user`, `telf_user`, `correo_user`, `esta_user`) VALUES
(1, 1, '', 'Emanuel Yasmanny', 'Mora Pizarro', '(09) 80811189', 'yasma@hotmail.com', 1),
(4, 163, '0512415785', 'manuel vicente', 'mora merelo', '(09) 58752201', 'manuelmoramerelo@hotmail.com', 1),
(12, 174, '0941754845', 'Modesta Cira', 'Caicedo Castro', '(09) 88739136', '', 1),
(13, 175, '0814578412', 'William Wilfrido', 'Mora Merelo', '(09) 67577481', '', 1),
(14, 176, '0665784210', 'Luis Enrique', 'Guerrero Dominguez', '(09) 60283949', '', 1),
(15, 177, '0512748592', 'Maria Yolanda', 'Castro Mero', '(09) 94703366', '', 1),
(97, 259, '', 'Karla Ariana', 'Flores Torres', '--------', '---------', 1),
(102, 264, '0914697990', 'Laura Margarita', 'Pizarro Ronquillo', '(09) 800088__', 'laurita@_._', 1),
(103, 265, '', 'Dayra Isabel', 'Bravo Torres', '--------', '---------', 1),
(104, 266, '', 'Ricardo Marcelo', 'Estacio Moran', '--------', '---------', 1),
(105, 267, '', 'Jordy Cristobal', 'Gomez Lumisaca', '--------', '---------', 1),
(106, 268, '', 'Jhoel Leonardo', 'Lema Hernandez', '--------', '---------', 1),
(107, 269, '', 'Dennys Steven', 'Riofrio Cruz', '--------', '---------', 1),
(108, 270, '', 'Jose Daniel', 'Ayala Vivero', '--------', '---------', 1),
(109, 271, '', 'Manuel Enrique', 'Contreras Alvarez', '--------', '---------', 1),
(110, 272, '', 'Carlos Jose', 'Moreno Castro', '--------', '---------', 1),
(111, 273, '', 'Fernando Ariel', 'Solis Rodriguez', '--------', '---------', 1),
(112, 274, '', 'Heidy Stefania', 'Valencia Yonson', '--------', '---------', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id_docente` int(10) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `doc_titulo` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `doc_cargo` int(11) NOT NULL,
  `doc_estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id_docente`, `id_usuario`, `doc_titulo`, `doc_cargo`, `doc_estado`) VALUES
(10, 163, 'Master', 1, 1),
(12, 174, 'Licenciado(a)', 2, 1),
(13, 175, 'Licenciado(a)', 2, 1),
(14, 176, 'Licenciado(a)', 2, 1),
(15, 177, 'Licenciado(a)', 2, 1),
(20, 264, 'Master', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doc_curso`
--

CREATE TABLE `doc_curso` (
  `id_doc_cur` int(11) NOT NULL,
  `id_docente` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `est_doc_cur` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `doc_curso`
--

INSERT INTO `doc_curso` (`id_doc_cur`, `id_docente`, `id_curso`, `est_doc_cur`) VALUES
(5, 15, 1, 1),
(9, 15, 3, 3),
(8, 13, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornadas`
--

CREATE TABLE `jornadas` (
  `id_seccion` int(11) NOT NULL,
  `nom_seccion` varchar(200) CHARACTER SET utf8 NOT NULL,
  `est_seccion` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
  `est_pregu` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id_pregunta`, `id_taller`, `des_pregunta`, `opc_1`, `opc_2`, `opc_3`, `opc_4`, `opc_correcta`, `est_pregu`) VALUES
(1, 1, 'pregu 1', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 2, 1),
(2, 1, 'pregunta 2', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 1, 1),
(3, 1, 'pregunta 3', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 1, 1),
(4, 1, 'pregunta 4', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 4, 1),
(5, 1, 'pregunta 5', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 2, 1),
(6, 2, 'pregunta 1', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 1, 1),
(7, 2, 'pregunta 2', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 3, 1),
(8, 2, 'pregunta', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 2, 1),
(9, 2, 'pregunta 4', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 3, 1),
(10, 2, 'pregunta 5', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 3, 1),
(11, 1, 'pregunta 6', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 2, 1),
(12, 1, 'pregunta 7', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 1, 1),
(13, 1, 'pregunta 8', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 3, 1),
(14, 1, 'pregunta 9', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 2, 1),
(15, 1, 'pregunta 10', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 2, 1),
(16, 3, 'pregunta 1', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 3, 1),
(17, 3, 'pregunta 2', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 3, 1),
(18, 3, 'pregunta 3', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 1, 1),
(19, 3, 'pregunta 4', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 2, 1),
(20, 3, 'pregunta 5', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 4, 1),
(21, 4, 'pregunta 1', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 1, 1),
(22, 4, 'pregu 2', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 3, 1),
(23, 4, 'pregunta 3', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 2, 1),
(24, 4, 'pregunta 4', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 4, 1),
(25, 4, 'pregunta 5', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 2, 1),
(26, 5, 'pregu 1', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 3, 1),
(27, 5, 'pregu 2', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 1, 1),
(28, 5, 'pregu 3', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 2, 1),
(29, 5, 'pregu 4', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 4, 1),
(30, 5, 'pregu 5', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 2, 1),
(31, 6, 'pregu 1', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 2, 1),
(32, 6, 'pregu 2', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 3, 1),
(33, 6, 'pregiu 3', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 3, 1),
(34, 6, 'pregu 4', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 4, 1),
(35, 6, 'pregu 5', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 3, 1),
(36, 7, 'pregunta 1', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 2, 1),
(37, 7, 'pregu 2', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 2, 1),
(38, 7, 'pregu 3', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 3, 1),
(39, 7, 'pregu 4', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 2, 1),
(40, 7, 'pregu 5', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 2, 1),
(41, 8, 'pregu 1', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 2, 1),
(42, 8, 'pregu', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 2, 1),
(43, 8, 'pregu 3', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 3, 1),
(44, 8, 'pregu 4', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 2, 1),
(45, 8, 'pregu 5', 'resp 1', 'resp 2', 'resp 3', 'resp 4', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE `respuesta` (
  `id_respuesta` int(3) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_pregunta` int(3) NOT NULL,
  `resp_alumno` varchar(50) CHARACTER SET latin1 NOT NULL,
  `est_resp` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`id_respuesta`, `id_alumno`, `id_pregunta`, `resp_alumno`, `est_resp`) VALUES
(11, 2, 6, '1', 1),
(12, 2, 7, '2', 1),
(13, 2, 8, '3', 1),
(14, 2, 9, '3', 1),
(15, 2, 10, '3', 1),
(16, 2, 1, '1', 1),
(17, 2, 2, '3', 1),
(18, 2, 3, '3', 1),
(19, 2, 4, '3', 1),
(20, 2, 5, '4', 1),
(21, 2, 11, '2', 1),
(22, 2, 12, '3', 1),
(23, 2, 13, '1', 1),
(24, 2, 14, '3', 1),
(25, 2, 15, '3', 1),
(26, 3, 1, '1', 1),
(27, 3, 2, '3', 1),
(28, 3, 3, '2', 1),
(29, 3, 4, '3', 1),
(30, 3, 5, '3', 1),
(31, 3, 11, '1', 1),
(32, 3, 12, '4', 1),
(33, 3, 13, '2', 1),
(34, 3, 14, '3', 1),
(35, 3, 15, '1', 1),
(36, 3, 6, '1', 1),
(37, 3, 7, '2', 1),
(38, 3, 8, '2', 1),
(39, 3, 9, '1', 1),
(40, 3, 10, '3', 1),
(41, 4, 6, '2', 1),
(42, 4, 7, '4', 1),
(43, 4, 8, '2', 1),
(44, 4, 9, '1', 1),
(45, 4, 10, '2', 1),
(46, 4, 1, '2', 1),
(47, 4, 2, '1', 1),
(48, 4, 3, '1', 1),
(49, 4, 4, '2', 1),
(50, 4, 5, '3', 1),
(51, 4, 11, '2', 1),
(52, 4, 12, '1', 1),
(53, 4, 13, '2', 1),
(54, 4, 14, '2', 1),
(55, 4, 15, '2', 1),
(56, 5, 1, '2', 1),
(57, 5, 2, '2', 1),
(58, 5, 3, '1', 1),
(59, 5, 4, '2', 1),
(60, 5, 5, '4', 1),
(61, 5, 11, '3', 1),
(62, 5, 12, '1', 1),
(63, 5, 13, '3', 1),
(64, 5, 14, '3', 1),
(65, 5, 15, '3', 1),
(66, 5, 6, '3', 1),
(67, 5, 7, '2', 1),
(68, 5, 8, '3', 1),
(69, 5, 9, '2', 1),
(70, 5, 10, '3', 1),
(71, 6, 1, '2', 1),
(72, 6, 2, '3', 1),
(73, 6, 3, '4', 1),
(74, 6, 4, '3', 1),
(75, 6, 5, '2', 1),
(76, 6, 11, '2', 1),
(77, 6, 12, '2', 1),
(78, 6, 13, '2', 1),
(79, 6, 14, '2', 1),
(80, 6, 15, '2', 1),
(81, 6, 6, '3', 1),
(82, 6, 7, '4', 1),
(83, 6, 8, '2', 1),
(84, 6, 9, '2', 1),
(85, 6, 10, '3', 1),
(86, 7, 6, '3', 1),
(87, 7, 7, '1', 1),
(88, 7, 8, '3', 1),
(89, 7, 9, '2', 1),
(90, 7, 10, '2', 1),
(91, 7, 1, '2', 1),
(92, 7, 2, '2', 1),
(93, 7, 3, '1', 1),
(94, 7, 4, '2', 1),
(95, 7, 5, '2', 1),
(96, 7, 11, '3', 1),
(97, 7, 12, '1', 1),
(98, 7, 13, '4', 1),
(99, 7, 14, '2', 1),
(100, 7, 15, '2', 1),
(101, 8, 31, '1', 1),
(102, 8, 32, '3', 1),
(103, 8, 33, '3', 1),
(104, 8, 34, '1', 1),
(105, 8, 35, '3', 1),
(106, 8, 26, '2', 1),
(107, 8, 27, '2', 1),
(108, 8, 28, '2', 1),
(109, 8, 29, '2', 1),
(110, 8, 30, '3', 1),
(111, 8, 21, '2', 1),
(112, 8, 22, '4', 1),
(113, 8, 23, '3', 1),
(114, 8, 24, '2', 1),
(115, 8, 25, '3', 1),
(116, 9, 31, '1', 1),
(117, 9, 32, '2', 1),
(118, 9, 33, '4', 1),
(119, 9, 34, '3', 1),
(120, 9, 35, '1', 1),
(121, 9, 26, '1', 1),
(122, 9, 27, '2', 1),
(123, 9, 28, '1', 1),
(124, 9, 29, '3', 1),
(125, 9, 30, '4', 1),
(126, 9, 21, '2', 1),
(127, 9, 22, '2', 1),
(128, 9, 23, '1', 1),
(129, 9, 24, '1', 1),
(130, 9, 25, '2', 1),
(131, 10, 31, '2', 1),
(132, 10, 32, '3', 1),
(133, 10, 33, '1', 1),
(134, 10, 34, '2', 1),
(135, 10, 35, '2', 1),
(136, 10, 26, '4', 1),
(137, 10, 27, '2', 1),
(138, 10, 28, '2', 1),
(139, 10, 29, '2', 1),
(140, 10, 30, '1', 1),
(141, 10, 21, '2', 1),
(142, 10, 22, '4', 1),
(143, 10, 23, '4', 1),
(144, 10, 24, '1', 1),
(145, 10, 25, '3', 1),
(146, 11, 31, '4', 1),
(147, 11, 32, '4', 1),
(148, 11, 33, '2', 1),
(149, 11, 34, '1', 1),
(150, 11, 35, '2', 1),
(151, 11, 26, '3', 1),
(152, 11, 27, '2', 1),
(153, 11, 28, '1', 1),
(154, 11, 29, '4', 1),
(155, 11, 30, '3', 1),
(156, 11, 21, '2', 1),
(157, 11, 22, '3', 1),
(158, 11, 23, '2', 1),
(159, 11, 24, '3', 1),
(160, 11, 25, '2', 1),
(161, 12, 31, '2', 1),
(162, 12, 32, '1', 1),
(163, 12, 33, '4', 1),
(164, 12, 34, '2', 1),
(165, 12, 35, '4', 1),
(166, 12, 26, '2', 1),
(167, 12, 27, '3', 1),
(168, 12, 28, '1', 1),
(169, 12, 29, '3', 1),
(170, 12, 30, '2', 1),
(171, 12, 21, '2', 1),
(172, 12, 22, '1', 1),
(173, 12, 23, '4', 1),
(174, 12, 24, '3', 1),
(175, 12, 25, '4', 1),
(176, 2, 41, '2', 1),
(177, 2, 42, '2', 1),
(178, 2, 43, '3', 1),
(179, 2, 44, '2', 1),
(180, 2, 45, '2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `taller`
--

CREATE TABLE `taller` (
  `id_taller` int(11) NOT NULL,
  `tema_taller` int(11) NOT NULL,
  `curs_taller` int(11) NOT NULL,
  `nom_taller` varchar(200) CHARACTER SET latin1 NOT NULL,
  `cant_taller` int(11) NOT NULL,
  `acce_taller` int(11) NOT NULL,
  `inicio_t` datetime NOT NULL,
  `fin_t` datetime NOT NULL,
  `esta_taller` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `taller`
--

INSERT INTO `taller` (`id_taller`, `tema_taller`, `curs_taller`, `nom_taller`, `cant_taller`, `acce_taller`, `inicio_t`, `fin_t`, `esta_taller`) VALUES
(1, 1, 1, 'Taller #1 Sistema Nervioso', 10, 1, '2021-02-13 12:00:00', '2021-02-13 12:10:00', 1),
(2, 5, 1, 'Taller #2 sistema muscular', 5, 1, '2021-02-13 16:44:25', '2021-02-13 18:50:00', 1),
(3, 6, 1, 'taller # sistema endocrino', 5, 2, '2021-02-18 10:00:00', '2021-02-18 18:00:00', 1),
(4, 1, 3, 'sistema nervioso', 5, 1, '2021-02-20 15:50:00', '2021-02-27 18:00:00', 1),
(5, 5, 3, 'sistema muscular', 5, 1, '2021-02-20 15:50:00', '2021-02-27 18:00:00', 1),
(6, 6, 3, 'sistema endocrino', 5, 1, '2021-02-20 15:50:00', '2021-02-27 18:00:00', 1),
(7, 4, 1, 'Animales invertebrados', 5, 1, '2021-02-24 12:00:00', '2021-02-25 12:00:00', 1),
(8, 2, 1, 'Animales Vertebrados', 5, 2, '2021-02-22 17:40:01', '2021-02-23 17:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tema`
--

CREATE TABLE `tema` (
  `id_tema` int(11) NOT NULL,
  `Id_unidad` int(11) NOT NULL,
  `te_nombre` varchar(200) CHARACTER SET latin1 NOT NULL,
  `te_descripcion` text CHARACTER SET latin1,
  `tem_estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tema`
--

INSERT INTO `tema` (`id_tema`, `Id_unidad`, `te_nombre`, `te_descripcion`, `tem_estado`) VALUES
(1, 1, 'Tema 1 Sistema nervioso', 'Se encarga de analizar la información que nos llega del exterior a través de los sentidos y de elaborar una respuesta.', 1),
(2, 2, 'Tema 1 Vertebrados', 'Animales que cuentan con estructura osea', 1),
(3, 3, 'Tema 1 plantas con flor o criptógamas ', 'Son de estructura muy sencilla y no tienen flores, por lo que no presentan ni frutos ni semillas.', 1),
(4, 2, 'Tema 2 Invertebrados', 'Animales que no cuenta con columna vertebral, estos pueden contar con un esqueleto externo o uno interno o sin ningún tipo de protección.', 1),
(5, 1, 'Tema 2 Sistema muscular', 'Constituye la parte activa del aparato locomotor, esta formado por los músculos y tendones', 1),
(6, 1, 'Tema 3 Sistema endocrino', 'Es el conjunto de órganos y tejidos del organismo que segregan hormonas con el propósito de regular las funciones del cuerpo', 1),
(7, 1, 'Tema 4 Sistema esquelético', 'Actúa como soporte de nuestro cuerpo posibilitando su movimiento y da protección a los órganos internos mas delicados', 1),
(8, 3, 'Tema 2 plantas con flor fanerógamas', 'Son las plantas que si presentan flores y se reproducen mediante estas flores.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `nombre_tipo` varchar(200) CHARACTER SET utf8 NOT NULL,
  `estado_tipo` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
  `uni_descripcion` text CHARACTER SET latin1,
  `url_img` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `uni_est` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `unidad`
--

INSERT INTO `unidad` (`id_unidad`, `uni_nombre`, `uni_descripcion`, `url_img`, `uni_est`) VALUES
(1, 'El cuerpo humano', 'Es el conjunto de la estructura física y de órganos que forman al ser humano.', '../recursos/img/cuerpo.png', 1),
(2, 'El reino animal', 'Todo lo relacionado con un conjunto de seres vivos que comparten características relevantes que los distingue de otros.', '../recursos/img/animales.png', 1),
(3, 'El reino plantae', 'Se refiere al grupo de las plantas terrestres, que son los organismos eucariotas multicelulares fotosintéticos', '../recursos/img/plantas.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `u_usuario` varchar(50) CHARACTER SET latin1 NOT NULL,
  `u_contra` varchar(12) CHARACTER SET latin1 NOT NULL,
  `u_tipo` int(11) NOT NULL,
  `u_estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `u_usuario`, `u_contra`, `u_tipo`, `u_estado`) VALUES
(1, 'admin', 'admin', 1, 1),
(163, 'mmerelo', 'mmerelo', 2, 1),
(174, 'CCmodesta', 'ccmodesta', 2, 1),
(175, 'MMwilliam', 'mmwilliam', 2, 1),
(176, 'GDluis', 'gdluis', 2, 1),
(177, 'CMmaria', 'cmmaria', 2, 1),
(274, 'VYheidy', 'vyheidy', 3, 1),
(273, 'SRfernando', 'srfernando', 3, 1),
(272, 'MCcarlos', 'mccarlos', 3, 1),
(271, 'CAmanuel', 'camanuel', 3, 1),
(270, 'AVjose', 'avjose', 3, 1),
(269, 'RCdennys', 'rcdennys', 3, 1),
(268, 'LHjhoel', 'lhjhoel', 3, 1),
(267, 'GLjordy', 'gljordy', 3, 1),
(266, 'EMricardo', 'emricardo', 3, 1),
(265, 'Btdayra', 'btdayra', 3, 1),
(264, 'PRmargarita', 'prmargarita', 2, 1),
(259, 'FTarianna', 'ftarianna', 3, 1);

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
-- Indices de la tabla `anios_lectivos`
--
ALTER TABLE `anios_lectivos`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id_altall` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `anios_lectivos`
--
ALTER TABLE `anios_lectivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `datos_usuarios`
--
ALTER TABLE `datos_usuarios`
  MODIFY `id_dat_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id_docente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `doc_curso`
--
ALTER TABLE `doc_curso`
  MODIFY `id_doc_cur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `jornadas`
--
ALTER TABLE `jornadas`
  MODIFY `id_seccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT de la tabla `respuesta`
--
ALTER TABLE `respuesta`
  MODIFY `id_respuesta` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;
--
-- AUTO_INCREMENT de la tabla `taller`
--
ALTER TABLE `taller`
  MODIFY `id_taller` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `tema`
--
ALTER TABLE `tema`
  MODIFY `id_tema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
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
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=275;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
