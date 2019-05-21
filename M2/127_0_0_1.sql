-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Temps de generació: 21-05-2019 a les 21:22:05
-- Versió del servidor: 5.7.17
-- Versió de PHP: 7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `projecte_kevin`
--
DROP DATABASE IF EXISTS `projecte_kevin`;
CREATE DATABASE IF NOT EXISTS `projecte_kevin` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `projecte_kevin`;

-- --------------------------------------------------------

--
-- Estructura de la taula `cata`
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
-- Bolcant dades de la taula `cata`
--

INSERT INTO `cata` (`id`, `empresa`, `producte`, `estat`, `data`) VALUES
(3, 15, 11, 1, '2019-05-18 18:00:00'),
(4, 15, 13, 0, '2019-05-28 00:15:00'),
(5, 14, 8, 0, '2019-05-30 10:00:00'),
(6, 12, 10, 0, '2019-05-31 16:24:00'),
(7, 14, 6, 1, '2019-05-21 09:00:00');

-- --------------------------------------------------------

--
-- Estructura de la taula `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
  `email` varchar(50) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Bolcant dades de la taula `client`
--

INSERT INTO `client` (`email`, `username`, `password`) VALUES
('britney@gmail.com', 'BritneySpears', 'Britneyspears+1'),
('britnney@gmail.com', 'BritneySpears1', 'a1A+sasasa'),
('dracarys@gmail.com', 'DaenerysTargaryen', 'daenerysdaenerys'),
('emma_watson@gmail.com', 'EmmaWatson', 'emmaemma'),
('kkevvin19@gmacil.com', 'KevinMede', '1+1icareBTINH12'),
('w2.kmedina@infomila.info', 'Kev', 'kevinkevin'),
('w2.mgomez@infomila.info', 'Miwui11', 'miguelmiguel'),
('w2.ppuyo@infomila.info', 'Pedronsio', 'pedropedro');

-- --------------------------------------------------------

--
-- Estructura de la taula `empresa`
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
  `password` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `visibilitat` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='password';

--
-- Bolcant dades de la taula `empresa`
--

INSERT INTO `empresa` (`id`, `username`, `nom`, `tipusVia`, `direccio`, `comarca`, `numDireccio`, `password`, `email`, `visibilitat`) VALUES
(11, 'Clein', 'Clein Frankfurt', 'Carrer', 'Rambla Sant Isidre', 'Anoia', 26, 'cleinclein', 'clein@clein.es', 0),
(12, 'Krusty', 'Krusty Burger', 'Avinguda', 'Evergreen Terrace ', 'Neverland', 11, 'krustykrusty', 'krusty@krusty.com', 0),
(13, 'BobEsponja', 'Crustáceo crujiente', 'Carrer', 'Piña debajo del mar', 'Anoia', 12, 'bobesponja', 'bobesponja@gmail.com', 0),
(14, 'centralPerk', 'Central Perk Cafe', 'Avinguda', 'la quinta avenida', 'Anoia', 5, 'centralPerk', 'illbethereforyou@friends.com', 0),
(15, 'Baviera', 'Baviera Frankfurt', 'Carrer', 'Lleida ', 'Anoia', 57, 'bavierabaviera', 'baviera@igualada.com', 0),
(16, 'sdfsdfsdf', 'dssdfsdfsd', 'Carrer', 'bbb', 'Anoia', 12, 'sdfsdfsdf', 'efdsdfsdfsd', 1),
(17, 'Fitzgerald', 'Fitzgerald Foods', 'Avinguda', 'whaaat', 'Garraf', 23, '1+1icareB', 'fitzgerald@gmail.com', 0);

-- --------------------------------------------------------

--
-- Estructura de la taula `participacio`
--

DROP TABLE IF EXISTS `participacio`;
CREATE TABLE `participacio` (
  `cata` int(11) NOT NULL,
  `client` varchar(50) NOT NULL,
  `valoracio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Bolcant dades de la taula `participacio`
--

INSERT INTO `participacio` (`cata`, `client`, `valoracio`) VALUES
(3, 'emma_watson@gmail.com', 5),
(3, 'w2.kmedina@infomila.info', 5),
(4, 'dracarys@gmail.com', 4),
(4, 'emma_watson@gmail.com', 5),
(6, 'w2.kmedina@infomila.info', 2),
(6, 'w2.mgomez@infomila.info', 5),
(7, 'w2.ppuyo@infomila.info', 2);

-- --------------------------------------------------------

--
-- Estructura de la taula `producte`
--

DROP TABLE IF EXISTS `producte`;
CREATE TABLE `producte` (
  `codi` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `descripcio` varchar(210) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Bolcant dades de la taula `producte`
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
(17, 13, 'La concha de arenita', 'La parte salada de una ardilla submarina');

--
-- Indexos per taules bolcades
--

--
-- Index de la taula `cata`
--
ALTER TABLE `cata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producte` (`producte`),
  ADD KEY `empresa` (`empresa`);

--
-- Index de la taula `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Index de la taula `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nom` (`nom`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Index de la taula `participacio`
--
ALTER TABLE `participacio`
  ADD PRIMARY KEY (`cata`,`client`),
  ADD KEY `client` (`client`),
  ADD KEY `cata` (`cata`);

--
-- Index de la taula `producte`
--
ALTER TABLE `producte`
  ADD PRIMARY KEY (`codi`,`empresa`),
  ADD UNIQUE KEY `nom` (`nom`),
  ADD KEY `empresa` (`empresa`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `cata`
--
ALTER TABLE `cata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT per la taula `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT per la taula `producte`
--
ALTER TABLE `producte`
  MODIFY `codi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Restriccions per taules bolcades
--

--
-- Restriccions per la taula `cata`
--
ALTER TABLE `cata`
  ADD CONSTRAINT `cata_ibfk_1` FOREIGN KEY (`producte`) REFERENCES `producte` (`codi`),
  ADD CONSTRAINT `cata_ibfk_2` FOREIGN KEY (`empresa`) REFERENCES `empresa` (`id`);

--
-- Restriccions per la taula `participacio`
--
ALTER TABLE `participacio`
  ADD CONSTRAINT `participacio_ibfk_1` FOREIGN KEY (`client`) REFERENCES `client` (`email`),
  ADD CONSTRAINT `participacio_ibfk_2` FOREIGN KEY (`cata`) REFERENCES `cata` (`id`);

--
-- Restriccions per la taula `producte`
--
ALTER TABLE `producte`
  ADD CONSTRAINT `producte_ibfk_1` FOREIGN KEY (`empresa`) REFERENCES `empresa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
