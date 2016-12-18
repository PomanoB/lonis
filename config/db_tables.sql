DROP TABLE IF EXISTS `lang`;
CREATE TABLE `lang` (
  `lang` varchar(2) NOT NULL,
  `var` varchar(64) NOT NULL,
  `value` varchar(256) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

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
  PRIMARY KEY (`id`)
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

DROP TABLE IF EXISTS `unr_achiev`;
CREATE TABLE `unr_achiev` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `count` int(10) unsigned NOT NULL,
  `type` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `unr_activate`;
CREATE TABLE `unr_activate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `player` int(11) NOT NULL,
  `key` varchar(50) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `unr_dr_stats`;
CREATE TABLE `unr_dr_stats` (
  `map` varchar(32) NOT NULL,
  `player` int(10) unsigned NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `free` int(1) unsigned NOT NULL,
  KEY `map` (`map`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
  PRIMARY KEY (`playerId`,`achievId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

DROP TABLE IF EXISTS `unr_players_var`;
CREATE TABLE `unr_players_var` (
  `playerId` int(11) NOT NULL,
  `key` varchar(50) NOT NULL,
  `value` varchar(512) NOT NULL,
  PRIMARY KEY (`playerId`,`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `kz_map_comm`;
CREATE TABLE `kz_map_comm` (
  `mapname` varchar(64) NOT NULL,
  `mappath` varchar(16) DEFAULT NULL,
  `time` decimal(10,2) DEFAULT NULL,
  `player` varchar(32) DEFAULT NULL,
  `country` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `kz_map_rec`;
CREATE TABLE `kz_map_rec` (
  `mapname` varchar(64) NOT NULL,
  `mappath` varchar(16) DEFAULT NULL,
  `time` decimal(10,2) DEFAULT NULL,
  `player` varchar(32) DEFAULT NULL,
  `country` varchar(8) DEFAULT NULL,
  `comm` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `kz_map_list`;
CREATE TABLE `kz_map_list` (
  `mapname` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE OR REPLACE VIEW `kz_norecx` AS (
select  
	`kz_map_top`.`map` AS `map`,  
	`kz_map_top`.`player` AS `player`,  
	`kz_map_top`.`time` AS `time`,  
	`kz_map_top`.`cp` AS `cp`,  
	`kz_map_top`.`go_cp` AS `go_cp`,  
	`kz_map_top`.`weapon` AS `weapon` 
from `kz_map_top`  
group by `kz_map_top`.`map`,`kz_map_top`.`player`);

CREATE OR REPLACE VIEW `kz_norec` AS (
SELECT  
	`kz_map_list`.`mapname` AS `mapname`,  
	`tmp`.`map` AS `map`,  
	`tmp`.`player` AS `player`,  
	`tmp`.`time` AS `time`,  
	`tmp`.`cp` AS `cp`,  
	`tmp`.`go_cp` AS `go_cp`,  
	`tmp`.`weapon` AS `weapon` 
FROM (`kz_map_list`  LEFT JOIN `kz_norecx` AS `tmp`  
	ON ((`kz_map_list`.`mapname` = `tmp`.`map`))) 
ORDER BY `kz_map_list`.`mapname`);

CREATE OR REPLACE VIEW `kz_top1` AS (
select  `kz_map_top`.`map` AS `map`,  
	min(`kz_map_top`.`time`) AS `time` 
from `kz_map_top` group by `kz_map_top`.`map`);

CREATE OR REPLACE VIEW `kz_topx` AS (
SELECT
	`kz_map_top`.`map` AS `map`,
	`kz_map_top`.`player` AS `player`,
	`kz_map_top`.`time` AS `time`,
	`kz_map_top`.`cp` AS `cp`,
	`kz_map_top`.`go_cp` AS `go_cp`,
	`kz_map_top`.`weapon` AS `weapon` 
FROM (`kz_map_top` JOIN `kz_top1`) 
WHERE ((`kz_map_top`.`map` = `kz_top1`.`map`) AND (`kz_map_top`.`time` = `kz_top1`.`time`)) 
ORDER BY `kz_map_top`.`time`);

CREATE OR REPLACE VIEW `kz_tops` AS (
SELECT
	`tmp`.`map` AS `map`,
	`tmp`.`player` AS `player`,
	`tmp`.`time` AS `time`,
	`tmp`.`cp` AS `cp`,
	`tmp`.`go_cp` AS `go_cp`,
	`tmp`.`weapon` AS `weapon`,
	`unr_players`.`name` AS `name` 
FROM (`kz_topx` AS `tmp` JOIN `unr_players`) 
WHERE (`unr_players`.`id` = `tmp`.`player`) 
GROUP BY `tmp`.`map` ORDER BY `tmp`.`map`);

CREATE OR REPLACE VIEW `achiev` AS
SELECT 
	`id` AS `id`,
	`lname`.value AS `name`, 
	`ldesc`.value AS `description`, 
	`count` AS `count`, 
	`type` AS `type`, 
	`lname`.lang AS `lname`, 
	`ldesc`.lang AS `ldesc`
FROM (unr_achiev LEFT JOIN lang AS `lname` ON unr_achiev.name = lname.var) 
	LEFT JOIN lang AS `ldesc` ON unr_achiev.description = ldesc.var;
