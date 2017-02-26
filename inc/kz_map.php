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

$types = array(
	'pro' => 'AND `go_cp` = 0 AND (`weapon` = 16 OR `weapon` = 29)',
	'noob' => 'AND (`go_cp` != 0 OR (`weapon` != 16 AND `weapon` != 29))',
	'all' => ''
);

$map = isset($_GET["map"]) ? $_GET["map"] : '';
$type = (isset($_GET["type"]) && isset($types[$_GET["type"]])) ? $_GET["type"] : 'all';
$page = isset($_GET["page"]) ? $_GET["page"] : 0;

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
	$q = "SELECT * FROM `kz_map_tops` WHERE 1 {$types[$type]} ORDER BY `time_add` DESC, `map` LIMIT 0, 10";

$r = mysqli_query($db, $q);
	
$total = mysqli_num_rows($r);

$pages = generate_page($page, $total, $playersPerPage, "$baseUrl/kreedz/$map/$type/page%page%");

if($total) {
	if($map) {
		$img_file = "{$docRoot}/img/cstrike/{$map}.jpg";
		$imgmap = "{$baseUrl}/img/noimage.jpg";
		
		$imgmap = file_exists("{$docRoot}/img/noimage.jpg") ? $imgmap : "";
		if(file_exists($img_file)) {
			$imgmap = "{$baseUrl}/img/cstrike/{$map}.jpg";
		}

		$q = "SELECT * FROM `kz_map_rec` `r`, `kz_comm` `c` WHERE `map` = '{$map}' AND `name` = `comm` ORDER BY `sort`";	
		$r_rec = mysqli_query($db, $q);
		
		$maprec = array();
		while($row = mysqli_fetch_assoc($r_rec)) {
			$row["download_url"] = str_replace("%map%", $map, $row["download"]);
			
			$row["time"] = timed($row["time"], 2);
			
			$img = "img/country/{$row["country"]}.png";
			$row["countryImg"] = file_exists($img) ? $img : "";
		
			$maprec[] = $row;	
		}
		$download_url = isset($maprec[0]["download_url"]) ? $maprec[0]["download_url"] : "";
	}
	
	// List
	$i=0;
	$rows_limit = mysqli_fetch_limit($r, $pages["start"], $playersPerPage);
	
	$number = $pages["start"]+1;
	$players = array();
	foreach($rows_limit as $row) {
		$row["time"] = timed($row["time"], 5);
		$row["number"] = $number++;
		
		$row["name_url"] = url_replace($row["name"]);
		$players[] = $row;
	}
}
?>