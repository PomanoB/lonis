-- VIEWS --

CREATE OR REPLACE VIEW `kz_map_tops` AS
SELECT `t`.*, `name`, `wname` FROM `kz_map_top` `t`
JOIN `unr_players` `p` ON `p`.`id` = `t`.`player`
JOIN `weapons` `w` ON `w`.`id` = `t`.`weapon`;

CREATE OR REPLACE VIEW `kz_map_top_min` AS
SELECT `t`.`map` AS `map`, min(`t`.`time`) as `time` FROM `kz_map_top` `t` GROUP BY `t`.`map`;

CREATE OR REPLACE VIEW `kz_map_top1` AS 
SELECT `t`.* FROM `kz_map_top` `t` 
JOIN `kz_map_top_min` `tm` ON `t`.`map` = `tm`.`map` and `t`.`time` = `tm`.`time`;

CREATE OR REPLACE VIEW `kz_map_tops1` AS 
SELECT `t`.*, `name`, `wname` FROM `kz_map_top` `t` 
JOIN `kz_map_top_min` `tm` ON `t`.`map` = `tm`.`map` and `t`.`time` = `tm`.`time`
JOIN `unr_players` `p` ON `p`.`id` = `t`.`player`
JOIN `weapons` `w` ON `w`.`id` = `t`.`weapon`;

CREATE OR REPLACE VIEW `players` AS 
SELECT `p`.`id` AS `id`,`p`.`name` AS `name`,`p`.`lastIp` AS `lastIp`,`p`.`email` AS `email`,`p`.`steam_id_64` AS `steam_id_64`,
	`p`.`country` AS `country`,`l`.`country_name` AS `countryName`, `locale_code` as `lang`,
	
	(SELECT COUNT(0) FROM (`unr_players_achiev` `pa` JOIN `unr_achiev` `a`) 
		WHERE ((`pa`.`achievId` = `a`.`id`) AND (`a`.`count` = `pa`.`progress`) AND (`pa`.`playerId` = `p`.`id`))) AS `achiev`

FROM `unr_players` `p` LEFT JOIN `geoip_locations` `l` ON `p`.`country` = `l`.`country_iso_code`