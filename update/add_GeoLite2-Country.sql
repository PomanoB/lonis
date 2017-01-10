-- TABLES --

DROP TABLE IF EXISTS `geoip_blocks`;
CREATE TABLE `geoip_blocks` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`network` VARCHAR(20) NOT NULL,
	`ip_from` INT(10) UNSIGNED NOT NULL,
	`ip_to` INT(10) UNSIGNED NOT NULL,
	`geoname_id` INT(10) NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `geoname_id` (`geoname_id`),
	INDEX `ip_from` (`ip_from`),
	INDEX `ip_to` (`ip_to`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `geoip_locations`;
CREATE TABLE `geoip_locations` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`geoname_id` INT(10) NOT NULL,
	`locale_code` CHAR(2) NOT NULL,
	`continent_code` CHAR(2) NOT NULL,
	`continent_name` VARCHAR(32) NOT NULL,
	`country_iso_code` CHAR(2) NOT NULL,
	`country_name` VARCHAR(64) NOT NULL,
	PRIMARY KEY (`id`, `country_iso_code`),
	INDEX `geoname_id` (`geoname_id`),
	INDEX `country_iso_code` (`country_iso_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- DATA --

LOAD DATA LOCAL INFILE 'geoip/GeoLite2-Country-Blocks-IPv4.csv'
INTO TABLE `geoip_blocks` CHARACTER SET 'UTF8' FIELDS TERMINATED BY ',' 
OPTIONALLY ENCLOSED BY '' IGNORE 1 LINES
(`network`,`geoname_id`,@ignored,@ignored,@ignored,@ignored);

LOAD DATA LOCAL INFILE 'geoip/GeoLite2-Country-Locations-de.csv'
INTO TABLE `geoip_locations` CHARACTER SET 'UTF8' FIELDS TERMINATED BY ',' 
OPTIONALLY ENCLOSED BY '' IGNORE 1 LINES
(`geoname_id`,`locale_code`,`continent_code`,`continent_name`,`country_iso_code`,`country_name`);

LOAD DATA LOCAL INFILE 'geoip/GeoLite2-Country-Locations-en.csv'
INTO TABLE `geoip_locations` CHARACTER SET 'UTF8' FIELDS TERMINATED BY ',' 
OPTIONALLY ENCLOSED BY '' IGNORE 1 LINES
(`geoname_id`,`locale_code`,`continent_code`,`continent_name`,`country_iso_code`,`country_name`);

LOAD DATA LOCAL INFILE 'geoip/GeoLite2-Country-Locations-es.csv'
INTO TABLE `geoip_locations` CHARACTER SET 'UTF8' FIELDS TERMINATED BY ',' 
OPTIONALLY ENCLOSED BY '' IGNORE 1 LINES
(`geoname_id`,`locale_code`,`continent_code`,`continent_name`,`country_iso_code`,`country_name`);

LOAD DATA LOCAL INFILE 'geoip/GeoLite2-Country-Locations-fr.csv'
INTO TABLE `geoip_locations` CHARACTER SET 'UTF8' FIELDS TERMINATED BY ',' 
OPTIONALLY ENCLOSED BY '' IGNORE 1 LINES
(`geoname_id`,`locale_code`,`continent_code`,`continent_name`,`country_iso_code`,`country_name`);

LOAD DATA LOCAL INFILE 'geoip/GeoLite2-Country-Locations-ja.csv'
INTO TABLE `geoip_locations` CHARACTER SET 'UTF8' FIELDS TERMINATED BY ',' 
OPTIONALLY ENCLOSED BY '' IGNORE 1 LINES
(`geoname_id`,`locale_code`,`continent_code`,`continent_name`,`country_iso_code`,`country_name`);

LOAD DATA LOCAL INFILE 'geoip/GeoLite2-Country-Locations-pt-BR.csv'
INTO TABLE `geoip_locations` CHARACTER SET 'UTF8' FIELDS TERMINATED BY ',' 
OPTIONALLY ENCLOSED BY '' IGNORE 1 LINES
(`geoname_id`,`locale_code`,`continent_code`,`continent_name`,`country_iso_code`,`country_name`);

LOAD DATA LOCAL INFILE 'geoip/GeoLite2-Country-Locations-ru.csv'
INTO TABLE `geoip_locations` CHARACTER SET 'UTF8' FIELDS TERMINATED BY ',' 
OPTIONALLY ENCLOSED BY '' IGNORE 1 LINES
(`geoname_id`,`locale_code`,`continent_code`,`continent_name`,`country_iso_code`,`country_name`);

LOAD DATA LOCAL INFILE 'geoip/GeoLite2-Country-Locations-zh-CN.csv'
INTO TABLE `geoip_locations` CHARACTER SET 'UTF8' FIELDS TERMINATED BY ',' 
OPTIONALLY ENCLOSED BY '' IGNORE 1 LINES
(`geoname_id`,`locale_code`,`continent_code`,`continent_name`,`country_iso_code`,`country_name`);