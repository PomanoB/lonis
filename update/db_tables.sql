DROP TABLE IF EXISTS `kz_comm`;
CREATE TABLE `kz_comm` (
	`name` VARCHAR(8) NOT NULL,
	`url` VARCHAR(64) NULL DEFAULT NULL,
	`image` VARCHAR(256) NULL DEFAULT NULL,
	`download` VARCHAR(256) NULL DEFAULT NULL,
	`map` VARCHAR(256) NULL DEFAULT NULL,
	PRIMARY KEY (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `unr_achiev`;
CREATE TABLE `unr_achiev` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(40) NOT NULL,
  `count` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `unr_achiev_lang`;
CREATE TABLE `unr_achiev_lang` (
  `lid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `achievid` int(10) NOT NULL,
  `ltype` varchar(4) NOT NULL,
  `lang` varchar(2) NOT NULL,
  `value` varchar(256) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `servers`;
CREATE TABLE `servers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mod` int(10) DEFAULT NULL,
  `addres` varchar(32) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `map` varchar(32) DEFAULT NULL,
  `players` varchar(8) DEFAULT NULL,
  `update` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `servers_mod`;
CREATE TABLE `servers_mod` (
  `mid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modname` varchar(16) NOT NULL,
  KEY `id` (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

DROP TABLE IF EXISTS `weapons`;
CREATE TABLE `weapons` (
  `id` int(10) unsigned DEFAULT NULL,
  `name` varchar(16),
  `fullname` varchar(32)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `lang`;
CREATE TABLE `lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) NOT NULL,
  `name` varchar(16) NOT NULL,
  `default` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `langs`;
CREATE TABLE `langs` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`lang` VARCHAR(2) NOT NULL,
	`var` VARCHAR(64) NOT NULL,
	`value` VARCHAR(256) NOT NULL,
	PRIMARY KEY (`id`)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `themes`;
CREATE TABLE `themes` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `theme` VARCHAR(8),
  `default` TINYINT(1) DEFAULT '0',
   `cs` TINYINT(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `themes_lang`;
CREATE TABLE `themes_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `themesid` int(10) NOT NULL,
  `lang` varchar(2) NOT NULL,
  `name` varchar(16) NOT NULL,
  KEY `id` (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `kz_duel`;
CREATE TABLE `kz_duel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `map` varchar(64) NOT NULL,
  `player1` int(10) unsigned NOT NULL,
  `player2` int(10) unsigned NOT NULL,
  `result1` int(11) NOT NULL,
  `result2` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `kz_map_top`;
CREATE TABLE `kz_map_top` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `map` varchar(64) NOT NULL,
  `player` int(10) unsigned NOT NULL,
  `time` decimal(10,5) NOT NULL,
  `cp` int(10) unsigned NOT NULL,
  `go_cp` int(10) unsigned NOT NULL,
  `weapon` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`, `map`),
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

DROP TABLE IF EXISTS `kz_save`;
CREATE TABLE `kz_save` (
  `map` varchar(50) NOT NULL,
  `player` int(11) NOT NULL,
  `posx` int(11) NOT NULL,
  `posy` int(11) NOT NULL,
  `posz` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `angle_x` int(11) NOT NULL,
  `angle_y` int(11) NOT NULL,
  `angle_z` int(11) NOT NULL,
  `cp` int(10) unsigned NOT NULL DEFAULT '0',
  `go_cp` int(10) unsigned NOT NULL DEFAULT '0',
  `weapon` int(10) unsigned NOT NULL,
  PRIMARY KEY (`map`,`player`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `unr_activate`;
CREATE TABLE `unr_activate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `player` int(11) NOT NULL,
  `key` varchar(50) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `unr_dr_stats`;
CREATE TABLE `unr_dr_stats` (
  `map` varchar(32) NOT NULL,
  `player` int(10) unsigned NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `free` int(1) unsigned NOT NULL,
  KEY `map` (`map`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `unr_players`;
CREATE TABLE `unr_players` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `password` varchar(50) NOT NULL,
  `ip` varchar(32) DEFAULT NULL,
  `lastIp` varchar(20) DEFAULT NULL,
  `lastTime` int(1) DEFAULT NULL,
  `onlineTime` int(1) DEFAULT NULL,
  `steam_id` varchar(32) DEFAULT NULL,
  `amxx_flags` varchar(34) DEFAULT NULL,
  `flags` int(11) DEFAULT NULL DEFAULT '0',
  `webadmin` tinyint(1) DEFAULT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL,
  `icq` int(9) DEFAULT NULL,
  `active` int(11) DEFAULT '0',
  `auth` int(10) unsigned DEFAULT NULL DEFAULT '0',
  `steam_id_64` varchar(30) DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT ;

DROP TABLE IF EXISTS `unr_players_achiev`;
CREATE TABLE `unr_players_achiev` (
  `playerId` int(11) NOT NULL,
  `achievId` int(11) NOT NULL,
  `progress` int(11) NOT NULL,
  `unlocked` INT(11) NOT NULL,
  PRIMARY KEY (`playerId`,`achievId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

DROP TABLE IF EXISTS `unr_players_var`;
CREATE TABLE `unr_players_var` (
  `playerId` int(11) NOT NULL,
  `key` varchar(50) NOT NULL,
  `value` varchar(512) NOT NULL,
  PRIMARY KEY (`playerId`,`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;	   

DROP TABLE IF EXISTS `kz_map_rec`;
CREATE TABLE `kz_map_rec` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`mapname` VARCHAR(64) NOT NULL,
	`mappath` VARCHAR(16) NULL DEFAULT NULL,
	`time` DECIMAL(10,2) NULL DEFAULT NULL,
	`player` VARCHAR(32) NULL DEFAULT NULL,
	`country` VARCHAR(8) NULL DEFAULT NULL,
	`comm` VARCHAR(8) NULL DEFAULT NULL,
	PRIMARY KEY (`id`, `mapname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `kz_map_list`;
CREATE TABLE `kz_map_list` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`mapname` VARCHAR(64) NOT NULL,
	PRIMARY KEY (`id`, `mapname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;