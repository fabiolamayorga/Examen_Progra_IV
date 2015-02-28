-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 27-02-2015 a las 04:12:36
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `Campeonato`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Equipos`
--

CREATE TABLE IF NOT EXISTS `Equipos` (
  `Codigo_Equipo` varchar(10) NOT NULL,
  `Nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Equipos`
--

INSERT INTO `Equipos` (`Codigo_Equipo`, `Nombre`) VALUES
('equipoA', 'saprissa'),
('equipoB', 'liga'),
('equipoC', 'santos'),
('equipoD', 'limon'),
('equipoE', 'belen'),
('equipoF', 'carmelita'),
('equipoG', 'heredia'),
('equipoH', 'ucr'),
('equipoI', 'puntarenas'),
('equipoJ', 'perez'),
('equipoK', 'puma'),
('equipoL', 'patitos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Partidos`
--

CREATE TABLE IF NOT EXISTS `Partidos` (
  `Jornada` int(11) NOT NULL,
  `Codigo_equipo_local` varchar(10) NOT NULL,
  `Codigo_equipo_visita` varchar(10) NOT NULL,
  `Goles_local` int(11) NOT NULL,
  `Goles_visita` int(11) NOT NULL,
  `Fecha_partido` date NOT NULL,
  `Hora_partido` varchar(10) NOT NULL,
  `Usuario_creacion` varchar(30) NOT NULL,
  `Fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Partidos`
--

INSERT INTO `Partidos` (`Jornada`, `Codigo_equipo_local`, `Codigo_equipo_visita`, `Goles_local`, `Goles_visita`, `Fecha_partido`, `Hora_partido`, `Usuario_creacion`, `Fecha_creacion`) VALUES
(1, 'equipoA', 'equipoB', 1, 2, '2015-02-04', '12:59', 'system', '2015-02-26'),
(1, 'equipoD', 'equipoF', 3, 5, '2015-02-11', '01:00', 'system', '2015-02-26');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Equipos`
--
ALTER TABLE `Equipos`
 ADD PRIMARY KEY (`Codigo_Equipo`);

--
-- Indices de la tabla `Partidos`
--
ALTER TABLE `Partidos`
 ADD PRIMARY KEY (`Jornada`,`Codigo_equipo_local`,`Codigo_equipo_visita`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
