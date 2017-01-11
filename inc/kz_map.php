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

$types = array(
	'pro' => 'AND `go_cp` = 0 AND (`weapon` = 16 OR `weapon` = 29)',
	'noob' => 'AND (`go_cp` != 0 OR (`weapon` != 16 AND `weapon` != 29))',
	'all' => ''
);

$map = isset($_GET["map"]) ? slashes($_GET["map"]) : '';
assign('map', stripslashes($map));
	
$type = (isset($_GET["type"]) && isset($types[$_GET["type"]])) ? $_GET["type"] : 'all';
assign('type', $type);

$page = isset($_GET["page"]) ? $_GET["page"] : 0;

$q = "SELECT COUNT(DISTINCT `map`) FROM `kz_map_top` WHERE `map` = '{$map}'";
$r = mysqli_query($db, $q);

$found = mysqli_result($r, 0);
assign('found', $found);

if($map && !$found) {
	header("Location: {$baseUrl}/kreedz/");
}

if($map)
	$q = "SELECT * FROM `kz_map_tops` WHERE `map` = '{$map}' {$types[$type]} GROUP BY `player` ORDER BY `time`";
else
	$q = "SELECT * FROM `kz_map_tops` WHERE 1 {$types[$type]} ORDER BY `time_add` DESC, `map` LIMIT 0, 10";

$r = mysqli_query($db, $q);
	
$total = mysqli_num_rows($r);
assign('total', $total);

$pages = generate_page($page, $total, $playersPerPage);
$pages["pageUrl"] = "$baseUrl/kreedz/$map/$type/page%page%";
assign('pages', $pages);

if($total) {
	if($map) {
		// Image
		$img_file = "{$docRoot}/img/cstrike/{$map}.jpg";
		$mapimage = "{$docRoot}/img/mapimage.jpg";
		$imgmap = "{$baseUrl}/img/noimage.jpg";
		
		$imgmap = file_exists("{$docRoot}/img/noimage.jpg") ? $imgmap : "";
		if(file_exists($img_file)) {
			file_put_contents($mapimage, file_get_contents($img_file));
			$imgmap = "{$baseUrl}/img/mapimage.jpg";
		}
		assign('imgmap', $imgmap);

		// World Record
		$q = "SELECT * FROM `kz_map_rec` `r`, `kz_comm` `c` WHERE `map` = '{$map}' AND `name` = `comm` ORDER BY `sort`";	
		$r_rec = mysqli_query($db, $q);
		
		$maprec = array();
		$download_url = "";
		while($row = mysqli_fetch_assoc($r_rec)) {
			$row["download_url"] = str_replace("%map%", $map, $row["download"]);
			
			$row["time"] = timed($row["time"], 2);
			
			$img = "img/country/{$row["country"]}.png";
			$row["countryImg"] = file_exists($img) ? $img : "";
		
			$maprec[] = $row;	
		}
		assign('maprec', $maprec);
		
		assign('download_url', $maprec[0]["download_url"]);
	}
	
	// List
	$i=0;
	$rows_limit = "";
	while($rows = mysqli_fetch_assoc($r)) {
		$i++;
		if($i>$pages["start"] && $i<$pages["end"])
			$rows_limit[] = $rows;
	}
	
	$number = $pages["start"]+1;
	$players = array();
	foreach($rows_limit as $row) {
		$row["time"] = timed($row["time"], 5);
		$row["number"] = $number++;
		
		$row["name_url"] = url_replace($row["name"]);
		$players[] = $row;
	}
	assign('players', $players);
}


assign('message', $message);
?>