DROP TABLE IF EXISTS `unr_achiev`;
CREATE TABLE `unr_achiev` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(40) NOT NULL,
  `count` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `unr_achiev_lang`;
CREATE TABLE `unr_achiev_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `achievid` int(10) NOT NULL,
  `ltype` varchar(4) NOT NULL,
  `lang` varchar(2) NOT NULL,
  `value` varchar(256) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `servers`;
CREATE TABLE `servers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `addres` varchar(32) DEFAULT NULL,
  `ip` int(10) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `servers_lang`;
CREATE TABLE `servers_lang` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `serverid` int(10) NOT NULL,
  `lang` varchar(2) NOT NULL,
  `desc` varchar(256) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `lang` varchar(2) NOT NULL,
  `var` varchar(64) NOT NULL,
  `value` varchar(256) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

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


CREATE OR REPLACE VIEW `achiev` AS 
SELECT
  `unr_achiev`.`id`    AS `id`,
  `unr_achiev`.`count` AS `count`,
  `unr_achiev`.`type`  AS `type`,
  `lname`.`value`      AS `name`,
  `ldesc`.`value`      AS `description`,
  `lname`.`lang`       AS `lang`
FROM ((`unr_achiev`
    JOIN `unr_achiev_lang` `lname`
      ON (((`unr_achiev`.`id` = `lname`.`achievid`)
           AND (`lname`.`ltype` = 'name'))))
   JOIN `unr_achiev_lang` `ldesc`
     ON (((`unr_achiev`.`id` = `ldesc`.`achievid`)
          AND (`ldesc`.`ltype` = 'desc'))))
WHERE (`lname`.`lang` = `ldesc`.`lang`);

CREATE OR REPLACE VIEW `kz_top1` AS 
SELECT
  `kz_map_top`.`map` AS `map`,
  MIN(`kz_map_top`.`time`) AS `time`
FROM `kz_map_top`
GROUP BY `kz_map_top`.`map`;

CREATE OR REPLACE VIEW `kz_wrs` AS 
SELECT
  `kz_map_rec`.`mapname` AS `mapname`,
  MIN(`kz_map_rec`.`time`) AS `time`
FROM `kz_map_rec`
GROUP BY `kz_map_rec`.`mapname`;

CREATE OR REPLACE VIEW `kz_map_rec_wrs` AS 
SELECT
  `kz_map_rec`.`mapname` AS `mapname`,
  `kz_map_rec`.`mappath` AS `mappath`,
  `kz_map_rec`.`time`    AS `timerec`,
  `kz_map_rec`.`player`  AS `playerrec`,
  `kz_map_rec`.`country` AS `country`,
  `kz_map_rec`.`comm`    AS `comm`
FROM (`kz_map_rec`
   JOIN `kz_wrs`)
WHERE ((`kz_map_rec`.`mapname` = `kz_wrs`.`mapname`)
       AND (`kz_map_rec`.`time` = `kz_wrs`.`time`));

CREATE OR REPLACE VIEW `kz_map_all` AS 	   
SELECT
  `kz_map_top`.`map`           AS `map`,
  `kz_map_top`.`player`        AS `player`,
  `unr_players`.`name`         AS `name`,
  `kz_map_top`.`time`          AS `time`,
  `kz_map_top`.`cp`            AS `cp`,
  `kz_map_top`.`go_cp`         AS `go_cp`,
  `kz_map_top`.`weapon`        AS `weapon`,
  `weapons`.`name`             AS `wname`,
  `kz_map_rec_wrs`.`mapname`   AS `mapname`,
  `kz_map_rec_wrs`.`mappath`   AS `mappath`,
  `kz_map_rec_wrs`.`timerec`   AS `timerec`,
  `kz_map_rec_wrs`.`playerrec` AS `playerrec`,
  `kz_map_rec_wrs`.`country`   AS `country`,
  `kz_map_rec_wrs`.`comm`      AS `comm`
FROM (((`kz_map_top`
     LEFT JOIN `weapons`
       ON ((`weapons`.`id` = `kz_map_top`.`weapon`)))
    LEFT JOIN `kz_map_rec_wrs`
      ON ((`kz_map_rec_wrs`.`mapname` = `kz_map_top`.`map`)))
   JOIN `unr_players`
     ON ((`unr_players`.`id` = `kz_map_top`.`player`)));
	 
CREATE OR REPLACE VIEW `kz_map_top1` AS 
SELECT
  `kz_map_top`.`map`           AS `map`,
  `kz_map_top`.`player`        AS `player`,
  `unr_players`.`name`  	AS `name`,
  `kz_map_top`.`time`          AS `time`,
  `kz_map_top`.`cp`            AS `cp`,
  `kz_map_top`.`go_cp`         AS `go_cp`,
  `kz_map_top`.`weapon`        AS `weapon`,
  `weapons`.`name`             AS `wname`,
  `kz_map_rec_wrs`.`mapname`   AS `mapname`,
  `kz_map_rec_wrs`.`mappath`   AS `mappath`,
  `kz_map_rec_wrs`.`timerec`   AS `timerec`,
  `kz_map_rec_wrs`.`playerrec` AS `playerrec`,
  `kz_map_rec_wrs`.`country`   AS `country`,
  `kz_map_rec_wrs`.`comm`      AS `comm`
FROM (((`kz_map_top`
   JOIN `kz_top1`
	ON (((`kz_map_top`.`map` = `kz_top1`.`map`) AND (`kz_map_top`.`time` = `kz_top1`.`time`))))
   LEFT JOIN `weapons`
	ON ((`weapons`.`id` = `kz_map_top`.`weapon`)))
   LEFT JOIN `kz_map_rec_wrs`
	ON ((`kz_map_rec_wrs`.`mapname` = `kz_map_top`.`map`)))
   JOIN `unr_players` 
	ON `unr_players`.`id` = `kz_map_top`.`player`
GROUP BY `kz_map_top`.`map`;

CREATE OR REPLACE VIEW `kz_map_tops` AS 
SELECT
  `kz_map_top`.`map`           AS `map`,
  `kz_map_top`.`player`        AS `player`,
  `unr_players`.`name`         AS `name`,
  `kz_map_top`.`time`          AS `time`,
  `kz_map_top`.`cp`            AS `cp`,
  `kz_map_top`.`go_cp`         AS `go_cp`,
  `kz_map_top`.`weapon`        AS `weapon`,
  `weapons`.`name`             AS `wname`,
  `kz_map_rec_wrs`.`mapname`   AS `mapname`,
  `kz_map_rec_wrs`.`mappath`   AS `mappath`,
  `kz_map_rec_wrs`.`timerec`   AS `timerec`,
  `kz_map_rec_wrs`.`playerrec` AS `playerrec`,
  `kz_map_rec_wrs`.`country`   AS `country`,
  `kz_map_rec_wrs`.`comm`      AS `comm`
FROM ((((`kz_map_top`
      JOIN `kz_top1`
        ON (((`kz_map_top`.`map` = `kz_top1`.`map`)
             AND (`kz_map_top`.`time` = `kz_top1`.`time`))))
     LEFT JOIN `weapons`
       ON ((`weapons`.`id` = `kz_map_top`.`weapon`)))
    LEFT JOIN `kz_map_rec_wrs`
      ON ((`kz_map_rec_wrs`.`mapname` = `kz_map_top`.`map`)))
   JOIN `unr_players`
     ON ((`unr_players`.`id` = `kz_map_top`.`player`)));
	 
CREATE OR REPLACE VIEW `kz_norec` AS 
SELECT
  `kz_map_list`.`mapname` AS `map`,
  IF(ISNULL(`kz_map_top`.`player`),0,`kz_map_top`.`player`) AS `player`
FROM (`kz_map_list`
   LEFT JOIN `kz_map_top`
     ON ((`kz_map_list`.`mapname` = `kz_map_top`.`map`)))
ORDER BY `kz_map_list`.`mapname`;

CREATE OR REPLACE VIEW `achiev_aname` AS 
SELECT
  `p`.`id`   AS `plid`,
  `p`.`name` AS `plname`,
  `a`.`id`   AS `aid`,
  (SELECT
     COUNT(*)
   FROM (`unr_players_achiev`
      JOIN `achiev`)
   WHERE ((`unr_players_achiev`.`achievId` = `achiev`.`id`)
          AND (`achiev`.`count` = `unr_players_achiev`.`progress`)
          AND (`unr_players_achiev`.`playerId` = `plid`))) AS `achiev_total`
FROM ((`unr_players` `p`
    JOIN `unr_players_achiev` `pa`)
   JOIN `achiev` `a`)
WHERE ((`a`.`count` = `pa`.`progress`)
       AND (`p`.`id` = `pa`.`playerId`)
       AND (`pa`.`achievId` = `a`.`id`));
	   