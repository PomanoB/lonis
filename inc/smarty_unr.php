<?php

include 'smarty/Smarty.class.php';

class Smarty_unr extends Smarty
{

	function Smarty_unr()
	{
		$this->Smarty();

		$this->template_dir = 'templates/';
		$this->compile_dir = 'smarty/templates_c/';
		$this->config_dir = 'config';
		$this->cache_dir = 'smarty/cache/';
	}
}

?>