<?php

$type = isset($_GET["type"]) && isset($types[$_GET["type"]]) ? $_GET["type"] : 'all';
$sort = isset($_GET["sort"]) && $_GET["sort"]!="" ? $_GET["sort"] : "all";
$page = isset($_GET["page"]) && $_GET["page"] ? $_GET["page"] : 0;

$search = isset($_GET["search"]) && $_GET["search"] ? $_GET["search"] : "";
$ssearch = slashes($search);

$where = $search ? "AND `name` LIKE '%$ssearch%'" : "";

$q = "SELECT `name`, `all`, `top1` FROM `unr_players` `p`
		JOIN (SELECT COUNT(DISTINCT `map`) as `all`, `player` FROM kz_map_top WHERE 1 {$types[$type]} GROUP BY `player`) as `t` ON `id` = `t`.`player`
		LEFT JOIN (SELECT COUNT(DISTINCT `map`) as `top1`, `player` FROM kz_map_top1 WHERE 1 {$types[$type]} GROUP BY `player`) as `t1` ON `id` = `t1`.`player`
		WHERE 1 {$where} AND `all`>50 ORDER BY `{$sort}` DESC, `name`";
$r = mysqli_query($db, $q);
$total = mysqli_num_rows($r);

$pages_plr = generate_page($page, $total, $playersPerPage, "$baseUrl/kreedz/players/$type/page%page%/$sort/$search");

$rows_limit = mysqli_fetch_limit($r, $pages_plr["start"], $playersPerPage);

$rows = array();
foreach($rows_limit as $row) {
	$rows[] = $row;
}

?>