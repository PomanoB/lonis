/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

DROP VIEW IF EXISTS `achiev`;
CREATE TABLE `achiev` (
	`id` INT(10) UNSIGNED NOT NULL,
	`type` VARCHAR(40) NOT NULL COLLATE 'utf8_general_ci',
	`count` INT(10) UNSIGNED NOT NULL,
	`icon` CHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`lid` INT(10) UNSIGNED NOT NULL,
	`achievid` INT(10) NOT NULL,
	`lang` VARCHAR(2) NULL COLLATE 'utf8_general_ci',
	`name` VARCHAR(256) NULL COLLATE 'utf8_general_ci',
	`desc` VARCHAR(256) NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `id` int(3) unsigned NOT NULL,
  `var` char(50) NOT NULL,
  `value` char(50) NOT NULL,
  `type` char(16) NOT NULL DEFAULT 'text'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `geoip_locations`;
CREATE TABLE IF NOT EXISTS `geoip_locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `geoname_id` int(10) NOT NULL,
  `locale_code` char(2) NOT NULL,
  `continent_code` char(2) NOT NULL,
  `continent_name` varchar(32) NOT NULL,
  `country_iso_code` char(2) NOT NULL,
  `country_name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`,`country_iso_code`),
  KEY `geoname_id` (`geoname_id`),
  KEY `country_iso_code` (`country_iso_code`)
) ENGINE=InnoDB AUTO_INCREMENT=2035 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `geoip_whois`;
CREATE TABLE IF NOT EXISTS `geoip_whois` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `network` varchar(20) NOT NULL,
  `ip_from` int(10) unsigned NOT NULL,
  `code` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `code` (`code`),
  KEY `ip_from` (`ip_from`)
) ENGINE=InnoDB AUTO_INCREMENT=239096 DEFAULT CHARSET=utf8;

DROP FUNCTION IF EXISTS `getSteamId64`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` FUNCTION `getSteamId64`(`steamId` varchar(64)) RETURNS varchar(30) CHARSET utf8
    COMMENT 'FUNCTION'
BEGIN
	DECLARE steamId64 VARCHAR(30);
 	DECLARE pos INT;
 	DECLARE bit1 INT;
 	DECLARE bit2 INT;
 	
 	IF LOCATE('STEAM_0:', steamId) = 0 THEN
 		RETURN "";
 	END IF;
	 	
 	SET steamId = REPLACE(steamId, 'STEAM_0:', '');
 	SET pos = LOCATE(':', steamId);
 	
	IF pos = 0 THEN
 		RETURN "";
 	END IF;	
 	
 	SET bit1 = LEFT(steamId, pos-1);
 	SET bit2 = MID(steamId, pos+1, LENGTH(steamId));
 	
 	SET steamId64 = 76561197960265728+bit1+bit2*2;
	 	
	RETURN steamId64; 
END//
DELIMITER ;

DROP TABLE IF EXISTS `info_stats`;
CREATE TABLE IF NOT EXISTS `info_stats` (
  `cvar` varchar(32) NOT NULL,
  `val` varchar(16) NOT NULL,
  UNIQUE KEY `cvar` (`cvar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `kz_comm`;
CREATE TABLE IF NOT EXISTS `kz_comm` (
  `sort` int(10) NOT NULL,
  `name` varchar(8) NOT NULL,
  `fullname` varchar(16) NOT NULL,
  `url` varchar(64) DEFAULT NULL,
  `image` varchar(256) DEFAULT NULL,
  `download` varchar(256) DEFAULT NULL,
  `mapinfo` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `kz_diff`;
CREATE TABLE IF NOT EXISTS `kz_diff` (
  `id` int(11) unsigned NOT NULL,
  `dpname` varchar(32) NOT NULL,
  `dname` varchar(32) NOT NULL,
  `ddot` int(1) NOT NULL,
  `dcolor` char(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `kz_duel`;
CREATE TABLE IF NOT EXISTS `kz_duel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `map` varchar(64) NOT NULL,
  `player1` int(10) unsigned NOT NULL,
  `player2` int(10) unsigned NOT NULL,
  `result1` int(11) NOT NULL,
  `result2` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `kz_ljs_recs`;
CREATE TABLE IF NOT EXISTS `kz_ljs_recs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plname` varchar(32) NOT NULL,
  `distance` varchar(8) NOT NULL,
  `block` varchar(3) NOT NULL,
  `prestrafe` varchar(8) NOT NULL,
  `speed` varchar(8) NOT NULL,
  `type` varchar(8) NOT NULL,
  `country` varchar(2) NOT NULL,
  `comm` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `kz_ljs_type`;
CREATE TABLE IF NOT EXISTS `kz_ljs_type` (
  `sort` int(3) unsigned NOT NULL DEFAULT '0',
  `name` varchar(8) NOT NULL,
  `fullname` varchar(32) NOT NULL DEFAULT '0',
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `kz_map`;
CREATE TABLE IF NOT EXISTS `kz_map` (
  `mapname` varchar(64) NOT NULL,
  `diff` int(2) unsigned DEFAULT '0',
  `type` varchar(32) DEFAULT NULL,
  `sc` int(10) unsigned DEFAULT NULL,
  `authors` varchar(128) DEFAULT NULL,
  `date_old` varchar(16) DEFAULT NULL,
  `comm` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`mapname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP VIEW IF EXISTS `kz_map_best`;
CREATE TABLE `kz_map_best` (
	`id` INT(10) UNSIGNED NOT NULL,
	`map` VARCHAR(64) NOT NULL COLLATE 'utf8_general_ci',
	`player` INT(10) UNSIGNED NOT NULL,
	`time` DECIMAL(10,5) NULL,
	`cp` INT(10) UNSIGNED NOT NULL,
	`go_cp` INT(10) UNSIGNED NOT NULL,
	`weapon` INT(10) UNSIGNED NOT NULL,
	`time_add` TIMESTAMP NOT NULL
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `kz_map_locked`;
CREATE TABLE IF NOT EXISTS `kz_map_locked` (
  `mapname` varchar(64) NOT NULL,
  `diff` int(2) unsigned DEFAULT '0',
  `type` varchar(32) DEFAULT NULL,
  `sc` int(10) unsigned DEFAULT NULL,
  `authors` varchar(128) DEFAULT NULL,
  `date_old` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`mapname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `kz_map_top`;
CREATE TABLE IF NOT EXISTS `kz_map_top` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `map` varchar(64) NOT NULL,
  `player` int(10) unsigned NOT NULL,
  `time` decimal(10,5) NOT NULL,
  `cp` int(10) unsigned NOT NULL,
  `go_cp` int(10) unsigned NOT NULL,
  `weapon` int(10) unsigned NOT NULL,
  `time_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `weapon` (`weapon`),
  KEY `map` (`map`),
  KEY `player` (`player`),
  KEY `time` (`time`)
) ENGINE=InnoDB AUTO_INCREMENT=276814 DEFAULT CHARSET=utf8;

DROP VIEW IF EXISTS `kz_map_top1`;
CREATE TABLE `kz_map_top1` (
	`id` INT(10) UNSIGNED NOT NULL,
	`map` VARCHAR(64) NOT NULL COLLATE 'utf8_general_ci',
	`player` INT(10) UNSIGNED NOT NULL,
	`time` DECIMAL(10,5) NOT NULL,
	`cp` INT(10) UNSIGNED NOT NULL,
	`go_cp` INT(10) UNSIGNED NOT NULL,
	`weapon` INT(10) UNSIGNED NOT NULL,
	`time_add` TIMESTAMP NOT NULL,
	`dname` VARCHAR(32) NULL COLLATE 'utf8_general_ci',
	`ddot` INT(1) NULL,
	`dcolor` CHAR(16) NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;

DROP VIEW IF EXISTS `kz_map_tops`;
CREATE TABLE `kz_map_tops` (
	`id` INT(10) UNSIGNED NOT NULL,
	`map` VARCHAR(64) NOT NULL COLLATE 'utf8_general_ci',
	`player` INT(10) UNSIGNED NOT NULL,
	`time` DECIMAL(10,5) NOT NULL,
	`cp` INT(10) UNSIGNED NOT NULL,
	`go_cp` INT(10) UNSIGNED NOT NULL,
	`weapon` INT(10) UNSIGNED NOT NULL,
	`time_add` TIMESTAMP NOT NULL,
	`name` VARCHAR(32) NOT NULL COLLATE 'utf8_general_ci',
	`wname` VARCHAR(16) NOT NULL COLLATE 'utf8_general_ci',
	`dname` VARCHAR(32) NULL COLLATE 'utf8_general_ci',
	`ddot` INT(1) NULL,
	`dcolor` CHAR(16) NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;

DROP VIEW IF EXISTS `kz_map_tops1`;
CREATE TABLE `kz_map_tops1` (
	`id` INT(10) UNSIGNED NOT NULL,
	`map` VARCHAR(64) NOT NULL COLLATE 'utf8_general_ci',
	`player` INT(10) UNSIGNED NOT NULL,
	`time` DECIMAL(10,5) NOT NULL,
	`cp` INT(10) UNSIGNED NOT NULL,
	`go_cp` INT(10) UNSIGNED NOT NULL,
	`weapon` INT(10) UNSIGNED NOT NULL,
	`time_add` TIMESTAMP NOT NULL,
	`name` VARCHAR(32) NOT NULL COLLATE 'utf8_general_ci',
	`wname` VARCHAR(16) NULL COLLATE 'utf8_general_ci',
	`dname` VARCHAR(32) NULL COLLATE 'utf8_general_ci',
	`ddot` INT(1) NULL,
	`dcolor` CHAR(16) NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;

DROP VIEW IF EXISTS `kz_map_top_min`;
CREATE TABLE `kz_map_top_min` (
	`minmap` VARCHAR(64) NOT NULL COLLATE 'utf8_general_ci',
	`mintime` DECIMAL(10,5) NULL
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `kz_map_update`;
CREATE TABLE IF NOT EXISTS `kz_map_update` (
  `mapname` varchar(64) NOT NULL,
  `diff` int(2) unsigned DEFAULT '0',
  `type` varchar(32) DEFAULT NULL,
  `sc` int(10) unsigned DEFAULT NULL,
  `authors` varchar(128) DEFAULT NULL,
  `date_old` varchar(16) DEFAULT NULL,
  `comm` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`mapname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `kz_records`;
CREATE TABLE IF NOT EXISTS `kz_records` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `map` varchar(64) NOT NULL,
  `mappath` varchar(16) DEFAULT NULL,
  `time` decimal(10,2) DEFAULT NULL,
  `player` varchar(32) DEFAULT NULL,
  `country` varchar(2) DEFAULT NULL,
  `comm` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `map` (`map`)
) ENGINE=InnoDB AUTO_INCREMENT=10181 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `kz_save`;
CREATE TABLE IF NOT EXISTS `kz_save` (
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

DROP TABLE IF EXISTS `lang`;
CREATE TABLE IF NOT EXISTS `lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) NOT NULL,
  `name` varchar(16) NOT NULL,
  `use` tinyint(1) NOT NULL DEFAULT '1',
  `default` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `langs`;
CREATE TABLE IF NOT EXISTS `langs` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) NOT NULL,
  `var` varchar(256) NOT NULL,
  `value` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=403 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `num` int(2) unsigned NOT NULL DEFAULT '0',
  `parent` varchar(16) DEFAULT NULL,
  `mname` varchar(16) NOT NULL,
  `action` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP VIEW IF EXISTS `players`;
CREATE TABLE `players` (
	`id` INT(10) UNSIGNED NOT NULL,
	`name` VARCHAR(32) NOT NULL COLLATE 'utf8_general_ci',
	`lastIp` VARCHAR(20) NULL COLLATE 'utf8_general_ci',
	`email` VARCHAR(100) NOT NULL COLLATE 'utf8_general_ci',
	`steam_id_64` VARCHAR(30) NULL COLLATE 'utf8_general_ci',
	`country` VARCHAR(5) NULL COLLATE 'utf8_general_ci',
	`countryName` VARCHAR(64) NULL COLLATE 'utf8_general_ci',
	`lang` CHAR(2) NULL COLLATE 'utf8_general_ci',
	`achiev` BIGINT(21) NULL
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `servers`;
CREATE TABLE IF NOT EXISTS `servers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mod` int(10) NOT NULL,
  `addres` varchar(32) NOT NULL,
  `vip` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `name` varchar(32) DEFAULT NULL,
  `map` varchar(32) DEFAULT NULL,
  `players` int(4) DEFAULT NULL,
  `max_players` int(4) DEFAULT NULL,
  `update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `servers_mod`;
CREATE TABLE IF NOT EXISTS `servers_mod` (
  `mid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modname` varchar(16) NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `themes`;
CREATE TABLE IF NOT EXISTS `themes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `theme` varchar(8) DEFAULT NULL,
  `default` tinyint(1) DEFAULT '0',
  `cs` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `themes_lang`;
CREATE TABLE IF NOT EXISTS `themes_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `themesid` int(10) NOT NULL,
  `lang` varchar(2) NOT NULL,
  `name` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `unr_achiev`;
CREATE TABLE IF NOT EXISTS `unr_achiev` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(40) NOT NULL,
  `count` int(10) unsigned NOT NULL,
  `icon` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `unr_achiev_lang`;
CREATE TABLE IF NOT EXISTS `unr_achiev_lang` (
  `lid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `achievid` int(10) NOT NULL,
  `lang` varchar(2) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `desc` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `unr_activate`;
CREATE TABLE IF NOT EXISTS `unr_activate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `player` int(11) NOT NULL,
  `key` varchar(50) NOT NULL,
  `time` int(11) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `unr_dr_stats`;
CREATE TABLE IF NOT EXISTS `unr_dr_stats` (
  `map` varchar(32) NOT NULL,
  `player` int(10) unsigned NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `free` int(1) unsigned NOT NULL,
  KEY `map` (`map`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `unr_players`;
CREATE TABLE IF NOT EXISTS `unr_players` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `password` varchar(50) DEFAULT '',
  `ip` varchar(32) DEFAULT NULL,
  `lastIp` varchar(20) DEFAULT NULL,
  `lastTime` int(1) DEFAULT NULL,
  `country` varchar(5) DEFAULT NULL,
  `onlineTime` int(1) DEFAULT NULL,
  `steam_id` varchar(32) DEFAULT NULL,
  `amxx_flags` varchar(34) DEFAULT NULL,
  `flags` int(11) DEFAULT '0',
  `webadmin` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '',
  `icq` int(9) DEFAULT NULL,
  `active` int(11) DEFAULT '0',
  `auth` int(10) DEFAULT '0',
  `steam_id_64` varchar(30) DEFAULT NULL,
  `lang` int(4) DEFAULT NULL,
  `themes` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `name_steam_id` (`name`,`steam_id`),
  KEY `country` (`country`)
) ENGINE=InnoDB AUTO_INCREMENT=1128 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

DROP TABLE IF EXISTS `unr_players_achiev`;
CREATE TABLE IF NOT EXISTS `unr_players_achiev` (
  `playerId` int(11) NOT NULL,
  `achievId` int(11) NOT NULL,
  `progress` int(11) NOT NULL,
  `unlocked` int(11) NOT NULL,
  PRIMARY KEY (`playerId`,`achievId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

DROP TABLE IF EXISTS `unr_players_var`;
CREATE TABLE IF NOT EXISTS `unr_players_var` (
  `playerId` int(11) NOT NULL,
  `key` varchar(50) NOT NULL,
  `value` varchar(512) NOT NULL,
  PRIMARY KEY (`playerId`,`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `uq_block_tops`;
CREATE TABLE IF NOT EXISTS `uq_block_tops` (
  `pid` int(11) NOT NULL,
  `type` varchar(32) NOT NULL,
  `distance` int(10) NOT NULL,
  `jumpoff` int(10) NOT NULL,
  `block` varchar(5) NOT NULL,
  `pspeed` int(3) NOT NULL,
  `wpn` varchar(32) NOT NULL,
  KEY `pid` (`pid`,`type`,`distance`,`jumpoff`,`pspeed`,`wpn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `uq_jumps`;
CREATE TABLE IF NOT EXISTS `uq_jumps` (
  `pid` int(11) NOT NULL,
  `type` varchar(32) NOT NULL,
  `distance` int(10) NOT NULL,
  `maxspeed` int(10) NOT NULL,
  `prestrafe` int(10) NOT NULL,
  `strafes` int(2) NOT NULL,
  `sync` int(3) NOT NULL,
  `ddbh` int(3) NOT NULL DEFAULT '0',
  `pspeed` int(3) NOT NULL,
  `wpn` varchar(32) NOT NULL,
  KEY `pid` (`pid`,`type`,`distance`,`maxspeed`,`prestrafe`,`strafes`,`sync`,`ddbh`,`pspeed`,`wpn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `uq_players`;
CREATE TABLE IF NOT EXISTS `uq_players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `ip` varchar(39) NOT NULL,
  `authid` varchar(35) NOT NULL,
  `lastseen` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`,`authid`)
) ENGINE=InnoDB AUTO_INCREMENT=68890 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `weapons`;
CREATE TABLE IF NOT EXISTS `weapons` (
  `id` int(10) unsigned NOT NULL,
  `wname` varchar(16) NOT NULL,
  `fullname` varchar(32) DEFAULT NULL,
  `info` text,
  `pspeed` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TRIGGER IF EXISTS `unr_players_before_insert`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `unr_players_before_insert` BEFORE INSERT ON `unr_players` FOR EACH ROW BEGIN 
SET NEW.`country` = (
	SELECT `code` FROM `geoip_whois`
	WHERE `ip_from` <= INET_ATON(NEW.`lastIp`) AND NEW.`lastIp` <> ''
	ORDER BY `ip_from` DESC LIMIT 1
);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

DROP TRIGGER IF EXISTS `unr_players_before_update`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `unr_players_before_update` BEFORE UPDATE ON `unr_players` FOR EACH ROW BEGIN 
SET NEW.`country` = (
	SELECT `code` FROM `geoip_whois`
	WHERE `ip_from` <= INET_ATON(NEW.`lastIp`) AND NEW.`lastIp` <> ''
	ORDER BY `ip_from` DESC LIMIT 1
);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

DROP VIEW IF EXISTS `achiev`;
DROP TABLE IF EXISTS `achiev`;
CREATE VIEW `achiev` AS select `a`.`id` AS `id`,`a`.`type` AS `type`,`a`.`count` AS `count`,`a`.`icon` AS `icon`,`al`.`lid` AS `lid`,`al`.`achievid` AS `achievid`,`al`.`lang` AS `lang`,`al`.`name` AS `name`,`al`.`desc` AS `desc` from (`unr_achiev` `a` join `unr_achiev_lang` `al`) where (`a`.`id` = `al`.`achievid`);

DROP VIEW IF EXISTS `kz_map_best`;
DROP TABLE IF EXISTS `kz_map_best`;
CREATE ALGORITHM=TEMPTABLE DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kz_map_best` AS select `kz_map_top`.`id` AS `id`,`kz_map_top`.`map` AS `map`,`kz_map_top`.`player` AS `player`,min(`kz_map_top`.`time`) AS `time`,`kz_map_top`.`cp` AS `cp`,`kz_map_top`.`go_cp` AS `go_cp`,`kz_map_top`.`weapon` AS `weapon`,`kz_map_top`.`time_add` AS `time_add` from `kz_map_top` group by `kz_map_top`.`map`,`kz_map_top`.`player`,`kz_map_top`.`weapon`;

DROP VIEW IF EXISTS `kz_map_top1`;
DROP TABLE IF EXISTS `kz_map_top1`;
CREATE VIEW `kz_map_top1` AS select `t`.`id` AS `id`,`t`.`map` AS `map`,`t`.`player` AS `player`,`t`.`time` AS `time`,`t`.`cp` AS `cp`,`t`.`go_cp` AS `go_cp`,`t`.`weapon` AS `weapon`,`t`.`time_add` AS `time_add`,`d`.`dname` AS `dname`,`d`.`ddot` AS `ddot`,`d`.`dcolor` AS `dcolor` from (((`kz_map_top` `t` join `kz_map_top_min` on(((`t`.`map` = `kz_map_top_min`.`minmap`) and (`t`.`time` = `kz_map_top_min`.`mintime`)))) left join `kz_map` `m` on((`m`.`mapname` = `t`.`map`))) left join `kz_diff` `d` on((`m`.`diff` = `d`.`id`)));

DROP VIEW IF EXISTS `kz_map_tops`;
DROP TABLE IF EXISTS `kz_map_tops`;
CREATE VIEW `kz_map_tops` AS select `t`.`id` AS `id`,`t`.`map` AS `map`,`t`.`player` AS `player`,`t`.`time` AS `time`,`t`.`cp` AS `cp`,`t`.`go_cp` AS `go_cp`,`t`.`weapon` AS `weapon`,`t`.`time_add` AS `time_add`,`p`.`name` AS `name`,`w`.`wname` AS `wname`,`d`.`dname` AS `dname`,`d`.`ddot` AS `ddot`,`d`.`dcolor` AS `dcolor` from ((((`kz_map_top` `t` join `unr_players` `p` on((`p`.`id` = `t`.`player`))) join `weapons` `w` on((`w`.`id` = `t`.`weapon`))) left join `kz_map` `m` on((`m`.`mapname` = `t`.`map`))) left join `kz_diff` `d` on((`m`.`diff` = `d`.`id`)));

DROP VIEW IF EXISTS `kz_map_tops1`;
DROP TABLE IF EXISTS `kz_map_tops1`;
CREATE VIEW `kz_map_tops1` AS select `t`.`id` AS `id`,`t`.`map` AS `map`,`t`.`player` AS `player`,`t`.`time` AS `time`,`t`.`cp` AS `cp`,`t`.`go_cp` AS `go_cp`,`t`.`weapon` AS `weapon`,`t`.`time_add` AS `time_add`,`p`.`name` AS `name`,`w`.`wname` AS `wname`,`d`.`dname` AS `dname`,`d`.`ddot` AS `ddot`,`d`.`dcolor` AS `dcolor` from (((((`kz_map_top` `t` join `kz_map_top_min` on(((`t`.`map` = `kz_map_top_min`.`minmap`) and (`t`.`time` = `kz_map_top_min`.`mintime`)))) join `unr_players` `p` on((`p`.`id` = `t`.`player`))) left join `weapons` `w` on((`w`.`id` = `t`.`weapon`))) left join `kz_map` `m` on((`m`.`mapname` = `t`.`map`))) left join `kz_diff` `d` on((`m`.`diff` = `d`.`id`)));

DROP VIEW IF EXISTS `kz_map_top_min`;
DROP TABLE IF EXISTS `kz_map_top_min`;
CREATE VIEW `kz_map_top_min` AS select `t`.`map` AS `minmap`,min(`t`.`time`) AS `mintime` from `kz_map_top` `t` group by `t`.`map`;

DROP VIEW IF EXISTS `players`;
DROP TABLE IF EXISTS `players`;
CREATE VIEW `players` AS select `p`.`id` AS `id`,`p`.`name` AS `name`,`p`.`lastIp` AS `lastIp`,`p`.`email` AS `email`,`p`.`steam_id_64` AS `steam_id_64`,`p`.`country` AS `country`,`l`.`country_name` AS `countryName`,`l`.`locale_code` AS `lang`,(select count(0) from (`unr_players_achiev` `pa` join `unr_achiev` `a`) where ((`pa`.`achievId` = `a`.`id`) and (`a`.`count` = `pa`.`progress`) and (`pa`.`playerId` = `p`.`id`))) AS `achiev` from (`unr_players` `p` left join `geoip_locations` `l` on((`p`.`country` = `l`.`country_iso_code`)));

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
