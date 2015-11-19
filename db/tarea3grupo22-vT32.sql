-- MySQL Script generated by MySQL Workbench
-- 11/18/15 22:59:33
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema tarea3grupo22
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema tarea3grupo22
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tarea3grupo22` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `tarea3grupo22` ;

-- -----------------------------------------------------
-- Table `tarea3grupo22`.`userStatus`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tarea3grupo22`.`userStatus` ;

CREATE TABLE IF NOT EXISTS `tarea3grupo22`.`userStatus` (
  `iduserStatus` INT NOT NULL COMMENT '',
  `name` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`iduserStatus`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tarea3grupo22`.`chessClub`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tarea3grupo22`.`chessClub` ;

CREATE TABLE IF NOT EXISTS `tarea3grupo22`.`chessClub` (
  `idchessClub` INT NOT NULL COMMENT '',
  `name` VARCHAR(45) NULL COMMENT '',
  `description` VARCHAR(255) NULL COMMENT '',
  `website` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`idchessClub`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tarea3grupo22`.`chessPlayer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tarea3grupo22`.`chessPlayer` ;

CREATE TABLE IF NOT EXISTS `tarea3grupo22`.`chessPlayer` (
  `idchessPlayer` INT NOT NULL COMMENT '',
  `chessPlayercol` VARCHAR(45) NULL COMMENT '',
  `playerName` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`idchessPlayer`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tarea3grupo22`.`sex`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tarea3grupo22`.`sex` ;

CREATE TABLE IF NOT EXISTS `tarea3grupo22`.`sex` (
  `idtable1` CHAR(1) NOT NULL COMMENT '',
  `description` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`idtable1`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tarea3grupo22`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tarea3grupo22`.`user` ;

CREATE TABLE IF NOT EXISTS `tarea3grupo22`.`user` (
  `username` VARCHAR(30) NOT NULL COMMENT '',
  `password` VARCHAR(30) NOT NULL COMMENT '',
  `first_name` VARCHAR(50) NOT NULL COMMENT '',
  `last_name` VARCHAR(50) NOT NULL COMMENT '',
  `email` VARCHAR(100) NOT NULL COMMENT '',
  `sex` CHAR(1) NULL COMMENT '',
  `avatar` VARCHAR(100) NULL COMMENT '',
  `userStatus` INT NOT NULL COMMENT '',
  `chessClub_idchessClub` INT NULL COMMENT '',
  `chessPlayer_idchessPlayer` INT NULL COMMENT '',
  PRIMARY KEY (`username`)  COMMENT '',
  INDEX `fk_User_userStatus_idx` (`userStatus` ASC)  COMMENT '',
  INDEX `fk_user_chessClub1_idx` (`chessClub_idchessClub` ASC)  COMMENT '',
  INDEX `fk_user_chessPlayer1_idx` (`chessPlayer_idchessPlayer` ASC)  COMMENT '',
  INDEX `fk_user_sex1_idx` (`sex` ASC)  COMMENT '',
  CONSTRAINT `fk_User_userStatus`
    FOREIGN KEY (`userStatus`)
    REFERENCES `tarea3grupo22`.`userStatus` (`iduserStatus`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_chessClub1`
    FOREIGN KEY (`chessClub_idchessClub`)
    REFERENCES `tarea3grupo22`.`chessClub` (`idchessClub`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `fk_user_chessPlayer1`
    FOREIGN KEY (`chessPlayer_idchessPlayer`)
    REFERENCES `tarea3grupo22`.`chessPlayer` (`idchessPlayer`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `fk_user_sex1`
    FOREIGN KEY (`sex`)
    REFERENCES `tarea3grupo22`.`sex` (`idtable1`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tarea3grupo22`.`publication`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tarea3grupo22`.`publication` ;

CREATE TABLE IF NOT EXISTS `tarea3grupo22`.`publication` (
  `idPublication` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `publicationDate` DATETIME NOT NULL COMMENT '',
  PRIMARY KEY (`idPublication`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tarea3grupo22`.`comment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tarea3grupo22`.`comment` ;

CREATE TABLE IF NOT EXISTS `tarea3grupo22`.`comment` (
  `id_comment` INT NOT NULL COMMENT '',
  `commented_publication` INT NOT NULL COMMENT '',
  `content` VARCHAR(1000) NOT NULL COMMENT '',
  PRIMARY KEY (`id_comment`)  COMMENT '',
  INDEX `fk_comment_publication2_idx` (`commented_publication` ASC)  COMMENT '',
  CONSTRAINT `fk_comment_publication1`
    FOREIGN KEY (`id_comment`)
    REFERENCES `tarea3grupo22`.`publication` (`idPublication`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_comment_publication2`
    FOREIGN KEY (`commented_publication`)
    REFERENCES `tarea3grupo22`.`publication` (`idPublication`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tarea3grupo22`.`news`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tarea3grupo22`.`news` ;

CREATE TABLE IF NOT EXISTS `tarea3grupo22`.`news` (
  `id_new` INT NOT NULL COMMENT '',
  `title` VARCHAR(45) NOT NULL COMMENT '',
  `date` DATE NOT NULL COMMENT '',
  `content` VARCHAR(1000) NULL COMMENT '',
  `image_cover` VARCHAR(45) NULL COMMENT '',
  `category` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`id_new`)  COMMENT '',
  INDEX `fk_news_publication1_idx` (`id_new` ASC)  COMMENT '',
  CONSTRAINT `fk_news_publication1`
    FOREIGN KEY (`id_new`)
    REFERENCES `tarea3grupo22`.`publication` (`idPublication`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tarea3grupo22`.`timestamps`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tarea3grupo22`.`timestamps` ;

CREATE TABLE IF NOT EXISTS `tarea3grupo22`.`timestamps` (
  `username` VARCHAR(30) NOT NULL COMMENT '',
  `update_time` DATE NULL COMMENT '',
  `create_time` DATE NULL COMMENT '',
  INDEX `fk_activity_User1_idx` (`username` ASC)  COMMENT '',
  PRIMARY KEY (`username`)  COMMENT '',
  CONSTRAINT `fk_activity_User1`
    FOREIGN KEY (`username`)
    REFERENCES `tarea3grupo22`.`user` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tarea3grupo22`.`privateMessage`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tarea3grupo22`.`privateMessage` ;

CREATE TABLE IF NOT EXISTS `tarea3grupo22`.`privateMessage` (
  `idprivateMessage` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `content` VARCHAR(255) NOT NULL COMMENT '',
  `date` DATETIME NOT NULL COMMENT '',
  `id_sender` VARCHAR(30) NOT NULL COMMENT '',
  `id_receiver` VARCHAR(30) NOT NULL COMMENT '',
  PRIMARY KEY (`idprivateMessage`)  COMMENT '',
  INDEX `fk_privateMessage_user1_idx` (`id_sender` ASC)  COMMENT '',
  INDEX `fk_privateMessage_user2_idx` (`id_receiver` ASC)  COMMENT '',
  CONSTRAINT `fk_privateMessage_user1`
    FOREIGN KEY (`id_sender`)
    REFERENCES `tarea3grupo22`.`user` (`username`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_privateMessage_user2`
    FOREIGN KEY (`id_receiver`)
    REFERENCES `tarea3grupo22`.`user` (`username`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tarea3grupo22`.`publicationKarma`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tarea3grupo22`.`publicationKarma` ;

CREATE TABLE IF NOT EXISTS `tarea3grupo22`.`publicationKarma` (
  `id_publication` INT NOT NULL COMMENT '',
  `id_user` VARCHAR(30) NOT NULL COMMENT '',
  `value` INT(11) NOT NULL COMMENT '',
  PRIMARY KEY (`id_publication`, `id_user`)  COMMENT '',
  INDEX `fk_publicationKarma_user1_idx` (`id_user` ASC)  COMMENT '',
  CONSTRAINT `fk_publicationKarma_publication1`
    FOREIGN KEY (`id_publication`)
    REFERENCES `tarea3grupo22`.`publication` (`idPublication`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_publicationKarma_user1`
    FOREIGN KEY (`id_user`)
    REFERENCES `tarea3grupo22`.`user` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tarea3grupo22`.`event`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tarea3grupo22`.`event` ;

CREATE TABLE IF NOT EXISTS `tarea3grupo22`.`event` (
  `id_event` INT NOT NULL COMMENT '',
  `title` VARCHAR(45) NOT NULL COMMENT '',
  `description` VARCHAR(255) NOT NULL COMMENT '',
  `date_start` DATETIME NOT NULL COMMENT '',
  `date_end` DATETIME NOT NULL COMMENT '',
  `place` VARCHAR(45) NOT NULL COMMENT '',
  `visibility` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`id_event`)  COMMENT '',
  INDEX `fk_event_publication1_idx` (`id_event` ASC)  COMMENT '',
  CONSTRAINT `fk_event_publication1`
    FOREIGN KEY (`id_event`)
    REFERENCES `tarea3grupo22`.`publication` (`idPublication`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tarea3grupo22`.`invitedList`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tarea3grupo22`.`invitedList` ;

CREATE TABLE IF NOT EXISTS `tarea3grupo22`.`invitedList` (
  `id_event` INT NOT NULL COMMENT '',
  `id_user` VARCHAR(30) NOT NULL COMMENT '',
  `assistance` VARCHAR(45) NOT NULL COMMENT '',
  `show_notification` TINYINT(1) NOT NULL COMMENT '',
  INDEX `fk_invitedList_event1_idx` (`id_event` ASC)  COMMENT '',
  INDEX `fk_invitedList_user1_idx` (`id_user` ASC)  COMMENT '',
  PRIMARY KEY (`id_event`, `id_user`)  COMMENT '',
  CONSTRAINT `fk_invitedList_event1`
    FOREIGN KEY (`id_event`)
    REFERENCES `tarea3grupo22`.`event` (`id_event`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_invitedList_user1`
    FOREIGN KEY (`id_user`)
    REFERENCES `tarea3grupo22`.`user` (`username`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tarea3grupo22`.`contentTag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tarea3grupo22`.`contentTag` ;

CREATE TABLE IF NOT EXISTS `tarea3grupo22`.`contentTag` (
  `tag_name` VARCHAR(45) NOT NULL COMMENT '',
  `tag_description` VARCHAR(255) NULL COMMENT '',
  PRIMARY KEY (`tag_name`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tarea3grupo22`.`userTag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tarea3grupo22`.`userTag` ;

CREATE TABLE IF NOT EXISTS `tarea3grupo22`.`userTag` (
  `id_publication` INT NOT NULL COMMENT '',
  `id_user` VARCHAR(30) NOT NULL COMMENT '',
  `untagged` TINYINT(1) NULL COMMENT '',
  PRIMARY KEY (`id_publication`, `id_user`)  COMMENT '',
  INDEX `fk_userTag_user1_idx` (`id_user` ASC)  COMMENT '',
  CONSTRAINT `fk_userTag_publication1`
    FOREIGN KEY (`id_publication`)
    REFERENCES `tarea3grupo22`.`publication` (`idPublication`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_userTag_user1`
    FOREIGN KEY (`id_user`)
    REFERENCES `tarea3grupo22`.`user` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tarea3grupo22`.`publicationTag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tarea3grupo22`.`publicationTag` ;

CREATE TABLE IF NOT EXISTS `tarea3grupo22`.`publicationTag` (
  `idPublication` INT NOT NULL COMMENT '',
  `tag_name` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`idPublication`, `tag_name`)  COMMENT '',
  INDEX `fk_publicationTag_contentTag1_idx` (`tag_name` ASC)  COMMENT '',
  CONSTRAINT `fk_publicationTag_publication1`
    FOREIGN KEY (`idPublication`)
    REFERENCES `tarea3grupo22`.`publication` (`idPublication`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_publicationTag_contentTag1`
    FOREIGN KEY (`tag_name`)
    REFERENCES `tarea3grupo22`.`contentTag` (`tag_name`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tarea3grupo22`.`userPublication`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tarea3grupo22`.`userPublication` ;

CREATE TABLE IF NOT EXISTS `tarea3grupo22`.`userPublication` (
  `id_user` VARCHAR(30) NOT NULL COMMENT '',
  `id_publication` INT NOT NULL COMMENT '',
  `last_changed` DATETIME NULL COMMENT '',
  PRIMARY KEY (`id_user`, `id_publication`)  COMMENT '',
  INDEX `fk_user_publication_publication1_idx` (`id_publication` ASC)  COMMENT '',
  CONSTRAINT `fk_user_publication_user1`
    FOREIGN KEY (`id_user`)
    REFERENCES `tarea3grupo22`.`user` (`username`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_user_publication_publication1`
    FOREIGN KEY (`id_publication`)
    REFERENCES `tarea3grupo22`.`publication` (`idPublication`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tarea3grupo22`.`elo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tarea3grupo22`.`elo` ;

CREATE TABLE IF NOT EXISTS `tarea3grupo22`.`elo` (
  `idchessPlayer` INT NOT NULL COMMENT '',
  `date` DATE NOT NULL COMMENT '',
  `elo` INT NOT NULL COMMENT '',
  `k` INT NOT NULL COMMENT '',
  PRIMARY KEY (`idchessPlayer`, `date`)  COMMENT '',
  INDEX `fk_elo_chessPlayer1_idx` (`idchessPlayer` ASC)  COMMENT '',
  CONSTRAINT `fk_elo_chessPlayer1`
    FOREIGN KEY (`idchessPlayer`)
    REFERENCES `tarea3grupo22`.`chessPlayer` (`idchessPlayer`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tarea3grupo22`.`matchboard`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tarea3grupo22`.`matchboard` ;

CREATE TABLE IF NOT EXISTS `tarea3grupo22`.`matchboard` (
  `matchboard_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `white_player` VARCHAR(100) NOT NULL COMMENT '',
  `black_player` VARCHAR(100) NOT NULL COMMENT '',
  `match_origin` INT(1) NOT NULL DEFAULT 0 COMMENT '',
  `details` VARCHAR(1000) NULL COMMENT '',
  `format` INT(1) NOT NULL DEFAULT 0 COMMENT '',
  `pgn_board` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  `pgn_string` VARCHAR(45) NULL DEFAULT NULL COMMENT '',
  `input_date` DATE NULL DEFAULT NULL COMMENT '',
  `title` VARCHAR(45) NOT NULL COMMENT '',
  PRIMARY KEY (`matchboard_id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tarea3grupo22`.`user_info`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tarea3grupo22`.`user_info` ;

CREATE TABLE IF NOT EXISTS `tarea3grupo22`.`user_info` (
  `id_user_info` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `user_id` VARCHAR(30) NOT NULL COMMENT '',
  `about` VARCHAR(1000) NULL COMMENT '',
  `location` VARCHAR(45) NULL COMMENT '',
  `birth_date` DATE NULL COMMENT '',
  `work_place` VARCHAR(45) NULL COMMENT '',
  `contact_info` VARCHAR(1000) NULL COMMENT '',
  INDEX `fk_user_info_user1_idx` (`user_id` ASC)  COMMENT '',
  PRIMARY KEY (`id_user_info`)  COMMENT '',
  CONSTRAINT `fk_user_info_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `tarea3grupo22`.`user` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tarea3grupo22`.`uploadsMatch`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tarea3grupo22`.`uploadsMatch` ;

CREATE TABLE IF NOT EXISTS `tarea3grupo22`.`uploadsMatch` (
  `user_id` VARCHAR(30) NOT NULL COMMENT '',
  `matchboard_id` INT NOT NULL COMMENT '',
  PRIMARY KEY (`user_id`, `matchboard_id`)  COMMENT '',
  INDEX `fk_uploadsMatch_matchboard1_idx` (`matchboard_id` ASC)  COMMENT '',
  CONSTRAINT `fk_uploadsMatch_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `tarea3grupo22`.`user` (`username`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_uploadsMatch_matchboard1`
    FOREIGN KEY (`matchboard_id`)
    REFERENCES `tarea3grupo22`.`matchboard` (`matchboard_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tarea3grupo22`.`banStatus`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tarea3grupo22`.`banStatus` ;

CREATE TABLE IF NOT EXISTS `tarea3grupo22`.`banStatus` (
  `id_user` VARCHAR(30) NOT NULL COMMENT '',
  `banned` INT(1) NOT NULL COMMENT '',
  `ban_until` DATETIME NULL COMMENT '',
  `banCause` VARCHAR(45) NULL COMMENT '',
  `banDescription` VARCHAR(45) NULL COMMENT '',
  INDEX `fk_banStatus_user1_idx` (`id_user` ASC)  COMMENT '',
  PRIMARY KEY (`id_user`)  COMMENT '',
  CONSTRAINT `fk_banStatus_user1`
    FOREIGN KEY (`id_user`)
    REFERENCES `tarea3grupo22`.`user` (`username`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `tarea3grupo22`.`userStatus`
-- -----------------------------------------------------
START TRANSACTION;
USE `tarea3grupo22`;
INSERT INTO `tarea3grupo22`.`userStatus` (`iduserStatus`, `name`) VALUES (1, 'Usuario Activo');
INSERT INTO `tarea3grupo22`.`userStatus` (`iduserStatus`, `name`) VALUES (2, 'Usuario Baneado');
INSERT INTO `tarea3grupo22`.`userStatus` (`iduserStatus`, `name`) VALUES (3, 'Usuario Administrador');

COMMIT;


-- -----------------------------------------------------
-- Data for table `tarea3grupo22`.`sex`
-- -----------------------------------------------------
START TRANSACTION;
USE `tarea3grupo22`;
INSERT INTO `tarea3grupo22`.`sex` (`idtable1`, `description`) VALUES ('0', 'Desconocido');
INSERT INTO `tarea3grupo22`.`sex` (`idtable1`, `description`) VALUES ('1', 'Masculino');
INSERT INTO `tarea3grupo22`.`sex` (`idtable1`, `description`) VALUES ('2', 'Femenino');
INSERT INTO `tarea3grupo22`.`sex` (`idtable1`, `description`) VALUES ('9', 'No Aplica');

COMMIT;


-- -----------------------------------------------------
-- Data for table `tarea3grupo22`.`user`
-- -----------------------------------------------------
START TRANSACTION;
USE `tarea3grupo22`;
INSERT INTO `tarea3grupo22`.`user` (`username`, `password`, `first_name`, `last_name`, `email`, `sex`, `avatar`, `userStatus`, `chessClub_idchessClub`, `chessPlayer_idchessPlayer`) VALUES ('user01', 'password', 'Hibiki', 'Tachibana', 'user01@XX.cl', '2', 'avatar0.jpg', 3, NULL, NULL);
INSERT INTO `tarea3grupo22`.`user` (`username`, `password`, `first_name`, `last_name`, `email`, `sex`, `avatar`, `userStatus`, `chessClub_idchessClub`, `chessPlayer_idchessPlayer`) VALUES ('user02', 'password', 'Hikaru', 'Nakamura', 'user02@XX.cl', '1', 'avatar1.jpg', 1, NULL, NULL);
INSERT INTO `tarea3grupo22`.`user` (`username`, `password`, `first_name`, `last_name`, `email`, `sex`, `avatar`, `userStatus`, `chessClub_idchessClub`, `chessPlayer_idchessPlayer`) VALUES ('user03', 'password', 'Magnus', 'Carlsen', 'user03@XX.cl', '1', 'avatar2.jpg', 1, NULL, NULL);
INSERT INTO `tarea3grupo22`.`user` (`username`, `password`, `first_name`, `last_name`, `email`, `sex`, `avatar`, `userStatus`, `chessClub_idchessClub`, `chessPlayer_idchessPlayer`) VALUES ('user04', 'password', 'Maria', 'Cadenzavna', 'user04@XX.cl', '2', 'avatar3.jpg', 1, NULL, NULL);
INSERT INTO `tarea3grupo22`.`user` (`username`, `password`, `first_name`, `last_name`, `email`, `sex`, `avatar`, `userStatus`, `chessClub_idchessClub`, `chessPlayer_idchessPlayer`) VALUES ('user05', 'password', 'Mauricio', 'Muñoz', 'user05@XX.cl', '1', 'avatar4.jpg', 1, NULL, NULL);
INSERT INTO `tarea3grupo22`.`user` (`username`, `password`, `first_name`, `last_name`, `email`, `sex`, `avatar`, `userStatus`, `chessClub_idchessClub`, `chessPlayer_idchessPlayer`) VALUES ('user06', 'password', 'Gerald', 'Zeballos', 'user06@XX.cl', '0', 'avatar5.jpg', 1, NULL, NULL);
INSERT INTO `tarea3grupo22`.`user` (`username`, `password`, `first_name`, `last_name`, `email`, `sex`, `avatar`, `userStatus`, `chessClub_idchessClub`, `chessPlayer_idchessPlayer`) VALUES ('user07', 'password', 'Juan', 'Perez', 'user07@XX.cl', '0', 'avatar6.jpg', 1, NULL, NULL);
INSERT INTO `tarea3grupo22`.`user` (`username`, `password`, `first_name`, `last_name`, `email`, `sex`, `avatar`, `userStatus`, `chessClub_idchessClub`, `chessPlayer_idchessPlayer`) VALUES ('user08', 'password', 'Pablo', 'Pollo', 'user08@XX.cl', '1', 'avatar7.jpg', 1, NULL, NULL);
INSERT INTO `tarea3grupo22`.`user` (`username`, `password`, `first_name`, `last_name`, `email`, `sex`, `avatar`, `userStatus`, `chessClub_idchessClub`, `chessPlayer_idchessPlayer`) VALUES ('user09', 'password', 'Chris', 'Yukine', 'user09@XX.cl', '2', 'avatar8.jpg', 1, NULL, NULL);
INSERT INTO `tarea3grupo22`.`user` (`username`, `password`, `first_name`, `last_name`, `email`, `sex`, `avatar`, `userStatus`, `chessClub_idchessClub`, `chessPlayer_idchessPlayer`) VALUES ('user10', 'password', 'John', 'Titor', 'user10@XX.cl', '1', 'avatar9.jpg', 1, NULL, NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `tarea3grupo22`.`publication`
-- -----------------------------------------------------
START TRANSACTION;
USE `tarea3grupo22`;
INSERT INTO `tarea3grupo22`.`publication` (`idPublication`, `publicationDate`) VALUES (5, '2015-11-18 00:00:00');
INSERT INTO `tarea3grupo22`.`publication` (`idPublication`, `publicationDate`) VALUES (6, '2015-11-18 00:00:00');

COMMIT;


-- -----------------------------------------------------
-- Data for table `tarea3grupo22`.`news`
-- -----------------------------------------------------
START TRANSACTION;
USE `tarea3grupo22`;
INSERT INTO `tarea3grupo22`.`news` (`id_new`, `title`, `date`, `content`, `image_cover`, `category`) VALUES (5, 'Ganadores Primer Torneo Chacriento 2015', '2015-11-13', 'Finaliza el primer torneo chacriento realizado en la FCFM este año 2015.\\r\\nEn la imágen podemos ver a los felices ganadores.\\r\\nDe derecha a izquierda:\\r\\nJuan Pérez     - Plata\\r\\nKevin Rosero - Bronce\\r\\nLuis Pinochet - Oro.\\r\\n\\r\\nExtendemos nuestras felicitaciones a todos los participantes y esperamos puedan seguir asistiendo a los siguientes eventos que se realizarán en la facultad.', '5.jpg', 'fcfm');
INSERT INTO `tarea3grupo22`.`news` (`id_new`, `title`, `date`, `content`, `image_cover`, `category`) VALUES (6, 'Ganadores Segundo Torneo Chacriento 2015', '2015-11-13', 'Finaliza el segundo torneo chacriento realizado en la FCFM este año 2015. En la imágen podemos ver a los felices ganadores.\\r\\nDe derecha a izquierda: \\r\\nPablo Poblete - Plata\\r\\nLuis Pinochet - Oro\\r\\nJuan Pérez - Bronce.\\r\\nExtendemos nuestras felicitaciones a todos los participantes y esperamos puedan seguir asistiendo a los siguientes eventos que se realizarán en la facultad.', '6.jpg', 'fcfm');

COMMIT;


-- -----------------------------------------------------
-- Data for table `tarea3grupo22`.`timestamps`
-- -----------------------------------------------------
START TRANSACTION;
USE `tarea3grupo22`;
INSERT INTO `tarea3grupo22`.`timestamps` (`username`, `update_time`, `create_time`) VALUES ('user01', '2015-11-11', '2015-10-30');
INSERT INTO `tarea3grupo22`.`timestamps` (`username`, `update_time`, `create_time`) VALUES ('user02', '2015-10-30', '2015-10-30');
INSERT INTO `tarea3grupo22`.`timestamps` (`username`, `update_time`, `create_time`) VALUES ('user03', '2015-10-30', '2015-10-30');
INSERT INTO `tarea3grupo22`.`timestamps` (`username`, `update_time`, `create_time`) VALUES ('user05', '2015-10-30', '2015-10-30');
INSERT INTO `tarea3grupo22`.`timestamps` (`username`, `update_time`, `create_time`) VALUES ('user06', '2015-10-30', '2015-10-30');
INSERT INTO `tarea3grupo22`.`timestamps` (`username`, `update_time`, `create_time`) VALUES ('user07', '2015-10-30', '2015-10-30');
INSERT INTO `tarea3grupo22`.`timestamps` (`username`, `update_time`, `create_time`) VALUES ('user08', '2015-10-30', '2015-10-30');
INSERT INTO `tarea3grupo22`.`timestamps` (`username`, `update_time`, `create_time`) VALUES ('user09', '2015-10-30', '2015-10-30');
INSERT INTO `tarea3grupo22`.`timestamps` (`username`, `update_time`, `create_time`) VALUES ('user10', '2015-10-30', '2015-10-30');

COMMIT;


-- -----------------------------------------------------
-- Data for table `tarea3grupo22`.`userPublication`
-- -----------------------------------------------------
START TRANSACTION;
USE `tarea3grupo22`;
INSERT INTO `tarea3grupo22`.`userPublication` (`id_user`, `id_publication`, `last_changed`) VALUES ('user01', 5, NULL);
INSERT INTO `tarea3grupo22`.`userPublication` (`id_user`, `id_publication`, `last_changed`) VALUES ('user01', 6, NULL);

COMMIT;
