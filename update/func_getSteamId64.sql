DROP FUNCTION IF EXISTS getSteamId64;
DELIMITER $$
 
CREATE FUNCTION getSteamId64(steamId varchar(64)) RETURNS VARCHAR(30)
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
END $$