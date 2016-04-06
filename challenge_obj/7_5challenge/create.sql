DROP DATABASE IF EXISTS `7_5challenge`;
CREATE DATABASE 7_5challenge;

use 7_5challenge;

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `name` varchar(255) NOT NULL,
  `userID` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp932;

DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp932;

insert into user values('田中太郎','tanaka','tt1234'),('山田花子','yamada','yh9876');
