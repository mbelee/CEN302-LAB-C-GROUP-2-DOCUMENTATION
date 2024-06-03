-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema hms
-- ----------------------xhonixhoni2013@gmail.com-------------------------------

-- -----------------------------------------------------
-- Schema hms
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `hms` ;
USE `hms` ;

-- -----------------------------------------------------
-- Table `hms`.`doctors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hms`.`doctors` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `father_name` VARCHAR(45) NULL,
  `surname` VARCHAR(45) NULL,
  `birth_year` DATE NULL,
  `gender` VARCHAR(45) NULL,
  `password` VARCHAR(255) NULL,
  `photo` VARCHAR(45) NULL,
  `telephone` VARCHAR(45) NULL,
  `specialty` VARCHAR(45) NULL,
  `email` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

INSERT INTO `hms`.`doctors` (`name`, `surname`, `gender`, `password`, `specialty`, `email`) VALUES
('Will', 'Williams', 'Male', '$2a$12$z25kqY84pOvL.Qs9USvrh.2yK0tdOfzM86xotDilQUYVt6.dTPI1G', 'Cardiologist', 'williams@gmail.com'),
('Ralph', 'Bh', 'Male', '$2a$12$z25kqY84pOvL.Qs9USvrh.2yK0tdOfzM86xotDilQUYVt6.dTPI1G', 'Neurologist', 'ralph@gmail.com'),
('Ryan', 'Chandler', 'Female', '$2a$12$z25kqY84pOvL.Qs9USvrh.2yK0tdOfzM86xotDilQUYVt6.dTPI1G', 'Pediatrician', 'ryanc@gmail.com'),
('Lou', 'Lewis', 'Male', '$2a$12$z25kqY84pOvL.Qs9USvrh.2yK0tdOfzM86xotDilQUYVt6.dTPI1G', 'Gynecologist', 'lewis@gmail.com'),
('Chris', 'Olivas', 'Male', '$2a$12$z25kqY84pOvL.Qs9USvrh.2yK0tdOfzM86xotDilQUYVt6.dTPI1G', 'Oncologist', 'chris@gmail.com'),
('Danial', 'Rivera', 'Female', '$2a$12$z25kqY84pOvL.Qs9USvrh.2yK0tdOfzM86xotDilQUYVt6.dTPI1G', 'Neurologist', 'danial@gmail.com');


-- -----------------------------------------------------
-- Table `hms`.`receptionists`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hms`.`receptionists` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `surname` VARCHAR(45) NULL,
  `gender` VARCHAR(45) NULL,
  `email` VARCHAR(255) NULL,
  `birth_year` DATE NULL,
  `telephone` VARCHAR(45) NULL,
  `details` MEDIUMTEXT NULL,
  `password` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

INSERT INTO `hms`.`receptionists` (`name`, `surname`, `gender`, `email`, `birth_year`, `telephone`, `details`, `password`) VALUES
('Alice', 'Johnson', 'Female', 'alice.johnson@gmail.com', '1985-04-15', '5551234567', 'Experienced receptionist with excellent organizational skills.', '$2a$12$z25kqY84pOvL.Qs9USvrh.2yK0tdOfzM86xotDilQUYVt6.dTPI1G'),
('Bob', 'Smith', 'Male', 'bob.smith@gmail.com', '1978-09-23', '5552345678', 'Friendly and efficient receptionist with over 10 years of experience.', '$2a$12$z25kqY84pOvL.Qs9USvrh.2yK0tdOfzM86xotDilQUYVt6.dTPI1G'),
('Cathy', 'Brown', 'Female', 'cathy.brown@gmail.com', '1990-07-30', '5553456789', 'Detail-oriented receptionist with a background in healthcare.', '$2a$12$z25kqY84pOvL.Qs9USvrh.2yK0tdOfzM86xotDilQUYVt6.dTPI1G'),
('David', 'Taylor', 'Male', 'david.taylor@gmail.com', '1982-11-11', '5554567890', 'Professional receptionist with strong communication skills.', '$2a$12$z25kqY84pOvL.Qs9USvrh.2yK0tdOfzM86xotDilQUYVt6.dTPI1G'),
('Eva', 'Miller', 'Female', 'eva.miller@gmail.com', '1995-01-25', '5555678901', 'Receptionist with excellent customer service skills.', '$2a$12$z25kqY84pOvL.Qs9USvrh.2yK0tdOfzM86xotDilQUYVt6.dTPI1G');


-- -----------------------------------------------------
-- Table `hms`.`patients`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hms`.`patients` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `father_name` VARCHAR(45) NULL,
  `surname` VARCHAR(45) NULL,
  `birth_year` DATE NULL,
  `gender` VARCHAR(45) NULL,
  `email` VARCHAR(255) NULL,
  `password` VARCHAR(255) NULL,
  `photo` VARCHAR(45) NULL,
  `telephone` VARCHAR(45) NULL,
  `address` VARCHAR(255) NULL,
  `details` MEDIUMTEXT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

INSERT INTO `hms`.`patients` (`name`, `surname`, `gender`, `email`, `password`, `telephone`) VALUES
('Curtis', 'Hicks', 'Male', 'curtis@gmail.com', '$2a$12$z25kqY84pOvL.Qs9USvrh.2yK0tdOfzM86xotDilQUYVt6.dTPI1G', '7410000010'),
('Emily', 'Smith', 'Female', 'emily@gmail.com', '$2a$12$z25kqY84pOvL.Qs9USvrh.2yK0tdOfzM86xotDilQUYVt6.dTPI1G', '7896541222'),
('Robert', 'Ray', 'Male', 'robert@gmail.com', '$2a$12$z25kqY84pOvL.Qs9USvrh.2yK0tdOfzM86xotDilQUYVt6.dTPI1G', '7014744444'),
('Michael', 'Foster', 'Male', 'michael@gmail.com', '$2a$12$z25kqY84pOvL.Qs9USvrh.2yK0tdOfzM86xotDilQUYVt6.dTPI1G', '7023696969'),
('Victor', 'Owen', 'Male', 'victor@gmail.com', '$2a$12$z25kqY84pOvL.Qs9USvrh.2yK0tdOfzM86xotDilQUYVt6.dTPI1G', '7897895500'),
('Johnny', 'Collins', 'Male', 'johnny@gmail.com', '$2a$12$z25kqY84pOvL.Qs9USvrh.2yK0tdOfzM86xotDilQUYVt6.dTPI1G', '7530001250'),
('Elsie', 'Meads', 'Female', 'elsie@gmail.com', '$2a$12$z25kqY84pOvL.Qs9USvrh.2yK0tdOfzM86xotDilQUYVt6.dTPI1G', '7850001250'),
('David', 'Fburn', 'Male', 'david@gmail.com', '$2a$12$z25kqY84pOvL.Qs9USvrh.2yK0tdOfzM86xotDilQUYVt6.dTPI1G', '7301450000'),
('Brandon', 'Mckinnon', 'Male', 'brandon@gmail.com', '$2a$12$z25kqY84pOvL.Qs9USvrh.2yK0tdOfzM86xotDilQUYVt6.dTPI1G', '7026969500'),
('Tyler', 'Smith', 'Male', 'tyler@gmail.com', '$2a$12$z25kqY84pOvL.Qs9USvrh.2yK0tdOfzM86xotDilQUYVt6.dTPI1G', '7900145300'),
('Kathryn', 'Anderson', 'Female', 'kathryn@gmail.com', '$2a$12$z25kqY84pOvL.Qs9USvrh.2yK0tdOfzM86xotDilQUYVt6.dTPI1G', '7850002580'),
('Liam', 'Moore', 'Male', 'liam@gmail.com', '$2a$12$z25kqY84pOvL.Qs9USvrh.2yK0tdOfzM86xotDilQUYVt6.dTPI1G', '7412225680'),
('Brian', 'Rowe', 'Male', 'brian@gmail.com', '$2a$12$z25kqY84pOvL.Qs9USvrh.2yK0tdOfzM86xotDilQUYVt6.dTPI1G', '7012569999');


-- -----------------------------------------------------
-- Table `hms`.`medical_records`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hms`.`medical_records` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `date_created` DATETIME NULL,
  `bloodtype` VARCHAR(45) NULL,
  `allergies` MEDIUMTEXT NULL,
  `details` MEDIUMTEXT NULL,
  `patients_id` INT NOT NULL,
  `doctors_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_medical_records_patients1_idx` (`patients_id` ASC) VISIBLE,
  INDEX `fk_medical_records_doctors1_idx` (`doctors_id` ASC) VISIBLE,
  CONSTRAINT `fk_medical_records_patients1`
    FOREIGN KEY (`patients_id`)
    REFERENCES `hms`.`patients` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_medical_records_doctors1`
    FOREIGN KEY (`doctors_id`)
    REFERENCES `hms`.`doctors` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO `hms`.`medical_records` (`date_created`, `allergies`, `details`, `patients_id`, `doctors_id`) VALUES
('2021-07-06 10:00:00', 'rhinoconjunctivitis', 'trandolapril (Mavik)', 12, 1),
('2021-07-05 10:00:00', 'lumpy rash on the legs - or lupus vulgaris which gives lumps or ulcers', 'Isoniazid, Ethambutol (Myambutol), Linezolid (Zyvox)', 1, 3),
('2021-07-05 10:00:00', '00000000', 'Narcotic analgesics and nonsteroidal anti-inflammatory drugs', 11, 4),
('2021-07-06 08:00:00', '0000000', 'Nimodipine - empty stomach, at least 1 hour before a meal or 2 hours after a meal', 13, 2);



-- -----------------------------------------------------
-- Table `hms`.`checkups`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hms`.`checkups` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `date_created` DATE NULL,
  `details` MEDIUMTEXT NULL,
  `diagnosis` VARCHAR(45) NULL,
  `patients_id` INT NOT NULL,
  `doctors_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_checkups_patients1_idx` (`patients_id` ASC) VISIBLE,
  INDEX `fk_checkups_doctors1_idx` (`doctors_id` ASC) VISIBLE,
  CONSTRAINT `fk_checkups_patients1`
    FOREIGN KEY (`patients_id`)
    REFERENCES `hms`.`patients` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_checkups_doctors1`
    FOREIGN KEY (`doctors_id`)
    REFERENCES `hms`.`doctors` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO `hms`.`checkups` (`date_created`, `diagnosis`, `patients_id`, `doctors_id`) VALUES
('2021-07-06', 'Congenital heart disease', 12, 1),
('2021-07-05', 'Tuberculosis', 1, 3),
('2021-07-05', 'Ovarian cysts', 11, 4),
('2021-07-06', 'Cerebral Aneurysm', 13, 2);



-- -----------------------------------------------------
-- Table `hms`.`messages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hms`.`messages` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `reciever_email` VARCHAR(45) NULL,
  `sender_email` VARCHAR(45) NULL,
  `mark_as_read` VARCHAR(45) NULL,
  `doctors_id` INT NOT NULL,
  `patients_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_messages_doctors1_idx` (`doctors_id` ASC) VISIBLE,
  INDEX `fk_messages_patients1_idx` (`patients_id` ASC) VISIBLE,
  CONSTRAINT `fk_messages_doctors1`
    FOREIGN KEY (`doctors_id`)
    REFERENCES `hms`.`doctors` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_messages_patients1`
    FOREIGN KEY (`patients_id`)
    REFERENCES `hms`.`patients` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO `hms`.`messages` (`reciever_email`, `sender_email`, `mark_as_read`, `doctors_id`, `patients_id`) VALUES
('liam@gmail.com', 'williams@gmail.com', 'no', 1, 12),
('curtis@gmail.com', 'ryanc@gmail.com', 'no', 3, 1),
('kathryn@gmail.com', 'lewis@gmail.com', 'no', 4, 11),
('brian@gmail.com', 'ralph@gmail.com', 'no', 2, 13);



-- -----------------------------------------------------
-- Table `hms`.`feedbacks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hms`.`feedbacks` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `date_created` DATE NULL,
  `comment` MEDIUMTEXT NULL,
  `patients_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_feedbacks_patients1_idx` (`patients_id` ASC) VISIBLE,
  CONSTRAINT `fk_feedbacks_patients1`
    FOREIGN KEY (`patients_id`)
    REFERENCES `hms`.`patients` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO `hms`.`feedbacks` (`date_created`, `comment`, `patients_id`) VALUES
('2021-07-06', 'Very professional and kind.', 12),
('2021-07-05', 'Helpful and thorough.', 1),
('2021-07-05', 'Great experience.', 11),
('2021-07-06', 'Knowledgeable and patient.', 13);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
