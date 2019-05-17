-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Temps de generació: 17-05-2019 a les 20:28:13
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
(1, 2, 1, 0, '2019-05-18 16:30:00'),
(2, 2, 2, 0, '2019-05-25 18:15:00');

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
('w2.kmedina@infomila.info', 'Kevin', 'kevinkevin'),
('w2.ppuyo@infomila.info', 'Pedronsio', 'Pedronsio');

-- --------------------------------------------------------

--
-- Estructura de la taula `empresa`
--

DROP TABLE IF EXISTS `empresa`;
CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `nom` varchar(80) NOT NULL,
  `direccio` varchar(210) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `visibilitat` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='password';

--
-- Bolcant dades de la taula `empresa`
--

INSERT INTO `empresa` (`id`, `username`, `nom`, `direccio`, `password`, `email`, `visibilitat`) VALUES
(1, 'BrisingrGaunt', 'BrisingrGaunt Productions', 'Carrer, P Sherman wallaby (Sidney), 42 ', 'brisingrgaunt', 'brisingrgaunt@gmail.com', 0),
(2, 'Baviera', 'borrar', 'Carrer,    Lleida (Igualada),    37', 'Baviera', 'baviera@gmail.com', 0),
(3, 'kevin', 'Baby', 'Carrer, Seem like everywhere I go, 12', 'kevinkevin', 'Iseeyou@gmail.com', 0),
(4, 'jejejejeje', 'Taki ', 'Carrer, Taki Rumba, 23', 'jejejejeje', 'ejejej@jejeje.jejeje', 0),
(5, 'jejeje', 'puta', 'Via, tu, y tus', 'ejejeje', 'amigas', 1),
(6, '', 'jajajaja', 'Avinguda,     holalalaland,     12', '', '', 0),
(8, 'a', 'jejejejeje', 'Via,  loco,  z', 'j', 'a', 0);

-- --------------------------------------------------------

--
-- Estructura de la taula `participacio`
--

DROP TABLE IF EXISTS `participacio`;
CREATE TABLE `participacio` (
  `empresa` int(11) NOT NULL,
  `cata` int(11) NOT NULL,
  `client` varchar(50) NOT NULL,
  `valoracio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Bolcant dades de la taula `participacio`
--

INSERT INTO `participacio` (`empresa`, `cata`, `client`, `valoracio`) VALUES
(2, 1, 'w2.kmedina@infomila.info', 4),
(2, 1, 'w2.ppuyo@infomila.info', 0),
(2, 2, 'w2.kmedina@infomila.info', 5),
(2, 2, 'w2.ppuyo@infomila.info', 3);

-- --------------------------------------------------------

--
-- Estructura de la taula `producte`
--

DROP TABLE IF EXISTS `producte`;
CREATE TABLE `producte` (
  `codi` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `descripcio` varchar(210) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Bolcant dades de la taula `producte`
--

INSERT INTO `producte` (`codi`, `nom`, `descripcio`) VALUES
(1, 'Patates de Blat de moro', 'Patates de Blat de moro amb salsa brava'),
(2, 'Pizza de tonyina', 'Pizza de tonyina amb ceba caramelitzada');

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
  ADD PRIMARY KEY (`empresa`,`cata`,`client`),
  ADD KEY `client` (`client`),
  ADD KEY `cata` (`cata`);

--
-- Index de la taula `producte`
--
ALTER TABLE `producte`
  ADD PRIMARY KEY (`codi`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `cata`
--
ALTER TABLE `cata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT per la taula `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT per la taula `producte`
--
ALTER TABLE `producte`
  MODIFY `codi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  ADD CONSTRAINT `participacio_ibfk_2` FOREIGN KEY (`cata`) REFERENCES `cata` (`id`),
  ADD CONSTRAINT `participacio_ibfk_3` FOREIGN KEY (`empresa`) REFERENCES `empresa` (`id`);


--
-- Metadades
--
USE `phpmyadmin`;

--
-- Metadades per a la taula cata
--

--
-- Metadades per a la taula client
--

--
-- Metadades per a la taula empresa
--

--
-- Metadades per a la taula participacio
--

--
-- Metadades per a la taula producte
--

--
-- Metadades per a la base de dades projecte_kevin
--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
