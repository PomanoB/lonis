-- VIEWS --

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
		ON (((`unr_achiev`.`id` = `lname`.`achievid`) AND (`lname`.`ltype` = 'name'))))
	JOIN `unr_achiev_lang` `ldesc`
		ON (((`unr_achiev`.`id` = `ldesc`.`achievid`) AND (`ldesc`.`ltype` = 'desc'))))
WHERE (`lname`.`lang` = `ldesc`.`lang`);

CREATE OR REPLACE VIEW `kz_map_tops` AS 
SELECT `t`.*, `unr_players`.`name`, `wname` 
FROM `kz_map_top` `t` 
LEFT JOIN `weapons` ON `weapons`.`id` = `t`.`weapon` 
JOIN `unr_players` ON `unr_players`.`id` = `t`.`player`;
	 
CREATE OR REPLACE VIEW `kz_map_top1` AS 
SELECT * FROM `kz_map_top` GROUP BY `map` ORDER BY `time`;

CREATE OR REPLACE VIEW `kz_map_tops1` AS 
SELECT `t`.*, `p`.`name`, `wname` 
FROM `kz_map_top1` `t`,  `unr_players` `p`, `weapons` `w`
WHERE `p`.`id` = `t`.`player` AND `w`.`id` = `t`.`weapon`;
GROUP BY `t`.`map`;

CREATE OR REPLACE VIEW `players` AS 
SELECT `p`.`id` AS `id`,`p`.`name` AS `name`,`p`.`lastIp` AS `lastIp`,`p`.`email` AS `email`,`p`.`steam_id_64` AS `steam_id_64`,
	`p`.`country` AS `country`,`l`.`country_name` AS `countryName`, `locale_code` as `lang`,
	
	(SELECT COUNT(0) FROM (`unr_players_achiev` `pa` JOIN `unr_achiev` `a`) 
		WHERE ((`pa`.`achievId` = `a`.`id`) AND (`a`.`count` = `pa`.`progress`) AND (`pa`.`playerId` = `p`.`id`))) AS `achiev`,

FROM `unr_players` `p` LEFT JOIN `geoip_locations` `l` ON `p`.`country` = `l`.`country_iso_code`