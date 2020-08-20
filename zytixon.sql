-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(21) NOT NULL,
  `privacy_level` int(11) NOT NULL,
  `sidebar` longtext NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_activity` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `rooms` (`id`, `name`, `privacy_level`, `sidebar`, `date_created`, `date_modified`, `date_last_activity`) VALUES
(1,	'general',	0,	'',	'2020-08-10 17:32:12',	'2020-08-10 17:32:12',	'2020-08-10 17:32:12'),
(2,	'dev',	4,	'',	'2020-08-10 17:32:52',	'2020-08-10 17:32:52',	'2020-08-10 17:32:52'),
(3,	'&lt;strong&gt;',	0,	'',	'2020-08-10 17:35:50',	'2020-08-10 17:35:50',	'2020-08-10 17:35:50'),
(4,	'Création',	0,	'',	'2020-08-10 17:36:16',	'2020-08-10 17:36:16',	'2020-08-10 17:36:16');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(14) DEFAULT NULL,
  `password` tinytext,
  `avatar_url` mediumtext,
  `registered_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_developer` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `tag`, `password`, `avatar_url`, `registered_date`, `is_developer`) VALUES
(2,	'locness3',	'$2y$10$2hhZVvaBzv4nQHvctc69IuDzoYFe0tYPGWCDEhf/O7MhtXgB.8lM6',	'/assets/images/avatar-default.png',	'2020-07-03 18:43:27',	0);

DROP TABLE IF EXISTS `user_room_relationship`;
CREATE TABLE `user_room_relationship` (
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `join_status` int(11) NOT NULL DEFAULT '0',
  `permission_level` int(11) NOT NULL DEFAULT '1',
  `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_room_relationship_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user_room_relationship` (`user_id`, `room_id`, `join_status`, `permission_level`, `join_date`) VALUES
(2,	1,	2,	4,	'2020-08-10 17:32:12'),
(2,	2,	2,	4,	'2020-08-10 17:32:52'),
(2,	3,	2,	4,	'2020-08-10 17:35:50'),
(2,	4,	2,	4,	'2020-08-10 17:36:16');

-- 2020-08-20 06:57:12
