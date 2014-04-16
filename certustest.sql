-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 14, 2014 at 11:24 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `certustest`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gebruikersnaam` varchar(30) NOT NULL,
  `wachtwoord` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `voornaam` varchar(30) NOT NULL,
  `achternaam` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `gebruikersnaam`, `wachtwoord`, `email`, `voornaam`, `achternaam`) VALUES
(1, 'admin', 'admin', 'admin@email.com', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `bedrijf`
--

CREATE TABLE IF NOT EXISTS `bedrijf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bedrijfnaam` varchar(30) NOT NULL,
  `straatnaam` varchar(30) NOT NULL,
  `huisnummer` int(10) NOT NULL,
  `huistoevoeging` varchar(10) NOT NULL,
  `postcode` varchar(6) NOT NULL,
  `plaats` varchar(30) NOT NULL,
  `land` varchar(30) NOT NULL,
  `telnr` int(15) NOT NULL,
  `vn_contact` varchar(20) NOT NULL,
  `an_contact` varchar(20) NOT NULL,
  `telnr_contact` int(15) NOT NULL,
  `email_contact` varchar(100) NOT NULL,
  `gebruikersnaam` varchar(30) NOT NULL,
  `wachtwoord` varchar(30) NOT NULL,
  `maatwerkpakket` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `bedrijf`
--

INSERT INTO `bedrijf` (`id`, `bedrijfnaam`, `straatnaam`, `huisnummer`, `huistoevoeging`, `postcode`, `plaats`, `land`, `telnr`, `vn_contact`, `an_contact`, `telnr_contact`, `email_contact`, `gebruikersnaam`, `wachtwoord`, `maatwerkpakket`) VALUES
(1, 'Adecco', 'zandstraat', 65, '', '7009bb', '''s-Heerenberg', 'Nederland', 61234556, 'Rob', 'Hendrixx', 6123456, 'mail.rob@adecco.nl', 'adecco', 'visje3', ''),
(2, 'randstad', 'straatnaam', 45, '', '4960vb', 'Rotterdam', 'Nederland', 31563987, 'Jan', 'Arondsen', 61234489, 'info354@randstad.nl', 'randstad', 'welkom_2', ''),
(3, 'Start People', 'industrieweg', 14, 'b', '1337gg', 'Doetinchem', 'Nederland', 612334456, 'Kay', 'Elshof', 6123456, 'info@sturtppl.nl', 'startpeople', 'visje3', '');

-- --------------------------------------------------------

--
-- Table structure for table `klant`
--

CREATE TABLE IF NOT EXISTS `klant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voornaam` varchar(20) NOT NULL,
  `tussenvoegsel` varchar(20) NOT NULL,
  `achternaam` varchar(20) NOT NULL,
  `geslacht` varchar(1) NOT NULL,
  `straatnaam` varchar(20) NOT NULL,
  `huisnummer` int(10) NOT NULL,
  `huistoevoeging` varchar(5) NOT NULL,
  `postcode` varchar(6) NOT NULL,
  `plaats` varchar(20) NOT NULL,
  `land` varchar(30) NOT NULL,
  `geboortedatum` date NOT NULL,
  `geboorteplaats` varchar(20) NOT NULL,
  `telnr` int(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `digid` tinyint(1) NOT NULL,
  `gebruikersnaam` varchar(30) NOT NULL,
  `wachtwoord` varchar(30) NOT NULL,
  `temppassword` tinyint(1) NOT NULL,
  `cv` varchar(100) NOT NULL,
  `identiteit` varchar(100) NOT NULL,
  `toestemming` varchar(100) NOT NULL,
  `integriteit` varchar(100) NOT NULL,
  `pakket` int(1) NOT NULL,
  `opleverdatum` date NOT NULL,
  `rapport` varchar(100) NOT NULL,
  `bedrijfid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `klant`
--

INSERT INTO `klant` (`id`, `voornaam`, `tussenvoegsel`, `achternaam`, `geslacht`, `straatnaam`, `huisnummer`, `huistoevoeging`, `postcode`, `plaats`, `land`, `geboortedatum`, `geboorteplaats`, `telnr`, `email`, `digid`, `gebruikersnaam`, `wachtwoord`, `temppassword`, `cv`, `identiteit`, `toestemming`, `integriteit`, `pakket`, `opleverdatum`, `rapport`, `bedrijfid`) VALUES
(1, 'Jo', '', 'Bonten', 'm', 'natuurweg', 2, '', '3556eg', 'Elten', 'Nederland', '1960-03-04', 'Amsterdam', 6123456, 'jo.bonten@mail.nl', 1, 'jo.bonten', '', 1, '', '', '', '', 1, '2014-04-30', '', 2),
(2, 'Roy', '', 'Thuis', 'm', 'Lekstraat', 18, '', '7071vb', 'Ulft', 'Nederland', '1994-07-05', 'Doetinchem', 612609673, 'roythuis1994@hotmail.com', 1, 'roy.thuis', 'visje3', 0, '', '', '', '', 3, '2014-05-02', '', 3),
(4, 'Cairan', '', 'Steverink', 'm', 'vossenstraat', 23, '', '7064CN', 'Silvolde', 'Nederland', '1994-03-23', 'Silvolde', 650939044, 'cairan_432@hotmail.com', 1, 'cairan.steverink', 'visje3', 0, '', '', '', '', 1, '2014-06-10', '', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
