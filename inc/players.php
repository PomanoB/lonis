<?php

if (isset($_REQUEST["search"]) && $_REQUEST["search"] != '')
{
	if (get_magic_quotes_gpc()) {
		$search = $_REQUEST["search"];
	}
	else {
		$search = addslashes($_REQUEST["search"]);
	}
	$smarty->assign('pageUrl', "$baseUrl/players/$search/page%page%");
		
	$smarty->assign('search', stripslashes($search));
	
	$where = "WHERE `name` LIKE '%$search%'";
}
else
{
	$where = '';
	$smarty->assign('pageUrl', "$baseUrl/players/page%page%");
}

$q = "SELECT COUNT(*) FROM `unr_players` $where";
$r = mysql_query($q);

$total = mysql_result($r, 0);

if (isset($_GET["page"]))
	$page = abs((int)$_GET["page"]);
else
	$page = 1;
if (!$page)
	$page = 1;

$totalPages = ceil($total/$playerPerPage);	
if ($page > $totalPages)
	$page = 1;

$smarty->assign('page', $page);
$smarty->assign('totalPages', $totalPages);	
	
$players = array();

if ($total)
{	
	$start = ($page - 1) * $playerPerPage;

	$q = "SELECT * FROM `unr_players` $where ORDER BY `name` LIMIT $start, $playerPerPage";

	$r = mysql_query($q);
	while($row = mysql_fetch_array($r))
	{
		$countryName = '';
		$countryCode = '';
		if ($row["lastIp"])
		{
			$record = geoip_record_by_addr($gi, $row["lastIp"]);
			if(!is_null($record))
			{
				$countryCode = strtolower($record->country_code);
				$countryName = $record->country_name;
			}
		}
		
		$row["countryCode"] = $countryCode;
		$row["countryName"] = $countryName;
		
		if (file_exists('img/country/'.$countryCode.'.png'))
			$row["countryImg"] = 'img/country/'.$countryCode.'.png';
		else
			$row["countryImg"] = '';
			
		$players[] = $row;
	}
}
$smarty->assign('players', $players);
$template = 'players.tpl';


?>