-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Temps de generació: 13-05-2019 a les 19:00:55
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

-- Base de dades: `projecte_kevin`
--
CREATE DATABASE IF NOT EXISTS `projecte_kevin` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `projecte_kevin`;

-- --------------------------------------------------------

--
-- Estructura de la taula `cata`
--

CREATE TABLE `cata` (
  `id` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `producte` int(11) NOT NULL,
  `estat` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de la taula `client`
--

CREATE TABLE `client` (
  `email` varchar(50) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de la taula `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `nom` varchar(80) NOT NULL,
  `direccio` varchar(210) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='password';

-- --------------------------------------------------------

--
-- Estructura de la taula `participacio`
--

CREATE TABLE `participacio` (
  `empresa` int(11) NOT NULL,
  `cata` int(11) NOT NULL,
  `client` varchar(50) NOT NULL,
  `valoracio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de la taula `producte`
--

CREATE TABLE `producte` (
  `codi` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `descripcio` varchar(210) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexos per taules bolcades
--

--
-- Index de la taula `cata`
--
ALTER TABLE `cata`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`empresa`,`cata`,`client`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
--
-- AUTO_INCREMENT per la taula `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

  
--
-- AUTO_INCREMENT per la taula `producte`
--
ALTER TABLE `producte`
  MODIFY `codi` int(11) NOT NULL AUTO_INCREMENT;--
  
--
-- CLAU_FORANA de la taula participacio cap a client
--
ALTER TABLE participacio ADD FOREIGN KEY (client) REFERENCES client (email) ;


--
-- CLAU_FORANA de la taula participacio cap a cata
--
ALTER TABLE participacio ADD FOREIGN KEY (cata) REFERENCES cata(id);

--
-- CLAU_FORANA de la taula participacio cap a empresa
--
ALTER TABLE participacio ADD FOREIGN KEY (empresa) REFERENCES empresa(id);

--
-- CLAU_FORANA de la taula cata cap a producte
--
ALTER TABLE cata ADD FOREIGN KEY (producte) REFERENCES producte(codi);
