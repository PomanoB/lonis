-- Tables --

DROP TABLE IF EXISTS `kz_map_rec`;
CREATE TABLE `kz_map_rec` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`map` VARCHAR(64) NOT NULL,
	`mappath` VARCHAR(16) NULL DEFAULT NULL,
	`time` DECIMAL(10,2) NULL DEFAULT NULL,
	`player` VARCHAR(32) NULL DEFAULT NULL,
	`country` VARCHAR(8) NULL DEFAULT NULL,
	`comm` VARCHAR(8) NULL DEFAULT NULL,
	PRIMARY KEY (`id`, `map`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `demos`;
CREATE TEMPORARY TABLE `demos` (
	`map` VARCHAR(64) NOT NULL,
	`time` DECIMAL(10,2) NULL DEFAULT NULL,
	`player` VARCHAR(32) NULL DEFAULT NULL,
	`country` VARCHAR(8) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- https://cosy-climbing.net/demos.txt --

LOAD DATA LOCAL INFILE 'files/demos_cc.txt'
INTO TABLE `demos` CHARACTER SET 'UTF8' FIELDS TERMINATED BY ' ' IGNORE 1 LINES
(`map`, `time`, @ignored, @ignored, @ignored, `country`, `player`);

INSERT INTO `kz_map_rec` (`map`, `mappath`, `time`,`player`, `country`, `comm`)
SELECT 
	IF(LOCATE("[", `map`), LEFT(`map`, LOCATE("[", `map`)-1), `map`) AS `map`,
	MID(`map`, LOCATE("[", `map`), LOCATE("]", `map`)) AS `mappath`, 
	IF(`time` = 0, NULL, `time`) AS `time`,
	IF(`player` = 'n/a', NULL, `player`) AS `player`,
	IF(`country` = 'n-a' , NULL, `country`) AS `country`,
	'cc' AS `comm`
FROM `demos`;

-- http://xtreme-jumps.eu/demos.txt --

DELETE FROM `demos`;
LOAD DATA LOCAL INFILE 'files/demos_xj.txt'
INTO TABLE `demos` CHARACTER SET 'UTF8' FIELDS TERMINATED BY ' ' IGNORE 1 LINES
(`map`, `time`,`player`, `country`);

INSERT INTO `kz_map_rec` (`map`, `mappath`, `time`,`player`, `country`, `comm`)
SELECT 
	IF(LOCATE("[", `map`), LEFT(`map`, LOCATE("[", `map`)-1), `map`) AS `map`,
	MID(`map`, LOCATE("[", `map`), LOCATE("]", `map`)) AS `mappath`, 
	IF(`time` = 0, NULL, `time`) AS `time`,
	IF(`player` = 'n/a', NULL, `player`) AS `player`,
	IF(`country` = 'n-a' , NULL, `country`) AS `country`,
	'xj' AS `comm`
FROM `demos`;

-- http//kzru.one/demos.txt --

DELETE FROM `demos`;
LOAD DATA LOCAL INFILE 'files/demos_kzru.txt'
INTO TABLE `demos` CHARACTER SET 'UTF8' FIELDS TERMINATED BY ' ' IGNORE 1 LINES
(`map`, `time`, `player`);

INSERT INTO `kz_map_rec` (`map`, `mappath`, `time`,`player`, `country`, `comm`)
SELECT 
	IF(LOCATE("[", `map`), LEFT(`map`, LOCATE("[", `map`)-1), `map`) AS `map`,
	MID(`map`, LOCATE("[", `map`), LOCATE("]", `map`)) AS `mappath`, 
	IF(`time` = 0, NULL, `time`) AS `time`,
	IF(`player` = 'n/a', NULL, `player`) AS `player`,
	'ru' AS `country`,
	'kzru' AS `comm` 
FROM `demos`;

DROP TABLE IF EXISTS `demos`;