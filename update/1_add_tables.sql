-- TABLES --

DROP TABLE IF EXISTS `kz_comm`;
CREATE TABLE `kz_comm` (
	`sort` INT(10) NOT NULL,
	`name` VARCHAR(8) NOT NULL,
	`fullname` VARCHAR(16) NOT NULL,
	`url` VARCHAR(64) NULL DEFAULT NULL,
	`image` VARCHAR(256) NULL DEFAULT NULL,
	`download` VARCHAR(256) NULL DEFAULT NULL,
	`mapinfo` VARCHAR(256) NULL DEFAULT NULL,
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
	`lid` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`achievid` INT(10) NOT NULL,
	`lang` VARCHAR(2) NULL DEFAULT NULL,
	`ltype` VARCHAR(4) NULL DEFAULT NULL,
	`value` VARCHAR(256) NULL DEFAULT NULL,
	PRIMARY KEY (`lid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `servers`;
CREATE TABLE `servers` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`mod` int(10) DEFAULT NULL,
	`addres` varchar(32) NOT NULL,
	`vip` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
	`name` varchar(32) DEFAULT NULL,
	`map` varchar(32) DEFAULT NULL,
	`players` varchar(8) DEFAULT NULL,
	`update` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `servers_mod`;
CREATE TABLE `servers_mod` (
	`mid` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`modname` varchar(16) NOT NULL,
	PRIMARY KEY (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

DROP TABLE IF EXISTS `weapons`;
CREATE TABLE `weapons` (
	`id` int(10) unsigned DEFAULT NULL,
	`wname` varchar(16),
	`fullname` varchar(32),
	PRIMARY KEY (`id`)
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
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`themesid` INT(10) NOT NULL,
	`lang` VARCHAR(2) NOT NULL,
	`name` VARCHAR(16) NOT NULL,
	PRIMARY KEY (`id`)
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
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`map` VARCHAR(64) NOT NULL,
	`player` INT(10) UNSIGNED NOT NULL,
	`time` DECIMAL(10,5) NOT NULL,
	`cp` INT(10) UNSIGNED NOT NULL,
	`go_cp` INT(10) UNSIGNED NOT NULL,
	`weapon` INT(10) UNSIGNED NOT NULL,
	`time_add` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`),
	INDEX `weapon` (`weapon`),
	INDEX `map` (`map`),
	INDEX `player` (`player`)
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
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(32) NOT NULL,
	`password` VARCHAR(50) NOT NULL,
	`ip` VARCHAR(32) NULL DEFAULT NULL,
	`lastIp` VARCHAR(20) NULL DEFAULT NULL,
	`lastTime` INT(1) NULL DEFAULT NULL,
	`country` VARCHAR(5) NULL DEFAULT NULL,
	`onlineTime` INT(1) NULL DEFAULT NULL,
	`steam_id` VARCHAR(32) NULL DEFAULT NULL,
	`amxx_flags` VARCHAR(34) NULL DEFAULT NULL,
	`flags` INT(11) NULL DEFAULT '0',
	`webadmin` TINYINT(1) NULL DEFAULT '0',
	`email` VARCHAR(100) NOT NULL,
	`icq` INT(9) NULL DEFAULT NULL,
	`active` INT(11) NULL DEFAULT '0',
	`auth` INT(10) NULL DEFAULT '0',
	`steam_id_64` VARCHAR(30) NULL DEFAULT NULL,
	`lang` INT(4) NULL DEFAULT NULL,
	`themes` INT(4) NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `name` (`name`),
	INDEX `country` (`country`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `unr_players_achiev`;
CREATE TABLE `unr_players_achiev` (
	`playerId` int(11) NOT NULL,
	`achievId` int(11) NOT NULL,
	`progress` int(11) NOT NULL,
	`unlocked` INT(11) NOT NULL,
	PRIMARY KEY (`playerId`,`achievId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `unr_players_var`;
CREATE TABLE `unr_players_var` (
	`playerId` int(11) NOT NULL,
	`key` varchar(50) NOT NULL,
	`value` varchar(512) NOT NULL,
	PRIMARY KEY (`playerId`,`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- TRIGGER --

DELIMITER |
CREATE TRIGGER `unr_players_before_insert` BEFORE INSERT ON `unr_players` FOR EACH ROW BEGIN 
SET NEW.`countryCode` = (
	SELECT `code` FROM `geoip_whois`
	WHERE `ip_to` >= INET_ATON(NEW.`lastIp`)
	ORDER BY `ip_to` ASC LIMIT 1
);
END

CREATE TRIGGER `unr_players_before_update` BEFORE UPDATE ON `unr_players` FOR EACH ROW BEGIN 
SET NEW.`countryCode` = (
	SELECT `code` FROM `geoip_whois`
	WHERE `ip_to` >= INET_ATON(NEW.`lastIp`)
	ORDER BY `ip_to` ASC LIMIT 1
);
END
| 
DELIMITER ;