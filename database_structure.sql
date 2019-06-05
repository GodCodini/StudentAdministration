SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema Schuelerverwaltung
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Schuelerverwaltung` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `Schuelerverwaltung` ;

-- -----------------------------------------------------
-- Table `Schuelerverwaltung`.`NotenschluesselTyp`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Schuelerverwaltung`.`NotenschluesselTyp` (
  `idNotenschluesselTyp` INT NOT NULL AUTO_INCREMENT,
  `SchlusselName` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idNotenschluesselTyp`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Schuelerverwaltung`.`Kurs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Schuelerverwaltung`.`Kurs` (
  `id_Kurs` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(45) NOT NULL,
  `NotenschluesselTyp_idNotenschluesselTyp` INT NOT NULL,
  PRIMARY KEY (`id_Kurs`),
  INDEX `fk_Kurs_NotenschluesselTyp1_idx` (`NotenschluesselTyp_idNotenschluesselTyp` ASC),
  CONSTRAINT `fk_Kurs_NotenschluesselTyp1`
    FOREIGN KEY (`NotenschluesselTyp_idNotenschluesselTyp`)
    REFERENCES `Schuelerverwaltung`.`NotenschluesselTyp` (`idNotenschluesselTyp`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Schuelerverwaltung`.`Schueler`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Schuelerverwaltung`.`Schueler` (
  `id_Schueler` INT NOT NULL AUTO_INCREMENT,
  `Vorname` VARCHAR(45) NOT NULL,
  `Nachname` VARCHAR(45) NOT NULL,
  `Geburtsdatum` VARCHAR(45) NOT NULL,
  `Kurs_id_Kurs` INT NOT NULL,
  PRIMARY KEY (`id_Schueler`),
  INDEX `fk_Schueler_Kurs1_idx` (`Kurs_id_Kurs` ASC),
  CONSTRAINT `fk_Schueler_Kurs1`
    FOREIGN KEY (`Kurs_id_Kurs`)
    REFERENCES `Schuelerverwaltung`.`Kurs` (`id_Kurs`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Schuelerverwaltung`.`Typ`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Schuelerverwaltung`.`Typ` (
  `idTyp` INT NOT NULL AUTO_INCREMENT,
  `Fachname` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idTyp`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Schuelerverwaltung`.`Fach`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Schuelerverwaltung`.`Fach` (
  `id_Fach` INT NOT NULL AUTO_INCREMENT,
  `Kurs_id_Kurs` INT NOT NULL,
  `Typ_idTyp` INT NOT NULL,
  PRIMARY KEY (`id_Fach`),
  INDEX `fk_Fach_Kurs1_idx` (`Kurs_id_Kurs` ASC),
  INDEX `fk_Fach_Typ1_idx` (`Typ_idTyp` ASC),
  CONSTRAINT `fk_Fach_Kurs1`
    FOREIGN KEY (`Kurs_id_Kurs`)
    REFERENCES `Schuelerverwaltung`.`Kurs` (`id_Kurs`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Fach_Typ1`
    FOREIGN KEY (`Typ_idTyp`)
    REFERENCES `Schuelerverwaltung`.`Typ` (`idTyp`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Schuelerverwaltung`.`NotenTyp`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Schuelerverwaltung`.`NotenTyp` (
  `idNotenTyp` INT NOT NULL AUTO_INCREMENT,
  `NotenTyp` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idNotenTyp`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Schuelerverwaltung`.`Note`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Schuelerverwaltung`.`Note` (
  `id_Note` INT NOT NULL AUTO_INCREMENT,
  `Kommentar` VARCHAR(255) NULL,
  `Note` FLOAT NOT NULL,
  `Prozent` FLOAT NOT NULL,
  `Datum` DATE NOT NULL,
  `Schueler_id_Schueler` INT NOT NULL,
  `Fach_id_Fach` INT NOT NULL,
  `NotenTyp_idNotenTyp` INT NOT NULL,
  PRIMARY KEY (`id_Note`),
  INDEX `fk_Note_Schueler1_idx` (`Schueler_id_Schueler` ASC),
  INDEX `fk_Note_Fach1_idx` (`Fach_id_Fach` ASC),
  INDEX `fk_Note_NotenTyp1_idx` (`NotenTyp_idNotenTyp` ASC),
  CONSTRAINT `fk_Note_Schueler1`
    FOREIGN KEY (`Schueler_id_Schueler`)
    REFERENCES `Schuelerverwaltung`.`Schueler` (`id_Schueler`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Note_Fach1`
    FOREIGN KEY (`Fach_id_Fach`)
    REFERENCES `Schuelerverwaltung`.`Fach` (`id_Fach`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Note_NotenTyp1`
    FOREIGN KEY (`NotenTyp_idNotenTyp`)
    REFERENCES `Schuelerverwaltung`.`NotenTyp` (`idNotenTyp`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
