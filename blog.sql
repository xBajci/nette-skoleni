-- Adminer 4.1.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) collate utf8_czech_ci NOT NULL,
  `slug` varchar(255) collate utf8_czech_ci default 'null',
  `content` text collate utf8_czech_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `article_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `article` (`id`, `user_id`, `title`, `slug`, `content`, `created`) VALUES
(7,	9,	'<script>',	'script',	'<h1>abc</h1>',	'2014-11-28 16:30:55'),
(10,	6,	'posledni almost',	'posledni-almost',	':D',	'2014-11-28 16:32:19'),
(12,	6,	'takjestejeden',	'takjestejeden',	'',	'2014-11-28 16:32:36'),
(13,	3,	'lalalala',	'lalalala',	'lalalala clanek',	'2014-11-28 16:32:49'),
(14,	3,	'bla',	'bla',	'bla',	'2014-11-28 16:32:57'),
(19,	4,	'Bootstrap',	'bootstrap',	'Download\n\nBootstrap (currently v3.3.1) has a few easy ways to quickly get started, each one appealing to a different skill level and use case. Read through to see what suits your particular needs.',	'2014-11-28 16:34:17'),
(21,	9,	'<?php echo \'LALALA\' ?>',	'php-echo-lalala',	'<?php echo \'LALALA\' ?>',	'2014-11-28 16:35:42'),
(23,	2,	'Treti',	'treti',	'asdfsadfasdf',	'2014-11-28 17:47:35'),
(24,	2,	'safdadfasdf',	'safdadfasdf',	'asfasfasfasdf',	'2014-11-28 17:48:05');

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) collate utf8_czech_ci NOT NULL,
  `article_id` int(11) NOT NULL,
  `content` text collate utf8_czech_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `article_id` (`article_id`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL auto_increment,
  `email` varchar(100) collate utf8_czech_ci NOT NULL,
  `password` varchar(100) collate utf8_czech_ci NOT NULL,
  `name` varchar(100) collate utf8_czech_ci NOT NULL,
  `role` enum('user','moderator','admin') collate utf8_czech_ci NOT NULL default 'user',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `user` (`id`, `email`, `password`, `name`, `role`) VALUES
(1,	'david@grudl.com',	'$2y$10$g/VSdNTpRngOLGWrFr1BZeys05rNTxJ2fyEgH5NihwhG6HGzaDAVW',	'David Grudl',	'user'),
(2,	'martin@martin.sk',	'$2y$10$FeAEQvZg4cS1Ik4IwkajvupwmIiIPL1MLXfeg0RJfIUaS8JS2PdmS',	'martin@martin.sk',	'user'),
(3,	'kadlecek@htkpro.cz',	'$2y$10$qtDawC6/Ms3HNfJUxvqWpuZ7F1ihJN1oFT1H7e99KUlaBJv6L.suC',	'kadlecek@htkpro.cz',	'user'),
(4,	'milan@milan.cz',	'$2y$10$OtHt8fHZw4TKIg9juLYSWO2196Q22Y9RufkZEF/Cm4bP1nAhpUkNO',	'milan@milan.cz',	'user'),
(6,	'mrdeepress@gmail.com',	'$2y$10$BPh8ZsFXA7XsaTRFhcNUoOUUvfSj0.9KDyOv3nI3tOj6..g1F.v7u',	'mrdeepress@gmail.com',	'user'),
(7,	'xbajci@gmail.com',	'$2y$10$myVxqQSvxr61ZFw60y897uGEjn9XNSNFwY4ZirxOGq4E6MzSoqHhO',	'xbajci@gmail.com',	'user'),
(8,	'xbajci@gmail.cz',	'$2y$10$VUUHsKvuTCR8MipMlUT0xeu7l2.L5v9RNdbj.ZQLHGi0LSz6AZvV2',	'xbajci@gmail.cz',	'user'),
(9,	'vladimir.voda@gmail.com',	'$2y$10$CMfCF2E0Uqtoy07HEWcMW.AA8p9s6dtMHaFArG.msIMV8FBhGF9yy',	'vladimir.voda@gmail.com',	'user');

-- 2014-11-28 17:09:25
