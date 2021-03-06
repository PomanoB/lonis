<?php
// Admin action
if (isset($_SESSION["user_$cookieKey"]) && $admin == 1) {
	$act = isset($_POST["act"]) ? $_POST["act"] : "";
	
	if ($act == "delete") {
		if(isset($_POST["confirm"]) && $_POST["confirm"]==1) {
			$id = $_POST["id"];
			
			$q = "DELETE FROM `kz_map_top` WHERE `id`= $id";
			mysqli_query($db, $q);
		}
		else
			$message = $langs["Confirm"];
	}
}

$map = isset($_GET["map"]) ? $_GET["map"] : '';
$type = (isset($_GET["type"]) && isset($types[$_GET["type"]])) ? $_GET["type"] : 'all';
$page = isset($_GET["page"]) ? $_GET["page"] : 0;

$search = isset($_GET["search"]) && $_GET["search"] ? $_GET["search"] : "";
if($search) header("Location: {$bUrl}/kreedz/maps/?search={$search}");

$wmap = slashes($map);
$q = "SELECT COUNT(DISTINCT `map`) FROM `kz_map_top` WHERE `map` = '{$wmap}'";
$r = mysqli_query($db, $q);

$found = mysqli_result($r, 0);
	
if($map)
	$q = "SELECT `t`.* FROM `kz_map_tops` `t`
				JOIN (SELECT `map`, `player`, min(`time`) as `time` FROM `kz_map_top` WHERE `map` = '{$wmap}' GROUP BY `player`) AS `tmp`
				ON `t`.`map` = `tmp`.`map` AND `t`.`player` = `tmp`.`player` AND `t`.`time` = `tmp`.`time`
				WHERE 1 {$types[$type]} GROUP BY `player`  ORDER BY `time`";
else
	$q = "SELECT * FROM `kz_map_tops` WHERE 1 {$types[$type]} ORDER BY `time_add` DESC, `map` LIMIT 0, 1000";

$r = mysqli_query($db, $q);
$total = mysqli_num_rows($r);

$actionS = str_replace("_","/", $action);
$pages = generate_page($page, $total, $mapsPerPage);

if($map) {
	$smap = slashes($map);
	$q = "SELECT * FROM `kz_map` LEFT JOIN `kz_comm` ON `comm`=`name` 
			LEFT JOIN `kz_diff` `d` ON `d`.`id`=`diff` 
			WHERE `mapname` = '{$smap}' ORDER BY `mapname` LIMIT 1";
	$rr = mysqli_query($db, $q);
	$mapinfo = mysqli_fetch_assoc($rr);
	
	$img_file = "{$docRoot}/{$bTheme}/img/cstrike/{$map}.jpg";
	$imgmap = "{$bTheme}/img/noimage.jpg";
	
	$imgmap = file_exists("{$bTheme}/img/noimage.jpg") ? $imgmap : "";
	if(file_exists($img_file)) {
		$imgmap = "{$bUrl}/{$bTheme}/img/cstrike/{$map}.jpg";
	}
	
	$q = "SELECT * FROM `kz_records` `r`, `kz_comm` `c` WHERE `map` = '{$map}' AND `name` = `comm` ORDER BY `sort`, `mappath`";	
	$r_rec = mysqli_query($db, $q);
	
	$maprec = array();
	$lastcomm = "";
	while($row = mysqli_fetch_assoc($r_rec)) {
		$row['part'] = $row["comm"]==$lastcomm ? 0 : 1;
		$lastcomm = $row["comm"];
		
		$row["time"] = timed($row["time"], 2);
		
		$maprec[] = $row;	
	}
}

// List
$i=0;
$rows_limit = mysqli_fetch_limit($r, $pages["start"], $mapsPerPage);

$maps = array();
foreach($rows_limit as $row) {
	$maps[] = $row;
}
?>