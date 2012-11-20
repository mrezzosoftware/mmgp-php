-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Servidor: mysql.qlix.com.br
-- Tempo de Geração: Nov 20, 2012 as 08:59 PM
-- Versão do Servidor: 5.5.24
-- Versão do PHP: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `mrsoftware`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `maquinas`
--

CREATE TABLE IF NOT EXISTS `maquinas` (
  `email` varchar(100) COLLATE latin1_bin NOT NULL,
  `maquina` varchar(50) COLLATE latin1_bin NOT NULL,
  `ligada` tinyint(1) NOT NULL DEFAULT '0',
  `tempo_atualizacao` int(11) NOT NULL DEFAULT '120000',
  `ultima_atualizacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `acao` varchar(1) COLLATE latin1_bin NOT NULL,
  `keylogger` tinyint(1) NOT NULL DEFAULT '0',
  `geolocalizacao` tinyint(1) NOT NULL DEFAULT '0',
  `latitude` varchar(15) COLLATE latin1_bin NOT NULL,
  `longitude` varchar(15) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`email`,`maquina`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Extraindo dados da tabela `maquinas`
--

INSERT INTO `maquinas` (`email`, `maquina`, `ligada`, `tempo_atualizacao`, `ultima_atualizacao`, `acao`, `keylogger`, `geolocalizacao`, `latitude`, `longitude`) VALUES
('myron.rezzo@gmail.com', 'casa', 0, 120000, '2012-11-20 20:20:53', 'l', 0, 0, '0', '0'),
('myron.rezzo@gmail.com', 'fnde', 1, 60000, '2012-11-20 20:54:53', 'r', 2, 2, '-123', '-321'),
('myron.rezzo@gmail.com', 'outro', 0, 120000, '2012-11-20 19:59:23', 'b', 3, 3, '0', '0');
