<?php
if (isset($_SESSION["user_$cookieKey"]) && $_SESSION["user_$cookieKey"]["webadmin"] == 1) {
	$act = isset($_POST["act"]) ? $_POST["act"] : "";
	
	if ($act == "delete") {
		if(isset($_POST["confirm"]) && $_POST["confirm"]==1) {
			$id = $_POST["id"];
			
			$q = "DELETE FROM `kz_map_top` WHERE `id`= $id";
			mysqli_query($db, $q);
		}
		else
			$smarty->assign('message', $langs["langConfirm"]);
	}
}

if (!isset($_GET["map"]))
		header("Location: $baseUrl/kreedz");
else {	
	if (get_magic_quotes_gpc()) {
		$map = $_GET["map"];
	}
	else {
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
	$smarty->assign('langType', $langs[$typesLang[$type]]);
	
	$players = array();
	$mapcomm = array();
	$maprec = array();

	$q = "SELECT * FROM `kz_map_rec` WHERE `mapname` = '$map' ORDER BY `mappath`";	
	$r = mysqli_query($db, $q);
	while($row = mysqli_fetch_array($r)) {		
		$row["time"] = timed($row["time"], 2);
		
		$maprec[] = $row;		
	}
	$smarty->assign('maprec', $maprec);
	
	
	if(isset($maprec[0]["comm"])) {
		if(isset($conf["image_".$maprec[0]["comm"]])) {
			$imgmap = str_replace("%map%", $map, $conf["image_".$maprec[0]['comm']]);
			$smarty->assign('imgmap', $imgmap);
		}	

		if(isset($conf["image_".$maprec[0]["comm"]])) {
			$downmap = str_replace("%map%", $map, $conf["download_".$maprec[0]['comm']]);
			$smarty->assign('downmap', $downmap);
		}
	}
	
	$q = "SELECT * FROM `kz_map_comm` WHERE `mapname` = '$map' ORDER BY `mappath`";	
	$r = mysqli_query($db, $q);
	while($row = mysqli_fetch_array($r)) {		
		$row["time"] = timed($row["time"], 2);
		
		$mapcomm[] = $row;		
	}
	$smarty->assign('mapcomm', $mapcomm);

	$q = "SELECT COUNT(DISTINCT `player`) FROM `kz_map_top` WHERE `map` = '$map' {$types[$type]}";	
	$r = mysqli_query($db, $q);
	$total = mysqli_result($r, 0);
	$smarty->assign('total', $total);
	$smarty->assign('mapname', stripslashes($map));
	
	if($total) {	
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

	
		$q = "SELECT `kz_map_top`.*, `unr_players`.`name` FROM 
					(`kz_map_top` LEFT JOIN `unr_players` ON `unr_players`.`id` = `player`)
					WHERE `map` = '$map' {$types[$type]} 
					GROUP BY `player` ORDER BY `time` LIMIT $start, $playersPerPage";
		$r = mysqli_query($db, $q);
		$i = ($page - 1)*$playersPerPage + 1;
		while($row = mysqli_fetch_array($r)) {
			$row["time"] = timed($row["time"], 5);
			
			$row["number"] = $i++;
			
			$players[] = $row;
		}
		
		$smarty->assign('players', $players);
		
		$smarty->assign('page', $page);
		$smarty->assign('totalPages', $totalPages);
		$smarty->assign('pageUrl', "$baseUrl/kreedz/$map/$type/page%page%");
	
	}
}
?>