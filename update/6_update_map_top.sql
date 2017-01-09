-- Map List --

DELETE FROM `kz_map_top` WHERE time = 0;

LOAD DATA LOCAL INFILE 'files/maplist.txt'
INTO TABLE `kz_map_top` CHARACTER SET 'UTF8'
(`map`);