-- TABLES --

DROP TABLE IF EXISTS `geoip_countries`;
CREATE TABLE `geoip_countries` (
	`ip_from` INT UNSIGNED  NOT NULL,
	`ip_to`   INT UNSIGNED  NOT NULL,
	`code`    CHAR(2) NOT NULL,
	PRIMARY KEY (`ip_from`),
	KEY (`ip_to`),
	KEY (`code`)	
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `geoip_locations`;
CREATE TABLE `geoip_locations` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`geoname_id` INT(10),
	`locale_code`  CHAR(2) NOT NULL,
	`continent_code`  CHAR(2) NOT NULL,
	`continent_name`      VARCHAR(32) NOT NULL,
	`country_iso_code`  CHAR(2) NOT NULL,
	`country_name`      VARCHAR(64) NOT NULL,
	PRIMARY KEY (`id`, `geoname_id`, `continent_code`, `country_iso_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


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

-- DATA --

LOAD DATA LOCAL INFILE 'files/GeoIPCountryWhois.csv'
INTO TABLE `geoip_countries` CHARACTER SET 'UTF8' FIELDS TERMINATED BY ',' 
OPTIONALLY ENCLOSED BY '"' 
(@ignored, @ignored, `ip_from`, `ip_to`, `code`, `country`);

LOAD DATA LOCAL INFILE 'files/GeoLite2-Country-Locations-en.csv'
INTO TABLE `geoip_locations` CHARACTER SET 'UTF8' FIELDS TERMINATED BY ',' 
OPTIONALLY ENCLOSED BY '' IGNORE 1 LINES
(`geoname_id`,`locale_code`,`continent_code`,`continent_name`,`country_iso_code`,`country_name`);

LOAD DATA LOCAL INFILE 'files/GeoLite2-Country-Locations-ru.csv'
INTO TABLE `geoip_locations` CHARACTER SET 'UTF8' FIELDS TERMINATED BY ',' 
OPTIONALLY ENCLOSED BY '' IGNORE 1 LINES
(`geoname_id`,`locale_code`,`continent_code`,`continent_name`,`country_iso_code`,`country_name`);