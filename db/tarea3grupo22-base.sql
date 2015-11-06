-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2015 at 12:40 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tarea3grupo22`
--

-- --------------------------------------------------------

--
-- Table structure for table `annotatedgame`
--

CREATE TABLE IF NOT EXISTS `annotatedgame` (
  `idplayed` int(11) NOT NULL,
  `white_player` int(11) NOT NULL,
  `elo_white_game` int(11) DEFAULT NULL,
  `black_player` int(11) NOT NULL,
  `elo_black_game` int(11) DEFAULT NULL,
  `chessPosition_idchessPosition` int(11) NOT NULL,
  `location` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chessclub`
--

CREATE TABLE IF NOT EXISTS `chessclub` (
  `idchessClub` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `website` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chessplayer`
--

CREATE TABLE IF NOT EXISTS `chessplayer` (
  `idchessPlayer` int(11) NOT NULL,
  `chessPlayercol` varchar(45) DEFAULT NULL,
  `playerName` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chessposition`
--

CREATE TABLE IF NOT EXISTS `chessposition` (
  `idchessPosition` int(11) NOT NULL,
  `pgn_filename` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `idComment` int(11) NOT NULL,
  `commented_publication` int(11) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contenttag`
--

CREATE TABLE IF NOT EXISTS `contenttag` (
  `tag_name` varchar(45) NOT NULL,
  `tag_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `elo`
--

CREATE TABLE IF NOT EXISTS `elo` (
  `idchessPlayer` int(11) NOT NULL,
  `date` date NOT NULL,
  `elo` int(11) NOT NULL,
  `k` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `publication_idPublication` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` varchar(45) NOT NULL,
  `time` varchar(45) NOT NULL,
  `place` varchar(45) NOT NULL,
  `visibility` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gamereference`
--

CREATE TABLE IF NOT EXISTS `gamereference` (
  `chessPosition_idchessPosition` int(11) NOT NULL,
  `publication_idPublication` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invitedlist`
--

CREATE TABLE IF NOT EXISTS `invitedlist` (
  `idevent` int(11) NOT NULL,
  `invited_username` varchar(30) NOT NULL,
  `assistance` varchar(45) NOT NULL,
  `show_notification` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `match`
--

CREATE TABLE IF NOT EXISTS `match` (
  `idmatch` int(11) NOT NULL,
  `white_player` int(11) NOT NULL,
  `black_player` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `matchboard`
--

CREATE TABLE IF NOT EXISTS `matchboard` (
  `matchboard_id` int(11) NOT NULL,
  `white_player` varchar(100) NOT NULL,
  `black_player` varchar(100) NOT NULL,
  `match_origin` int(7) NOT NULL DEFAULT '0',
  `details` text,
  `format` int(1) NOT NULL DEFAULT '0',
  `pgn_board` varchar(255) DEFAULT NULL,
  `pgn_string` varchar(255) DEFAULT NULL,
  `input_date` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `matchboard`
--

INSERT INTO `matchboard` (`matchboard_id`, `white_player`, `black_player`, `match_origin`, `details`, `format`, `pgn_board`, `pgn_string`, `input_date`) VALUES
(1, '0', '0', 0, 'fasdfasdfasdfsdf', 0, 'partida.pgn', '', NULL),
(2, 'dfafasdfasdf', 'fadfasdfsdf', 0, 'fasdfasdfasdfsdf', 0, 'partida.pgn', '', NULL),
(3, 'fadfasdf', 'adfasdfsadf', 0, 'dfasdfasdf', 1, '', 'dfasdfasfdasdf', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `matchesplayed`
--

CREATE TABLE IF NOT EXISTS `matchesplayed` (
  `idtournament` int(11) NOT NULL,
  `idtournamentRound` int(11) NOT NULL,
  `match_idmatch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `idNew` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `date` date NOT NULL,
  `content` varchar(1000) DEFAULT NULL,
  `image_url` varchar(45) DEFAULT NULL,
  `video_url` varchar(45) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`idNew`, `title`, `date`, `content`, `image_url`, `video_url`, `category`) VALUES
(1, 'Bla', '2015-10-29', 'adlfkasdlfkasjdgo', 'https://fbcdn-sphotos-c-a.akamaihd.net/hphoto', NULL, 'fcfm'),
(2, 'Bla', '2015-10-29', 'adlfkasdlfkasjdgo', 'https://fbcdn-sphotos-c-a.akamaihd.net/hphoto', NULL, 'fcfm'),
(3, 'adfadfadf', '2015-10-29', 'adfadfadf', 'http://www.asdfadf.clf', NULL, 'nacional'),
(4, 'adfadfadf', '2015-10-29', 'adfadfadf', 'http://www.asdfadf.clf', NULL, 'nacional');

-- --------------------------------------------------------

--
-- Table structure for table `privatemessage`
--

CREATE TABLE IF NOT EXISTS `privatemessage` (
  `idprivateMessage` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `sender_username` varchar(30) NOT NULL,
  `receiver_username` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `publication`
--

CREATE TABLE IF NOT EXISTS `publication` (
  `idPublication` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `publication`
--

INSERT INTO `publication` (`idPublication`) VALUES
(1),
(2),
(3),
(4);

-- --------------------------------------------------------

--
-- Table structure for table `publicationkarma`
--

CREATE TABLE IF NOT EXISTS `publicationkarma` (
  `publication_idPublication` int(11) NOT NULL,
  `user_username` varchar(30) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `publicationtag`
--

CREATE TABLE IF NOT EXISTS `publicationtag` (
  `idPublication` int(11) NOT NULL,
  `tag_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sex`
--

CREATE TABLE IF NOT EXISTS `sex` (
  `idtable1` char(1) NOT NULL,
  `description` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sex`
--

INSERT INTO `sex` (`idtable1`, `description`) VALUES
('0', 'Desconocido'),
('1', 'Masculino'),
('2', 'Femenino'),
('9', 'No Aplica');

-- --------------------------------------------------------

--
-- Table structure for table `timestamps`
--

CREATE TABLE IF NOT EXISTS `timestamps` (
  `username` varchar(30) NOT NULL,
  `update_time` date DEFAULT NULL,
  `create_time` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `timestamps`
--

INSERT INTO `timestamps` (`username`, `update_time`, `create_time`) VALUES
('hola', '2015-10-30', '2015-10-30'),
('user01', '2015-10-30', '2015-10-30'),
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
-- Table structure for table `tournament`
--

CREATE TABLE IF NOT EXISTS `tournament` (
  `idtournament` int(11) NOT NULL,
  `tournament_filename` varchar(45) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tournamentround`
--

CREATE TABLE IF NOT EXISTS `tournamentround` (
  `idtournamentRound` int(11) NOT NULL,
  `tournament_idtournament` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

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
  `chessPlayer_idchessPlayer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
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
-- Table structure for table `userpublication`
--

CREATE TABLE IF NOT EXISTS `userpublication` (
  `user_username` varchar(30) NOT NULL,
  `publication_idPublication` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userpublication`
--

INSERT INTO `userpublication` (`user_username`, `publication_idPublication`) VALUES
('user01', 1),
('user01', 2),
('user01', 3),
('user01', 4);

-- --------------------------------------------------------

--
-- Table structure for table `userstatus`
--

CREATE TABLE IF NOT EXISTS `userstatus` (
  `iduserStatus` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userstatus`
--

INSERT INTO `userstatus` (`iduserStatus`, `name`) VALUES
(1, 'Usuario Activo'),
(2, 'Usuario Baneado'),
(3, 'Usuario Administrador');

-- --------------------------------------------------------

--
-- Table structure for table `usertag`
--

CREATE TABLE IF NOT EXISTS `usertag` (
  `publication_idPublication` int(11) NOT NULL,
  `user_username` varchar(30) NOT NULL,
  `untagged` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `annotatedgame`
--
ALTER TABLE `annotatedgame`
  ADD PRIMARY KEY (`idplayed`,`white_player`,`black_player`,`chessPosition_idchessPosition`),
  ADD KEY `fk_played_chessPlayer1_idx` (`white_player`),
  ADD KEY `fk_played_chessPlayer2_idx` (`black_player`),
  ADD KEY `fk_played_chessPosition1_idx` (`chessPosition_idchessPosition`);

--
-- Indexes for table `chessclub`
--
ALTER TABLE `chessclub`
  ADD PRIMARY KEY (`idchessClub`);

--
-- Indexes for table `chessplayer`
--
ALTER TABLE `chessplayer`
  ADD PRIMARY KEY (`idchessPlayer`);

--
-- Indexes for table `chessposition`
--
ALTER TABLE `chessposition`
  ADD PRIMARY KEY (`idchessPosition`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`idComment`),
  ADD KEY `fk_comment_publication2_idx` (`commented_publication`);

--
-- Indexes for table `contenttag`
--
ALTER TABLE `contenttag`
  ADD PRIMARY KEY (`tag_name`);

--
-- Indexes for table `elo`
--
ALTER TABLE `elo`
  ADD PRIMARY KEY (`idchessPlayer`,`date`),
  ADD KEY `fk_elo_chessPlayer1_idx` (`idchessPlayer`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`publication_idPublication`),
  ADD KEY `fk_event_publication1_idx` (`publication_idPublication`);

--
-- Indexes for table `gamereference`
--
ALTER TABLE `gamereference`
  ADD PRIMARY KEY (`chessPosition_idchessPosition`,`publication_idPublication`),
  ADD KEY `fk_gameReference_publication1_idx` (`publication_idPublication`);

--
-- Indexes for table `invitedlist`
--
ALTER TABLE `invitedlist`
  ADD PRIMARY KEY (`idevent`,`invited_username`),
  ADD KEY `fk_invitedList_event1_idx` (`idevent`),
  ADD KEY `fk_invitedList_user1_idx` (`invited_username`);

--
-- Indexes for table `match`
--
ALTER TABLE `match`
  ADD PRIMARY KEY (`idmatch`),
  ADD KEY `fk_match_chessPlayer1_idx` (`white_player`),
  ADD KEY `fk_match_chessPlayer2_idx` (`black_player`);

--
-- Indexes for table `matchboard`
--
ALTER TABLE `matchboard`
  ADD PRIMARY KEY (`matchboard_id`);

--
-- Indexes for table `matchesplayed`
--
ALTER TABLE `matchesplayed`
  ADD PRIMARY KEY (`idtournament`,`idtournamentRound`,`match_idmatch`),
  ADD KEY `fk_matchesPlayed_match1_idx` (`match_idmatch`),
  ADD KEY `fk_matchesPlayed_tournamentRound1` (`idtournamentRound`,`idtournament`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`idNew`),
  ADD KEY `fk_news_publication1_idx` (`idNew`);

--
-- Indexes for table `privatemessage`
--
ALTER TABLE `privatemessage`
  ADD PRIMARY KEY (`idprivateMessage`),
  ADD KEY `fk_privateMessage_user1_idx` (`sender_username`),
  ADD KEY `fk_privateMessage_user2_idx` (`receiver_username`);

--
-- Indexes for table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`idPublication`);

--
-- Indexes for table `publicationkarma`
--
ALTER TABLE `publicationkarma`
  ADD PRIMARY KEY (`publication_idPublication`,`user_username`),
  ADD KEY `fk_publicationKarma_user1_idx` (`user_username`);

--
-- Indexes for table `publicationtag`
--
ALTER TABLE `publicationtag`
  ADD PRIMARY KEY (`idPublication`,`tag_name`),
  ADD KEY `fk_publicationTag_contentTag1_idx` (`tag_name`);

--
-- Indexes for table `sex`
--
ALTER TABLE `sex`
  ADD PRIMARY KEY (`idtable1`);

--
-- Indexes for table `timestamps`
--
ALTER TABLE `timestamps`
  ADD PRIMARY KEY (`username`),
  ADD KEY `fk_activity_User1_idx` (`username`);

--
-- Indexes for table `tournament`
--
ALTER TABLE `tournament`
  ADD PRIMARY KEY (`idtournament`);

--
-- Indexes for table `tournamentround`
--
ALTER TABLE `tournamentround`
  ADD PRIMARY KEY (`idtournamentRound`,`tournament_idtournament`),
  ADD KEY `fk_tournamentRound_tournament1_idx` (`tournament_idtournament`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD KEY `fk_User_userStatus_idx` (`userStatus`),
  ADD KEY `fk_user_chessClub1_idx` (`chessClub_idchessClub`),
  ADD KEY `fk_user_chessPlayer1_idx` (`chessPlayer_idchessPlayer`),
  ADD KEY `fk_user_sex1_idx` (`sex`);

--
-- Indexes for table `userpublication`
--
ALTER TABLE `userpublication`
  ADD PRIMARY KEY (`user_username`,`publication_idPublication`),
  ADD KEY `fk_user_publication_publication1_idx` (`publication_idPublication`);

--
-- Indexes for table `userstatus`
--
ALTER TABLE `userstatus`
  ADD PRIMARY KEY (`iduserStatus`);

--
-- Indexes for table `usertag`
--
ALTER TABLE `usertag`
  ADD PRIMARY KEY (`publication_idPublication`,`user_username`),
  ADD KEY `fk_userTag_user1_idx` (`user_username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `match`
--
ALTER TABLE `match`
  MODIFY `idmatch` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `matchboard`
--
ALTER TABLE `matchboard`
  MODIFY `matchboard_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `publication`
--
ALTER TABLE `publication`
  MODIFY `idPublication` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tournament`
--
ALTER TABLE `tournament`
  MODIFY `idtournament` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `annotatedgame`
--
ALTER TABLE `annotatedgame`
  ADD CONSTRAINT `fk_played_chessPlayer1` FOREIGN KEY (`white_player`) REFERENCES `chessplayer` (`idchessPlayer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_played_chessPlayer2` FOREIGN KEY (`black_player`) REFERENCES `chessplayer` (`idchessPlayer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_played_chessPosition1` FOREIGN KEY (`chessPosition_idchessPosition`) REFERENCES `chessposition` (`idchessPosition`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_comment_publication1` FOREIGN KEY (`idComment`) REFERENCES `publication` (`idPublication`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comment_publication2` FOREIGN KEY (`commented_publication`) REFERENCES `publication` (`idPublication`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `elo`
--
ALTER TABLE `elo`
  ADD CONSTRAINT `fk_elo_chessPlayer1` FOREIGN KEY (`idchessPlayer`) REFERENCES `chessplayer` (`idchessPlayer`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `fk_event_publication1` FOREIGN KEY (`publication_idPublication`) REFERENCES `publication` (`idPublication`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gamereference`
--
ALTER TABLE `gamereference`
  ADD CONSTRAINT `fk_gameReference_chessPosition1` FOREIGN KEY (`chessPosition_idchessPosition`) REFERENCES `chessposition` (`idchessPosition`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_gameReference_publication1` FOREIGN KEY (`publication_idPublication`) REFERENCES `publication` (`idPublication`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `invitedlist`
--
ALTER TABLE `invitedlist`
  ADD CONSTRAINT `fk_invitedList_event1` FOREIGN KEY (`idevent`) REFERENCES `event` (`publication_idPublication`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_invitedList_user1` FOREIGN KEY (`invited_username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `match`
--
ALTER TABLE `match`
  ADD CONSTRAINT `fk_match_chessPlayer1` FOREIGN KEY (`white_player`) REFERENCES `chessplayer` (`idchessPlayer`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_match_chessPlayer2` FOREIGN KEY (`black_player`) REFERENCES `chessplayer` (`idchessPlayer`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `matchesplayed`
--
ALTER TABLE `matchesplayed`
  ADD CONSTRAINT `fk_matchesPlayed_match1` FOREIGN KEY (`match_idmatch`) REFERENCES `match` (`idmatch`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_matchesPlayed_tournamentRound1` FOREIGN KEY (`idtournamentRound`, `idtournament`) REFERENCES `tournamentround` (`idtournamentRound`, `tournament_idtournament`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `fk_news_publication1` FOREIGN KEY (`idNew`) REFERENCES `publication` (`idPublication`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `privatemessage`
--
ALTER TABLE `privatemessage`
  ADD CONSTRAINT `fk_privateMessage_user1` FOREIGN KEY (`sender_username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_privateMessage_user2` FOREIGN KEY (`receiver_username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `publicationkarma`
--
ALTER TABLE `publicationkarma`
  ADD CONSTRAINT `fk_publicationKarma_publication1` FOREIGN KEY (`publication_idPublication`) REFERENCES `publication` (`idPublication`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_publicationKarma_user1` FOREIGN KEY (`user_username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `publicationtag`
--
ALTER TABLE `publicationtag`
  ADD CONSTRAINT `fk_publicationTag_contentTag1` FOREIGN KEY (`tag_name`) REFERENCES `contenttag` (`tag_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_publicationTag_publication1` FOREIGN KEY (`idPublication`) REFERENCES `publication` (`idPublication`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `timestamps`
--
ALTER TABLE `timestamps`
  ADD CONSTRAINT `fk_activity_User1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tournamentround`
--
ALTER TABLE `tournamentround`
  ADD CONSTRAINT `fk_tournamentRound_tournament1` FOREIGN KEY (`tournament_idtournament`) REFERENCES `tournament` (`idtournament`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_User_userStatus` FOREIGN KEY (`userStatus`) REFERENCES `userstatus` (`iduserStatus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_chessClub1` FOREIGN KEY (`chessClub_idchessClub`) REFERENCES `chessclub` (`idchessClub`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_chessPlayer1` FOREIGN KEY (`chessPlayer_idchessPlayer`) REFERENCES `chessplayer` (`idchessPlayer`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_sex1` FOREIGN KEY (`sex`) REFERENCES `sex` (`idtable1`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `userpublication`
--
ALTER TABLE `userpublication`
  ADD CONSTRAINT `fk_user_publication_publication1` FOREIGN KEY (`publication_idPublication`) REFERENCES `publication` (`idPublication`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_publication_user1` FOREIGN KEY (`user_username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `usertag`
--
ALTER TABLE `usertag`
  ADD CONSTRAINT `fk_userTag_publication1` FOREIGN KEY (`publication_idPublication`) REFERENCES `publication` (`idPublication`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_userTag_user1` FOREIGN KEY (`user_username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
