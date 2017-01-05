<?php
$message = "";

include 'hlds.php';

if(isset($_GET["addr"])) {
	$addr = $_GET["addr"];
}
else
if(isset($_POST["addr"])) {
	$addr =  $_POST["addr"];
}
else
	$addr = "";

$server=new hlds();

if($addr) {	
	if (!$server->connect($addr)) {
		$message = $langs['langServerNotFound'];
	}
	else {
		$info = $server->info();
		$players = $server->get_players();
		
		$img = "$baseUrl/img/{$info['mod']}/{$info['map']}.jpg";
		$info['img'] = file_exists($img) ? $img : "$baseUrl/img/noimage.png";
		
		$addrs = explode(":", $addr);
		$info["ip"] = gethostbyname($addrs[0]);
		
		$smarty->assign('info', $info);
		$smarty->assign('players', $players);
	}
}
else {
	$q = "SELECT * FROM `servers` LEFT JOIN `servers_mod` ON `mod` = `mid`";
	$r = mysqli_query($db, $q);
	
	while($row = mysqli_fetch_array($r)) {
		$id = $row['id'];
		$update = $row['update'];

		$up = time()-$update;
		if($up>30*60) {
			if($server->connect($row["addres"])) {
				$info = $server->info();
				$row = array_replace($row, $info);
				
				$name = $info['name'];
				$map = $info['map'];
				$players = $info['players'];
				$max_players = $info['max_players'];
				$update = time();
				
				$q = "UPDATE `servers` 
						SET `name` = '$name', `map` = '$map', `players` = '$players', 
							`max_players` = '$max_players', `update` = '$update' 
						WHERE `id` = $id";
				mysqli_query($db, $q);
			}
		}
		
		$row["update"] = strftime("%H:%M %d.%m.%Y", $update);
		
		$servers[] = $row;
	}
	
	$smarty->assign('servers', $servers);
}

$smarty->assign('message', $message); 
$smarty->assign('addr', $addr);
$smarty->assign('server_name', $server_name);

?>