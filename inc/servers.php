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
		
		$img_file = "{$docRoot}/{$dimg}/{$info['mod']}/{$info['map']}.jpg";
		$imgmap = "{$baseUrl}/{$dimg}/noimage.jpg";
		
		$imgmap = file_exists("{$docRoot}/{$dimg}/noimage.jpg") ? $imgmap : "";
		if(file_exists($img_file)) {
			$info['img'] = "{$baseUrl}/{$dimg}/{$info['mod']}/{$info['map']}.jpg";
		}
		
		$addrs = explode(":", $addr);
		$info["ip"] = gethostbyname($addrs[0]);
	}
}
else {
	$q = "SELECT * FROM `servers` LEFT JOIN `servers_mod` ON `mod` = `mid` WHERE 1 {$vip} ORDER BY `name`";	
	$r = mysqli_query($db, $q);
	$total = mysqli_num_rows($r);
	
	$pagess = generate_page($page, $total, 10, "$baseUrl/servers/$addr");

	$rows_limit = mysqli_fetch_limit($r, $pagess["start"], 10);
	
	$servers = array();
	foreach($rows_limit as $row) {
		$update = strtotime($row['update']." ".$timezone);
		$row["updatef"] = strftime("%d.%m %H:%M", $update);
		
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
					WHERE `id` = {$row['id']}";
			mysqli_query($db, $q);
			
			$row["update"] = strftime("%d.%m %H:%M", time());
		}

		$servers[] = $row;
	}
}

?>