<?php

function smarty_function_generate_pages($params, &$smarty) {
	$params_list = array(
		"totalPages" => 0,
		"page" => 0,
		"pageUrl" => ""
		);
		
	foreach($params as $key => $val) {
		$$key = isset($key) ? $val : $param_list[$key]; 
	}
	
	if ($totalPages <= 1)
		return "";
	
	$output = "";
	if ($page > 2) $output .= "<a href=".str_replace("%page%", 1, $pageUrl).">1</a> ";
	if ($page > 1) $output .= "<a href=".str_replace("%page%", ($page - 1), $pageUrl).">".($page - 1)."</a> ";
	$output .= "<b>{$page}</b> ";
	if ($page < $totalPages) $output .= "<a href=".str_replace("%page%", ($page + 1), $pageUrl).">".($page+1)."</a> ";
	if ($page < $totalPages - 1) $output .= "<a href=".str_replace("%page%", ($totalPages), $pageUrl).">".($totalPages)."</a> ";
	$output .= "";
	
	return $output;
}
?>