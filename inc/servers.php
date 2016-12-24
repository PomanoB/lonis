<?php
$message = "";

include 'hlds.php';

if(isset($_GET["addr"])) {
	$addr = $_GET["addr"];
	preg_match('/"(.*)"/', $addr, $addr);
	$addr = isset($addr[1]) ? $addr[1] : "" ;
}
else
if(isset($_POST["addr"])) {
	$addr =  $_POST["addr"];
}
else
	$addr = "";

if($addr) {
	$server=new hlds();
	if (!$server->connect($addr)) {
		$message = $langs['langServerNotFound'];
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
	$r = mysqli_query($db, $q);
	
	while($row = mysqli_fetch_array($r)) {
		$servers[] = $row;
	}
	
	$smarty->assign('servers', $servers);
}

$smarty->assign('message', $message); 
$smarty->assign('addr', $addr);
$smarty->assign('server_name', $server_name);

?>