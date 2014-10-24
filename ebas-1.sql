-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 24. Okt 2014 um 09:56
-- Server Version: 5.5.40-0ubuntu0.14.04.1
-- PHP-Version: 5.5.9-1ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `ebas`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_anmeldungen_2014_2`
--

CREATE TABLE IF NOT EXISTS `tbl_anmeldungen_2014_2` (
  `anmeldung_id` int(11) NOT NULL AUTO_INCREMENT,
  `kurs` int(11) NOT NULL,
  `gutschein` varchar(150) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `vorname` varchar(150) NOT NULL,
  `adresse` varchar(150) NOT NULL,
  `plz` varchar(10) NOT NULL,
  `ort` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `sprache` char(2) NOT NULL,
  `zeit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`anmeldung_id`),
  KEY `kurs` (`kurs`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=252 ;

--
-- Daten für Tabelle `tbl_anmeldungen_2014_2`
--

INSERT INTO `tbl_anmeldungen_2014_2` (`anmeldung_id`, `kurs`, `gutschein`, `name`, `vorname`, `adresse`, `plz`, `ort`, `email`, `sprache`, `zeit`) VALUES
(247, 19, '123456789', 'Muster', 'Hans', 'Beispielstrasse 1', '6688 ', 'KSL', 'blabal@blalba.ch', 'Po', '2014-10-23 19:32:03'),
(248, 19, '234567', 'Nuster', 'Philipp', 'Seispielstrasse 5', '3344', 'Affo', 'spsp@spsp.ch', 'Ru', '2014-10-23 19:33:52'),
(249, 18, '', 'Xuster', 'Patrick', 'Hochbeispiel 3', '5588', 'Fräk', 'uiiu@iiuu.ch', 'Po', '2014-10-23 19:35:05'),
(250, 4, '', 'Roger', 'Auster', 'Swissstrasse 9', '0099', 'Wolf', 'ele@ele.ch', 'Bu', '2014-10-23 19:36:12'),
(251, 9, '', 'Sepp', 'Cluster', 'Wildstrasse', '4422', 'Vivo', 'wll@wll.com', 'En', '2014-10-23 19:37:17');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_interessenten_2014_2`
--

CREATE TABLE IF NOT EXISTS `tbl_interessenten_2014_2` (
  `interessent_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `vorname` varchar(150) NOT NULL,
  `adresse` varchar(150) DEFAULT NULL,
  `plz` varchar(10) DEFAULT NULL,
  `ort` varchar(150) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `kursort` varchar(150) NOT NULL,
  `sprache` char(2) NOT NULL,
  `zeit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`interessent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Daten für Tabelle `tbl_interessenten_2014_2`
--

INSERT INTO `tbl_interessenten_2014_2` (`interessent_id`, `name`, `vorname`, `adresse`, `plz`, `ort`, `email`, `kursort`, `sprache`, `zeit`) VALUES
(47, 'Muster', 'Hans', 'Bananstr. 09', '8822', 'Heli', 'kleb@kleb.ch', 'London', 'En', '2014-10-23 19:38:37'),
(48, 'Suster', 'rudolf', 'hsluweg 3', '3355', 'Fürio', 'tast@tast.ch', 'Singapur', 'En', '2014-10-23 19:39:31'),
(49, 'Kossmann', 'Marcel', 'Batweg 6', '3399', 'Gum', 'tosh@tosh.xh', 'Dubai', 'Ar', '2014-10-23 19:40:35'),
(50, 'Port', 'elio', 'Schneiderweg', '5511', 'Stabilo', 'smi@smi.ch', 'Montreal', 'Fr', '2014-10-23 19:41:50'),
(51, 'Ludwig', 'Ludin', 'Ludgasse 4', '8899', 'Expo', 'sali@sali.de', 'Vancouver', 'Ch', '2014-10-23 19:42:54'),
(52, 'Pearson', 'Herold', 'Luztweg', '0022', 'Info', 'lutz@lutz.com', 'NewYork', 'Ru', '2014-10-23 19:44:03');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_kurse_2014_2`
--

CREATE TABLE IF NOT EXISTS `tbl_kurse_2014_2` (
  `kurs_id` int(11) NOT NULL AUTO_INCREMENT,
  `bezeichnung_de` varchar(150) NOT NULL,
  `bezeichnung_fr` varchar(150) NOT NULL,
  `bezeichnung_it` varchar(150) NOT NULL,
  `bezeichnung_en` varchar(150) NOT NULL,
  `sortierung` tinyint(4) NOT NULL,
  `sprache` char(2) NOT NULL,
  `max_teilnehmer` tinyint(4) NOT NULL,
  `max_teilnehmer_PF` tinyint(4) NOT NULL,
  PRIMARY KEY (`kurs_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=124 ;

--
-- Daten für Tabelle `tbl_kurse_2014_2`
--

INSERT INTO `tbl_kurse_2014_2` (`kurs_id`, `bezeichnung_de`, `bezeichnung_fr`, `bezeichnung_it`, `bezeichnung_en`, `sortierung`, `sprache`, `max_teilnehmer`, `max_teilnehmer_PF`) VALUES
(1, 'Zürich: Do, 23.10.14, 17:00 - 19:15 Uhr', 'Zürich (allemand): Jeu, 23.10.14, 17h00 - 19h15', 'Zürich (tedesco): Gio, 23.10.14, ore 17.00 - 19.15', 'Zürich (German): Thu, 23.10.14, 17:00 - 19:15', 3, 'de', 16, 10),
(2, 'Basel: Di, 28.10.14, 17:00 - 19:15 Uhr', 'Basel (allemand): Mar, 28.10.14, 17h00 - 19h15', 'Basel (tedesco): Mar, 28.10.14, ore 17.00 - 19.15', 'Basel (German): Tue, 28.10.14, 17:00 - 19:15', 4, 'de', 18, 15),
(3, 'Luzern: Mi, 29.10.14, 17:00 - 19:15 Uhr', 'Luzern (allemand): Mer, 29.10.14, 17h00 - 19h15', 'Luzern (tedesco): Mer, 29.10.14, ore 17.00 - 19.15', 'Luzern (German): Wed, 29.10.14, 17:00 - 19:15', 6, 'de', 25, 10),
(4, 'Aarau: Do, 30.10.14, 17:00 - 19:15 Uhr', 'Aarau (allemand): Jeu, 30.10.14, 17h00 - 19h15', 'Aarau (tedesco): Gio, 30.10.14, ore 17.00 - 19.15', 'Aarau (German): Thu, 30.10.14, 17:00 - 19:15', 7, 'de', 18, 10),
(5, 'Bern: Di, 04.11.14, 17:00 - 19:15 Uhr', 'Bern (allemand): Mar, 04.11.14, 17h00 - 19h15', 'Bern (tedesco): Mar, 04.11.14, ore 17.00 - 19.15', 'Bern (German): Tue, 04.11.14, 17:00 - 19:15', 8, 'de', 20, 10),
(6, 'Chur: Mi, 05.11.14, 17:00 - 19:15 Uhr', 'Chur (allemand): Mer, 05.11.14, 17h00 - 19h15', 'Chur (tedesco): Mer, 05.11.14, ore 17.00 - 19.15', 'Chur (German): Wed, 05.11.14, 17:00 - 19:15', 9, 'de', 17, 10),
(7, 'St. Gallen: Do, 06.11.14, 17:00 - 19:15 Uhr', 'St. Gallen (allemand): Jeu, 06.11.14, 17h00 - 19h15', 'St. Gallen (tedesco): Gio, 06.11.14, ore 17.00 - 19.15', 'St. Gallen (German): Thu, 06.11.14, 17:00 - 19:15', 10, 'de', 18, 10),
(8, 'Olten: Montag, 17.11.14, 17:00 - 19:15 Uhr', 'Olten (allemand): Lun, 17.11.14, 17h00 - 19h15', 'Olten (tedesco): Lun, 17.11.14, ore 17.00 - 19.15', 'Olten (German): Mon, 17.11.14, 17:00 - 19:15', 12, 'de', 8, 10),
(9, 'Zürich: Di, 11.11.14, 17:00 - 19:15 Uhr', 'Zürich (allemand): Mar, 11.11.14, 17h00 - 19h15', 'Zürich (tedesco): Mar, 11.11.14, ore 17.00 - 19.15', 'Zürich (German): Tue, 11.11.14, 17:00 - 19:15', 11, 'de', 16, 10),
(10, 'Zürich: Mi, 26.11.14, 17:00 - 19:15 Uhr', 'Zürich (allemand): Mer, 26.11.14, 17h00 - 19h15', 'Zürich (tedesco) : Mer, 26.11.14, ore 17.00 - 19.15', 'Zürich (German): Wed, 26.11.14, 17:00 - 19:15', 14, 'de', 16, 10),
(11, 'Luzern: Do, 27.11.14, 17:00 - 19:15 Uhr', 'Luzern (allemand): Jeu, 27.11.14, 17h00 - 19h15', 'Luzern (tedesco): Gio, 27.11.14, ore 17.00 - 19.15', 'Luzern (German): Thu, 27.11.14, 17:00 - 19:15', 15, 'de', 25, 10),
(12, 'Solothurn: Di, 25.11.14, 17:00 - 19:15 Uhr', 'Solothurn (allemand): Mar, 25.11.14, 17h00 - 19h15', 'Solothurn (tedesco): Mar, 25.11.14, ore 17.00 - 19.15', 'Solothurn (German): Tue, 25.11.14, 17:00 - 19:15', 13, 'de', 8, 10),
(13, 'Basel: Mo, 01.12.14, 17:00 - 19:15 Uhr', 'Basel (allemand): Lun, 01.12.14, 17h00 - 19h15', 'Basel (tedesco): Lun, 01.12.14, ore 17.00 - 19.15', 'Basel (German): Mon, 01.12.14, 17:00 - 19:15', 16, 'de', 25, 10),
(14, 'Winterthur: Di, 02.12.14, 17:00 - 19:15 Uhr', 'Winterthur (allemand): Mar, 02.12.14, 17h00 - 19h15', 'Winterthur (tedesco): Mar, 02.12.14, ore 17.00 - 19.15', 'Winterthur (German): Tue, 02.12.14, 17:00 - 19:15', 17, 'de', 16, 10),
(15, 'Zürich: Mi, 03.12.14, 17:00 - 19:15 Uhr', 'Zürich (allemand): Mer, 03.12.14, 17h00 - 19h15', 'Zürich (tedesco): Mer, 03.12.14, ore 17.00 - 19.15', 'Zürich (German): Wed, 03.12.14, 17:00 - 19:15', 18, 'de', 16, 10),
(16, 'Bern: Do, 04.12.14, 17:00 - 19:15 Uhr', 'Bern (allemand): Jeu, 04.12.14, 17h00 - 19h15', 'Bern (tedesco): Gio, 04.12.14, ore 17.00 - 19.15', 'Bern (German): Thu, 04.12.14, 17:00 - 19:15', 19, 'de', 20, 10),
(17, 'Bern: Di, 09.12.14, 17:00 - 19:15 Uhr', 'Bern (allemand): Mar, 09.12.14, 17h00 - 19h15', 'Bern (tedesco): Mar, 09.12.14, ore 17.00 - 19.15', 'Bern (German): Tue, 09.12.14, 17:00 - 19:15', 20, 'de', 20, 10),
(18, 'Sion (Franz.): Mi, 15.10.14, 17:00 - 19:15 Uhr', 'Sion: Mer, 15.10.14, 17h00 - 19h15', 'Sion (francese): Mer, 15.10.14, ore 17.00 - 19.15', 'Sion (French): Wed, 15.10.14, 17:00 - 19:15', 1, 'fr', 17, 10),
(19, 'Lausanne (Franz.): Di, 28.10.14, 18:00 - 20:15 Uhr', 'Lausanne: Mar, 28.10.14, 18h00 - 20h15', 'Lausanne (francese): Mar, 28.10.14, ore 18.00 - 20.15', 'Lausanne (French): Tue, 28.10.14, 18:00 - 20:15', 5, 'fr', 25, 15),
(120, 'Musterkurs', 'Cour de muster', 'Courso de mustera', 'example class', 0, 'En', 127, 127),
(121, 'Beispiel', 'par example', 'para example ', 'for example', 0, 'Ru', 127, 111),
(122, 'php mein Admin', 'php mon Admin', 'php ma Admin ', 'php my Admin', 0, 'Le', 127, 127),
(123, 'ein Test', 'un test', 'una testa ', 'a test', 0, '', 127, 111);

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `tbl_anmeldungen_2014_2`
--
ALTER TABLE `tbl_anmeldungen_2014_2`
  ADD CONSTRAINT `kurs_fk` FOREIGN KEY (`kurs`) REFERENCES `tbl_kurse_2014_2` (`kurs_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
