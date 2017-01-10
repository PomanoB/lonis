DROP TABLE IF EXISTS `geoip_whois`;
CREATE TABLE `geoip_whois` (
	`ip_from` INT(10) UNSIGNED NOT NULL,
	`ip_to` INT(10) UNSIGNED NOT NULL,
	`code` CHAR(2) NOT NULL,
	`country` VARCHAR(64) NOT NULL,
	PRIMARY KEY (`ip_from`),
	INDEX `ip_to` (`ip_to`),
	INDEX `code` (`code`)	
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOAD DATA LOCAL INFILE 'geoip/GeoIPCountryWhois.csv'
INTO TABLE `geoip_whois` CHARACTER SET 'UTF8' FIELDS TERMINATED BY ',' 
OPTIONALLY ENCLOSED BY '"' 
(@ignored, @ignored, `ip_from`, `ip_to`, `code`, `country`);