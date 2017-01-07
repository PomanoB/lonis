<?php
$message = "";

// Admin action
if (isset($_SESSION["user_$cookieKey"]) && $_SESSION["user_$cookieKey"]["webadmin"] == 1) {
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

// All action
if (!isset($_GET["map"]))
		header("Location: $baseUrl/kreedz/");
else {	
	$map = slashes($_GET["map"]);
	
	$types = array(
		'pro' => 'AND `go_cp` = 0 AND (`weapon` = 16 OR `weapon` = 29)',
		'noob' => 'AND (`go_cp` != 0 OR (`weapon` != 16 AND `weapon` != 29))',
		'all' => ''
	);	

	$type = 'all';
	if (isset($_GET["type"]) && isset($types[$_GET["type"]]))
		$type = $_GET["type"];
	
	assign('type', $type);
	
	// Image
	echo $img_file = "{$docRoot}{$baseSite}/img/cstrike/$map.jpg";
	$mapimage = "{$docRoot}{$baseSite}/img/mapimage.jpg";
	$imgmap = $noimg = "{$baseUrl}/img/noimage.jpg";
	
	if(file_exists($img_file)) {
		file_put_contents($mapimage, file_get_contents($img_file));
		$imgmap = "{$baseUrl}/img/mapimage.jpg";
	}
	assign('imgmap', $imgmap);
	
	// Community list
	$r = mysqli_query($db, "SELECT * FROM `kz_comm`");
	
	$comms = array();
	while($row = mysqli_fetch_array($r)) {
		foreach($row as $key=>$value) {
			$row[$key] = str_replace("%map%", $map, $row[$key]);
		}
		$comms[$row["name"]] = $row;
	}

	// World Record
	$q = "SELECT * FROM `kz_map_rec` WHERE `mapname` = '$map' AND (`comm` = 'xj' OR `comm` = 'cc') ORDER BY `mappath`";	
	$r = mysqli_query($db, $q);
	
	$maprec = array();
	while($row = mysqli_fetch_array($r)) {		
		$row["time"] = timed($row["time"], 2);
		$maprec[] = $row;		
	}
	assign('maprec', $maprec);
	
	$comm = isset($maprec[0]["comm"]) ? $maprec[0]["comm"] : "";
	assign('wrs', $comms[$comm]);
	
	// KZRU
	$q = "SELECT * FROM `kz_map_rec` WHERE `mapname` = '$map' AND `comm` = 'kzru' ORDER BY `mappath`";	
	$r = mysqli_query($db, $q);
	
	$mapcomm = array();
	while($row = mysqli_fetch_array($r)) {		
		$row["time"] = timed($row["time"], 2);
		$mapcomm[] = $row;		
	}
	assign('mapcomm', $mapcomm);
	
	assign('kzru', $comms["kzru"]);
	
	// Total
	$q = "SELECT COUNT(DISTINCT `player`) FROM `kz_map_top` WHERE `map` = '{$map}' {$types[$type]}";	
	$r = mysqli_query($db, $q);
	$total = mysqli_result($r, 0);
	assign('total', $total);
	assign('mapname', stripslashes($map));
	
	$pages = generate_page($_GET["page"], $total, $playersPerPage);
	$pages["pageUrl"] = "$baseUrl/kreedz/$map/$type/page%page%";
	assign('pages', $pages);

	$limit = "LIMIT ".$pages["start"].",".$pages["perpage"];
	
	$number = $pages["start"]+1;
	
	// Players
	$players = array();
	if($total) {
		$q = "SELECT `kz_map_top`.*, `unr_players`.`name`, `weapons`.`name` AS `wname` 
				FROM `kz_map_top`, `unr_players`, `weapons`
				WHERE `map` = '{$map}' AND `unr_players`.`id` = `player` AND `weapons`.`id` = `kz_map_top`.`weapon` {$types[$type]} 
				GROUP BY `player` ORDER BY `time` {$limit}";
		$r = mysqli_query($db, $q);
		
		while($row = mysqli_fetch_array($r)) {
			$row["time"] = timed($row["time"], 5);
			$row["number"] = $number++;
			
			$players[] = $row;
		}
		
		assign('players', $players);
	}
}

assign('message', $message);
?>