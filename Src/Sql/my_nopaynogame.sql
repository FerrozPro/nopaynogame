-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 20, 2018 alle 23:59
-- Versione del server: 5.6.33-log
-- PHP Version: 5.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `my_nopaynogame`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `DOM_CONSOLE`
--

CREATE TABLE IF NOT EXISTS `DOM_CONSOLE` (
  `COD_CONSOLE` varchar(4) NOT NULL,
  `DESC_CONSOLE` varchar(45) NOT NULL,
  PRIMARY KEY (`COD_CONSOLE`),
  UNIQUE KEY `COD_CONSOLE` (`COD_CONSOLE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `DOM_CONSOLE`
--

INSERT INTO `DOM_CONSOLE` (`COD_CONSOLE`, `DESC_CONSOLE`) VALUES
('CO01', 'XBOX ONE X'),
('CO02', 'XBOX ONE S'),
('CO03', 'XBOX ONE'),
('CO04', 'PS4'),
('CO05', 'PS4 PRO'),
('CO06', 'PC'),
('CO07', 'NINTENDO WII U'),
('CO08', 'NINTENDO SWITCH'),
('CO09', 'NINTENDO 3DS'),
('CO10', 'PSVITA');

-- --------------------------------------------------------

--
-- Struttura della tabella `DOM_GENRE`
--

CREATE TABLE IF NOT EXISTS `DOM_GENRE` (
  `COD_GENRE` varchar(4) NOT NULL,
  `DESC_GENRE` varchar(45) NOT NULL,
  PRIMARY KEY (`COD_GENRE`),
  UNIQUE KEY `COD_GENRE` (`COD_GENRE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `DOM_GENRE`
--

INSERT INTO `DOM_GENRE` (`COD_GENRE`, `DESC_GENRE`) VALUES
('GE01', 'AZIONE'),
('GE02', 'AVVENTURA'),
('GE03', 'SPORT'),
('GE04', 'SPARATUTTO'),
('GE05', 'FPS'),
('GE06', 'MMO'),
('GE07', 'RPG'),
('GE08', 'PICCHIADURO'),
('GE09', 'ARENA'),
('GE10', 'MOBA'),
('GE11', 'ROMPICAPO'),
('GE12', 'PUZZLE');

-- --------------------------------------------------------

--
-- Struttura della tabella `DOM_PAYMENT`
--

CREATE TABLE IF NOT EXISTS `DOM_PAYMENT` (
  `COD_PAYMENT` varchar(4) NOT NULL,
  `DESC_PAYMENT` varchar(45) NOT NULL,
  PRIMARY KEY (`COD_PAYMENT`),
  UNIQUE KEY `COD_PAYMENT` (`COD_PAYMENT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `DOM_PAYMENT`
--

INSERT INTO `DOM_PAYMENT` (`COD_PAYMENT`, `DESC_PAYMENT`) VALUES
('PAY1', 'PAYPAL'),
('PAY2', 'BONIFICO'),
('PAY3', 'CARTA DI CREDITO'),
('PAY4', 'CONTRASSEGNO');

-- --------------------------------------------------------

--
-- Struttura della tabella `DOM_ROLE`
--

CREATE TABLE IF NOT EXISTS `DOM_ROLE` (
  `COD_ROLE` char(3) NOT NULL,
  `DESC_ROLE` varchar(45) NOT NULL,
  PRIMARY KEY (`COD_ROLE`),
  UNIQUE KEY `COD_ROLE` (`COD_ROLE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `DOM_ROLE`
--

INSERT INTO `DOM_ROLE` (`COD_ROLE`, `DESC_ROLE`) VALUES
('RL1', 'USER'),
('RL2', 'MAGAZZINIERE'),
('RL3', 'AMMINISTRATORE'),
('RL4', 'SUPERUSER');

-- --------------------------------------------------------

--
-- Struttura della tabella `GAMES`
--

CREATE TABLE IF NOT EXISTS `GAMES` (
  `COD_GAME` int(11) NOT NULL AUTO_INCREMENT,
  `TITLE` varchar(45) NOT NULL,
  `PRICE` float NOT NULL,
  `COD_CONSOLE` varchar(4) NOT NULL,
  `PRICE_ON_SALE` float NOT NULL,
  `FLAG_SALE` char(1) NOT NULL,
  `FLAG_NEWS` char(1) NOT NULL DEFAULT 'Y',
  `IMAGE` varchar(250) NOT NULL DEFAULT 'img/default.jpg',
  `DESCRIPTION` varchar(20000) NOT NULL,
  `SPEC_REQ` varchar(20000) DEFAULT NULL,
  `TRAILER` varchar(20000) DEFAULT NULL,
  `INSERTION_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`COD_GAME`),
  UNIQUE KEY `COD_GAME` (`COD_GAME`),
  KEY `GAMES_FK01` (`COD_CONSOLE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=87 ;

--
-- Dump dei dati per la tabella `GAMES`
--

INSERT INTO `GAMES` (`COD_GAME`, `TITLE`, `PRICE`, `COD_CONSOLE`, `PRICE_ON_SALE`, `FLAG_SALE`, `FLAG_NEWS`, `IMAGE`, `DESCRIPTION`, `SPEC_REQ`, `TRAILER`, `INSERTION_DATE`) VALUES
(60, 'Overwatch GOTY', 39.99, 'CO06', 24.95, 'Y', 'Y', 'img/overwatch.jpg', 'Overwatch BEST GAME', 'La 1070ti di FAB rotta\r\nIl master Quando?', 'https://www.youtube.com/watch?v=K_m8fcJb5tE', '2018-04-15 16:32:30'),
(62, 'Playerunknowns Battleground', 30, 'CO06', 21.99, 'Y', 'Y', 'img/pubg.jpg', 'PLAYERUNKNOWNS BATTLEGROUNDS is a last-man-standing shooter being developed with community feedback. Starting with nothing, players must fight to locate weapons and supplies in a battle to be the lone survivor. This realistic, high tension game is set on a massive 8x8 km island with a level of detail that showcases Unreal Engine 4s capabilities. \r\n<br><br>\r\nPLAYERUNKNOWN aka Brendan Greene, is a pioneer of the Battle Royale genre. As the creator of the Battle Royale game-mode found in the ARMA series and H1Z1 : King of the Kill, Greene is co-developing the game with veteran team at Bluehole to create the most diverse and robust Battle Royale experience to date\r\n<br><br>\r\nNot Just a Game. This is BATTLE ROYALE', 'OS	Win 7 64\r\n<br>\r\nCPU	Core i3-4340 / AMD FX-6300\r\n<br>\r\nRAM	6 GB\r\n<br>\r\nGPU	GeForce GTX 660 2GB / AMD Radeon HD 7850 2GB<br><br>\r\nHDD	30 GB', 'https://www.youtube.com/watch?v=tXrNhHt0l1A', '2018-04-15 20:38:04'),
(70, 'Assassinâ€™s CreedÂ® 2', 15, 'CO06', 15, 'N', 'Y', 'img/AC2.jpg', 'Assassinâ€™s CreedÂ® 2 is the follow-up to the title that became the fastest-selling new IP in video game history. The highly anticipated title features a new hero, Ezio Auditore da Firenze, a young Italian noble, and a new era, the Renaissance.<br>\r\nAssassinâ€™s Creed 2 retains the core gameplay experience that made the first opus a resounding success and features new experiences that will surprise and challenge players.<br>\r\nAssassinâ€™s Creed 2 is an epic story of family, vengeance and conspiracy set in the pristine, yet brutal, backdrop of a Renaissance Italy. \r\nEzio befriends Leonardo da Vinci, takes on Florenceâ€™s most powerful families and ventures throughout the canals of Venice where he learns to become a master assassin.\r\n<br><br>\r\nEZIO, A NEW ASSASSIN FOR A NEW ERA Ezio Auditore da Firenze is a young Italian noble who will learn the ways of the assassins after his family was betrayed and he looks to seek vengeance. He is a ladyâ€™s man, a free soul with panache yet has a very human side to his personality. Through him, you become a master assassin.\r\n<br><br>\r\nRENAISSANCE ITALY Italy in the 15th century was less a country and more a collection of city-states where families with political and economic strength began to take leadership roles in cities like Florence and Venice. This journey through some of the most beautiful cities in the world takes place in a time in history where culture and art were born alongside some of the most chilling stories of corruption, greed and murder. \r\n<br><br>\r\nA NEW-FOUND FREEDOM You will be able to perform missions when you want and how you want in this open-ended world that brings back free-running and adds elements such as swimming and even flying to the adventure. The variety in gameplay adds another layer for you to truly play through the game any way you choose.\r\n<br><br>\r\nDYNAMIC CROWD Discover a living, breathing world where every character is an opportunity for the player. Blending in with the crowd is easier, working with in-game characters provide ample rewards but can also lead to surprising consequences.\r\n<br><br>\r\nBECOME A MASTER ASSASSIN Perfect your skills to become a master assassin where you brandish new weapons, learn to disarm enemies then use their weapons against them, and assassinate enemies using both hidden blades.', 'OS	Win XP 32<br>\r\nCPU	Core 2 Duo 1.8 GHZ / Athlon X2 64 2.4GHZ<br>\r\nRAM	1.5 GB<br>\r\nGPU	256 MB DirectX 9.0â€“compliant card with Shader Model 3.0 or higher (see supported list)<br>\r\nHDD	8 GB<br>', 'https://www.youtube.com/watch?v=pRjALdKIBAE&t=2s', '2018-04-20 20:14:26'),
(82, 'Assassinâ€™s CreedÂ® 2', 15, 'CO03', 2, 'Y', 'N', 'img/AC2.jpg', 'Assassinâ€™s CreedÂ® 2 is the follow-up to the title that became the fastest-selling new IP in video game history. The highly anticipated title features a new hero, Ezio Auditore da Firenze, a young Italian noble, and a new era, the Renaissance.<br>\r\nAssassinâ€™s Creed 2 retains the core gameplay experience that made the first opus a resounding success and features new experiences that will surprise and challenge players.<br>\r\nAssassinâ€™s Creed 2 is an epic story of family, vengeance and conspiracy set in the pristine, yet brutal, backdrop of a Renaissance Italy. \r\nEzio befriends Leonardo da Vinci, takes on Florenceâ€™s most powerful families and ventures throughout the canals of Venice where he learns to become a master assassin.\r\n<br><br>\r\nEZIO, A NEW ASSASSIN FOR A NEW ERA Ezio Auditore da Firenze is a young Italian noble who will learn the ways of the assassins after his family was betrayed and he looks to seek vengeance. He is a ladyâ€™s man, a free soul with panache yet has a very human side to his personality. Through him, you become a master assassin.\r\n<br><br>\r\nRENAISSANCE ITALY Italy in the 15th century was less a country and more a collection of city-states where families with political and economic strength began to take leadership roles in cities like Florence and Venice. This journey through some of the most beautiful cities in the world takes place in a time in history where culture and art were born alongside some of the most chilling stories of corruption, greed and murder. \r\n<br><br>\r\nA NEW-FOUND FREEDOM You will be able to perform missions when you want and how you want in this open-ended world that brings back free-running and adds elements such as swimming and even flying to the adventure. The variety in gameplay adds another layer for you to truly play through the game any way you choose.\r\n<br><br>\r\nDYNAMIC CROWD Discover a living, breathing world where every character is an opportunity for the player. Blending in with the crowd is easier, working with in-game characters provide ample rewards but can also lead to surprising consequences.\r\n<br><br>\r\nBECOME A MASTER ASSASSIN Perfect your skills to become a master assassin where you brandish new weapons, learn to disarm enemies then use their weapons against them, and assassinate enemies using both hidden blades.', 'OS	Win XP 32<br>\r\nCPU	Core 2 Duo 1.8 GHZ / Athlon X2 64 2.4GHZ<br>\r\nRAM	1.5 GB<br>\r\nGPU	256 MB DirectX 9.0â€“compliant card with Shader Model 3.0 or higher (see supported list)<br>\r\nHDD	8 GB<br>', '', '2018-04-20 20:19:13'),
(85, 'Assassins Creed III', 20, 'CO06', 4.44, 'Y', 'N', 'img/AC3.jpg', 'Corre anno 1775. Le colonie del Nuovo Mondo sono sull orlo della rivolta. Sei Connor, un Assassino che ha giurato di restituire la libertÃ  al suo popolo e alla sua nazione. Per farlo, dovrai dare la caccia ai tuoi nemici in un mondo incredibilmente vasto e realistico. Ricorri alle tue abilitÃ  letali in una pericolosa missione che ti porterÃ  dalle caotiche strade cittadine agli insanguinati campi di battaglia dell America selvaggia, al fianco di eroi leggendari della storia americana: combattete insieme per annientare coloro che minacciano la libertÃ .\r\n<br><br>\r\nPreferisci uccidere silenziosamente assecondando il tuo istinto predatore, oppure sfruttare l arsenale a tua disposizione? In ogni caso, una cosa Ã¨ certa: il mondo in cui vivono gli Assassini Ã¨ diventato piÃ¹ letale che mai. E anche tu...', 'OS	Win Vista 32<br>\r\nCPU	Core 2 Duo E6700 2.66GHz / Athlon 64 X2 Dual Core 6000+<br>\r\nRAM	2 GB<br>\r\nGPU	GeForce 8600 GT 512MB GDDR3 / Radeon HD 3870<br>\r\nHDD	17 GB', 'https://www.youtube.com/watch?v=SVD2tBQe0p8', '2018-04-20 20:33:10'),
(86, 'Assassins Creed III', 15, 'CO04', 2.3, 'Y', 'N', 'img/AC3.jpg', 'Corre anno 1775. Le colonie del Nuovo Mondo sono sull orlo della rivolta. Sei Connor, un Assassino che ha giurato di restituire la libertÃ  al suo popolo e alla sua nazione. Per farlo, dovrai dare la caccia ai tuoi nemici in un mondo incredibilmente vasto e realistico. Ricorri alle tue abilitÃ  letali in una pericolosa missione che ti porterÃ  dalle caotiche strade cittadine agli insanguinati campi di battaglia dell America selvaggia, al fianco di eroi leggendari della storia americana: combattete insieme per annientare coloro che minacciano la libertÃ .\r\n<br><br>\r\nPreferisci uccidere silenziosamente assecondando il tuo istinto predatore, oppure sfruttare l arsenale a tua disposizione? In ogni caso, una cosa Ã¨ certa: il mondo in cui vivono gli Assassini Ã¨ diventato piÃ¹ letale che mai. E anche tu...', 'OS	Win Vista 32<br>\r\nCPU	Core 2 Duo E6700 2.66GHz / Athlon 64 X2 Dual Core 6000+<br>\r\nRAM	2 GB<br>\r\nGPU	GeForce 8600 GT 512MB GDDR3 / Radeon HD 3870<br>\r\nHDD	17 GB', 'https://www.youtube.com/watch?v=SVD2tBQe0p8', '2018-04-20 20:34:22');

-- --------------------------------------------------------

--
-- Struttura della tabella `GAME_GENRE`
--

CREATE TABLE IF NOT EXISTS `GAME_GENRE` (
  `ID_GAME_GENRE` int(11) NOT NULL AUTO_INCREMENT,
  `COD_GAME` int(11) NOT NULL,
  `COD_GENRE` varchar(4) NOT NULL,
  PRIMARY KEY (`ID_GAME_GENRE`),
  KEY `GAME_GENRE_FK01` (`COD_GAME`),
  KEY `GAME_GENRE_FK02` (`COD_GENRE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=120 ;

--
-- Dump dei dati per la tabella `GAME_GENRE`
--

INSERT INTO `GAME_GENRE` (`ID_GAME_GENRE`, `COD_GAME`, `COD_GENRE`) VALUES
(58, 60, 'GE04'),
(59, 60, 'GE05'),
(60, 60, 'GE06'),
(61, 60, 'GE10'),
(74, 62, 'GE01'),
(75, 62, 'GE04'),
(76, 62, 'GE05'),
(77, 62, 'GE09'),
(80, 70, 'GE01'),
(81, 70, 'GE02'),
(108, 82, 'GE01'),
(109, 82, 'GE02'),
(114, 85, 'GE01'),
(115, 85, 'GE02'),
(116, 85, 'GE11'),
(117, 86, 'GE01'),
(118, 86, 'GE02'),
(119, 86, 'GE11');

-- --------------------------------------------------------

--
-- Struttura della tabella `GAME_ORDER`
--

CREATE TABLE IF NOT EXISTS `GAME_ORDER` (
  `ID_GAME_ORDER` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ORDER` int(11) NOT NULL,
  `COD_GAME` int(11) NOT NULL,
  `QUANTITY` int(11) NOT NULL DEFAULT '0',
  `GAME_PRICE` float NOT NULL,
  PRIMARY KEY (`ID_GAME_ORDER`),
  KEY `GAME_ORDER_FK01` (`COD_GAME`),
  KEY `GAME_ORDER_FK02` (`ID_ORDER`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dump dei dati per la tabella `GAME_ORDER`
--

INSERT INTO `GAME_ORDER` (`ID_GAME_ORDER`, `ID_ORDER`, `COD_GAME`, `QUANTITY`, `GAME_PRICE`) VALUES
(7, 5, 60, 15, 16.99);

-- --------------------------------------------------------

--
-- Struttura della tabella `GAME_WAREHOUSE`
--

CREATE TABLE IF NOT EXISTS `GAME_WAREHOUSE` (
  `ID_GAME_WAREHOUSE` int(11) NOT NULL AUTO_INCREMENT,
  `QUANTITY` int(11) NOT NULL,
  `COD_WAREHOUSE` char(3) NOT NULL,
  `COD_GAME` int(11) NOT NULL,
  PRIMARY KEY (`ID_GAME_WAREHOUSE`),
  KEY `GAME_WAREHOUSE_FK01` (`COD_WAREHOUSE`),
  KEY `GAME_WAREHOUSE_FK02` (`COD_GAME`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=88 ;

--
-- Dump dei dati per la tabella `GAME_WAREHOUSE`
--

INSERT INTO `GAME_WAREHOUSE` (`ID_GAME_WAREHOUSE`, `QUANTITY`, `COD_WAREHOUSE`, `COD_GAME`) VALUES
(10, 10040, 'WH1', 60),
(11, 1, 'WH2', 60),
(12, 40, 'WH3', 60),
(16, 20, 'WH1', 62),
(17, 1, 'WH2', 62),
(18, 60, 'WH3', 62),
(37, 60, 'WH1', 70),
(38, 50, 'WH2', 70),
(39, 100, 'WH3', 70),
(73, 0, 'WH1', 82),
(74, 0, 'WH2', 82),
(75, 0, 'WH3', 82),
(82, 100, 'WH1', 85),
(83, 200, 'WH2', 85),
(84, 500, 'WH3', 85),
(85, 50, 'WH1', 86),
(86, 0, 'WH2', 86),
(87, 0, 'WH3', 86);

-- --------------------------------------------------------

--
-- Struttura della tabella `ORDERS`
--

CREATE TABLE IF NOT EXISTS `ORDERS` (
  `ID_ORDER` int(11) NOT NULL AUTO_INCREMENT,
  `ID_USER` int(11) NOT NULL,
  `COD_PAYMENT` varchar(4) NOT NULL,
  `DATE_ORDER` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FLAG_PAYD` char(1) NOT NULL DEFAULT 'N',
  `FLAG_EVADE` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`ID_ORDER`),
  KEY `ORDERS_FK01` (`ID_USER`),
  KEY `ORDERS_FK02` (`COD_PAYMENT`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dump dei dati per la tabella `ORDERS`
--

INSERT INTO `ORDERS` (`ID_ORDER`, `ID_USER`, `COD_PAYMENT`, `DATE_ORDER`, `FLAG_PAYD`, `FLAG_EVADE`) VALUES
(5, 4, 'PAY1', '2018-04-17 20:20:18', 'Y', 'Y');

-- --------------------------------------------------------

--
-- Struttura della tabella `REVIEW`
--

CREATE TABLE IF NOT EXISTS `REVIEW` (
  `ID_REVIEW` int(11) NOT NULL AUTO_INCREMENT,
  `COD_GAME` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `STARS` int(11) NOT NULL,
  `COMMENT_TEXT` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`ID_REVIEW`),
  KEY `REVIEW_FK01` (`COD_GAME`),
  KEY `REVIEW_FK02` (`ID_USER`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dump dei dati per la tabella `REVIEW`
--

INSERT INTO `REVIEW` (`ID_REVIEW`, `COD_GAME`, `ID_USER`, `STARS`, `COMMENT_TEXT`) VALUES
(5, 60, 9, 2, 'Questo gioco Ã¨ davvero bellissimo, non so come ho fatto a vivere senza. A voi piace?'),
(6, 62, 1, 3, 'afa afa sf asf'),
(7, 60, 1, 2, '1sadfdfasg q dfgsfa gfds gsdf g'),
(8, 62, 9, 4, 'dd');

-- --------------------------------------------------------

--
-- Struttura della tabella `USERS`
--

CREATE TABLE IF NOT EXISTS `USERS` (
  `ID_USER` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(45) NOT NULL,
  `SURNAME` varchar(45) NOT NULL,
  `ADDRESS` varchar(45) NOT NULL,
  `PHONE` varchar(10) NOT NULL,
  `USERNAME` varchar(11) NOT NULL,
  `PASSWORD` varchar(32) NOT NULL,
  `EMAIL` varchar(45) NOT NULL,
  `COD_ROLE` char(3) NOT NULL,
  `PASSWORD_LAST_MODIFY` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `FIDELITY_POINT` int(11) NOT NULL DEFAULT '0',
  `FLAG_DELETED` char(1) NOT NULL DEFAULT 'N',
  `FLAG_ACTIVE` char(1) NOT NULL DEFAULT 'N',
  `WALLET` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_USER`),
  UNIQUE KEY `USERNAME` (`USERNAME`),
  UNIQUE KEY `EMAIL` (`EMAIL`),
  KEY `USERS_FK01` (`COD_ROLE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dump dei dati per la tabella `USERS`
--

INSERT INTO `USERS` (`ID_USER`, `NAME`, `SURNAME`, `ADDRESS`, `PHONE`, `USERNAME`, `PASSWORD`, `EMAIL`, `COD_ROLE`, `PASSWORD_LAST_MODIFY`, `FIDELITY_POINT`, `FLAG_DELETED`, `FLAG_ACTIVE`, `WALLET`) VALUES
(1, 'Admin', 'Ferroz', 'via Admin 1', '1234567890', 'Admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com', 'RL4', '2018-04-15 12:29:14', 8900, 'N', 'Y', 1354),
(2, 'Maria', 'Dusina', 'Via Riviera 18 Giugno', '3294252388', 'alexis', '4124bc0a9335c27f086f24ba207a4912', 'alexiscatmiao@ciscobank.com', 'RL1', '2018-04-15 13:09:56', 0, 'N', 'Y', 0),
(4, 'Kris', 'Kros', 'no', '860405522', 'Chipmunk', '25f9e794323b453885f5181f1b624d0b', 'awayandfree@gmail.com', 'RL4', '2018-04-15 15:19:54', 0, 'N', 'Y', 16),
(8, 'roberta', 'rossi', 'rob', '3', 'roberta', '0cc175b9c0f1b6a831c399e269772661', 'robertarossi@yahoo.it', 'RL3', '2018-04-16 15:24:45', 0, 'N', 'Y', 123),
(9, 'Maria', 'di campi', 'Via Riviera 18 Giugno', '3294252389', 'a', '0cc175b9c0f1b6a831c399e269772661', 'alexiscatmiao@ciscobank.it', 'RL1', '2018-04-16 15:40:42', 0, 'N', 'N', 1050),
(10, 'Magazzino', 'Magazzino', 'magazzino', '1234567890', 'magazzino', 'bc848daffa39ae8dc03869d1e254487a', 'mag@azz.ino', 'RL2', '2018-04-16 17:59:26', 0, 'N', 'N', 100),
(11, 'Franco', 'Baresi', 'Via e man dal cueo, 16', '1234567890', 'FrancoB', '99d2470a3073b4a570031f75896c6ac6', 'franco@franco.franco', 'RL1', '2018-04-17 07:58:34', 0, 'N', 'Y', 100);

-- --------------------------------------------------------

--
-- Struttura della tabella `WAREHOUSE`
--

CREATE TABLE IF NOT EXISTS `WAREHOUSE` (
  `COD_WAREHOUSE` char(3) NOT NULL,
  `ADDRESS` varchar(45) NOT NULL,
  `PHONE` varchar(45) NOT NULL,
  PRIMARY KEY (`COD_WAREHOUSE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `WAREHOUSE`
--

INSERT INTO `WAREHOUSE` (`COD_WAREHOUSE`, `ADDRESS`, `PHONE`) VALUES
('WH1', 'via Macello 1', '1236547890'),
('WH2', 'via Budello 2', '9874563210'),
('WH3', 'via Fretello 3', '0147852369');

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `GAMES`
--
ALTER TABLE `GAMES`
  ADD CONSTRAINT `GAMES_FK01` FOREIGN KEY (`COD_CONSOLE`) REFERENCES `DOM_CONSOLE` (`COD_CONSOLE`);

--
-- Limiti per la tabella `GAME_GENRE`
--
ALTER TABLE `GAME_GENRE`
  ADD CONSTRAINT `GAME_GENRE_FK01` FOREIGN KEY (`COD_GAME`) REFERENCES `GAMES` (`COD_GAME`),
  ADD CONSTRAINT `GAME_GENRE_FK02` FOREIGN KEY (`COD_GENRE`) REFERENCES `DOM_GENRE` (`COD_GENRE`);

--
-- Limiti per la tabella `GAME_ORDER`
--
ALTER TABLE `GAME_ORDER`
  ADD CONSTRAINT `GAME_ORDER_FK01` FOREIGN KEY (`COD_GAME`) REFERENCES `GAMES` (`COD_GAME`),
  ADD CONSTRAINT `GAME_ORDER_FK02` FOREIGN KEY (`ID_ORDER`) REFERENCES `ORDERS` (`ID_ORDER`);

--
-- Limiti per la tabella `GAME_WAREHOUSE`
--
ALTER TABLE `GAME_WAREHOUSE`
  ADD CONSTRAINT `GAME_WAREHOUSE_FK01` FOREIGN KEY (`COD_WAREHOUSE`) REFERENCES `WAREHOUSE` (`COD_WAREHOUSE`),
  ADD CONSTRAINT `GAME_WAREHOUSE_FK02` FOREIGN KEY (`COD_GAME`) REFERENCES `GAMES` (`COD_GAME`);

--
-- Limiti per la tabella `ORDERS`
--
ALTER TABLE `ORDERS`
  ADD CONSTRAINT `ORDERS_FK01` FOREIGN KEY (`ID_USER`) REFERENCES `USERS` (`ID_USER`),
  ADD CONSTRAINT `ORDERS_FK02` FOREIGN KEY (`COD_PAYMENT`) REFERENCES `DOM_PAYMENT` (`COD_PAYMENT`);

--
-- Limiti per la tabella `REVIEW`
--
ALTER TABLE `REVIEW`
  ADD CONSTRAINT `REVIEW_FK01` FOREIGN KEY (`COD_GAME`) REFERENCES `GAMES` (`COD_GAME`),
  ADD CONSTRAINT `REVIEW_FK02` FOREIGN KEY (`ID_USER`) REFERENCES `USERS` (`ID_USER`);

--
-- Limiti per la tabella `USERS`
--
ALTER TABLE `USERS`
  ADD CONSTRAINT `USERS_FK01` FOREIGN KEY (`COD_ROLE`) REFERENCES `DOM_ROLE` (`COD_ROLE`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
