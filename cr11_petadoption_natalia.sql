-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 01. Mai 2021 um 15:22
-- Server-Version: 10.4.18-MariaDB
-- PHP-Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `cr11_petadoption_natalia`
--
CREATE DATABASE IF NOT EXISTS `cr11_petadoption_natalia` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cr11_petadoption_natalia`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pets`
--

CREATE TABLE `pets` (
  `petID` int(11) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `pet_name` varchar(255) NOT NULL,
  `pet_descr` varchar(255) NOT NULL,
  `pet_date_of_birth` date NOT NULL,
  `hobbies` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `pet_size` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `pets`
--

INSERT INTO `pets` (`petID`, `breed`, `pet_name`, `pet_descr`, `pet_date_of_birth`, `hobbies`, `picture`, `pet_size`, `location`) VALUES
(5, 'dog', 'Colin', 'White with brown dots', '2013-05-01', 'running, splashing in water', '608d53ed2deea.jpg', 'large', 'KÃ¤rntner Ring 1, 1010 Vienna, Austria'),
(6, 'snake', 'Coolio', 'A 1 year old Smooth Green Snake, very lovely and calm', '2020-02-01', 'sleeping, eating, jumping, cuddling', 'pet.png', 'small', 'KÃ¤rntner Ring 1, 1010 Vienna, Austria'),
(7, 'dog', 'Sesam', 'Small 1 year old labrador retriever, very lovely with light fur.', '2020-05-05', 'running, catching ball, cuddling', '608d28d8a6304.jpg', 'small', 'Animal Shelter Gasse 1, 1100 Vienna, Austria'),
(8, 'cat', 'Lioness', 'A grown-up tiger cat. Used to live in household with children, so a good child companion.', '2011-02-20', 'dancing, drinking almond milk, playing with a feather', '608d28e57c84b.jpg', 'small', 'Cat Gasse 1, 1150 Vienna, Austria'),
(9, 'parrot', 'Captain Jack', 'A grown red parrot.', '2012-02-22', 'singing, discussions about food, drinking rum', '608d28efdb286.jpg', 'large', 'Animal Shelter Gasse 1, 1100 Vienna, Austria'),
(10, 'parrot', 'Bonnie and Clyde', 'Our senior pair of green parrots - a couple you will not find anywhere else. Possible to take only as a couple because one can not live without the other.', '2010-10-10', 'dancing, singing, repeating the sentence of the other', '608d2909e23f4.jpg', 'small', 'Animal Shelter Gasse 1, 1100 Vienna, Austria'),
(11, 'cat', 'Himnie', 'A beautiful white cat with long fur and a grey dot on a half of his face. Very easy going and keeps your house out of bugs.', '2015-07-07', 'running after bugs, jumping', '608d2912ee786.jpg', 'large', 'Cat Gasse 1, 1150 Vienna, Austria'),
(12, 'hamster', 'Biscuit and cheese', 'Biscuit and cheese are siblings. Very calm, perfect to be taken care by children. ', '2019-09-21', 'running a wheel, eating nuts', '608d291b98f12.jpg', 'large', 'Animal Shelter Gasse 1, 1100 Vienna, Austria'),
(14, 'chamaeleon', 'Chimnie', 'Chimnie is a grown-up chamaeleon who was rescued from being sold on the black market.', '2012-08-31', 'eating bugs, smiling and making water fountains', '608d2924c6a47.jpg', 'large', 'Animal Shelter Gasse 1, 1100 Vienna, Austria'),
(16, 'hamster', 'Doughnut', 'Despite his name doughnat enjoys eating veggies.', '2017-08-04', 'running a wheel, eating carrots & broccoli', '608d29320b91c.jpg', 'small', 'Animal Shelter Gasse 1, 1100 Vienna, Austria'),
(17, 'chamaeleon', 'Greenie', 'Greenie is a 2 year old chameleon who enjoys company of non-smoking people.', '2018-06-02', 'eating bugs, climbing trees and eating leaves', '608d293bc678e.jpg', 'small', 'KÃ¤rntner Ring 1, 1010 Vienna, Austria');

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `pets_adopted_by_user`
-- (Siehe unten für die tatsächliche Ansicht)
--
CREATE TABLE `pets_adopted_by_user` (
`pet_adoptionID` int(11) unsigned
,`petID` int(11)
,`pet_name` varchar(255)
,`pet_date_of_birth` date
,`userID` int(11)
,`first_name` varchar(255)
,`last_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pet_adoption`
--

CREATE TABLE `pet_adoption` (
  `pet_adoptionID` int(11) UNSIGNED NOT NULL,
  `fk_userID` int(11) NOT NULL,
  `fk_petID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `pet_adoption`
--

INSERT INTO `pet_adoption` (`pet_adoptionID`, `fk_userID`, `fk_petID`) VALUES
(18, 6, 8),
(19, 6, 6),
(20, 4, 12),
(21, 5, 9),
(22, 5, 7),
(23, 5, 11);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`userID`, `first_name`, `last_name`, `password`, `date_of_birth`, `email`, `picture`, `status`) VALUES
(1, 'admin', 'last', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2011-01-01', 'admin@gmail.com', 'avatar.png', 'adm'),
(3, 'Richie', 'Doe', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2001-02-02', 'richie@gmail.com', '608bd19c9f988.jpg', 'user'),
(4, 'Susanne', 'Brick', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2002-02-02', 'susanne@gmail.com', '608bd65e3cc40.jpg', 'user'),
(5, 'Jenny', 'Ofoldstones', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1996-12-31', 'jenny@gmail.com', '608bd6885d673.jpg', 'user'),
(6, 'Tobias', 'Tierfreund', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '1957-07-01', 'tobias@gmail.com', '608d35dfde81e.jpg', 'user');

-- --------------------------------------------------------

--
-- Struktur des Views `pets_adopted_by_user`
--
DROP TABLE IF EXISTS `pets_adopted_by_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pets_adopted_by_user`  AS SELECT `pet_adoption`.`pet_adoptionID` AS `pet_adoptionID`, `pets`.`petID` AS `petID`, `pets`.`pet_name` AS `pet_name`, `pets`.`pet_date_of_birth` AS `pet_date_of_birth`, `user`.`userID` AS `userID`, `user`.`first_name` AS `first_name`, `user`.`last_name` AS `last_name` FROM ((`pets` join `pet_adoption` on(`pet_adoption`.`fk_petID` = `pets`.`petID`)) join `user` on(`pet_adoption`.`fk_userID` = `user`.`userID`)) ;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`petID`);

--
-- Indizes für die Tabelle `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD PRIMARY KEY (`pet_adoptionID`),
  ADD KEY `fk_userID` (`fk_userID`),
  ADD KEY `fk_petID` (`fk_petID`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `pets`
--
ALTER TABLE `pets`
  MODIFY `petID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT für Tabelle `pet_adoption`
--
ALTER TABLE `pet_adoption`
  MODIFY `pet_adoptionID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD CONSTRAINT `pet_adoption_ibfk_1` FOREIGN KEY (`fk_userID`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `pet_adoption_ibfk_2` FOREIGN KEY (`fk_petID`) REFERENCES `pets` (`petID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
