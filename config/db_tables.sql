CREATE TABLE IF NOT EXISTS `kz_duel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `map` varchar(64) NOT NULL,
  `player1` int(10) unsigned NOT NULL,
  `player2` int(10) unsigned NOT NULL,
  `result1` int(11) NOT NULL,
  `result2` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `kz_map_top` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `map` varchar(64) NOT NULL,
  `player` int(10) unsigned NOT NULL,
  `time` decimal(10,5) NOT NULL,
  `cp` int(10) unsigned NOT NULL,
  `go_cp` int(10) unsigned NOT NULL,
  `weapon` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

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

CREATE TABLE IF NOT EXISTS `unr_achiev` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `count` int(10) unsigned NOT NULL,
  `type` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `unr_activate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `player` int(11) NOT NULL,
  `key` varchar(50) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

CREATE TABLE IF NOT EXISTS `unr_dr_stats` (
  `map` varchar(32) NOT NULL,
  `player` int(10) unsigned NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `free` int(1) unsigned NOT NULL,
  KEY `map` (`map`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `unr_players` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `password` varchar(50) NOT NULL,
  `ip` varchar(32) NOT NULL,
  `lastIp` varchar(20) NOT NULL,
  `lastTime` int(1) NOT NULL,
  `onlineTime` int(1) NOT NULL,
  `steam_id` varchar(32) NOT NULL,
  `amxx_flags` varchar(34) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  `webadmin` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL,
  `icq` int(9) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `auth` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT ;

CREATE TABLE IF NOT EXISTS `unr_players_achiev` (
  `playerId` int(11) NOT NULL,
  `achievId` int(11) NOT NULL,
  `progress` int(11) NOT NULL,
  PRIMARY KEY (`playerId`,`achievId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `unr_players_var` (
  `playerId` int(11) NOT NULL,
  `key` varchar(50) NOT NULL,
  `value` varchar(512) NOT NULL,
  PRIMARY KEY (`playerId`,`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `kz_map_comm` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mapname` varchar(64) DEFAULT NULL,
  `mappath` varchar(16) DEFAULT NULL,
  `time` decimal(10,2) DEFAULT NULL,
  `player` varchar(32) DEFAULT NULL,
  `country` varchar(8) DEFAULT NULL,
  PRIMARY KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `kz_map_rec` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mapname` varchar(64) DEFAULT NULL,
  `mappath` varchar(16) DEFAULT NULL,
  `time` decimal(10,2) DEFAULT NULL,
  `player` varchar(32) DEFAULT NULL,
  `country` varchar(8) DEFAULT NULL,
  PRIMARY KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `kz_map_list` (
  `mid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mapname` varchar(64) DEFAULT NULL,
  PRIMARY KEY `mid` (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kz_norec` AS (
select  `lonis`.`kz_map_list`.`mid` AS `mid`,  `lonis`.`kz_map_list`.`mapname` AS `mapname`,  `tmp`.`id` AS `id`,  `tmp`.`map` AS `map`,  `tmp`.`player` AS `player`,  `tmp`.`time` AS `time`,  `tmp`.`cp` AS `cp`,  `tmp`.`go_cp` AS `go_cp`,  `tmp`.`weapon` AS `weapon` from (`lonis`.`kz_map_list`  left join (select  `lonis`.`kz_map_top`.`id` AS `id`,  `lonis`.`kz_map_top`.`map` AS `map`,  `lonis`.`kz_map_top`.`player` AS `player`,  `lonis`.`kz_map_top`.`time` AS `time`,  `lonis`.`kz_map_top`.`cp` AS `cp`,  `lonis`.`kz_map_top`.`go_cp` AS `go_cp`,  `lonis`.`kz_map_top`.`weapon` AS `weapon`  from `lonis`.`kz_map_top`  group by `lonis`.`kz_map_top`.`map`,`lonis`.`kz_map_top`.`player`) `tmp`  on ((`lonis`.`kz_map_list`.`mapname` = `tmp`.`map`))) order by `lonis`.`kz_map_list`.`mapname`);

CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kz_top1` AS (
select  `kz_map_top`.`map` AS `map`,  min(`kz_map_top`.`time`) AS `time` from `kz_map_top` group by `kz_map_top`.`map`);

CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kz_tops` AS 
select `tmp`.`id` AS `id`,`tmp`.`map` AS `map`,`tmp`.`player` AS `player`,`tmp`.`time` AS `time`,`tmp`.`cp` AS `cp`,`tmp`.`go_cp` AS `go_cp`,`tmp`.`weapon` AS `weapon`,`lonis`.`unr_players`.`name` AS `name` from (((select `lonis`.`kz_map_top`.`id` AS `id`,`lonis`.`kz_map_top`.`map` AS `map`,`lonis`.`kz_map_top`.`player` AS `player`,`lonis`.`kz_map_top`.`time` AS `time`,`lonis`.`kz_map_top`.`cp` AS `cp`,`lonis`.`kz_map_top`.`go_cp` AS `go_cp`,`lonis`.`kz_map_top`.`weapon` AS `weapon` from (`lonis`.`kz_map_top` join `lonis`.`kz_top1`) where ((`lonis`.`kz_map_top`.`map` = `kz_top1`.`map`) and (`lonis`.`kz_map_top`.`time` = `kz_top1`.`time`)) order by `lonis`.`kz_map_top`.`time`)) `tmp` join `lonis`.`unr_players`) where (`lonis`.`unr_players`.`id` = `tmp`.`player`) group by `tmp`.`map` order by `tmp`.`map`;