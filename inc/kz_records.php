<?php
$community = "kzru";
$country = "ru";

if (isset($_SESSION["user_$cookieKey"]) && $admin == 1) {
	$act = isset($_POST["act"]) ? $_POST["act"] : "";
	
	if ($act == "deletex") {
		if(isset($_POST["confirm"]) && $_POST["confirm"]==1) {
			$delmap = $_POST["delmap"];
			
			$q = "DELETE FROM `kz_map_top` WHERE `map`= '$delmap'";
			mysqli_query($db, $q);
		}
		else
			$message = $langs["Confirm"];;
	}
}

$page = isset($_GET["page"]) && $_GET["page"] ? $_GET["page"] : 0;

$search = "";
if(isset($_POST["search"]) && $_POST["search"])
	$search = $_POST["search"];
else 
if(isset($_GET["search"]) && $_GET["search"])
	$search = $_GET["search"];

$ssearch = slashes($search);
$where = $search ? "AND `r1`.`map` LIKE '%$ssearch%'" : "";

$q = "SELECT `r1`.`map` `map`, `r1`.`mappath`,
			`r1`.`time` `wr_time`, `r1`.`player` `wr_player`, `r1`.`country` `wr_country`,
			`r2`.`time` `comm_time`, `r2`.`player` `comm_player`, `r2`.`country` `comm_country`
	FROM `kz_records` `r1` 
		LEFT JOIN (SELECT * FROM `kz_records` WHERE comm='{$community}') `r2` ON r1.map=r2.map AND r1.mappath=r2.mappath
	WHERE (r1.comm='xj' OR r1.comm='cc' OR r1.comm IS NULL) {$where} ORDER BY `r1`.`map`";
$r = mysqli_query($db, $q);
$total = mysqli_num_rows($r);

$pages = generate_page($page, $total, $mapsPerPage, "$baseUrl/kreedz/records/page%page%/$search");

$img = "img/country/{$country}.png";
$comm_countryImg = file_exists($img) ? $img : "";
		
if ($total) {
	$rows_limit = mysqli_fetch_limit($r, $pages["start"], $mapsPerPage);
	
	$maps = array();
	foreach($rows_limit as $row) {
		$row["wr_time"] = timed($row["wr_time"], 2);
		$row["comm_time"] = timed($row["comm_time"], 2);
		
		$img = "img/country/{$row["wr_country"]}.png";
		$row["wr_countryImg"] = file_exists($img) ? $img : "";
		
		$maps[] = $row;
	}
}

?>