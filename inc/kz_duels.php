<?php
$page = isset($_GET["page"]) ? $_GET["page"] : 0;

$q = "SELECT *,
	(SELECT `name` FROM `unr_players` WHERE `id` = `player1`) AS `name1`,
	(SELECT `name` FROM `unr_players` WHERE `id` = `player2`) AS `name2`
	FROM `kz_duel`";
$r = mysqli_query($db, $q);

$total = mysqli_num_rows($r);
assign('total', $total);

$pages = generate_page($page, $total, $mapsPerPage);
$pages["pageUrl"] = "$baseUrl/kreedz/duels/page%page%";
assign('pages', $pages);

if($total) {
	$i=0;
	while($rows = mysqli_fetch_assoc($r)) {
		$i++;
		if($i>$pages["start"] && $i<$pages["end"])
			$rows_limit[] = $rows;
	}

	$duels = array();
	foreach($rows_limit as $row) {
		$res = $row["result1"] < $row["result2"] ? 0 : 1;
		$pw =  $res+1; $pl = !$res+1;

		$row["winnerId"] 	 = $row["player$pw"];
		$row["winnerName"] 	 = $row["name$pw"];
		$row["winnerPoints"] = $row["result$pw"];
		$row["looserId"] 	 = $row["player$pl"];
		$row["looserName"] 	 = $row["name$pl"];
		$row["looserPoints"] = $row["result$pl"];
		
		$row["winnerName_url"] = url_replace($row["name$pw"]);
		$row["looserName_url"] = url_replace($row["name$pl"]);
		
		$duels[] = $row;
	}
	assign('duels', $duels);
}
?>