-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 09. Aug 2019 um 13:21
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
  `Name` varchar(45) NOT NULL,
  `NotenschluesselTyp_idNotenschluesselTyp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `kurs`
--

INSERT INTO `kurs` (`id_Kurs`, `Name`, `NotenschluesselTyp_idNotenschluesselTyp`) VALUES
(1, 'FI7S', 1);

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
  `NotenTyp_idNotenTyp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `note`
--

INSERT INTO `note` (`id_Note`, `Kommentar`, `Note`, `Prozent`, `Datum`, `Schueler_id_Schueler`, `Fach_id_Fach`, `NotenTyp_idNotenTyp`) VALUES
(1, NULL, 1, 95, '2019-05-14', 1, 1, 1),
(2, NULL, 2, 88, '2019-05-10', 1, 1, 2),
(3, NULL, 1, 95, '2019-05-10', 2, 1, 2),
(4, NULL, 3, 76, '2019-05-09', 1, 2, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `notenschluesseltyp`
--

CREATE TABLE `notenschluesseltyp` (
  `idNotenschluesselTyp` int(11) NOT NULL,
  `SchlusselName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `notenschluesseltyp`
--

INSERT INTO `notenschluesseltyp` (`idNotenschluesselTyp`, `SchlusselName`) VALUES
(1, 'IHK'),
(2, 'Abitur');

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
(2, 'Referat');

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
  `Kurs_id_Kurs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `schueler`
--

INSERT INTO `schueler` (`id_Schueler`, `Vorname`, `Nachname`, `Geburtsdatum`, `Kurs_id_Kurs`) VALUES
(1, 'Lennart', 'Pamperin', '1996-10-11', 1),
(2, 'Ralf', 'Klaßen', '1979-12-26', 1);

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
  ADD KEY `fk_Note_NotenTyp1_idx` (`NotenTyp_idNotenTyp`);

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
  MODIFY `id_Kurs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `note`
--
ALTER TABLE `note`
  MODIFY `id_Note` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT für Tabelle `notenschluesseltyp`
--
ALTER TABLE `notenschluesseltyp`
  MODIFY `idNotenschluesselTyp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `notentyp`
--
ALTER TABLE `notentyp`
  MODIFY `idNotenTyp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `passwort`
--
ALTER TABLE `passwort`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `schueler`
--
ALTER TABLE `schueler`
  MODIFY `id_Schueler` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  ADD CONSTRAINT `fk_Note_Schueler1` FOREIGN KEY (`Schueler_id_Schueler`) REFERENCES `schueler` (`id_Schueler`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `schueler`
--
ALTER TABLE `schueler`
  ADD CONSTRAINT `fk_Schueler_Kurs1` FOREIGN KEY (`Kurs_id_Kurs`) REFERENCES `kurs` (`id_Kurs`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
