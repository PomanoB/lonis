-- General Record  --

-- https://cosy-climbing.net/demos.txt --

DROP TABLE IF EXISTS `demos`;
CREATE TEMPORARY TABLE `demos` (
	`mapname` VARCHAR(64) NOT NULL,
	`time` DECIMAL(10,2) NULL DEFAULT NULL,
	`player` VARCHAR(32) NULL DEFAULT NULL,
	`country` VARCHAR(8) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOAD DATA LOCAL INFILE '/files/demos_cc.txt'
INTO TABLE `demos` CHARACTER SET 'UTF8' FIELDS TERMINATED BY ' ' IGNORE 1 LINES
(`mapname`, `time`, @ignored, @ignored, @ignored, `country`, `player`);

INSERT INTO `kz_map_rec` (`mapname`, `mappath`, `time`,`player`, `country`, `comm`)
SELECT 
	IF(LOCATE("[", `mapname`), LEFT(`mapname`, LOCATE("[", `mapname`)-1), `mapname`) AS `mapname`,
	MID(`mapname`, LOCATE("[", `mapname`), LOCATE("]", `mapname`)) AS `mappath`, 
	IF(`time` = 0, NULL, `time`) AS `time`,
	IF(`player` = 'n/a', NULL, `player`) AS `player`,
	IF(`country` = 'n-a' , NULL, `time`) AS `country`,
	'cc' AS `comm`
FROM `demos`;

-- http://xtreme-jumps.eu/demos.txt --

DELETE FROM `demos`;
LOAD DATA LOCAL INFILE '/files/demos_xj.txt'
INTO TABLE `demos` CHARACTER SET 'UTF8' FIELDS TERMINATED BY ' ' IGNORE 1 LINES
(`mapname`, `time`,`player`, `country`);

INSERT INTO `kz_map_rec` (`mapname`, `mappath`, `time`,`player`, `country`, `comm`)
SELECT 
	IF(LOCATE("[", `mapname`), LEFT(`mapname`, LOCATE("[", `mapname`)-1), `mapname`) AS `mapname`,
	MID(`mapname`, LOCATE("[", `mapname`), LOCATE("]", `mapname`)) AS `mappath`, 
	IF(`time` = 0, NULL, `time`) AS `time`,
	IF(`player` = 'n/a', NULL, `player`) AS `player`,
	IF(`country` = 'n-a' , NULL, `time`) AS `country`,
	'xj' AS `comm`
FROM `demos`;

-- http//kzru.one/demos.txt --

DELETE FROM `demos`;
LOAD DATA LOCAL INFILE '/files/demos_kzru.txt'
INTO TABLE `demos` CHARACTER SET 'UTF8' FIELDS TERMINATED BY ' ' IGNORE 1 LINES
(`mapname`, `time`, `player`);

INSERT INTO `kz_map_rec` (`mapname`, `mappath`, `time`,`player`, `country`, `comm`)
SELECT 
	IF(LOCATE("[", `mapname`), LEFT(`mapname`, LOCATE("[", `mapname`)-1), `mapname`) AS `mapname`,
	MID(`mapname`, LOCATE("[", `mapname`), LOCATE("]", `mapname`)) AS `mappath`, 
	IF(`time` = 0, NULL, `time`) AS `time`,
	IF(`player` = 'n/a', NULL, `player`) AS `player`,
	'ru' AS `country`, 
	'kzru' AS `comm` 
FROM `demos`;

DROP TABLE IF EXISTS `demos`;

-- Map List --

LOAD DATA LOCAL INFILE '/files/maplist.txt'
INTO TABLE `kz_map_list` CHARACTER SET 'UTF8'
(`mapname`);
