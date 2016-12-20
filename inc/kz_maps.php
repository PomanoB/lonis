<?php

if (isset($_SESSION["user_$cookieKey"]) && $_SESSION["user_$cookieKey"]["webadmin"] == 1) {
	$act = isset($_POST["act"]) ? $_POST["act"] : "";
	
	if ($act == "delete") {
		if(isset($_POST["confirm"]) && $_POST["confirm"]==1) {
			$delmap = $_POST["delmap"];
			
			$q = "DELETE FROM `kz_map_top` WHERE `map`= '$delmap'";
			mysql_query($q);
		}
		else
			$smarty->assign('message', $langs["langConfirm"]);
	}
}

$where = '';
if (isset($_POST["map"]) && $_POST["map"] !='') {
	//header('Location: kreedz/'.$_POST["map"]); exit();
	if (get_magic_quotes_gpc()) {
		$map = $_POST["map"];
	}
	else {
		$map = addslashes($_POST["map"]);
	}
	
	$smarty->assign('map', stripslashes($map));
	
	$where = "AND `map` LIKE '%$map%'";
}

$types = array(
	'pro' => 'AND `go_cp` = 0 AND (`weapon` = 16 OR `weapon` = 29)',
	'noob' => 'AND (`go_cp` != 0 OR (`weapon` != 16 AND `weapon` != 29))',
	'all' => ''
);	

$type = 'all';
if (isset($_GET["type"]) && isset($types[$_GET["type"]])) $type = $_GET["type"];

$typesLang = array(
	'pro' => 'langKzPro',
	'noob' => 'langKzNoob',
	'all' => 'langKzAll'
);	
	
$smarty->assign('type', $type);
$smarty->assign('langType', $smarty->get_config_vars($typesLang[$type]));

$recs = array(
	'norec' => 'AND',
	'rec' => ''
);

$rec = 'rec';
if (isset($_GET["rec"])) $rec = $_GET["rec"];
$smarty->assign('rec', $rec);

if($rec=="norec") {		
	$q = "SELECT COUNT(*) FROM (SELECT * FROM `kz_norec` WHERE `player` = 0) AS tmp";	
}
else {
	$q = "SELECT COUNT(DISTINCT `map`) FROM `kz_tops` WHERE 1 {$types[$type]} {$where}";	
}
	 
$r = mysql_query($q);

$total = mysql_result($r, 0);
$smarty->assign('total', $total);

if (isset($_GET["page"]))
	$page = abs((int)$_GET["page"]);
else
	$page = 1;
if (!$page)
	$page = 1;

$totalPages = ceil($total/$mapsPerPage);	
if ($page > $totalPages)
	$page = 1;

$maps = array();

if ($total)
{	
	$start = ($page - 1) * $mapsPerPage;
		
	if($rec=="norec") {
		$q = "SELECT * FROM (SELECT * FROM `kz_norec` WHERE `player` = 0) AS tmp LIMIT $start, $mapsPerPage";
		
		$r = mysql_query($q);
		while($row = mysql_fetch_array($r)) {
			$maps[] = $row;
		}
	}
	else {
		$q = "SELECT `kz_tops`.*, `unr_players`.`name`, MIN(`wrs`.`time`) AS timerec, `wrs`.`mapname`, `wrs`.`player` AS plrrec, `wrs`.`country` FROM 
		`kz_tops`, `unr_players`, 
		(SELECT * FROM `kz_map_rec` ORDER BY `time`) AS `wrs`
		WHERE `unr_players`.`id` = `kz_tops`.`player` AND `wrs`.`mapname` = `kz_tops`.`map` {$where}
		GROUP BY `map` ORDER BY `map` LIMIT $start, $mapsPerPage";

		$r = mysql_query($q);
		while($row = mysql_fetch_array($r))
		{
			$row["time"] = timed($row["time"], 2);
			$row["timerec"] = timed($row["timerec"], 2);
			
			$row["weapon_name"] = $langs["lang_wpn_".$row["weapon"]];
			$maps[] = $row;
		}
	}
}
$smarty->assign('maps', $maps);

$smarty->assign('page', $page);
$smarty->assign('totalPages', $totalPages);

$smarty->assign('pageUrl', "$baseUrl/kreedz/$type/page%page%/$rec");
	
$template = 'kz_maps.tpl';	
	
?>