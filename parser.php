<?php

$demos_ru = comm(file("demos/demos_ru.txt"));
$demos_xj = demos_wr(file("demos/demos_xj.txt"), "xj");
$demos_cc = demos_wr(file("demos/demos_cc.txt"), "cc");
$maplist = maplist(file("demos/maplist.txt"));

echo "<pre>";
echo "<p>$demos_ru<br>";
echo "<p>$demos_xj<br>";
echo "<p>$demos_cc<br>";
echo "<p>$maplist<br>";
echo "</pre>";

function comm($file) {
	$sql = "DELETE FROM `kz_map_comm`;\n";
	$sql .= "INSERT INTO `kz_map_comm` (`mapname`, `mappath`, `time`, `player`, `country`) VALUES\n";
	foreach ($file as $key=>$value) {
		$col = explode(" ", trim($value));
		$pos = strpos($col[0],"[");
		$mapname = $col[0];
		$mappath = '';
		if($pos!=false) {
			$pos2 = strpos($col[0],"]");
			$mappath = substr($col[0],$pos, $pos2-$pos+1);
			$mapname = substr($col[0],0, $pos);
		}
		
		$delim = $key==(count($file)-1) ? "" : ",\n";
		$sql .= "('$mapname','$mappath','".$col[1]."','".$col[2]."','ru')".$delim;
	}
	return $sql .= ";"; 
}

// World Record
function demos_wr($file, $comm) {
	$sql = "DELETE FROM `kz_map_rec`;\n";	
	$sql .= "INSERT INTO `kz_map_rec` (`mapname`, `mappath`, `time`, `player`, `country`, `comm`) VALUES\n";
	foreach ($file as $key=>$value) {
		$col = explode(" ", trim($value));
		$pos = strpos($col[0],"[");
		$mapname = $col[0];
		$mappath = '';
		if($pos!=false) {
			$pos2 = strpos($col[0],"]");
			$mappath = substr($col[0],$pos, $pos2-$pos+1);
			$mapname = substr($col[0],0, $pos);
		}
		
		$delim = $key==(count($file)-1) ? "" : ",\n";
		$sql .= "('$mapname','$mappath','".$col[1]."','".$col[2]."','".$col[3]."', '$comm')".$delim;
	}
	return $sql .= ";";
}
	
// Список всех карт из файла в базу
function maplist($file) {
	$sql = "DELETE FROM `kz_map_list`;\n";
	$sql .= "INSERT INTO `kz_map_list` (`mapname`) VALUES\n";
	foreach ($file as $key=>$value) {
		$delim = $key==(count($file)-1) ? "" : ",\n";
		$sql .= "('".trim($value)."')".$delim;
	}
	return $sql .= ";";
}

function langlist($langs, $lang) {
	$sql = "DELETE FROM `lang`;\n";
	$sql .= "INSERT INTO `lang` (`lang`, `var`, `value`) VALUES\n";
	$i = 0;
	foreach ($langs as $key=>$value) {
		$delim = $i++==(count($langs)-1) ? "" : ",\n";
		$sql .= "('$lang','$key','$value')".$delim;
	}
	return $sql .= ";";
}
?>