<?php
// Make sure we have built in support for MySQL
if (!function_exists('mysqli_connect'))
	exit('This PHP environment doesn\'t have MySQLi support built in. MySQLi support is required if you want to use a MySQLi database to run this forum. Consult the PHP documentation for further assistance.');
	
class DBClass {
	var $link_id;
	var $num_queries = 1;
	var $query_result;
	
	function connect($mysql) {
		if ($mysql['persistent'])
			$this->link_id = @mysqli_connect('p:'.$mysql['host'], $mysql['user'], $mysql['pass'], $mysql['db'], $mysql['port']);
		else
			$this->link_id = @mysqli_connect($mysql['host'], $mysql['user'], $mysql['pass'], $mysql['db'], $mysql['port']);

		if (!$this->link_id)
			die('Unable to connect to MySQL and select database. MySQL reported: '.mysqli_connect_error().'<br/>'. __FILE__ .':'. __LINE__);
		
		return $this->link_id;
	}
	
	function query($sql) {
		if (strlen($sql) > 140000)
			exit('Insane query. Aborting.');
			
		$this->query_result = mysqli_query($this->link_id, $sql);
		
		if ($this->query_result) {
			$this->num_queries++;
			return $this->query_result;
		} else
			return false;
	}
	
	function fetch_assoc($query_id = 0)
	{
		return ($query_id) ? mysqli_fetch_assoc($query_id) : false;
	}
	
	function num_queries()
	{
		return $this->num_queries;
	}
	
	function escape($str)
	{
		return is_array($str) ? '' : '\''.mysqli_real_escape_string($this->link_id, $str).'\'';
	}
	
	function error()
	{
		$result['error_no'] = mysqli_errno($this->link_id);
		$result['error_msg'] = mysqli_error($this->link_id);

		return $result;
	}
	
	function close($link = false)
	{
		if(!$link)
			$link = $this->link_id;
			
		if($this->query_result)
			mysqli_free_result($this->query_result);

		if ($link)
			return mysqli_close($link);
		else
			return false;
	}
}
?>