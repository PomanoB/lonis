-- TABLES --

DROP TABLE IF EXISTS `geoip_countries`;
CREATE TABLE `geoip_countries` (
  `ip_from` INT UNSIGNED  NOT NULL,
  `ip_to`   INT UNSIGNED  NOT NULL,
  `code`    CHAR(2) NOT NULL,
  `country` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`ip_from`),
  KEY (`ip_to`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- DATA --

LOAD DATA LOCAL INFILE 'files/GeoIPCountryWhois.csv'
INTO TABLE `geoip_countries` CHARACTER SET 'UTF8' FIELDS TERMINATED BY ',' 
OPTIONALLY ENCLOSED BY '"'
(@ignored, @ignored, `ip_from`, `ip_to`, `code`, `country`);
