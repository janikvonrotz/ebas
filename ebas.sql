-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 09. Dez 2014 um 18:22
-- Server Version: 5.6.20
-- PHP-Version: 5.5.15

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
`anmeldung_id` int(11) NOT NULL,
  `kurs` int(11) NOT NULL,
  `gutschein` varchar(150) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `vorname` varchar(150) NOT NULL,
  `adresse` varchar(150) NOT NULL,
  `plz` varchar(10) NOT NULL,
  `ort` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `sprache` char(2) NOT NULL,
  `zeit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=255 ;

--
-- Daten für Tabelle `tbl_anmeldungen_2014_2`
--

INSERT INTO `tbl_anmeldungen_2014_2` (`anmeldung_id`, `kurs`, `gutschein`, `name`, `vorname`, `adresse`, `plz`, `ort`, `email`, `sprache`, `zeit`) VALUES
(247, 17, '123456789', 'Muster', 'Hans', 'Beispielstrasse 1', '6688 ', 'KSL', 'blabal@blalba.ch', 'Po', '2014-10-23 19:32:03'),
(248, 19, '234567', 'Nuster', 'Philipp', 'Seispielstrasse 5', '3344', 'Affo', 'spsp@spsp.ch', 'Ru', '2014-10-23 19:33:52'),
(249, 18, '', 'Xuster', 'Patrick', 'Hochbeispiel 3', '5588', 'Fräk', 'uiiu@iiuu.ch', 'Po', '2014-10-23 19:35:05'),
(250, 4, '', 'Roger', 'Auster', 'Swissstrasse 9', '0099', 'Wolf', 'ele@ele.ch', 'Bu', '2014-10-23 19:36:12'),
(251, 9, '', 'Sepp', 'Cluster', 'Wildstrasse', '4422', 'Vivo', 'wll@wll.com', 'En', '2014-10-23 19:37:17'),
(254, 4, '', 'Ackermann', 'Philip', 'Etwasstrasse 1', '6789', 'BWL', 'spo@spq.com', 'De', '2014-12-09 17:20:49');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_interessenten_2014_2`
--

CREATE TABLE IF NOT EXISTS `tbl_interessenten_2014_2` (
`interessent_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `vorname` varchar(150) NOT NULL,
  `adresse` varchar(150) DEFAULT NULL,
  `plz` varchar(10) DEFAULT NULL,
  `ort` varchar(150) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `kursort` varchar(150) NOT NULL,
  `sprache` char(2) NOT NULL,
  `zeit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- Daten für Tabelle `tbl_interessenten_2014_2`
--

INSERT INTO `tbl_interessenten_2014_2` (`interessent_id`, `name`, `vorname`, `adresse`, `plz`, `ort`, `email`, `kursort`, `sprache`, `zeit`) VALUES
(48, 'Suster', 'rudolf', 'hsluweg 3', '3355', 'Fürio', 'tast@tast.ch', 'Singapur', 'En', '2014-10-23 19:39:31'),
(49, 'Kossmann', 'Marcel', 'Batweg 6', '3399', 'Gum', 'tosh@tosh.xh', 'Dubai', 'Ar', '2014-10-23 19:40:35'),
(50, 'Port', 'elio', 'Schneiderweg', '5511', 'Stabilo', 'smi@smi.ch', 'Montreal', 'Fr', '2014-10-23 19:41:50'),
(51, 'Ludwig', 'Ludin', 'Ludgasse 4', '8899', 'Expo', 'sali@sali.de', 'Vancouver', 'Ch', '2014-10-23 19:42:54'),
(52, 'Pearson', 'Herold', 'Lüztweg', '0022', 'Info', 'lutz@lutz.com', 'NewYork', 'Ru', '2014-10-23 19:44:03'),
(57, 'Ackermann', 'Philipp', 'Etwasstrasse 3', '6789', 'Bwl', 'spo@spq.com', '', 'De', '2014-12-09 17:22:01');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_kurse_2014_2`
--

CREATE TABLE IF NOT EXISTS `tbl_kurse_2014_2` (
`kurs_id` int(11) NOT NULL,
  `bezeichnung_de` varchar(150) NOT NULL,
  `bezeichnung_fr` varchar(150) NOT NULL,
  `bezeichnung_it` varchar(150) NOT NULL,
  `bezeichnung_en` varchar(150) NOT NULL,
  `kurs_datum` date NOT NULL,
  `sortierung` tinyint(4) NOT NULL,
  `sprache` char(2) NOT NULL,
  `max_teilnehmer` tinyint(4) NOT NULL,
  `max_teilnehmer_PF` tinyint(4) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=124 ;

--
-- Daten für Tabelle `tbl_kurse_2014_2`
--

INSERT INTO `tbl_kurse_2014_2` (`kurs_id`, `bezeichnung_de`, `bezeichnung_fr`, `bezeichnung_it`, `bezeichnung_en`, `kurs_datum`, `sortierung`, `sprache`, `max_teilnehmer`, `max_teilnehmer_PF`) VALUES
(4, 'Aarau: Do, 30.12.14, 17:00 - 19:15 Uhr', 'Aarau (allemand): Jeu, 30.10.14, 17h00 - 19h15', 'Aarau (tedesco): Gio, 30.10.14, ore 17.00 - 19.15', 'Aarau (German): Thu, 30.10.14, 17:00 - 19:15', '2014-12-30', 7, 'de', 18, 10),
(5, 'Bern: Di, 04.11.14, 17:00 - 19:15 Uhr', 'Bern (allemand): Mar, 04.11.14, 17h00 - 19h15', 'Bern (tedesco): Mar, 04.11.14, ore 17.00 - 19.15', 'Bern (German): Tue, 04.11.14, 17:00 - 19:15', '2014-11-04', 8, 'de', 20, 10),
(6, 'Chur: Mi, 05.11.14, 17:00 - 19:15 Uhr', 'Chur (allemand): Mer, 05.11.14, 17h00 - 19h15', 'Chur (tedesco): Mer, 05.11.14, ore 17.00 - 19.15', 'Chur (German): Wed, 05.11.14, 17:00 - 19:15', '2014-11-05', 9, 'de', 17, 10),
(7, 'St. Gallen: Do, 06.11.14, 17:00 - 19:15 Uhr', 'St. Gallen (allemand): Jeu, 06.11.14, 17h00 - 19h15', 'St. Gallen (tedesco): Gio, 06.11.14, ore 17.00 - 19.15', 'St. Gallen (German): Thu, 06.11.14, 17:00 - 19:15', '2014-11-06', 10, 'de', 18, 10),
(9, 'Zürich: Di, 11.11.14, 17:00 - 19:15 Uhr', 'Zürich (allemand): Mar, 11.11.14, 17h00 - 19h15', 'Zürich (tedesco): Mar, 11.11.14, ore 17.00 - 19.15', 'Zürich (German): Tue, 11.11.14, 17:00 - 19:15', '2014-11-11', 11, 'de', 16, 10),
(10, 'Zürich: Mi, 26.12.14, 17:00 - 19:15 Uhr', 'Zürich (allemand): Mer, 26.11.14, 17h00 - 19h15', 'Zürich (tedesco) : Mer, 26.11.14, ore 17.00 - 19.15', 'Zürich (German): Wed, 26.11.14, 17:00 - 19:15', '2014-12-26', 14, 'de', 16, 10),
(12, 'Solothurn: Di, 25.11.14, 17:00 - 19:15 Uhr', 'Solothurn (allemand): Mar, 25.11.14, 17h00 - 19h15', 'Solothurn (tedesco): Mar, 25.11.14, ore 17.00 - 19.15', 'Solothurn (German): Tue, 25.11.14, 17:00 - 19:15', '2014-11-25', 13, 'de', 8, 10),
(14, 'Winterthur: Di, 02.12.14, 17:00 - 19:15 Uhr', 'Winterthur (allemand): Mar, 02.12.14, 17h00 - 19h15', 'Winterthur (tedesco): Mar, 02.12.14, ore 17.00 - 19.15', 'Winterthur (German): Tue, 02.12.14, 17:00 - 19:15', '2014-12-02', 17, 'de', 16, 10),
(15, 'Zürich: Mi, 03.12.14, 17:00 - 19:15 Uhr', 'Zürich (allemand): Mer, 03.12.14, 17h00 - 19h15', 'Zürich (tedesco): Mer, 03.12.14, ore 17.00 - 19.15', 'Zürich (German): Wed, 03.12.14, 17:00 - 19:15', '2014-12-03', 18, 'de', 16, 10),
(16, 'Bern: Do, 04.12.14, 17:00 - 19:15 Uhr', 'Bern (allemand): Jeu, 04.12.14, 17h00 - 19h15', 'Bern (tedesco): Gio, 04.12.14, ore 17.00 - 19.15', 'Bern (German): Thu, 04.12.14, 17:00 - 19:15', '2014-12-04', 19, 'de', 20, 10),
(17, 'Bern: Di, 09.12.14, 17:00 - 19:15 Uhr', 'Bern (allemand): Mar, 09.12.14, 17h00 - 19h15', 'Bern (tedesco): Mar, 09.12.14, ore 17.00 - 19.15', 'Bern (German): Tue, 09.12.14, 17:00 - 19:15', '2014-12-09', 20, 'de', 20, 10),
(18, 'Sion (Franz.): Mi, 15.12.14, 17:00 - 19:15 Uhr', 'Sion: Mer, 15.10.14, 17h00 - 19h15', 'Sion (francese): Mer, 15.10.14, ore 17.00 - 19.15', 'Sion (French): Wed, 15.10.14, 17:00 - 19:15', '2014-12-15', 1, 'fr', 17, 10),
(19, 'Lausanne (Franz.): Di, 28.10.14, 18:00 - 20:15 Uhr', 'Lausanne: Mar, 28.10.14, 18h00 - 20h15', 'Lausanne (francese): Mar, 28.10.14, ore 18.00 - 20.15', 'Lausanne (French): Tue, 28.10.14, 18:00 - 20:15', '2014-10-28', 5, 'fr', 25, 15);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`user_id`, `user`, `password`, `isAdmin`) VALUES
(1, 'login@ebas.ch', 'cbb3abb148828b2cc6e4d22ac00ca10894962992', 0),
(2, 'admin@ebas.ch', 'cbb3abb148828b2cc6e4d22ac00ca10894962992', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_anmeldungen_2014_2`
--
ALTER TABLE `tbl_anmeldungen_2014_2`
 ADD PRIMARY KEY (`anmeldung_id`), ADD KEY `kurs` (`kurs`);

--
-- Indexes for table `tbl_interessenten_2014_2`
--
ALTER TABLE `tbl_interessenten_2014_2`
 ADD PRIMARY KEY (`interessent_id`);

--
-- Indexes for table `tbl_kurse_2014_2`
--
ALTER TABLE `tbl_kurse_2014_2`
 ADD PRIMARY KEY (`kurs_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_anmeldungen_2014_2`
--
ALTER TABLE `tbl_anmeldungen_2014_2`
MODIFY `anmeldung_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=255;
--
-- AUTO_INCREMENT for table `tbl_interessenten_2014_2`
--
ALTER TABLE `tbl_interessenten_2014_2`
MODIFY `interessent_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `tbl_kurse_2014_2`
--
ALTER TABLE `tbl_kurse_2014_2`
MODIFY `kurs_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=124;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
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
