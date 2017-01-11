<?php
$search = $where = "";
if (isset($_POST["search"]) && $_POST["search"] !='') {
	$search = slashes($_POST["search"]);
	
	header("Location: $baseUrl/players/$search");
}

if (isset($_GET["search"]) && $_GET["search"] != '') {
	$search = slashes($_GET["search"]);
	
	assign('search', stripslashes($search));
	
	$where = "AND `name` LIKE '%{$search}%'";
}

$page = isset($_GET["page"]) ? $_GET["page"] : 0;
$order = (isset($_GET["order"])) ? $_GET["order"] : "";
$page = isset($_GET["page"]) ? $_GET["page"] : 0;
$sort = isset($_GET["sort"]) ? $_GET["sort"] : "";

$orderby = $order ? "`{$order}` {$sort}, `name` {$sort}" : "`name`";

$q = "SELECT * FROM `players` WHERE (`lang`='{$lang}' OR `lang` IS NULL) {$where} ORDER BY {$orderby}";	
$r = mysqli_query($db, $q);
$total = mysqli_num_rows($r);
assign('total', $total);

$pages = generate_page($page, $total, $playerPerPage);
$pages["pageUrl"] = "{$baseUrl}/players/{$order}-{$sort}/page%page%/{$search}";
assign('pages', $pages);

if($total) {
	$i=0;
	while($rows = mysqli_fetch_assoc($r)) {
		$i++;
		if($i>$pages["start"] && $i<$pages["end"])
			$rows_limit[] = $rows;
	}
	
	$players = array();
	foreach($rows_limit as $row) {
		$img = 'img/country/'.$row["country"].'.png';
		$row["countryImg"] = file_exists($img) ? $img : "";
		
		$row["avatarLink"] = "http://www.gravatar.com";
		$row["avatar"] = $row["avatarLink"].'/avatar/'.md5($row["email"]).'?d=wavatar&s='.$avatarSize["Icon"];
		
		$row["name_url"] = url_replace($row["name"]);
		
		$players[] = $row;
	}
	assign('players', $players);
}
?>