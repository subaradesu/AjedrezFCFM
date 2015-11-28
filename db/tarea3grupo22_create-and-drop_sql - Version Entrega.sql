-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 11-11-2015 a las 00:35:07
-- Versión del servidor: 5.5.46-0ubuntu0.14.04.2
-- Versión de PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `tarea3grupo22`
--
CREATE DATABASE IF NOT EXISTS `tarea3grupo22` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `tarea3grupo22`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `annotatedgame`
--

DROP TABLE IF EXISTS `annotatedgame`;
CREATE TABLE IF NOT EXISTS `annotatedgame` (
  `idplayed` int(11) NOT NULL,
  `white_player` int(11) NOT NULL,
  `elo_white_game` int(11) DEFAULT NULL,
  `black_player` int(11) NOT NULL,
  `elo_black_game` int(11) DEFAULT NULL,
  `chessPosition_idchessPosition` int(11) NOT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`idplayed`,`white_player`,`black_player`,`chessPosition_idchessPosition`),
  KEY `fk_played_chessPlayer1_idx` (`white_player`),
  KEY `fk_played_chessPlayer2_idx` (`black_player`),
  KEY `fk_played_chessPosition1_idx` (`chessPosition_idchessPosition`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chessclub`
--

DROP TABLE IF EXISTS `chessclub`;
CREATE TABLE IF NOT EXISTS `chessclub` (
  `idchessClub` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `website` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idchessClub`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chessplayer`
--

DROP TABLE IF EXISTS `chessplayer`;
CREATE TABLE IF NOT EXISTS `chessplayer` (
  `idchessPlayer` int(11) NOT NULL,
  `chessPlayercol` varchar(45) DEFAULT NULL,
  `playerName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idchessPlayer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chessposition`
--

DROP TABLE IF EXISTS `chessposition`;
CREATE TABLE IF NOT EXISTS `chessposition` (
  `idchessPosition` int(11) NOT NULL,
  `pgn_filename` varchar(50) NOT NULL,
  PRIMARY KEY (`idchessPosition`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `idComment` int(11) NOT NULL,
  `commented_publication` int(11) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`idComment`),
  KEY `fk_comment_publication2_idx` (`commented_publication`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenttag`
--

DROP TABLE IF EXISTS `contenttag`;
CREATE TABLE IF NOT EXISTS `contenttag` (
  `tag_name` varchar(45) NOT NULL,
  `tag_description` varchar(255) NOT NULL,
  PRIMARY KEY (`tag_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elo`
--

DROP TABLE IF EXISTS `elo`;
CREATE TABLE IF NOT EXISTS `elo` (
  `idchessPlayer` int(11) NOT NULL,
  `date` date NOT NULL,
  `elo` int(11) NOT NULL,
  `k` int(11) NOT NULL,
  PRIMARY KEY (`idchessPlayer`,`date`),
  KEY `fk_elo_chessPlayer1_idx` (`idchessPlayer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `publication_idPublication` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` varchar(45) NOT NULL,
  `time` varchar(45) NOT NULL,
  `place` varchar(45) NOT NULL,
  `visibility` varchar(45) NOT NULL,
  PRIMARY KEY (`publication_idPublication`),
  KEY `fk_event_publication1_idx` (`publication_idPublication`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gamereference`
--

DROP TABLE IF EXISTS `gamereference`;
CREATE TABLE IF NOT EXISTS `gamereference` (
  `chessPosition_idchessPosition` int(11) NOT NULL,
  `publication_idPublication` int(11) NOT NULL,
  PRIMARY KEY (`chessPosition_idchessPosition`,`publication_idPublication`),
  KEY `fk_gameReference_publication1_idx` (`publication_idPublication`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invitedlist`
--

DROP TABLE IF EXISTS `invitedlist`;
CREATE TABLE IF NOT EXISTS `invitedlist` (
  `idevent` int(11) NOT NULL,
  `invited_username` varchar(30) NOT NULL,
  `assistance` varchar(45) NOT NULL,
  `show_notification` tinyint(1) NOT NULL,
  PRIMARY KEY (`idevent`,`invited_username`),
  KEY `fk_invitedList_event1_idx` (`idevent`),
  KEY `fk_invitedList_user1_idx` (`invited_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `match`
--

DROP TABLE IF EXISTS `match`;
CREATE TABLE IF NOT EXISTS `match` (
  `idmatch` int(11) NOT NULL AUTO_INCREMENT,
  `white_player` int(11) NOT NULL,
  `black_player` int(11) NOT NULL,
  PRIMARY KEY (`idmatch`),
  KEY `fk_match_chessPlayer1_idx` (`white_player`),
  KEY `fk_match_chessPlayer2_idx` (`black_player`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matchboard`
--

DROP TABLE IF EXISTS `matchboard`;
CREATE TABLE IF NOT EXISTS `matchboard` (
  `matchboard_id` int(11) NOT NULL AUTO_INCREMENT,
  `white_player` varchar(100) NOT NULL,
  `black_player` varchar(100) NOT NULL,
  `match_origin` int(7) NOT NULL DEFAULT '0',
  `details` text,
  `format` int(1) NOT NULL DEFAULT '0',
  `pgn_board` varchar(255) DEFAULT NULL,
  `pgn_string` varchar(255) DEFAULT NULL,
  `input_date` date DEFAULT NULL,
  PRIMARY KEY (`matchboard_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `matchboard`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matchesplayed`
--

DROP TABLE IF EXISTS `matchesplayed`;
CREATE TABLE IF NOT EXISTS `matchesplayed` (
  `idtournament` int(11) NOT NULL,
  `idtournamentRound` int(11) NOT NULL,
  `match_idmatch` int(11) NOT NULL,
  PRIMARY KEY (`idtournament`,`idtournamentRound`,`match_idmatch`),
  KEY `fk_matchesPlayed_match1_idx` (`match_idmatch`),
  KEY `fk_matchesPlayed_tournamentRound1` (`idtournamentRound`,`idtournament`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `idNew` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `date` date NOT NULL,
  `content` varchar(1000) DEFAULT NULL,
  `image_url` varchar(45) DEFAULT NULL,
  `video_url` varchar(45) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idNew`),
  KEY `fk_news_publication1_idx` (`idNew`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `news`
--
INSERT INTO `news` (`idNew`, `title`, `date`, `content`, `image_url`, `video_url`, `category`) VALUES
(5, 'Ganadores Primer Torneo Chacriento 2015', '2015-11-13', 'Finaliza el primer torneo chacriento realizado en la FCFM este año 2015.\r\nEn la imágen podemos ver a los felices ganadores.\r\nDe derecha a izquierda:\r\nJuan Pérez     - Plata\r\nKevin Rosero - Bronce\r\nLuis Pinochet - Oro.\r\n\r\nExtendemos nuestras felicitaciones a todos los participantes y esperamos puedan seguir asistiendo a los siguientes eventos que se realizarán en la facultad.', '5.jpg', NULL, 'fcfm'),
(6, 'Ganadores Segundo Torneo Chacriento 2015', '2015-11-13', 'Finaliza el segundo torneo chacriento realizado en la FCFM este año 2015. En la imágen podemos ver a los felices ganadores.\r\nDe derecha a izquierda: \r\nPablo Poblete - Plata\r\nLuis Pinochet - Oro\r\nJuan Pérez - Bronce.\r\nExtendemos nuestras felicitaciones a todos los participantes y esperamos puedan seguir asistiendo a los siguientes eventos que se realizarán en la facultad.', '6.jpg', NULL, 'fcfm');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privatemessage`
--

DROP TABLE IF EXISTS `privatemessage`;
CREATE TABLE IF NOT EXISTS `privatemessage` (
  `idprivateMessage` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `sender_username` varchar(30) NOT NULL,
  `receiver_username` varchar(30) NOT NULL,
  PRIMARY KEY (`idprivateMessage`),
  KEY `fk_privateMessage_user1_idx` (`sender_username`),
  KEY `fk_privateMessage_user2_idx` (`receiver_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publication`
--

DROP TABLE IF EXISTS `publication`;
CREATE TABLE IF NOT EXISTS `publication` (
  `idPublication` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idPublication`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `publication`
--

INSERT INTO `publication` (`idPublication`) VALUES
(5),
(6);


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicationkarma`
--

DROP TABLE IF EXISTS `publicationkarma`;
CREATE TABLE IF NOT EXISTS `publicationkarma` (
  `publication_idPublication` int(11) NOT NULL,
  `user_username` varchar(30) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`publication_idPublication`,`user_username`),
  KEY `fk_publicationKarma_user1_idx` (`user_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicationtag`
--

DROP TABLE IF EXISTS `publicationtag`;
CREATE TABLE IF NOT EXISTS `publicationtag` (
  `idPublication` int(11) NOT NULL,
  `tag_name` varchar(45) NOT NULL,
  PRIMARY KEY (`idPublication`,`tag_name`),
  KEY `fk_publicationTag_contentTag1_idx` (`tag_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sex`
--

DROP TABLE IF EXISTS `sex`;
CREATE TABLE IF NOT EXISTS `sex` (
  `idtable1` char(1) NOT NULL,
  `description` varchar(45) NOT NULL,
  PRIMARY KEY (`idtable1`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sex`
--

INSERT INTO `sex` (`idtable1`, `description`) VALUES
('0', 'Desconocido'),
('1', 'Masculino'),
('2', 'Femenino'),
('9', 'No Aplica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `timestamps`
--

DROP TABLE IF EXISTS `timestamps`;
CREATE TABLE IF NOT EXISTS `timestamps` (
  `username` varchar(30) NOT NULL,
  `update_time` date DEFAULT NULL,
  `create_time` date DEFAULT NULL,
  PRIMARY KEY (`username`),
  KEY `fk_activity_User1_idx` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `timestamps`
--

INSERT INTO `timestamps` (`username`, `update_time`, `create_time`) VALUES
('hola', '2015-10-30', '2015-10-30'),
('user01', '2015-11-11', '2015-10-30'),
('user02', '2015-10-30', '2015-10-30'),
('user03', '2015-10-30', '2015-10-30'),
('user04', '2015-10-30', '2015-10-30'),
('user05', '2015-10-30', '2015-10-30'),
('user06', '2015-10-30', '2015-10-30'),
('user07', '2015-10-30', '2015-10-30'),
('user08', '2015-10-30', '2015-10-30'),
('user09', '2015-10-30', '2015-10-30'),
('user10', '2015-10-30', '2015-10-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tournament`
--

DROP TABLE IF EXISTS `tournament`;
CREATE TABLE IF NOT EXISTS `tournament` (
  `idtournament` int(11) NOT NULL AUTO_INCREMENT,
  `tournament_filename` varchar(45) NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`idtournament`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tournamentround`
--

DROP TABLE IF EXISTS `tournamentround`;
CREATE TABLE IF NOT EXISTS `tournamentround` (
  `idtournamentRound` int(11) NOT NULL,
  `tournament_idtournament` int(11) NOT NULL,
  PRIMARY KEY (`idtournamentRound`,`tournament_idtournament`),
  KEY `fk_tournamentRound_tournament1_idx` (`tournament_idtournament`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sex` char(1) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `userStatus` int(11) NOT NULL,
  `chessClub_idchessClub` int(11) DEFAULT NULL,
  `chessPlayer_idchessPlayer` int(11) DEFAULT NULL,
  PRIMARY KEY (`username`),
  KEY `fk_User_userStatus_idx` (`userStatus`),
  KEY `fk_user_chessClub1_idx` (`chessClub_idchessClub`),
  KEY `fk_user_chessPlayer1_idx` (`chessPlayer_idchessPlayer`),
  KEY `fk_user_sex1_idx` (`sex`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`username`, `password`, `first_name`, `last_name`, `email`, `sex`, `avatar`, `userStatus`, `chessClub_idchessClub`, `chessPlayer_idchessPlayer`) VALUES
('hola', 'hola', 'Hola', 'Chao', 'h@h.cl', '0', 'defaultAvatar.jpg', 1, NULL, NULL),
('user01', 'password', 'Hibiki', 'Tachibana', 'user01@XX.cl', '2', 'avatar0.jpg', 3, NULL, NULL),
('user02', 'password', 'Hikaru', 'Nakamura', 'user02@XX.cl', '1', 'avatar1.jpg', 1, NULL, NULL),
('user03', 'password', 'Magnus', 'Carlsen', 'user03@XX.cl', '1', 'avatar2.jpg', 1, NULL, NULL),
('user04', 'password', 'Maria', 'Cadenzavna', 'user04@XX.cl', '2', 'avatar3.jpg', 1, NULL, NULL),
('user05', 'password', 'Mauricio', 'Muñoz', 'user05@XX.cl', '1', 'avatar4.jpg', 1, NULL, NULL),
('user06', 'password', 'Gerald', 'Zeballos', 'user06@XX.cl', '0', 'avatar5.jpg', 1, NULL, NULL),
('user07', 'password', 'Juan', 'Perez', 'user07@XX.cl', '0', 'avatar6.jpg', 1, NULL, NULL),
('user08', 'password', 'Pablo', 'Pollo', 'user08@XX.cl', '1', 'avatar7.jpg', 2, NULL, NULL),
('user09', 'password', 'Chris', 'Yukine', 'user09@XX.cl', '2', 'avatar8.jpg', 1, NULL, NULL),
('user10', 'password', 'John', 'Titor', 'user10@XX.cl', '1', 'avatar9.jpg', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userpublication`
--

DROP TABLE IF EXISTS `userpublication`;
CREATE TABLE IF NOT EXISTS `userpublication` (
  `user_username` varchar(30) NOT NULL,
  `publication_idPublication` int(11) NOT NULL,
  PRIMARY KEY (`user_username`,`publication_idPublication`),
  KEY `fk_user_publication_publication1_idx` (`publication_idPublication`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `userpublication`
--
INSERT INTO `userpublication` (`user_username`, `publication_idPublication`) VALUES
('user01', 5),
('user01', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `userstatus`
--

DROP TABLE IF EXISTS `userstatus`;
CREATE TABLE IF NOT EXISTS `userstatus` (
  `iduserStatus` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`iduserStatus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `userstatus`
--

INSERT INTO `userstatus` (`iduserStatus`, `name`) VALUES
(1, 'Usuario Activo'),
(2, 'Usuario Baneado'),
(3, 'Usuario Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usertag`
--

DROP TABLE IF EXISTS `usertag`;
CREATE TABLE IF NOT EXISTS `usertag` (
  `publication_idPublication` int(11) NOT NULL,
  `user_username` varchar(30) NOT NULL,
  `untagged` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`publication_idPublication`,`user_username`),
  KEY `fk_userTag_user1_idx` (`user_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `annotatedgame`
--
ALTER TABLE `annotatedgame`
  ADD CONSTRAINT `fk_played_chessPlayer1` FOREIGN KEY (`white_player`) REFERENCES `chessplayer` (`idchessPlayer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_played_chessPlayer2` FOREIGN KEY (`black_player`) REFERENCES `chessplayer` (`idchessPlayer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_played_chessPosition1` FOREIGN KEY (`chessPosition_idchessPosition`) REFERENCES `chessposition` (`idchessPosition`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_comment_publication1` FOREIGN KEY (`idComment`) REFERENCES `publication` (`idPublication`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comment_publication2` FOREIGN KEY (`commented_publication`) REFERENCES `publication` (`idPublication`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `elo`
--
ALTER TABLE `elo`
  ADD CONSTRAINT `fk_elo_chessPlayer1` FOREIGN KEY (`idchessPlayer`) REFERENCES `chessplayer` (`idchessPlayer`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `fk_event_publication1` FOREIGN KEY (`publication_idPublication`) REFERENCES `publication` (`idPublication`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `gamereference`
--
ALTER TABLE `gamereference`
  ADD CONSTRAINT `fk_gameReference_chessPosition1` FOREIGN KEY (`chessPosition_idchessPosition`) REFERENCES `chessposition` (`idchessPosition`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_gameReference_publication1` FOREIGN KEY (`publication_idPublication`) REFERENCES `publication` (`idPublication`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `invitedlist`
--
ALTER TABLE `invitedlist`
  ADD CONSTRAINT `fk_invitedList_event1` FOREIGN KEY (`idevent`) REFERENCES `event` (`publication_idPublication`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_invitedList_user1` FOREIGN KEY (`invited_username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `match`
--
ALTER TABLE `match`
  ADD CONSTRAINT `fk_match_chessPlayer1` FOREIGN KEY (`white_player`) REFERENCES `chessplayer` (`idchessPlayer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_match_chessPlayer2` FOREIGN KEY (`black_player`) REFERENCES `chessplayer` (`idchessPlayer`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `matchesplayed`
--
ALTER TABLE `matchesplayed`
  ADD CONSTRAINT `fk_matchesPlayed_match1` FOREIGN KEY (`match_idmatch`) REFERENCES `match` (`idmatch`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_matchesPlayed_tournamentRound1` FOREIGN KEY (`idtournamentRound`, `idtournament`) REFERENCES `tournamentround` (`idtournamentRound`, `tournament_idtournament`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `fk_news_publication1` FOREIGN KEY (`idNew`) REFERENCES `publication` (`idPublication`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `privatemessage`
--
ALTER TABLE `privatemessage`
  ADD CONSTRAINT `fk_privateMessage_user1` FOREIGN KEY (`sender_username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_privateMessage_user2` FOREIGN KEY (`receiver_username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `publicationkarma`
--
ALTER TABLE `publicationkarma`
  ADD CONSTRAINT `fk_publicationKarma_publication1` FOREIGN KEY (`publication_idPublication`) REFERENCES `publication` (`idPublication`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_publicationKarma_user1` FOREIGN KEY (`user_username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `publicationtag`
--
ALTER TABLE `publicationtag`
  ADD CONSTRAINT `fk_publicationTag_contentTag1` FOREIGN KEY (`tag_name`) REFERENCES `contenttag` (`tag_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_publicationTag_publication1` FOREIGN KEY (`idPublication`) REFERENCES `publication` (`idPublication`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `timestamps`
--
ALTER TABLE `timestamps`
  ADD CONSTRAINT `fk_activity_User1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tournamentround`
--
ALTER TABLE `tournamentround`
  ADD CONSTRAINT `fk_tournamentRound_tournament1` FOREIGN KEY (`tournament_idtournament`) REFERENCES `tournament` (`idtournament`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_User_userStatus` FOREIGN KEY (`userStatus`) REFERENCES `userstatus` (`iduserStatus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_chessClub1` FOREIGN KEY (`chessClub_idchessClub`) REFERENCES `chessclub` (`idchessClub`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_chessPlayer1` FOREIGN KEY (`chessPlayer_idchessPlayer`) REFERENCES `chessplayer` (`idchessPlayer`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_sex1` FOREIGN KEY (`sex`) REFERENCES `sex` (`idtable1`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `userpublication`
--
ALTER TABLE `userpublication`
  ADD CONSTRAINT `fk_user_publication_publication1` FOREIGN KEY (`publication_idPublication`) REFERENCES `publication` (`idPublication`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_publication_user1` FOREIGN KEY (`user_username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `usertag`
--
ALTER TABLE `usertag`
  ADD CONSTRAINT `fk_userTag_publication1` FOREIGN KEY (`publication_idPublication`) REFERENCES `publication` (`idPublication`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_userTag_user1` FOREIGN KEY (`user_username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
