-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Servidor: mysql.qlix.com.br
-- Tempo de Geração: Nov 20, 2012 as 08:58 PM
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
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `email` varchar(100) COLLATE latin1_bin NOT NULL,
  `senha` varchar(10) COLLATE latin1_bin NOT NULL,
  `assinante` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`email`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`email`, `senha`, `assinante`) VALUES
('myron.rezzo@gmail.com', '12345', 0);
