-- New Maps --

LOAD DATA LOCAL INFILE 'files/newmaps.txt'
INTO TABLE `kz_map` CHARACTER SET 'UTF8'
(`map`);