<?php
// Make sure we have built in support for MySQL
if (!function_exists('mysql_connect'))
	exit('This PHP environment doesn\'t have MySQL support built in. MySQL support is required if you want to use a MySQL database to run this forum. Consult the PHP documentation for further assistance.');
	
class DBClass {
	var $link_id;
	var $num_queries = 1;
	var $query_result;
	
	function connect($mysql) {
		if ($mysql['persistent'])
			$this->link_id = mysql_pconnect($mysql['host'].':'.$mysql['port'], $mysql['user'], $mysql['pass']);
		else
			$this->link_id = mysql_connect($mysql['host'].':'.$mysql['port'], $mysql['user'], $mysql['pass']);

		if (!$this->link_id)
			die('Unable to connect to MySQL. MySQL reported: '.mysql_error().'<br/>'. __FILE__ .':'. __LINE__);
		
		if(!$this->query('USE `'.$mysql['db'].'`'))
			die('Unable to select MySQL database. MySQL reported: '.mysql_error().'<br/>'. __FILE__ .':'. __LINE__);
		
		return $this->link_id;
	}
	
	function query($sql) {
		if (strlen($sql) > 140000)
			exit('Insane query. Aborting.');
		
		$this->query_result = mysql_query($sql,$this->link_id);
		
		if ($this->query_result) {
			$this->num_queries++;
			return $this->query_result;
		} else
			return false;
	}
	
	function fetch_assoc($query_id = 0)
	{
		return ($query_id) ? mysql_fetch_assoc($query_id) : false;
	}
	
	function get_num_queries()
	{
		return $this->num_queries;
	}
	
	function escape($str)
	{
		return is_array($str) ? '' : '\''.mysql_real_escape_string($str,$this->link_id).'\'';
	}
	
	function error()
	{
		$result['error_no'] = mysql_errno($this->link_id);
		$result['error_msg'] = mysql_error($this->link_id);

		return $result;
	}
	
	function close($link = false)
	{
		if(!$link)
			$link = $this->link_id;
			
		if($this->query_result)
			mysql_free_result($this->query_result);

		if ($link)
			return mysql_close($link);
		else
			return false;
	}
}
?>