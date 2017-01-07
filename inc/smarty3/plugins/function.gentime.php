<?php

function smarty_function_gentime($params, &$smarty)
{
	return microtime(true)-$params['start'];
}
?>