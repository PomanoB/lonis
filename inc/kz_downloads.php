<?php
$diff = array("", "Easy", "Medium", "Hard", "Xtreme");

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
$where = $search ? "AND `mapname` LIKE '%$ssearch%'" : "";

$q = "SELECT * FROM `kz_map` LEFT JOIN `kz_comm` ON `comm`=`name` LEFT JOIN `kz_diff` `d` ON `d`.`id`=`diff` WHERE 1 {$where} ORDER BY `mapname`";
$r = mysqli_query($db, $q);
$total = mysqli_num_rows($r);

$pages = generate_page($page, $total, $mapsPerPage, "$baseUrl/kreedz/downloads/page%page%/$search");

if ($total) {
	$rows_limit = mysqli_fetch_limit($r, $pages["start"], $mapsPerPage);
	
	$maps = array();
	foreach($rows_limit as $row) {
		$row["download_url"] = str_replace("%map%", $row["mapname"], $row["download"]);
		
		$maps[] = $row;
	}
}
?>