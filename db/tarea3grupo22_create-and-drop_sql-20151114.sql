-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 14-11-2015 a las 01:19:35
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
('user10', 'password', 'John', 'Titor', 'user10@XX.cl', '1', 'avatar9.jpg', 3, NULL, NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_User_userStatus` FOREIGN KEY (`userStatus`) REFERENCES `userstatus` (`iduserStatus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_chessClub1` FOREIGN KEY (`chessClub_idchessClub`) REFERENCES `chessclub` (`idchessClub`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_chessPlayer1` FOREIGN KEY (`chessPlayer_idchessPlayer`) REFERENCES `chessplayer` (`idchessPlayer`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_sex1` FOREIGN KEY (`sex`) REFERENCES `sex` (`idtable1`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
