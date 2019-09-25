-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 25. Sep 2019 um 10:44
-- Server-Version: 10.1.25-MariaDB
-- PHP-Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `schuelerverwaltung`
--
CREATE DATABASE IF NOT EXISTS `schuelerverwaltung` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `schuelerverwaltung`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fach`
--

CREATE TABLE `fach` (
  `id_Fach` int(11) NOT NULL,
  `Kurs_id_Kurs` int(11) NOT NULL,
  `Typ_idTyp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `fach`
--

INSERT INTO `fach` (`id_Fach`, `Kurs_id_Kurs`, `Typ_idTyp`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kurs`
--

CREATE TABLE `kurs` (
  `id_Kurs` int(11) NOT NULL,
  `kursName` varchar(45) NOT NULL,
  `NotenschluesselTyp_idNotenschluesselTyp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `kurs`
--

INSERT INTO `kurs` (`id_Kurs`, `kursName`, `NotenschluesselTyp_idNotenschluesselTyp`) VALUES
(1, 'FI7S', 1),
(24, 'ITB3', 1),
(25, 'FI8A', 1),
(26, 'ITB1', 2);

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `loadallstudents`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `loadallstudents` (
`Vorname` varchar(45)
,`Nachname` varchar(45)
,`Geburtsdatum` date
);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `note`
--

CREATE TABLE `note` (
  `id_Note` int(11) NOT NULL,
  `Kommentar` varchar(255) DEFAULT NULL,
  `Note` float NOT NULL,
  `Prozent` float NOT NULL,
  `Datum` date NOT NULL,
  `Schueler_id_Schueler` int(11) NOT NULL,
  `Fach_id_Fach` int(11) NOT NULL,
  `NotenTyp_idNotenTyp` int(11) NOT NULL,
  `notenschluesselTyp_Id` int(11) NOT NULL,
  `scoredPoints` float NOT NULL,
  `maxPoints` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `note`
--

INSERT INTO `note` (`id_Note`, `Kommentar`, `Note`, `Prozent`, `Datum`, `Schueler_id_Schueler`, `Fach_id_Fach`, `NotenTyp_idNotenTyp`, `notenschluesselTyp_Id`, `scoredPoints`, `maxPoints`) VALUES
(3, '', 2, 88, '2019-08-12', 3, 1, 1, 1, 0, 0),
(4, 'Ein inhaltlicher Fehler, sonst sehr gut', 1, 98, '2019-08-20', 3, 2, 2, 1, 0, 0),
(5, '', 1, 12, '1998-12-12', 1, 1, 1, 1, 0, 0),
(6, '', 1, 96, '2019-08-28', 3, 1, 1, 1, 0, 0),
(7, '', 2, 85, '2019-08-28', 3, 2, 1, 1, 0, 0),
(8, '', 2, 85, '2019-08-28', 3, 2, 1, 1, 0, 0),
(9, '', 2, 90, '2019-08-30', 1, 2, 2, 1, 0, 0),
(10, '', 3, 69, '2019-08-28', 3, 1, 2, 1, 0, 0),
(11, '', 3, 68, '2019-08-29', 3, 2, 1, 6, 0, 0),
(12, '', 2, 87, '2019-08-26', 7, 2, 1, 1, 0, 0),
(13, 'total kagge', 6, 1, '2019-09-04', 7, 1, 2, 1, 0, 0),
(14, '', 3, 77, '2019-09-09', 7, 1, 1, 1, 0, 0),
(15, 'test', 3, 68, '2019-05-14', 7, 1, 1, 1, 0, 0),
(16, '', 2, 90, '2019-09-20', 1, 1, 1, 1, 90, 100),
(17, '', 1, 92, '0000-00-00', 3, 1, 1, 1, 12, 13);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `notenschluessel`
--

CREATE TABLE `notenschluessel` (
  `id` int(11) NOT NULL,
  `notenschluesselTyp_id` int(11) NOT NULL,
  `von` int(11) NOT NULL,
  `bis` int(11) NOT NULL,
  `entspricht` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `notenschluessel`
--

INSERT INTO `notenschluessel` (`id`, `notenschluesselTyp_id`, `von`, `bis`, `entspricht`) VALUES
(1, 1, 92, 100, 1),
(2, 1, 82, 91, 2),
(3, 1, 67, 81, 3),
(4, 1, 50, 66, 4),
(5, 1, 30, 49, 5),
(6, 1, 0, 29, 6),
(7, 2, 96, 100, 1),
(8, 2, 80, 95, 2),
(9, 2, 60, 79, 3),
(10, 2, 45, 59, 4),
(11, 2, 16, 44, 5),
(12, 2, 0, 15, 6),
(19, 4, 90, 100, 1),
(20, 4, 80, 89, 2),
(21, 4, 70, 79, 3),
(22, 4, 60, 69, 4),
(23, 4, 50, 59, 5),
(24, 4, 0, 49, 6),
(31, 6, 90, 100, 1),
(32, 6, 76, 89, 2),
(33, 6, 60, 75, 3),
(34, 6, 50, 59, 4),
(35, 6, 30, 49, 5),
(36, 6, 0, 29, 6),
(37, 7, 0, 15, 1),
(38, 7, 16, 23, 2),
(39, 7, 24, 30, 3),
(40, 7, 31, 36, 4),
(41, 7, 37, 42, 5),
(42, 7, 43, 49, 6),
(43, 7, 50, 55, 7),
(44, 7, 56, 61, 8),
(45, 7, 62, 68, 9),
(46, 7, 69, 73, 10),
(47, 7, 74, 77, 11),
(48, 7, 78, 83, 12),
(49, 7, 84, 89, 13),
(50, 7, 90, 95, 14),
(51, 7, 96, 100, 15);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `notenschluesseltyp`
--

CREATE TABLE `notenschluesseltyp` (
  `idNotenschluesselTyp` int(11) NOT NULL,
  `SchlusselName` varchar(45) NOT NULL,
  `isGlobal` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `notenschluesseltyp`
--

INSERT INTO `notenschluesseltyp` (`idNotenschluesselTyp`, `SchlusselName`, `isGlobal`) VALUES
(1, 'IHK', 1),
(2, 'Abitur', 1),
(4, 'POOP', 0),
(6, 'Test', 0),
(7, '15Test', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `notentyp`
--

CREATE TABLE `notentyp` (
  `idNotenTyp` int(11) NOT NULL,
  `NotenTyp` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `notentyp`
--

INSERT INTO `notentyp` (`idNotenTyp`, `NotenTyp`) VALUES
(1, 'Klausur'),
(2, 'Referat'),
(3, 'Mündliche Leistung'),
(4, 'Test');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `passwort`
--

CREATE TABLE `passwort` (
  `id` int(11) NOT NULL,
  `aktuellesPW` varchar(255) NOT NULL,
  `altesPW` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `passwort`
--

INSERT INTO `passwort` (`id`, `aktuellesPW`, `altesPW`) VALUES
(1, '$2y$12$9kwRzDWUobKeCU.8VfLfbuKLLKbXlxottA.3clJ82xi4lnnmlxsKS', '$2y$12$UFLpQH8.MZaeUayd1LID6.CaAny5WK/D1wnvHyHzKLE8.e4.Qi.ZO');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `schueler`
--

CREATE TABLE `schueler` (
  `id_Schueler` int(11) NOT NULL,
  `Vorname` varchar(45) NOT NULL,
  `Nachname` varchar(45) NOT NULL,
  `Geburtsdatum` date NOT NULL,
  `Kurs_id_Kurs` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `schueler`
--

INSERT INTO `schueler` (`id_Schueler`, `Vorname`, `Nachname`, `Geburtsdatum`, `Kurs_id_Kurs`) VALUES
(1, 'Lennart', 'Pamperin', '1996-10-11', 1),
(2, 'Miladasdasd', 'Alshahaf', '1994-12-11', 25),
(3, 'Ralf', 'KlaÃŸen', '1979-12-26', 1),
(4, 'Alexadsasd', 'Scheibe', '1998-04-05', 25),
(5, 'Ralf', 'Klassen', '1979-12-26', 24),
(6, 'Ralf', 'KloÃŸen', '1979-12-26', 24),
(7, 'Milad', 'Alshahaf', '1994-12-11', 1),
(8, 'Dominik', 'Fladung', '2019-09-10', 1),
(9, 'Simon', 'Ulrich', '2019-08-26', 1),
(10, 'Orhan', 'Dietze', '1997-05-12', 1),
(11, 'Tekekin', 'Yilmazka', '1996-08-28', 1),
(12, 'Vincent', 'Pich', '1998-01-07', 1),
(13, 'Milad', 'Alshahaf', '1994-12-11', 24),
(14, 'Lennart', 'Pamperin', '1996-10-11', 24),
(15, 'Tobias', 'Brinker', '1997-09-15', 24),
(16, 'Ralf', 'KlaÃŸen', '1979-12-26', 25),
(17, 'Lennart', 'Pamperin', '1996-10-11', 25),
(18, 'Tonyyyyy', 'Stark', '1970-05-29', 26),
(19, 'Bruce', 'Banner', '1969-12-18', 26),
(20, 'Rolf', 'KlaÃŸen', '1979-12-26', 25),
(21, 'Relf', 'KlaÃŸen', '1979-12-26', 25),
(22, 'Relf', 'KloÃŸen', '1979-12-26', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `typ`
--

CREATE TABLE `typ` (
  `idTyp` int(11) NOT NULL,
  `Fachname` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `typ`
--

INSERT INTO `typ` (`idTyp`, `Fachname`) VALUES
(1, 'Anwendungsentwicklung'),
(2, 'ITSY');

-- --------------------------------------------------------

--
-- Struktur des Views `loadallstudents`
--
DROP TABLE IF EXISTS `loadallstudents`;

CREATE ALGORITHM=UNDEFINED DEFINER=`pamperin`@`%` SQL SECURITY DEFINER VIEW `loadallstudents`  AS  select `s`.`Vorname` AS `Vorname`,`s`.`Nachname` AS `Nachname`,`s`.`Geburtsdatum` AS `Geburtsdatum` from (`kurs` left join `schueler` `s` on((`kurs`.`id_Kurs` = `s`.`Kurs_id_Kurs`))) where (`kurs`.`kursName` = 'FI7S') ;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `fach`
--
ALTER TABLE `fach`
  ADD PRIMARY KEY (`id_Fach`),
  ADD KEY `fk_Fach_Kurs1_idx` (`Kurs_id_Kurs`),
  ADD KEY `fk_Fach_Typ1_idx` (`Typ_idTyp`);

--
-- Indizes für die Tabelle `kurs`
--
ALTER TABLE `kurs`
  ADD PRIMARY KEY (`id_Kurs`),
  ADD KEY `fk_Kurs_NotenschluesselTyp1_idx` (`NotenschluesselTyp_idNotenschluesselTyp`);

--
-- Indizes für die Tabelle `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id_Note`),
  ADD KEY `fk_Note_Schueler1_idx` (`Schueler_id_Schueler`),
  ADD KEY `fk_Note_Fach1_idx` (`Fach_id_Fach`),
  ADD KEY `fk_Note_NotenTyp1_idx` (`NotenTyp_idNotenTyp`),
  ADD KEY `fk_notenschluessel_id` (`notenschluesselTyp_Id`);

--
-- Indizes für die Tabelle `notenschluessel`
--
ALTER TABLE `notenschluessel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notenschlüsselTypID` (`notenschluesselTyp_id`);

--
-- Indizes für die Tabelle `notenschluesseltyp`
--
ALTER TABLE `notenschluesseltyp`
  ADD PRIMARY KEY (`idNotenschluesselTyp`);

--
-- Indizes für die Tabelle `notentyp`
--
ALTER TABLE `notentyp`
  ADD PRIMARY KEY (`idNotenTyp`);

--
-- Indizes für die Tabelle `passwort`
--
ALTER TABLE `passwort`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `schueler`
--
ALTER TABLE `schueler`
  ADD PRIMARY KEY (`id_Schueler`),
  ADD KEY `fk_Schueler_Kurs1_idx` (`Kurs_id_Kurs`);

--
-- Indizes für die Tabelle `typ`
--
ALTER TABLE `typ`
  ADD PRIMARY KEY (`idTyp`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `fach`
--
ALTER TABLE `fach`
  MODIFY `id_Fach` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `kurs`
--
ALTER TABLE `kurs`
  MODIFY `id_Kurs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT für Tabelle `note`
--
ALTER TABLE `note`
  MODIFY `id_Note` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT für Tabelle `notenschluessel`
--
ALTER TABLE `notenschluessel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT für Tabelle `notenschluesseltyp`
--
ALTER TABLE `notenschluesseltyp`
  MODIFY `idNotenschluesselTyp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT für Tabelle `notentyp`
--
ALTER TABLE `notentyp`
  MODIFY `idNotenTyp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT für Tabelle `passwort`
--
ALTER TABLE `passwort`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `schueler`
--
ALTER TABLE `schueler`
  MODIFY `id_Schueler` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT für Tabelle `typ`
--
ALTER TABLE `typ`
  MODIFY `idTyp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `fach`
--
ALTER TABLE `fach`
  ADD CONSTRAINT `fk_Fach_Kurs1` FOREIGN KEY (`Kurs_id_Kurs`) REFERENCES `kurs` (`id_Kurs`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Fach_Typ1` FOREIGN KEY (`Typ_idTyp`) REFERENCES `typ` (`idTyp`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `kurs`
--
ALTER TABLE `kurs`
  ADD CONSTRAINT `fk_Kurs_NotenschluesselTyp1` FOREIGN KEY (`NotenschluesselTyp_idNotenschluesselTyp`) REFERENCES `notenschluesseltyp` (`idNotenschluesselTyp`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `fk_Note_Fach1` FOREIGN KEY (`Fach_id_Fach`) REFERENCES `fach` (`id_Fach`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Note_NotenTyp1` FOREIGN KEY (`NotenTyp_idNotenTyp`) REFERENCES `notentyp` (`idNotenTyp`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Note_Schueler1` FOREIGN KEY (`Schueler_id_Schueler`) REFERENCES `schueler` (`id_Schueler`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notenschluessel_id` FOREIGN KEY (`notenschluesselTyp_Id`) REFERENCES `notenschluesseltyp` (`idNotenschluesselTyp`);

--
-- Constraints der Tabelle `notenschluessel`
--
ALTER TABLE `notenschluessel`
  ADD CONSTRAINT `notenschlüsselTypID` FOREIGN KEY (`notenschluesselTyp_id`) REFERENCES `notenschluesseltyp` (`idNotenschluesselTyp`);

--
-- Constraints der Tabelle `schueler`
--
ALTER TABLE `schueler`
  ADD CONSTRAINT `fk_Schueler_Kurs1` FOREIGN KEY (`Kurs_id_Kurs`) REFERENCES `kurs` (`id_Kurs`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
