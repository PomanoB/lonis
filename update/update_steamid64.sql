-- FUNCTION getSteamId64() --

DROP FUNCTION IF EXISTS getSteamId64;

DELIMITER $$
 
CREATE FUNCTION `getSteamId64`(`steamId` varchar(64))
RETURNS varchar(30) CHARSET utf8
LANGUAGE SQL
NOT DETERMINISTIC
CONTAINS SQL
SQL SECURITY DEFINER
COMMENT 'FUNCTION'
BEGIN
	DECLARE steamId64 VARCHAR(30);
 	DECLARE pos INT;
 	DECLARE bit1 INT;
 	DECLARE bit2 INT;
 	
 	IF LOCATE('STEAM_0:', steamId) = 0 THEN
 		RETURN "";
 	END IF;
	 	
 	SET steamId = REPLACE(steamId, 'STEAM_0:', '');
 	SET pos = LOCATE(':', steamId);
 	
	IF pos = 0 THEN
 		RETURN "";
 	END IF;	
 	
 	SET bit1 = LEFT(steamId, pos-1);
 	SET bit2 = MID(steamId, pos+1, LENGTH(steamId));
 	
 	SET steamId64 = 76561197960265728+bit1+bit2*2;
	 	
	RETURN steamId64; 
END

$$

DELIMITER ;

-- SHOW LIST --

/*
SELECT `steam_id`, `steam_id_64`, getSteamId64(`steam_id`) AS `new_steam_id_64` 
FROM `unr_players` WHERE `steam_id` != '' ORDER BY `steam_id` DESC;
*/

-- UNDATE steam_id_64 --

UPDATE `unr_players` as `t1`
INNER JOIN (SELECT `steam_id`, getSteamId64(`steam_id`) AS `new_steam_id_64` FROM `unr_players` WHERE `steam_id_64` = '') as `t2`
SET `steam_id_64` = `new_steam_id_64`
WHERE `t1`.`steam_id` = `t2`.`steam_id`;