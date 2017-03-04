-- VIEWS --

CREATE OR REPLACE VIEW `kz_map_top_min` AS
SELECT `t`.`map` AS `map`, min(`t`.`time`) as `time` FROM `kz_map_top` `t` GROUP BY `t`.`map`;

CREATE OR REPLACE VIEW `kz_map_top1` AS select `t`.`id` AS `id`,`t`.`map` AS `map`,`t`.`player` AS `player`,`t`.`time` AS `time`,`t`.`cp` AS `cp`,`t`.`go_cp` AS `go_cp`,`t`.`weapon` AS `weapon`,`t`.`time_add` AS `time_add`,`d`.`dname` as `dname`, `d`.`ddot` AS `ddot`,`d`.`dcolor` AS `dcolor` from (((`kz_map_top` `t` join `kz_map_top_min` on(((`t`.`map` = `kz_map_top_min`.`minmap`) and (`t`.`time` = `kz_map_top_min`.`mintime`)))) left join `kz_map` `m` on((`m`.`mapname` = `t`.`map`))) left join `kz_diff` `d` on((`m`.`diff` = `d`.`id`)));

CREATE OR REPLACE VIEW `kz_map_tops` AS select `t`.`id` AS `id`,`t`.`map` AS `map`,`t`.`player` AS `player`,`t`.`time` AS `time`,`t`.`cp` AS `cp`,`t`.`go_cp` AS `go_cp`,`t`.`weapon` AS `weapon`,`t`.`time_add` AS `time_add`,`p`.`name` AS `name`,`w`.`wname` AS `wname`,`d`.`dname` as `dname`, `d`.`ddot` AS `ddot`,`d`.`dcolor` AS `dcolor` from ((((`kz_map_top` `t` join `unr_players` `p` on((`p`.`id` = `t`.`player`))) join `weapons` `w` on((`w`.`id` = `t`.`weapon`))) left join `kz_map` `m` on((`m`.`mapname` = `t`.`map`))) left join `kz_diff` `d` on((`m`.`diff` = `d`.`id`)));

CREATE OR REPLACE VIEW `kz_map_tops1` AS select `t`.`id` AS `id`,`t`.`map` AS `map`,`t`.`player` AS `player`,`t`.`time` AS `time`,`t`.`cp` AS `cp`,`t`.`go_cp` AS `go_cp`,`t`.`weapon` AS `weapon`,`t`.`time_add` AS `time_add`,`p`.`name` AS `name`,`w`.`wname` AS `wname`,`d`.`dname` as `dname`, `d`.`ddot` AS `ddot`,`d`.`dcolor` AS `dcolor` from (((((`kz_map_top` `t` join `kz_map_top_min` on(((`t`.`map` = `kz_map_top_min`.`minmap`) and (`t`.`time` = `kz_map_top_min`.`mintime`)))) join `unr_players` `p` on((`p`.`id` = `t`.`player`))) left join `weapons` `w` on((`w`.`id` = `t`.`weapon`))) left join `kz_map` `m` on((`m`.`mapname` = `t`.`map`))) left join `kz_diff` `d` on((`m`.`diff` = `d`.`id`)));

CREATE OR REPLACE VIEW `players` AS 
SELECT `p`.`id` AS `id`,`p`.`name` AS `name`,`p`.`lastIp` AS `lastIp`,`p`.`email` AS `email`,`p`.`steam_id_64` AS `steam_id_64`,
	`p`.`country` AS `country`,`l`.`country_name` AS `countryName`, `locale_code` as `lang`,
	
	(SELECT COUNT(0) FROM (`unr_players_achiev` `pa` JOIN `unr_achiev` `a`) 
		WHERE ((`pa`.`achievId` = `a`.`id`) AND (`a`.`count` = `pa`.`progress`) AND (`pa`.`playerId` = `p`.`id`))) AS `achiev`

FROM `unr_players` `p` LEFT JOIN `geoip_locations` `l` ON `p`.`country` = `l`.`country_iso_code`;

CREATE OR REPLACE VIEW `achiev` AS select `a`.`id` AS `id`,`a`.`type` AS `type`,`a`.`count` AS `count`,`a`.`icon` AS `icon`,`al`.`lid` AS `lid`,`al`.`achievid` AS `achievid`,`al`.`lang` AS `lang`,`al`.`name` AS `name`,`al`.`desc` AS `desc` from (`unr_achiev` `a` join `unr_achiev_lang` `al`) where (`a`.`id` = `al`.`achievid`);