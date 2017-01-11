<?php
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

$message = "";

$types = array(
	'pro' => 'AND `go_cp` = 0 AND (`weapon` = 16 OR `weapon` = 29)',
	'noob' => 'AND (`go_cp` != 0 OR (`weapon` != 16 AND `weapon` != 29))',
	'all' => ''
);

$type = (isset($_GET["type"]) && isset($types[$_GET["type"]])) ? $_GET["type"] : 'all';
assign('type', $type);

$recs = array(
	'norec' => 'AND',
	'rec' => ''
);

$page = isset($_GET["page"]) ? $_GET["page"] : 0;

$rec = isset($_GET["rec"]) ? $_GET["rec"] : 'rec';
assign('rec', $rec);

$type = (isset($_GET["type"]) && isset($types[$_GET["type"]])) ? $_GET["type"] : 'all';

$where = '';

if(isset($_POST["map"]) && $_POST["map"] !='') 
	$map = slashes($_POST["map"]);
else if(isset($_GET["map"]) && $_GET["map"] !='')
	$map = slashes($_GET["map"]);

if(isset($map)) {
	assign('map', stripslashes($map));
	
	if($rec=="norec")
		$where = "AND `mapname` LIKE '%$map%'";
	else
		$where = "AND `map` LIKE '%$map%'";
}

if($rec=="norec") {
	$q = "SELECT * FROM `kz_map` `m` LEFT JOIN `kz_map_tops1` `t` ON `t`.`map` = `m`.`mapname` 
			WHERE `id` IS NULL {$where} ORDER By `mapname`";
}
else {
	$q = "SELECT `t`.`map` `mapname`, `t`.* FROM `kz_map_tops1` `t` WHERE 1 {$types[$type]} {$where} ORDER BY `map`";
}
$r = mysqli_query($db, $q);

$total = mysqli_num_rows($r);
assign('total', $total);

$pages = generate_page($page, $total, $mapsPerPage);
$pages["pageUrl"] = "$baseUrl/kreedz/maps/$type/page%page%/$rec";
assign('pages', $pages);

if ($total) {
	$rows_limit = mysqli_fetch_assoc_limit($r, $pages["start"], $mapsPerPage);

	foreach($rows_limit as $row) {
		$row["time"] = timed($row["time"], 2);
		
		if(isset($row["name"]))
			$row["name_url"] = url_replace($row["name"]);
		
		$maps[] = $row;
	}
	assign('maps', $maps);
}

assign('message', $message);
?>