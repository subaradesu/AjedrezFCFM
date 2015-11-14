-- MySQL Script generated by MySQL Workbench
-- 11/14/15 20:27:55
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema ajedrezfcfm
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ajedrezfcfm
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ajedrezfcfm` DEFAULT CHARACTER SET utf8 ;
USE `ajedrezfcfm` ;

-- -----------------------------------------------------
-- Table `ajedrezfcfm`.`userStatus`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajedrezfcfm`.`userStatus` ;

CREATE TABLE IF NOT EXISTS `ajedrezfcfm`.`userStatus` (
  `iduserStatus` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `until` DATETIME NULL,
  PRIMARY KEY (`iduserStatus`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ajedrezfcfm`.`chessClub`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajedrezfcfm`.`chessClub` ;

CREATE TABLE IF NOT EXISTS `ajedrezfcfm`.`chessClub` (
  `idchessClub` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  `description` VARCHAR(255) NULL,
  `website` VARCHAR(45) NULL,
  PRIMARY KEY (`idchessClub`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ajedrezfcfm`.`chessPlayer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajedrezfcfm`.`chessPlayer` ;

CREATE TABLE IF NOT EXISTS `ajedrezfcfm`.`chessPlayer` (
  `idchessPlayer` INT NOT NULL,
  `chessPlayercol` VARCHAR(45) NULL,
  `playerName` VARCHAR(45) NULL,
  PRIMARY KEY (`idchessPlayer`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ajedrezfcfm`.`sex`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajedrezfcfm`.`sex` ;

CREATE TABLE IF NOT EXISTS `ajedrezfcfm`.`sex` (
  `idtable1` CHAR(1) NOT NULL,
  `description` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idtable1`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ajedrezfcfm`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajedrezfcfm`.`user` ;

CREATE TABLE IF NOT EXISTS `ajedrezfcfm`.`user` (
  `username` VARCHAR(30) NOT NULL,
  `password` VARCHAR(30) NOT NULL,
  `first_name` VARCHAR(50) NOT NULL,
  `last_name` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `sex` CHAR(1) NULL,
  `avatar` VARCHAR(100) NULL,
  `userStatus` INT NOT NULL,
  `chessClub_idchessClub` INT NULL,
  `chessPlayer_idchessPlayer` INT NULL,
  PRIMARY KEY (`username`),
  INDEX `fk_User_userStatus_idx` (`userStatus` ASC),
  INDEX `fk_user_chessClub1_idx` (`chessClub_idchessClub` ASC),
  INDEX `fk_user_chessPlayer1_idx` (`chessPlayer_idchessPlayer` ASC),
  INDEX `fk_user_sex1_idx` (`sex` ASC),
  CONSTRAINT `fk_User_userStatus`
    FOREIGN KEY (`userStatus`)
    REFERENCES `ajedrezfcfm`.`userStatus` (`iduserStatus`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_chessClub1`
    FOREIGN KEY (`chessClub_idchessClub`)
    REFERENCES `ajedrezfcfm`.`chessClub` (`idchessClub`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `fk_user_chessPlayer1`
    FOREIGN KEY (`chessPlayer_idchessPlayer`)
    REFERENCES `ajedrezfcfm`.`chessPlayer` (`idchessPlayer`)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  CONSTRAINT `fk_user_sex1`
    FOREIGN KEY (`sex`)
    REFERENCES `ajedrezfcfm`.`sex` (`idtable1`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ajedrezfcfm`.`publication`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajedrezfcfm`.`publication` ;

CREATE TABLE IF NOT EXISTS `ajedrezfcfm`.`publication` (
  `idPublication` INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idPublication`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ajedrezfcfm`.`comment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajedrezfcfm`.`comment` ;

CREATE TABLE IF NOT EXISTS `ajedrezfcfm`.`comment` (
  `id_comment` INT NOT NULL,
  `commented_publication` INT NOT NULL,
  `content` VARCHAR(1000) NOT NULL,
  `date` DATE NOT NULL,
  PRIMARY KEY (`id_comment`),
  INDEX `fk_comment_publication2_idx` (`commented_publication` ASC),
  CONSTRAINT `fk_comment_publication1`
    FOREIGN KEY (`id_comment`)
    REFERENCES `ajedrezfcfm`.`publication` (`idPublication`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_comment_publication2`
    FOREIGN KEY (`commented_publication`)
    REFERENCES `ajedrezfcfm`.`publication` (`idPublication`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ajedrezfcfm`.`news`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajedrezfcfm`.`news` ;

CREATE TABLE IF NOT EXISTS `ajedrezfcfm`.`news` (
  `id_new` INT NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `date` DATE NOT NULL,
  `content` VARCHAR(1000) NULL,
  `image_url` VARCHAR(45) NULL,
  `video_url` VARCHAR(45) NULL,
  `category` VARCHAR(45) NULL,
  PRIMARY KEY (`id_new`),
  INDEX `fk_news_publication1_idx` (`id_new` ASC),
  CONSTRAINT `fk_news_publication1`
    FOREIGN KEY (`id_new`)
    REFERENCES `ajedrezfcfm`.`publication` (`idPublication`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ajedrezfcfm`.`timestamps`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajedrezfcfm`.`timestamps` ;

CREATE TABLE IF NOT EXISTS `ajedrezfcfm`.`timestamps` (
  `username` VARCHAR(30) NOT NULL,
  `update_time` DATE NULL,
  `create_time` DATE NULL,
  INDEX `fk_activity_User1_idx` (`username` ASC),
  PRIMARY KEY (`username`),
  CONSTRAINT `fk_activity_User1`
    FOREIGN KEY (`username`)
    REFERENCES `ajedrezfcfm`.`user` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ajedrezfcfm`.`privateMessage`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajedrezfcfm`.`privateMessage` ;

CREATE TABLE IF NOT EXISTS `ajedrezfcfm`.`privateMessage` (
  `idprivateMessage` INT NOT NULL,
  `content` VARCHAR(255) NOT NULL,
  `sender_username` VARCHAR(30) NOT NULL,
  `receiver_username` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`idprivateMessage`),
  INDEX `fk_privateMessage_user1_idx` (`sender_username` ASC),
  INDEX `fk_privateMessage_user2_idx` (`receiver_username` ASC),
  CONSTRAINT `fk_privateMessage_user1`
    FOREIGN KEY (`sender_username`)
    REFERENCES `ajedrezfcfm`.`user` (`username`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_privateMessage_user2`
    FOREIGN KEY (`receiver_username`)
    REFERENCES `ajedrezfcfm`.`user` (`username`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ajedrezfcfm`.`publicationKarma`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajedrezfcfm`.`publicationKarma` ;

CREATE TABLE IF NOT EXISTS `ajedrezfcfm`.`publicationKarma` (
  `publication_idPublication` INT NOT NULL,
  `user_username` VARCHAR(30) NOT NULL,
  `value` INT(11) NOT NULL,
  PRIMARY KEY (`publication_idPublication`, `user_username`),
  INDEX `fk_publicationKarma_user1_idx` (`user_username` ASC),
  CONSTRAINT `fk_publicationKarma_publication1`
    FOREIGN KEY (`publication_idPublication`)
    REFERENCES `ajedrezfcfm`.`publication` (`idPublication`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_publicationKarma_user1`
    FOREIGN KEY (`user_username`)
    REFERENCES `ajedrezfcfm`.`user` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ajedrezfcfm`.`event`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajedrezfcfm`.`event` ;

CREATE TABLE IF NOT EXISTS `ajedrezfcfm`.`event` (
  `id_event` INT NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `description` VARCHAR(255) NOT NULL,
  `date` VARCHAR(45) NOT NULL,
  `time` VARCHAR(45) NOT NULL,
  `place` VARCHAR(45) NOT NULL,
  `visibility` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_event`),
  INDEX `fk_event_publication1_idx` (`id_event` ASC),
  CONSTRAINT `fk_event_publication1`
    FOREIGN KEY (`id_event`)
    REFERENCES `ajedrezfcfm`.`publication` (`idPublication`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ajedrezfcfm`.`invitedList`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajedrezfcfm`.`invitedList` ;

CREATE TABLE IF NOT EXISTS `ajedrezfcfm`.`invitedList` (
  `id_event` INT NOT NULL,
  `id_user` VARCHAR(30) NOT NULL,
  `assistance` VARCHAR(45) NOT NULL,
  `show_notification` TINYINT(1) NOT NULL,
  INDEX `fk_invitedList_event1_idx` (`id_event` ASC),
  INDEX `fk_invitedList_user1_idx` (`id_user` ASC),
  PRIMARY KEY (`id_event`, `id_user`),
  CONSTRAINT `fk_invitedList_event1`
    FOREIGN KEY (`id_event`)
    REFERENCES `ajedrezfcfm`.`event` (`id_event`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_invitedList_user1`
    FOREIGN KEY (`id_user`)
    REFERENCES `ajedrezfcfm`.`user` (`username`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ajedrezfcfm`.`contentTag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajedrezfcfm`.`contentTag` ;

CREATE TABLE IF NOT EXISTS `ajedrezfcfm`.`contentTag` (
  `tag_name` VARCHAR(45) NOT NULL,
  `tag_description` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`tag_name`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ajedrezfcfm`.`userTag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajedrezfcfm`.`userTag` ;

CREATE TABLE IF NOT EXISTS `ajedrezfcfm`.`userTag` (
  `id_publication` INT NOT NULL,
  `id_user` VARCHAR(30) NOT NULL,
  `untagged` TINYINT(1) NULL,
  PRIMARY KEY (`id_publication`, `id_user`),
  INDEX `fk_userTag_user1_idx` (`id_user` ASC),
  CONSTRAINT `fk_userTag_publication1`
    FOREIGN KEY (`id_publication`)
    REFERENCES `ajedrezfcfm`.`publication` (`idPublication`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_userTag_user1`
    FOREIGN KEY (`id_user`)
    REFERENCES `ajedrezfcfm`.`user` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ajedrezfcfm`.`publicationTag`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajedrezfcfm`.`publicationTag` ;

CREATE TABLE IF NOT EXISTS `ajedrezfcfm`.`publicationTag` (
  `idPublication` INT NOT NULL,
  `tag_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idPublication`, `tag_name`),
  INDEX `fk_publicationTag_contentTag1_idx` (`tag_name` ASC),
  CONSTRAINT `fk_publicationTag_publication1`
    FOREIGN KEY (`idPublication`)
    REFERENCES `ajedrezfcfm`.`publication` (`idPublication`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_publicationTag_contentTag1`
    FOREIGN KEY (`tag_name`)
    REFERENCES `ajedrezfcfm`.`contentTag` (`tag_name`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ajedrezfcfm`.`userPublication`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajedrezfcfm`.`userPublication` ;

CREATE TABLE IF NOT EXISTS `ajedrezfcfm`.`userPublication` (
  `id_user` VARCHAR(30) NOT NULL,
  `id_publication` INT NOT NULL,
  PRIMARY KEY (`id_user`, `id_publication`),
  INDEX `fk_user_publication_publication1_idx` (`id_publication` ASC),
  CONSTRAINT `fk_user_publication_user1`
    FOREIGN KEY (`id_user`)
    REFERENCES `ajedrezfcfm`.`user` (`username`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_user_publication_publication1`
    FOREIGN KEY (`id_publication`)
    REFERENCES `ajedrezfcfm`.`publication` (`idPublication`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ajedrezfcfm`.`elo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajedrezfcfm`.`elo` ;

CREATE TABLE IF NOT EXISTS `ajedrezfcfm`.`elo` (
  `idchessPlayer` INT NOT NULL,
  `date` DATE NOT NULL,
  `elo` INT NOT NULL,
  `k` INT NOT NULL,
  PRIMARY KEY (`idchessPlayer`, `date`),
  INDEX `fk_elo_chessPlayer1_idx` (`idchessPlayer` ASC),
  CONSTRAINT `fk_elo_chessPlayer1`
    FOREIGN KEY (`idchessPlayer`)
    REFERENCES `ajedrezfcfm`.`chessPlayer` (`idchessPlayer`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ajedrezfcfm`.`matchboard`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajedrezfcfm`.`matchboard` ;

CREATE TABLE IF NOT EXISTS `ajedrezfcfm`.`matchboard` (
  `matchboard_id` INT NOT NULL AUTO_INCREMENT,
  `white_player` VARCHAR(100) NOT NULL,
  `black_player` VARCHAR(100) NOT NULL,
  `match_origin` INT(1) NOT NULL DEFAULT 0,
  `details` VARCHAR(1000) NULL,
  `format` INT(1) NOT NULL DEFAULT 0,
  `pgn_board` VARCHAR(45) NULL DEFAULT NULL,
  `pgn_string` VARCHAR(45) NULL DEFAULT NULL,
  `input_date` DATE NULL DEFAULT NULL,
  `title` VARCHAR(45) NOT NULL,
  `matchboardcol` VARCHAR(45) NULL,
  PRIMARY KEY (`matchboard_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ajedrezfcfm`.`user_info`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajedrezfcfm`.`user_info` ;

CREATE TABLE IF NOT EXISTS `ajedrezfcfm`.`user_info` (
  `user_id` VARCHAR(30) NOT NULL,
  `about` VARCHAR(1000) NULL,
  `location` VARCHAR(45) NULL,
  `birth_date` DATE NULL,
  `work_place` VARCHAR(45) NULL,
  `contact_info` VARCHAR(1000) NULL,
  INDEX `fk_user_info_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_user_info_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `ajedrezfcfm`.`user` (`username`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ajedrezfcfm`.`uploadsMatch`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ajedrezfcfm`.`uploadsMatch` ;

CREATE TABLE IF NOT EXISTS `ajedrezfcfm`.`uploadsMatch` (
  `user_id` VARCHAR(30) NOT NULL,
  `matchboard_id` INT NOT NULL,
  PRIMARY KEY (`user_id`, `matchboard_id`),
  INDEX `fk_uploadsMatch_matchboard1_idx` (`matchboard_id` ASC),
  CONSTRAINT `fk_uploadsMatch_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `ajedrezfcfm`.`user` (`username`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_uploadsMatch_matchboard1`
    FOREIGN KEY (`matchboard_id`)
    REFERENCES `ajedrezfcfm`.`matchboard` (`matchboard_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `ajedrezfcfm`.`userStatus`
-- -----------------------------------------------------
START TRANSACTION;
USE `ajedrezfcfm`;
INSERT INTO `ajedrezfcfm`.`userStatus` (`iduserStatus`, `name`, `until`) VALUES (1, 'Usuario Activo', NULL);
INSERT INTO `ajedrezfcfm`.`userStatus` (`iduserStatus`, `name`, `until`) VALUES (2, 'Usuario Baneado', NULL);
INSERT INTO `ajedrezfcfm`.`userStatus` (`iduserStatus`, `name`, `until`) VALUES (3, 'Usuario Administrador', NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `ajedrezfcfm`.`sex`
-- -----------------------------------------------------
START TRANSACTION;
USE `ajedrezfcfm`;
INSERT INTO `ajedrezfcfm`.`sex` (`idtable1`, `description`) VALUES ('0', 'Desconocido');
INSERT INTO `ajedrezfcfm`.`sex` (`idtable1`, `description`) VALUES ('1', 'Masculino');
INSERT INTO `ajedrezfcfm`.`sex` (`idtable1`, `description`) VALUES ('2', 'Femenino');
INSERT INTO `ajedrezfcfm`.`sex` (`idtable1`, `description`) VALUES ('9', 'No Aplica');

COMMIT;


-- -----------------------------------------------------
-- Data for table `ajedrezfcfm`.`user`
-- -----------------------------------------------------
START TRANSACTION;
USE `ajedrezfcfm`;
INSERT INTO `ajedrezfcfm`.`user` (`username`, `password`, `first_name`, `last_name`, `email`, `sex`, `avatar`, `userStatus`, `chessClub_idchessClub`, `chessPlayer_idchessPlayer`) VALUES ('user01', 'password', 'Hibiki', 'Tachibana', 'user01@XX.cl', '2', 'avatar0.jpg', 3, NULL, NULL);
INSERT INTO `ajedrezfcfm`.`user` (`username`, `password`, `first_name`, `last_name`, `email`, `sex`, `avatar`, `userStatus`, `chessClub_idchessClub`, `chessPlayer_idchessPlayer`) VALUES ('user02', 'password', 'Hikaru', 'Nakamura', 'user02@XX.cl', '1', 'avatar1.jpg', 1, NULL, NULL);
INSERT INTO `ajedrezfcfm`.`user` (`username`, `password`, `first_name`, `last_name`, `email`, `sex`, `avatar`, `userStatus`, `chessClub_idchessClub`, `chessPlayer_idchessPlayer`) VALUES ('user03', 'password', 'Magnus', 'Carlsen', 'user03@XX.cl', '1', 'avatar2.jpg', 1, NULL, NULL);
INSERT INTO `ajedrezfcfm`.`user` (`username`, `password`, `first_name`, `last_name`, `email`, `sex`, `avatar`, `userStatus`, `chessClub_idchessClub`, `chessPlayer_idchessPlayer`) VALUES ('user04', 'password', 'Maria', 'Cadenzavna', 'user04@XX.cl', '2', 'avatar3.jpg', 1, NULL, NULL);
INSERT INTO `ajedrezfcfm`.`user` (`username`, `password`, `first_name`, `last_name`, `email`, `sex`, `avatar`, `userStatus`, `chessClub_idchessClub`, `chessPlayer_idchessPlayer`) VALUES ('user05', 'password', 'Mauricio', 'Muñoz', 'user05@XX.cl', '1', 'avatar4.jpg', 1, NULL, NULL);
INSERT INTO `ajedrezfcfm`.`user` (`username`, `password`, `first_name`, `last_name`, `email`, `sex`, `avatar`, `userStatus`, `chessClub_idchessClub`, `chessPlayer_idchessPlayer`) VALUES ('user06', 'password', 'Gerald', 'Zeballos', 'user06@XX.cl', '0', 'avatar5.jpg', 1, NULL, NULL);
INSERT INTO `ajedrezfcfm`.`user` (`username`, `password`, `first_name`, `last_name`, `email`, `sex`, `avatar`, `userStatus`, `chessClub_idchessClub`, `chessPlayer_idchessPlayer`) VALUES ('user07', 'password', 'Juan', 'Perez', 'user07@XX.cl', '0', 'avatar6.jpg', 1, NULL, NULL);
INSERT INTO `ajedrezfcfm`.`user` (`username`, `password`, `first_name`, `last_name`, `email`, `sex`, `avatar`, `userStatus`, `chessClub_idchessClub`, `chessPlayer_idchessPlayer`) VALUES ('user08', 'password', 'Pablo', 'Pollo', 'user08@XX.cl', '1', 'avatar7.jpg', 1, NULL, NULL);
INSERT INTO `ajedrezfcfm`.`user` (`username`, `password`, `first_name`, `last_name`, `email`, `sex`, `avatar`, `userStatus`, `chessClub_idchessClub`, `chessPlayer_idchessPlayer`) VALUES ('user09', 'password', 'Chris', 'Yukine', 'user09@XX.cl', '2', 'avatar8.jpg', 1, NULL, NULL);
INSERT INTO `ajedrezfcfm`.`user` (`username`, `password`, `first_name`, `last_name`, `email`, `sex`, `avatar`, `userStatus`, `chessClub_idchessClub`, `chessPlayer_idchessPlayer`) VALUES ('user10', 'password', 'John', 'Titor', 'user10@XX.cl', '1', 'avatar9.jpg', 1, NULL, NULL);

COMMIT;
