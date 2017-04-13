<?php

$comm = isset($_GET["comm"]) && $_GET["comm"] ? $_GET["comm"] : "xj";
$where = $comm ? "AND `c`.`name` = '{$comm}'" : "";

$q = "SELECT `c`.`name`, `c`.`fullname` FROM `kz_ljs_recs` `r` 
		LEFT JOIN `kz_comm` `c` ON `comm`=`c`.`name` 
		GROUP BY `c`.`name` ORDER BY `c`.`sort`";
$r = mysqli_query($db, $q);
while($row = mysqli_fetch_assoc($r)) {
	$titles[] = $row;
}

$q = "SELECT `r`.*, `t`.`fullname` `type_name`, `c`.`fullname` `comm_name` FROM `kz_ljs_recs` `r` 
		LEFT JOIN `kz_ljs_type` `t` ON `type`=`t`.`name` 
		LEFT JOIN `kz_comm` `c` ON `comm`=`c`.`name`
		WHERE 1 {$where} ORDER BY `c`.`sort`, `t`.`sort`, `block` DESC, `distance` DESC";
$r = mysqli_query($db, $q);
$total = mysqli_num_rows($r);
		
$jumps = array();
$lasttype = $lastcomm = "";
while($row = mysqli_fetch_assoc($r)) {
	$jumps[] = $row;
}

?>