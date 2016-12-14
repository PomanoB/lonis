<?php

// Community record (RU)
mysql_query("
DROP TABLE IF EXISTS `kz_map_comm`; 
CREATE TABLE `kz_map_comm` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mapname` varchar(64) DEFAULT NULL,
  `mappath` varchar(16) DEFAULT NULL,
  `time` decimal(10,2) DEFAULT NULL,
  `player` varchar(32) DEFAULT NULL,
  `country` varchar(8) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$demos_ru = file("demos_ru.txt");
$sql = "insert into `lonis`.`kz_map_comm` (`id`, `mapname`, `mappath`, `time`, `player`, `country`) values ";
foreach ($demos_ru as $key=>$value) {
	$col = explode(" ", $value);
	$pos = strpos($col[0],"[");
	$mapname = $col[0];
	$mappath = '';
	if($pos!=false) {
		$pos2 = strpos($col[0],"]");
		$mappath = substr($col[0],$pos, $pos2-$pos+1);
		$mapname = substr($col[0],0, $pos);
	}
	
	$delim = $key==(count($demos_ru)-1) ? "" : ",\n";
	$sql .= "(".($key+1).",'".$mapname."','".$mappath."','".$col[1]."','".trim($col[2])."','ru')".$delim;
}
$sql .= ";";
mysql_query($sql);

mysql_query("
DROP TABLE IF EXISTS `kz_map_rec`;
CREATE TABLE `kz_map_rec` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mapname` varchar(64) DEFAULT NULL,
  `mappath` varchar(16) DEFAULT NULL,
  `time` decimal(10,2) DEFAULT NULL,
  `player` varchar(32) DEFAULT NULL,
  `country` varchar(8) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

// World Record
$demos_xj = file("demos_xj.txt");
$demos_cc = file("demos_cc.txt");
$demos_rec = array_merge($demos_xj, $demos_cc);
$sql = "insert into `lonis`.`kz_map_rec` (`id`, `mapname`, `mappath`, `time`, `player`, `country`) values ";
foreach ($demos_rec as $key=>$value) {
	$col = explode(" ", $value);
	$pos = strpos($col[0],"[");
	$mapname = $col[0];
	$mappath = '';
	if($pos!=false) {
		$pos2 = strpos($col[0],"]");
		$mappath = substr($col[0],$pos, $pos2-$pos+1);
		$mapname = substr($col[0],0, $pos);
	}
	
	$delim = $key==(count($demos_rec)-1) ? "" : ",\n";
	$sql .= "(".($key+1).",'".$mapname."','".$mappath."','".$col[1]."','".$col[2]."','".$col[3]."')".$delim;
}
$sql .= ";";
mysql_query($sql);

// Список всех карт из файла в базу
mysql_query("
DROP TABLE IF EXISTS `kz_map_list`;
CREATE TABLE `kz_map_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mapname` varchar(64) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$maplist = file("maplist.txt");
$sql = "insert into `lonis`.`kz_map_list` (`id`, `mapname`) values ";
foreach ($maplist as $key=>$value) {
	$delim = $key==(count($maplist)-1) ? "" : ",\n";
	$sql .= "(".($key+1).",'".trim($value)."')".$delim;
}
$sql .= ";";
echo $sql;
mysql_query($sql);
*/
?>