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
$sort = (isset($_GET["sort"]) && $_GET["sort"]!="") ? $_GET["sort"] : "name";

$desc = $sort=="achiev" ? "DESC" : "";
$order = "ORDER BY `{$sort}` {$desc}";

$q = "SELECT * FROM (SELECT `id` AS `plid`, `name`, `lastIp`, `email`, `steam_id_64`,
		(SELECT COUNT(*) FROM `unr_players_achiev`, `unr_achiev` 
			WHERE `achievId` = `unr_achiev`.`id` AND `count` = `progress` AND `playerId` = `plid`) AS `achiev`
		FROM `unr_players`) AS `tmp`
		WHERE 1 {$where} {$order}";	
$r = mysqli_query($db, $q);
$total = mysqli_num_rows($r);
assign('total', $total);

$pages = generate_page($page, $total, $playerPerPage);
$pages["pageUrl"] = "{$baseUrl}/players/{$sort}/page%page%/{$search}";
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
		if(isset($row["lastIp"]) && $row["lastIp"]!="") {
			$q = "SELECT `code`, `country_name` as `country` FROM
						(SELECT * FROM `geoip_countries` WHERE `ip_to` >= INET_ATON('{$row["lastIp"]}') ORDER BY `ip_to` ASC LIMIT 1) AS `cnt`,
						`geoip_locations`
					WHERE `code` = `country_iso_code` AND `locale_code` = '{$lang}'";
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
	assign('players', $players);
}
?>