<?php

include 'hlds.php';

$addr = isset($_POST["addr"]) ? $_POST["addr"] : (isset($_GET["addr"]) ? $_GET["addr"] : "");

preg_match("/%22(.*)%22/", $addr, $addr);
$addr = isset($addr[1]) ? $addr[1] : "" ;

if($addr) {
	$server=new hlds();
	if (!$server->connect($addr)) {
		$smarty->assign('message', $langs['langServerNotFound']);
	}
	else {
		$info=$server->info();
		$players=$server->get_players();
		
		$img = "$baseUrl/img/{$info['mod']}/{$info['map']}.jpg";
		$info['img'] = file_exists($img) ? $img : "$baseUrl/img/noimage.png";
		
		$smarty->assign('info', $info);
		$smarty->assign('players', $players);
	}
}
else {
	$q = "SELECT * FROM `servers` LEFT JOIN `servers_lang` ON `servers`.`id` = `serverid` WHERE `lang`='{$lang}'";
	$r = mysql_query($q);
	
	while($row = mysql_fetch_array($r)) {
		$servers[] = $row;
	}
	
	$smarty->assign('servers', $servers);
}

$smarty->assign('addr', $addr);
$smarty->assign('server_name', $server_name);

?>