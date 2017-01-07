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
select 
	`kz_map_top`.`map` AS `map`,
	`kz_map_top`.`player` AS `player`,
	`unr_players`.`name` AS `name`,
	`kz_map_top`.`time` AS `time`,
	`kz_map_top`.`cp` AS `cp`,
	`kz_map_top`.`go_cp` AS `go_cp`,
	`kz_map_top`.`weapon` AS `weapon`,
	`weapons`.`name` AS `wname` 
from (((`kz_map_top` 
	join `kz_top1` on(((`kz_map_top`.`map` = `kz_top1`.`map`) and (`kz_map_top`.`time` = `kz_top1`.`time`)))) 
	left join `weapons` on((`weapons`.`id` = `kz_map_top`.`weapon`))) 
	join `unr_players` on((`unr_players`.`id` = `kz_map_top`.`player`))) 
group by `kz_map_top`.`map`;
	 
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