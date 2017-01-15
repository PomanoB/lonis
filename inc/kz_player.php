<?php


$types = array(
	'pro' => 'AND `go_cp` = 0 AND (`weapon` = 16 OR `weapon` = 29)',
	'noob' => 'AND (`go_cp` != 0 OR (`weapon` != 16 AND `weapon` != 29))',
	'all' => ''
);

$type = (isset($_GET["type"]) && isset($types[$_GET["type"]])) ? $_GET["type"] : "all";
$sort = (isset($_GET["sort"]) && $_GET["sort"]!="") ? $_GET["sort"] : "num";
$rec = (isset($_GET["rec"]) && $_GET["rec"]!="") ? $_GET["rec"] : "rec";
$page = isset($_GET["page"]) ? $_GET["page"] : 0;

if(!$player["id"]) {
	header("Location: {$baseUrl}/kreedz/players/");
}
else {
	$id = $player["id"];
	if($rec!="norec") {
		$q = "SELECT `t`.*, `wname` 
					FROM `kz_map_top` AS `t`, `weapons`
					WHERE `player` = {$id} AND `weapons`.`id` = `t`.`weapon` {$types[$type]}
					GROUP BY `map` ORDER BY `map`";	
		$r_num = mysqli_query($db, $q);
		$map_num = mysqli_num_rows($r_num);
		assign('map_num', $map_num);

		$q = "SELECT * FROM `kz_map_tops1` WHERE `player` = {$id} {$types[$type]}";
		$r_top1 = mysqli_query($db, $q);
		$map_top1 = mysqli_num_rows($r_top1);
	}
	else {	
		$q = " SELECT * FROM `kz_map_tops1` 
				RIGHT JOIN (SELECT `mapname` FROM `kz_map` WHERE NOT EXISTS 
					(SELECT * FROM `kz_map_top` WHERE player={$id} AND `mapname`=`map`)) AS m ON `map`=`mapname`";
		$r_norec = mysqli_query($db, $q);
		$map_norec = mysqli_num_rows($r_norec);
	}
	
	$total = $rec=="norec" ? $map_norec : ($sort=="top1" ? $map_top1 : $map_num);
	
	$pages = generate_page($page, $total, $mapsPerPage, "$baseUrl/{$player["name_url"]}/kreedz/$type/page%page%/$rec/$sort");

	if($total) {
		$r = $rec=="norec" ? $r_norec : ($sort=="top1" ? $r_top1 : $r_num);
		
		$rows_limit = mysqli_fetch_limit($r, $pages["start"], $mapsPerPage);
		
		$maps = array();
		foreach($rows_limit as $row) {
			if(isset($row["mapname"]))
				$row["map"] = $row["mapname"];
			
			if(isset($row["time"]))
			$row["time"] = timed($row["time"], 5);
			
			$row["name_url"] = isset($row["name"]) ? url_replace($row["name"]) : "";
			
			if(!isset($row["weapon"])) $row["weapon"] = 0;
				
			$maps[] = $row;
		}
	}
}
?>