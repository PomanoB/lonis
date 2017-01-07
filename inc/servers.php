<?php
$message = "";

include 'hlds.php';

if(isset($_POST["addr"])) {
	$addr = $_POST["addr"];
	header("Location: {$baseUrl}/servers/$addr");
}

$addr = isset($_GET["addr"]) ?  $_GET["addr"] : "";

$server=new hlds();

if($addr) {	
	if (!$server->connect($addr)) {
		$message = $langs['ServerNotFound'];
	}
	else {
		$info = $server->info();
		$players = $server->get_players();
		
		$img_file = "{$docRoot}{$baseSite}/img/{$info['mod']}/{$info['map']}.jpg";
		$mapimage = "{$docRoot}{$baseSite}/img/mapimage.jpg";

		if(file_exists($img_file)) {
			file_put_contents($mapimage, file_get_contents($img_file));
			$info['img'] = "$baseUrl/img/mapimage.jpg";
		}
		
		$addrs = explode(":", $addr);
		$info["ip"] = gethostbyname($addrs[0]);
		
		assign('info', $info);
		assign('players', $players);
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
	
	assign('servers', $servers);
}

assign('message', $message); 
assign('addr', $addr);
assign('server_name', $server_name);

?>