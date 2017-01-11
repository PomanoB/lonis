<?php
if (isset($_POST["name"]) && $_POST["name"] !='') {
	$name = slashes($_POST["name"]);
	
	header("Location: $baseUrl/$name/kreedz");
}

$types = array(
	'pro' => 'AND `go_cp` = 0 AND (`weapon` = 16 OR `weapon` = 29)',
	'noob' => 'AND (`go_cp` != 0 OR (`weapon` != 16 AND `weapon` != 29))',
	'all' => ''
);

$type = (isset($_GET["type"]) && isset($types[$_GET["type"]])) ? $_GET["type"] : 'all';
assign('type', $type);

$sort = isset($_GET["sort"]) && $_GET["sort"]!="" ? $_GET["sort"] : "num";
assign('sort', $sort);

$rec = isset($_GET["rec"]) && $_GET["rec"]!="" ? $_GET["rec"] : "rec";
assign('rec', $rec);

$page = isset($_GET["page"]) ? $_GET["page"] : 0;

$table = $sort=="top1" ? "kz_map_tops1" : "kz_map_tops";

// Players top
$q = "SELECT `name`, COUNT(DISTINCT `map`) AS `records` FROM `{$table}` WHERE 1 {$types[$type]} GROUP BY `player` ORDER BY `records` DESC";
$r = mysqli_query($db, $q);

$total = mysqli_num_rows($r);
assign('total', $total);

$pages = generate_page($page, $total, $playersPerPage);
$pages["pageUrl"] = "$baseUrl/kreedz/players/$type/page%page%/$sort";
assign('pages', $pages);

if($total) {
	$i=0;
	while($rows = mysqli_fetch_assoc($r)) {
		$i++;
		if($i>$pages["start"] && $i<$pages["end"])
			$rows_limit[] = $rows;
	}

	$number = $pages["start"]+1;
	$players = array();
	foreach($rows_limit as $row) {
		$row["number"] = $number++;
		
		$row["name_url"] = url_replace($row["name"]);
		
		$players[] = $row;
	}	
	assign('players', $players);
}
?>