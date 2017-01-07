<?php
$message = "";
if (isset($_SESSION["user_$cookieKey"]) && $_SESSION["user_$cookieKey"]["webadmin"] == 1) {
	$act = isset($_POST["act"]) ? $_POST["act"] : "";
	
	if ($act == "delete") {
		if(isset($_POST["confirm"]) && $_POST["confirm"]==1) {
			$delmap = $_POST["delmap"];
			
			$q = "DELETE FROM `kz_map_top` WHERE `map`= '$delmap'";
			mysqli_query($db, $q);
		}
		else
			$message = $langs["Confirm"];;
	}
}

$where = '';
if (isset($_GET["map"]) && $_GET["map"] !='') {
	$map = slashes($_GET["map"]);
	
	assign('map', stripslashes($map));
	
	$where = "AND `map` LIKE '%$map%'";
}

$types = array(
	'pro' => 'AND `go_cp` = 0 AND (`weapon` = 16 OR `weapon` = 29)',
	'noob' => 'AND (`go_cp` != 0 OR (`weapon` != 16 AND `weapon` != 29))',
	'all' => ''
);

$type = 'all';
if (isset($_GET["type"]) && isset($types[$_GET["type"]])) $type = $_GET["type"];
	
assign('type', $type);

$recs = array(
	'norec' => 'AND',
	'rec' => ''
);

$rec = 'rec';
if (isset($_GET["rec"])) $rec = $_GET["rec"];
assign('rec', $rec);

if($rec=="norec") {		
	$q = "SELECT COUNT(*) FROM (SELECT * FROM `kz_norec` WHERE `player` = 0) AS tmp WHERE 1 {$where}";	
}
else {
	$q = "SELECT COUNT(DISTINCT `map`) FROM `kz_map_top` WHERE 1 {$types[$type]} {$where}";	
}
	 
$r = mysqli_query($db, $q);

$total = mysqli_result($r, 0);
assign('total', $total);

$pages = generate_page($_GET["page"], $total, $mapsPerPage);
$pages["pageUrl"] = "$baseUrl/kreedz/maps/$type/page%page%/$rec";
assign('pages', $pages);

$limit = "LIMIT ".$pages["start"].",".$pages["perpage"];

if ($total) {
	if($rec=="norec") {
		$q = "SELECT * FROM (SELECT * FROM `kz_norec` WHERE `player` = 0) AS tmp WHERE 1 {$where} {$limit}";
	}
	else {
		$q = "SELECT * FROM `kz_map_top1` WHERE 1 {$types[$type]} {$where} ORDER BY `map` {$limit}";
	}
	
	$r = mysqli_query($db, $q);
	while($row = mysqli_fetch_array($r))
	{
		$row["time"] = timed($row["time"], 2);
		
		if(isset($row["timerec"]))
			$row["timerec"] = timed($row["timerec"], 2);
		
		$maps[] = $row;
	}
}

assign('message', $message);
assign('maps', $maps);
?>