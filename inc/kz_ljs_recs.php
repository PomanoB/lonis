<?php

$q = "SELECT `r`.*, `t`.`fullname` `type_name`, `c`.`fullname` `comm_name` FROM `kz_ljs_recs` `r` 
		LEFT JOIN `kz_ljs_type` `t` ON `type`=`t`.`name` 
		LEFT JOIN `kz_comm` `c` ON `comm`=`c`.`name`
		ORDER BY `c`.`sort`, `t`.`sort`, `block` DESC, `distance` DESC";
$r = mysqli_query($db, $q);
$total = mysqli_num_rows($r);
		
if ($total) {
	$jumps = array();
	$lasttype = $lastcomm = "";
	while($row = mysqli_fetch_assoc($r)) {
		$row["section0"] = $row["comm"]==$lastcomm ? 0 : 1;
		$lastcomm = $row["comm"];
		
		$row["section1"] = $row["type"]==$lasttype ? 0 : 1;
		$lasttype = $row["type"];
		
		$jumps[] = $row;
	}
}

?>