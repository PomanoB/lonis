<?php

if(isset($_POST["addr"])) {
	$addr = $_POST["addr"];
	header("Location: {$baseUrl}/servers/$addr");
}
include 'plugins/hlds.php';
$server = new hlds();

$addr = isset($_GET["addr"]) ?  $_GET["addr"] : "";
$page = isset($_GET["page"]) ? $_GET["page"] : 0;

$vip = $addr=="vip" ? "AND `vip` = 1" : "";

if($addr && $addr!="vip") {	
	if (!$server->connect($addr)) {
		$message = $langs['ServerNotFound'];
	}
	else {
		$info = $server->info();
		$players = $server->get_players();
		
		$img_file = "{$docRoot}/img/{$info['mod']}/{$info['map']}.jpg";
		$imgmap = "{$baseUrl}/img/noimage.jpg";
		
		$imgmap = file_exists("{$docRoot}/img/noimage.jpg") ? $imgmap : "";
		if(file_exists($img_file)) {
			$info['img'] = "{$baseUrl}/img/{$info['mod']}/{$info['map']}.jpg";
		}
		
		$addrs = explode(":", $addr);
		$info["ip"] = gethostbyname($addrs[0]);
	}
}
else {
	$q = "SELECT * FROM `servers` LEFT JOIN `servers_mod` ON `mod` = `mid` WHERE 1 {$vip} ORDER BY `name`";	
	$r = mysqli_query($db, $q);
	$total = mysqli_num_rows($r);
	
	$pages = generate_page($page, $total, 15, "$baseUrl/servers/$addr");

	if($total) {
		$rows_limit = mysqli_fetch_limit($r, $pages["start"], 15);
		
		$rows = array();
		foreach($rows_limit as $row) {
			$id = $row['id'];
			
			$update = strtotime($row['update']." ".$timezone);
			$row["updatef"] = strftime("%d.%m %H:%M", $update);
			
			if(!$vip) {
				if(time()-$update > $server_update) {
					if($server->connect($row["addres"])) {
						$info = $server->info();
						if(isset($info))
							$row = array_replace($row, $info);
					}
					else {
						$row['map'] = "";
						$row['players'] = 0;
						$row['max_players'] = 0;
					}
					
					$q = "UPDATE `servers` 
							SET `name` = '{$row['name']}', 
								`map` = '{$row['map']}', 
								`players` = {$row['players']}, 
								`max_players` = {$row['max_players']},
								`update` = NOW()
							WHERE `id` = {$id}";
					mysqli_query($db, $q);
					
					$row["update"] = strftime("%d.%m %H:%M", time());
				}
			}
			
			
			
			$rows[] = $row;
		}
	}
}

?>