<?php
$id = isset($_GET["id"]) && $_GET["id"] ? $_GET["id"] : 0;

if($id) {
	$q = "SELECT * FROM `news` WHERE id = {$id}";
	$r = mysqli_query($db, $q);
	
	$post = mysqli_fetch_assoc($r);
}
else {
	$page = isset($_GET["page"]) && $_GET["page"] ? $_GET["page"] : 0;

	$search = isset($_GET["search"]) && $_GET["search"] ? urldecode($_GET["search"]) : "";
	$ssearch = slashes($search);

	$where = $search ? "AND (`caption` LIKE '%$ssearch%' OR `text` LIKE '%$ssearch%')" : "";

	$q = "SELECT * FROM `news` WHERE 1 {$where} ORDER BY date DESC";	
	$r = mysqli_query($db, $q);
	$total = mysqli_num_rows($r);

	$pages = generate_page($page, $total, 5);
	$rows_limit = mysqli_fetch_limit($r, $pages["start"], 5);

	$news = array();
	foreach($rows_limit as $row) {
		if($pos = strpos($row["text"], "<!--more-->"))
			$row["text"] = substr($row["text"], 0, $pos);
		
		$news[] = $row;
	}
}

?>