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

$sort = $_GET["sort"] ? $_GET["sort"] : "name";
$desc = $sort=="achiev" ? "DESC" : "";
$order = "ORDER BY `{$sort}` {$desc}";

$q = "SELECT COUNT(*) FROM `unr_players` WHERE 1 {$where}";
$r = mysqli_query($db, $q);
$total = mysqli_result($r, 0);

$pages = generate_page($_GET["page"], $total, $playerPerPage);
$pages["pageUrl"] = "{$baseUrl}/players/{$sort}/page%page%/{$search}";
assign('pages', $pages);

$limit = "LIMIT ".$pages["start"].",".$pages["perpage"];

$players = array();

if($total) {
	$q = "SELECT * FROM (SELECT `id` AS `plid`, `name`, `lastIp`, `email`, `steam_id_64`,
		(SELECT COUNT(*) FROM `unr_players_achiev`, `unr_achiev` 
			WHERE `achievId` = `unr_achiev`.`id` AND `count` = `progress` AND `playerId` = `plid`) AS `achiev`
		FROM `unr_players`) AS `tmp` WHERE 1 {$where} {$order} {$limit}";	
	$r = mysqli_query($db, $q);
	
	while($row = mysqli_fetch_array($r)) {
		if(isset($row["lastIp"]) && $row["lastIp"]!="") {
			$q = "SELECT `code`, `country` FROM `geoip_countries` WHERE `ip_to` >= INET_ATON('{$row["lastIp"]}') ORDER BY `ip_to` ASC LIMIT 1";
			$geoip = mysqli_fetch_assoc(mysqli_query($db, $q));
		}
		
		$row["countryName"] = isset($geoip["country"]) ? $geoip["country"] : "";
		$row["countryCode"] = isset($geoip["code"]) ? $geoip["code"] : "";
		
		$img = 'img/country/'.$row["countryCode"].'.png';
		$row["countryImg"] = file_exists($img) ? $img : "";
		
		$row["avatarLink"] = "http://www.gravatar.com";
		$row["avatar"] = $row["avatarLink"].'/avatar/'.md5($row["email"]).'?d=wavatar&s='.$avatarSize["Icon"];
		
		$row["name_url"] = url_replace($row["name"]);
		
		$players[] = $row;
	}
}

assign('players', $players);

?>