<?php
$message = "";

if(isset($_POST["addr"])) {
	$addr = $_POST["addr"];
	header("Location: {$baseUrl}/servers/$addr");
}

$addr = isset($_GET["addr"]) ?  $_GET["addr"] : "";
assign('addr', $addr);

$page = isset($_GET["page"]) ? $_GET["page"] : 0;

$vip = $addr=="vip" ? "AND `vip` = 1" : "";

include 'hlds.php';
$server = new hlds();

if($addr && $addr!="vip") {	
	if (!$server->connect($addr)) {
		$message = $langs['ServerNotFound'];
	}
	else {
		$info = $server->info();
		$players = $server->get_players();

		$img_file = "{$docRoot}/img/{$info['mod']}/{$info['map']}.jpg";
		$mapimage = "{$docRoot}/img/mapimage.jpg";

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
	$q = "SELECT * FROM `servers` LEFT JOIN `servers_mod` ON `mod` = `mid` WHERE 1 {$vip} ORDER BY `name`";	
	$r = mysqli_query($db, $q);
	$total = mysqli_num_rows($r);
	assign('total', $total);

	$pages = generate_page($page, $total, 15);
	$pages["pageUrl"] = "$baseUrl/servers/$addr";
	assign('pages', $pages);

	if($total) {
		$i=0;
		while($rows = mysqli_fetch_assoc($r)) {
			$i++;
			if($i>=$pages["start"] && $i<=$pages["end"])
				$rows_limit[] = $rows;
		}
		
		$servers = array();
		foreach($rows_limit as $row) {
			$id = $row['id'];
			$update = $row['update'];

			$up = time()-$update;
			if($up > $server_update) {
				$update = time();
				if($server->connect($row["addres"])) {
					$info = $server->info();
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
							`update` = '{$update}' 
						WHERE `id` = {$id}";
				mysqli_query($db, $q);
			}
			
			$row["update"] = strftime("%d.%m %H:%M", $update);
			
			$servers[] = $row;
		}
		assign('servers', $servers);
	}
}

assign('message', $message); 
?>