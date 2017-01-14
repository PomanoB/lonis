<?php

include 'inc/smarty3/Smarty.class.php';

class Smarty_unr extends Smarty {
	
	public function __construct() {
		global $dirs;
		
		try {
			parent::__construct();
		} 
		catch (SmartyException $e) {
			exit($e->getMessage());
		}

		$this->template_dir = $dirs["template_dir"];
		$this->compile_dir = $dirs["compile_dir"];
		$this->config_dir = $dirs["config_dir"];
		$this->cache_dir = $dirs["cache_dir"];
	}
}

$smarty = new Smarty_unr();
?>