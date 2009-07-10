-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2009 at 05:36 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `pokemon`
--

-- --------------------------------------------------------

--
-- Table structure for table `pokedex`
--

CREATE TABLE IF NOT EXISTS `pokedex` (
  `id` tinyint(4) NOT NULL auto_increment,
  `dname` tinytext,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pokedex`
--

INSERT INTO `pokedex` (`id`, `dname`) VALUES
(1, 'National'),
(2, 'Kanto'),
(3, 'Johto'),
(4, 'Hoenn'),
(5, 'Sinnoh');