<?php
if (isset($_SESSION["user_$cookieKey"]) && $_SESSION["user_$cookieKey"]["webadmin"] == 1) {
	$act = isset($_POST["act"]) ? $_POST["act"] : "";
	
	if ($act == "delete") {
		if(isset($_POST["confirm"]) && $_POST["confirm"]==1) {
			$id = $_POST["id"];
			
			$q = "DELETE FROM `kz_map_top` WHERE `id`= $id";
			mysql_query($q);
		}
		else
			$smarty->assign('message', $langs["langConfirm"]);
	}
}

if (!isset($_GET["map"]))
		header("Location: $baseUrl/kreedz");
else
{	
	if (get_magic_quotes_gpc())
	{
		$map = $_GET["map"];
	}
	else
	{
		$map = addslashes($_GET["map"]);
	}
	
	$types = array(
		'pro' => 'AND `go_cp` = 0 AND (`weapon` = 16 OR `weapon` = 29)',
		'noob' => 'AND (`go_cp` != 0 OR (`weapon` != 16 AND `weapon` != 29))',
		'all' => ''
	);	
	
	$typesLang = array(
		'pro' => 'langKzPro',
		'noob' => 'langKzNoob',
		'all' => 'langKzAll'
	);
	
	$type = 'all';
	if (isset($_GET["type"]) && isset($types[$_GET["type"]]))
		$type = $_GET["type"];
	
	$smarty->assign('type', $type);
	$smarty->assign('langType', $smarty->get_config_vars($typesLang[$type]));
	
	$q = "SELECT COUNT(DISTINCT `player`) FROM `kz_map_top` WHERE `map` = '$map' {$types[$type]}";	
	$r = mysql_query($q);
	$total = mysql_result($r, 0);
	$smarty->assign('total', $total);
	
	if (isset($_GET["page"]))
		$page = abs((int)$_GET["page"]);
	else
		$page = 1;
	if (!$page)
		$page = 1;

	$totalPages = ceil($total/$playersPerPage);	
	if ($page > $totalPages)
		$page = 1;

	$start = ($page - 1) * $playersPerPage;
	
	$players = array();
	$mapcomm = array();
	$maprec = array();
	$smarty->assign('mapname', stripslashes($map));
	
	if($map) {
		$q = "SELECT * FROM `kz_map_rec` WHERE `mapname` LIKE '$map%' ORDER BY `mappath`";	
		$r = mysql_query($q);
		while($row = mysql_fetch_array($r)) {		
			$row["time"] = timed($row["time"], 2);
			
			$maprec[] = $row;		
		}
		$smarty->assign('maprec', $maprec);

		$q = "SELECT * FROM `kz_map_comm` WHERE `mapname` LIKE '$map%' ORDER BY `mappath`";	
		$r = mysql_query($q);
		while($row = mysql_fetch_array($r)) {		
			$row["time"] = timed($row["time"], 2);
			
			$mapcomm[] = $row;		
		}
		$smarty->assign('mapcomm', $mapcomm);
	}
	
	$q = "SELECT `tmp`.*, `unr_players`.`name` FROM 
			(SELECT * FROM `kz_map_top` 
				WHERE `map` = '$map' ORDER BY `time` ) AS `tmp`, 
			`unr_players` 
		WHERE `unr_players`.`id` = `player` {$types[$type]} 
		GROUP BY `player` ORDER BY `time` LIMIT $start, $playersPerPage";
	$r = mysql_query($q);
	$i = ($page - 1)*$playersPerPage + 1;
	while($row = mysql_fetch_array($r)) {
		$row["time"] = timed($row["time"], 5);
		
		$row["weapon_name"] = $langs["lang_wpn_".$row["weapon"]];
		$row["number"] = $i++;
		
		$players[] = $row;
	}
	
	$smarty->assign('players', $players);
	
	$smarty->assign('page', $page);
	$smarty->assign('totalPages', $totalPages);
	$smarty->assign('pageUrl', "$baseUrl/kreedz/$map/$type/page%page%");
		
	$template = 'kz_map.tpl';
}
?>