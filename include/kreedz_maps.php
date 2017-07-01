<?php

if (isset($_SESSION["user_$cookieKey"]) && $admin == 1) {
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

$type = isset($_GET["type"]) && isset($types[$_GET["type"]]) ? $_GET["type"] : 'all';
$rec = isset($_GET["rec"]) && $_GET["rec"] ? $_GET["rec"] : 'rec';
$page = isset($_GET["page"]) && $_GET["page"] ? $_GET["page"] : 0;

$search = isset($_GET["search"]) && $_GET["search"] ? $_GET["search"] : "";
$ssearch = slashes($search);

$like = $rec=="norec" ? "mapname" : "map";
$where = $search ? "AND `$like` LIKE '%$ssearch%'" : "";

if($rec=="norec") {
	$q = "SELECT * FROM `kz_map` `m` LEFT JOIN `kz_map_tops1` `t` ON `t`.`map` = `m`.`mapname` 
			WHERE `id` IS NULL {$where} ORDER By `mapname`";
	$mapsPerPage = $mapsNorecPerPage;
}
else {
	$q = "SELECT `t`.`map` `mapname`, `t`.* FROM `kz_map_tops1` `t` WHERE 1 {$types[$type]} {$where} ORDER BY `map`";
}
$r = mysqli_query($db, $q);

$total = mysqli_num_rows($r);

$pages = generate_page($page, $total, $mapsPerPage);
$rows_limit = mysqli_fetch_limit($r, $pages["start"], $mapsPerPage);

$maps = array();
foreach($rows_limit as $row) {
	$maps[] = $row;
}

?>