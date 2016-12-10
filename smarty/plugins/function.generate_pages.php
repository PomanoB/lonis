<?php

function smarty_function_generate_pages($params, &$smarty)
{
	$totalPages = 1;
	$page = 1;
	$baseUrl = '';
	foreach($params as $_key => $_val)
	{
        switch($_key) 
		{
            case 'totalPages':
				$totalPages = $_val;
				break;
            case 'page':
				$page = $_val;
				break;
			case 'pageUrl':
				$baseUrl = $_val;
				break;
        }
    }
	if ($totalPages <= 1)
		return '';
	$output = '<div>';
	
	if ($page > 2)
		$output .= ('<a href="'.str_replace('%page%', 1, $baseUrl).'">1</a> ');
	if ($page > 1)
		$output .= ('<a href="'.str_replace('%page%', ($page - 1), $baseUrl).'">'.($page - 1).'</a> ');
	$output .= '<b>'.$page.'</b> ';
	if ($page < $totalPages)
		$output .= ('<a href="'.str_replace('%page%', ($page + 1), $baseUrl).'">'.($page + 1).'</a> ');
	if ($page < $totalPages - 1)
		$output .= ('<a href="'.str_replace('%page%', ($totalPages), $baseUrl).'">'.($totalPages).'</a> ');
	$output .= '</div>';
	return $output;
}
?>