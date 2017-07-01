<?php
$page = isset($_GET["page"]) ? $_GET["page"] : 0;

$search = isset($_GET["search"]) && $_GET["search"] ? $_GET["search"] : "";
$ssearch = slashes($search);

$where = $search ? "AND `map` LIKE '%$ssearch%' OR `pl1`.`name` LIKE '%$ssearch%' OR `pl2`.`name` LIKE '%$ssearch%'" : "";

$q = "SELECT `d`.*, `pl1`.`name` `name1`, `pl2`.`name` `name2` FROM `kz_duel` `d`
		LEFT JOIN `players` `pl1` ON `pl1`.`id` = `player1`
		LEFT JOIN `players` `pl2` ON `pl2`.`id` = `player2`
		WHERE 1 {$where}";
$r = mysqli_query($db, $q);
$total = mysqli_num_rows($r);

$pages = generate_page($page, $total, $mapsPerPage);
$rows_limit = mysqli_fetch_limit($r, $pages["start"], $mapsPerPage);

$rows = array();
foreach($rows_limit as $row) {
	$res = $row["result1"] < $row["result2"] ? 0 : 1;
	$pw = $res+1; $pl = !$res+1;

	$row["winnerId"] 	 = $row["player$pw"];
	$row["winnerName"] 	 = $row["name$pw"];
	$row["winnerPoints"] = $row["result$pw"];
	$row["looserId"] 	 = $row["player$pl"];
	$row["looserName"] 	 = $row["name$pl"];
	$row["looserPoints"] = $row["result$pl"];
	
	$row["winnerName_url"] = url_replace($row["name$pw"]);
	$row["looserName_url"] = url_replace($row["name$pl"]);
	
	$rows[] = $row;
}
?>