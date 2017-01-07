/* USAGE *\

BAD query:

SELECT `code`, `country`
FROM `geoip_countries`
WHERE INET_ATON('4.2.2.1') BETWEEN `ip_from` AND `ip_to`

GOOD query:

SELECT `code`, `country`
FROM `geoip_countries`
WHERE `ip_to` >= INET_ATON('4.2.2.1')
ORDER BY `ip_to` ASC
LIMIT 1

*OR*

SELECT `code`, `country`
FROM `geoip_countries`
ip_from <= INET_ATON('4.2.2.1')
ORDER BY ip_from DESC
LIMIT 1

\* END */

-- TABLES --
DROP TABLE IF EXISTS `geoip_blocks`;
CREATE TABLE `geoip_blocks` (
  `ip_from` INT(10) UNSIGNED NOT NULL,
  `ip_to`   INT(10) UNSIGNED NOT NULL,
  `loc_id`  INT(10) NOT NULL,
  PRIMARY KEY (`ip_from`),
  KEY (`ip_to`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

DROP TABLE IF EXISTS `geoip_locations`;
CREATE TABLE `geoip_locations` (
  `id`        INT(10) NOT NULL,
  `cnt_code`  CHAR(2) NOT NULL,
  `reg_code`  VARCHAR(2) NOT NULL,
  `city`      VARCHAR(64) NOT NULL,
  `zip`       VARCHAR(16) NOT NULL,
  `latitude`  DECIMAL(7,4) NOT NULL,
  `longitude` DECIMAL(7,4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `geoip_countries`;
CREATE TABLE `geoip_countries` (
  `ip_from` INT UNSIGNED  NOT NULL,
  `ip_to`   INT UNSIGNED  NOT NULL,
  `code`    CHAR(2) NOT NULL,
  `country` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`ip_from`),
  KEY (`ip_to`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `geoip_asnum`;
CREATE TABLE `geoip_asnum` (
  `ip_from` INT UNSIGNED  NOT NULL,
  `ip_to`   INT UNSIGNED  NOT NULL,
  `asnum`   VARCHAR(64) NOT NULL,
  PRIMARY KEY (`ip_from`),
  KEY (`ip_to`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- DATA --

LOAD DATA LOCAL INFILE 'GeoLiteCity-Blocks.csv'
INTO TABLE `geoip_blocks` CHARACTER SET 'UTF8' FIELDS TERMINATED BY ',' 
OPTIONALLY ENCLOSED BY '"' IGNORE 1 LINES
(`ip_from`, `ip_to`, `loc_id`);

LOAD DATA LOCAL INFILE 'GeoLiteCity-Location.csv'
INTO TABLE `geoip_locations` CHARACTER SET 'UTF8' FIELDS TERMINATED BY ',' 
OPTIONALLY ENCLOSED BY '"' IGNORE 1 LINES
(`id`, `cnt_code`, `reg_code`, `city`, `zip`, `latitude`, `longitude`, @ignored, @ignored);

LOAD DATA LOCAL INFILE 'GeoIPCountryWhois.csv'
INTO TABLE `geoip_countries` CHARACTER SET 'UTF8' FIELDS TERMINATED BY ',' 
OPTIONALLY ENCLOSED BY '"'
(@ignored, @ignored, `ip_from`, `ip_to`, `code`, `country`);

LOAD DATA LOCAL INFILE 'GeoIPASNum2.csv'
INTO TABLE `geoip_asnum` CHARACTER SET 'UTF8' FIELDS TERMINATED BY ',' 
OPTIONALLY ENCLOSED BY '"'
(`ip_from`, `ip_to`, `asnum`);

