<?php
if (isset($_POST["player"]) && $_POST["player"] !='') {
	$player = slashes($_POST["player"]);
	
	header("Location: $baseUrl/$player/kreedz");
}

$types = array(
	'pro' => 'AND `go_cp` = 0 AND (`weapon` = 16 OR `weapon` = 29)',
	'noob' => 'AND (`go_cp` != 0 OR (`weapon` != 16 AND `weapon` != 29))',
	'all' => ''
);

$type = 'all';
if (isset($_GET["type"]) && isset($types[$_GET["type"]])) $type = $_GET["type"];

assign('type', $type);

$sort = isset($_GET["sort"]) && $_GET["sort"]!="" ? $_GET["sort"] : "num";
assign('sort', $sort);

$rec = isset($_GET["rec"]) && $_GET["rec"]!="" ? $_GET["rec"] : "rec";
assign('rec', $rec);

$table = $sort=="top1" ? "kz_map_top1" : "kz_map_top";

// Players top
$q = "SELECT COUNT(DISTINCT `player`) FROM `{$table}` WHERE 1 {$types[$type]}";
$r = mysqli_query($db, $q);

$total = mysqli_result($r, 0);
assign('total', $total);

$pages = generate_page($_GET["page"], $total, $playersPerPage);
$pages["pageUrl"] = "$baseUrl/kreedz/players/$type/page%page%/$sort";
assign('pages', $pages);

$limit = "LIMIT ".$pages["start"].",".$pages["perpage"];

$q = "SELECT `tmp`.*, `unr_players`.`name` FROM `unr_players` RIGHT JOIN (
	SELECT *, COUNT(DISTINCT `map`) AS `records` FROM `{$table}` WHERE 1 {$types[$type]} GROUP BY `player`) AS `tmp` 
	ON `unr_players`.`id` = `tmp`.`player` ORDER BY `records` DESC {$limit}";
$r = mysqli_query($db, $q);

$players = array();
$number = $pages["start"]+1;
while($row = mysqli_fetch_array($r)) {
	$row["number"] = $number++;
	
	$row["name_url"] = url_replace($row["name"]);
	
	$players[] = $row;
}	

assign('players', $players);
?>