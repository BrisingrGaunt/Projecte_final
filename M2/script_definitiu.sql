-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-05-2019 a las 00:05:51
-- Versión del servidor: 5.7.17
-- Versión de PHP: 7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `projecte_kevin`
--
DROP DATABASE IF EXISTS `projecte_kevin`;
CREATE DATABASE IF NOT EXISTS `projecte_kevin` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `projecte_kevin`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cata`
--

DROP TABLE IF EXISTS `cata`;
CREATE TABLE `cata` (
  `id` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `producte` int(11) NOT NULL,
  `estat` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cata`
--

INSERT INTO `cata` (`id`, `empresa`, `producte`, `estat`, `data`) VALUES
(3, 15, 11, 1, '2019-05-18 18:00:00'),
(4, 15, 13, 1, '2019-05-28 00:15:00'),
(5, 14, 8, 1, '2019-05-30 10:00:00'),
(6, 12, 10, 1, '2019-05-30 16:24:00'),
(7, 14, 6, 1, '2019-05-21 09:00:00'),
(8, 15, 18, 0, '2019-07-26 07:07:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
  `email` varchar(50) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`email`, `username`, `password`) VALUES
('britney@gmail.com', 'BritneySpears', '136d0868ca00e163a85a0f2ad78dd1de'),
('britnney@gmail.com', 'BritneySpears1', '768b590d637df305726dbd9f5528673b'),
('dracarys@gmail.com', 'DaenerysTargaryen', '3cd6cb7178245ee37bf722396b687add'),
('emma_watson@gmail.com', 'EmmaWatson', '7461a5abe19aa8202257dd2f874ed234'),
('formationtour@gmail.com', 'Formation', 'acf4f333fb00bbe6b5e02d81cfbd395a'),
('kkevvin19@gmacil.com', 'KevinMede', 'acf4f333fb00bbe6b5e02d81cfbd395a'),
('w2.kmedina@infomila.info', 'Kev', '3e677d133fec4b263e4365f9c36dab72'),
('w2.mgomez@infomila.info', 'Miwui11', '7a6d45d35f0de5c5ba2ffd29958e1495'),
('w2.ppuyo@infomila.info', 'Pedronsio', '8157e3eb7e6533cf1ed55b44d6cc443a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

DROP TABLE IF EXISTS `empresa`;
CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `nom` varchar(80) NOT NULL,
  `tipusVia` varchar(15) NOT NULL,
  `direccio` varchar(210) NOT NULL,
  `comarca` varchar(45) NOT NULL,
  `numDireccio` int(11) NOT NULL,
  `password` varchar(130) NOT NULL,
  `email` varchar(50) NOT NULL,
  `visibilitat` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='password';

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `username`, `nom`, `tipusVia`, `direccio`, `comarca`, `numDireccio`, `password`, `email`, `visibilitat`) VALUES
(11, 'Clein', 'Clein Frankfurt', 'Carrer', 'Rambla Sant Isidre', 'Igualada', 26, 'ece65e19890b8bfbf064a31a90b712da', 'clein@clein.es', 0),
(12, 'Krusty', 'Krusty Burger', 'Avinguda', 'Evergreen Terrace ', 'Neverland', 11, 'fe8285631ba08a82af86a370a37353e4', 'krusty@krusty.com', 0),
(13, 'BobEsponja', 'Crustáceo crujiente', 'Carrer', 'Piña debajo del mar', 'Igualada', 12, '94336a363c529a5350ce2e50ccb49e5b', 'bobesponja@gmail.com', 0),
(14, 'centralPerk', 'Central Perk Cafe', 'Avinguda', 'la quinta avenida', 'Igualada', 5, 'ac82193c353f634f291849b03f999c1e', 'illbethereforyou@friends.com', 0),
(15, 'Baviera', 'Baviera Frankfurt', 'Carrer', 'Lleida', 'Igualada', 57, '63e3bfc5901e7554ecb6310d16d67bdf', 'baviera@igualada.com', 0),
(17, 'Fitzgerald', 'Fitzgerald Foods', 'Avinguda', 'whaaat', 'Garraf', 23, 'ec0e60929ec1dddae97fd87b301304ce', 'fitzgerald@gmail.com', 0),
(26, 'kevinmedina', 'Kevin Medina Delgado', 'Carrer', 'Veciana', 'Igualada', 6, 'acf4f333fb00bbe6b5e02d81cfbd395a', 'kkevvin19@gmasil.com', 0),
(27, 'lordgaunt', 'LordGaunt', 'Avinguda', 'falsaaaaa', 'Igualada', 1, 'acf4f333fb00bbe6b5e02d81cfbd395a', 'formationworld@gmail.com', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participacio`
--

DROP TABLE IF EXISTS `participacio`;
CREATE TABLE `participacio` (
  `cata` int(11) NOT NULL,
  `client` varchar(50) NOT NULL,
  `valoracio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `participacio`
--

INSERT INTO `participacio` (`cata`, `client`, `valoracio`) VALUES
(3, 'britney@gmail.com', 5),
(4, 'dracarys@gmail.com', NULL),
(4, 'emma_watson@gmail.com', NULL),
(4, 'w2.kmedina@infomila.info', NULL),
(5, 'w2.mgomez@infomila.info', 2),
(6, 'w2.mgomez@infomila.info', NULL),
(8, 'formationtour@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producte`
--

DROP TABLE IF EXISTS `producte`;
CREATE TABLE `producte` (
  `codi` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `descripcio` varchar(210) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producte`
--

INSERT INTO `producte` (`codi`, `empresa`, `nom`, `descripcio`) VALUES
(1, 11, 'Patates de Blat de moro', 'Patates de Blat de moro amb salsa brava'),
(2, 11, 'Pizza de tonyina', 'Pizza de tonyina amb ceba caramelitzada'),
(3, 11, 'Aigua de pluja', 'Aigua de les pluges de l\'Amazones'),
(4, 13, 'CangreBurger', 'Hamburguesa realizada for the one and only Señor Patricio'),
(5, 12, 'KrustyBurger', 'Hamburguesa de animal extinguido hecha por el chico de los granos'),
(6, 14, 'Café con amigos', 'Nosotros ponemos el café, tú los amigos'),
(7, 15, 'Aigua de pluja de l\'Amazones', 'Aigua purificada amb propietats curatives'),
(8, 14, 'Magdalena de xocolata gegant', 'Muffin para los amigos'),
(9, 13, 'Patates fregides', 'Patates fregides sota el mar'),
(10, 12, 'Bolsa sorpresa', 'Diferents ítems que es troben quan es neteja la fregidora (disponible 2 cops a l\'any)'),
(11, 15, 'Frankfurt de la casa', 'Frankfurt com el que et fas a casa, però més car'),
(12, 13, 'Gelat de pinya', '(No és la mateixa pinya que la del Bob)'),
(13, 15, 'Nuggets de pollastre', 'de que sinó?'),
(17, 13, 'La concha de arenita', 'La parte salada de una ardilla submarina'),
(18, 15, 'Ganas de vivir', 'No sé que son, no tengo'),
(19, 27, 'Blow me', 'Descripció 1'),
(20, 27, 'The truth about love', 'yeah yeah '),
(21, 27, 'Hola buenas que tal', 'Beam me up');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cata`
--
ALTER TABLE `cata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producte` (`producte`),
  ADD KEY `empresa` (`empresa`);

--
-- Indices de la tabla `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nom` (`nom`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indices de la tabla `participacio`
--
ALTER TABLE `participacio`
  ADD PRIMARY KEY (`cata`,`client`),
  ADD KEY `client` (`client`),
  ADD KEY `cata` (`cata`);

--
-- Indices de la tabla `producte`
--
ALTER TABLE `producte`
  ADD PRIMARY KEY (`codi`,`empresa`),
  ADD UNIQUE KEY `nom` (`nom`),
  ADD KEY `empresa` (`empresa`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cata`
--
ALTER TABLE `cata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `producte`
--
ALTER TABLE `producte`
  MODIFY `codi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cata`
--
ALTER TABLE `cata`
  ADD CONSTRAINT `cata_ibfk_1` FOREIGN KEY (`producte`) REFERENCES `producte` (`codi`),
  ADD CONSTRAINT `cata_ibfk_2` FOREIGN KEY (`empresa`) REFERENCES `empresa` (`id`);

--
-- Filtros para la tabla `participacio`
--
ALTER TABLE `participacio`
  ADD CONSTRAINT `participacio_ibfk_1` FOREIGN KEY (`client`) REFERENCES `client` (`email`),
  ADD CONSTRAINT `participacio_ibfk_2` FOREIGN KEY (`cata`) REFERENCES `cata` (`id`);

--
-- Filtros para la tabla `producte`
--
ALTER TABLE `producte`
  ADD CONSTRAINT `producte_ibfk_1` FOREIGN KEY (`empresa`) REFERENCES `empresa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
