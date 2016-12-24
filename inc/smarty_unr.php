<?php

include 'smarty3/Smarty.class.php';

class Smarty_unr extends Smarty
{

	public function __construct()
	{
		try {
			parent::__construct();
		} catch (SmartyException $e) {
			exit($e->getMessage());
		}

		$this->template_dir = 'templates/';
		$this->compile_dir = 'smarty3/templates_c/';
		$this->config_dir = 'config';
		$this->cache_dir = 'smarty3/cache/';
	}
}

?>