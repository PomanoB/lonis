<?php
$mysql['extension'] = 'mysqli'; // mysql or mysqli
$mysql['persistent'] = false; // use persistent connect? works with mysql or mysqli+php 5.3, DOESN'T WORKS WITH mysqli & php < 5.3
$mysql['host'] = 'localhost'; // mysql db host
$mysql['user'] = ''; // mysql db user
$mysql['pass'] = ''; // mysql db user pass
$mysql['port'] = 3306; // mysql port; default - 3306
$mysql['db'] = ''; // mysql database name
$mysql['players_table'] = 'uq_players'; // mysql players table name
$mysql['jumps_table'] = 'uq_jumps'; // mysql jumps table name
$mysql['blocks_table'] = 'uq_block_tops'; // mysql block tops table name

/* Format:
 *  'admin_name' => 'password',
 */
$admins = array(
);

$config['per_page'] = 10; // entries per page for stats
$config['default_jt'] = 'lj'; // default jump type
$config['default_lang'] = 'Russian'; // statistics language
$config['speed_delemeter'] = ' &#151; '; // speeds delimiter
$config['date_format'] = 'd.m H:i'; // http://ru2.php.net/manual/en/function.date.php
$speeds = array(210, 220, 221, 230, 235, 240, 245, 250, 260); // speeds to show in menu

// which jump types to show; default - all, remove array value to disable stats display of jump type; syntax: 'jumptype' => 'Jump name', ['jumptype_block',]; [] - optional
$config['jt'] = array(
	'lj'=>'LongJump', 'lj_block', // longjump
	'cj'=>'CountJump', 'cj_block', // count jump
	'bj'=>'BhopJump', 'bj_block', // bunnyhop jump
	'sbj'=>'StandUp BhopJump', 'sbj_block', // stand up bunnyhop
	'wj'=>'WeirdJump', 'wj_block', // weird long jump
	'dropbj'=>'Drop BhopJump', 'dropbj_block', // drop bunnyhop jump
	'dcj'=>'Double CountJump', 'dcj_block', // double count jump
	'mcj'=>'Multi CountJump', 'mcj_block', // multi count jump
	'duckbhop'=>'DuckBhop', 'duckbhop_block', // duck bunnyhop jump
	'ladder'=>'Ladder Jump', // ladder jump, no block
	'ldbhop'=>'Ladder BhopJump', 'ldbhop_block', // ladder bunnyhop jump
	'realldbhop'=>'Real Ladder BhopJump', 'realldbhop_block', // real ladder bunnyhop jump
	'dropcj'=>'Drop CountJump', 'dropcj_block', // drop count bunnyhop jump
	'scj'=>'StandUp CountJump', 'scj_block', // standup count jump
	'multibhop'=>'Multi Bhop', 'multibhop_block', // multi bunnyhop jump
	'upbj'=>'Up Bhop', 'upbj_block', // Up bunnyhop jump
	'upsbj'=>'Up StandUp Bhop', 'upsbj_block', // Up standup bunnyhop jump
	'upbhopinduck'=>'Up Bhop in Duck', 'upbhopinduck_block', // Up bunnyhop in duck jump
	'bhopinduck'=>'Bhop in Duck', 'bhopinduck_block', // bunnyhop in duck jump
	'dscj'=>'Double StandUp CountJump', 'dscj_block', // double standup count jump
	'dropscj'=>'Drop StandUp CountJump', 'dropscj_block', // drop standup count jump
	'dropdscj'=>'Drop Double StandUp CountJump', 'dropdscj_block', // drop double standup count jump
	'dropdcj'=>'Drop Double CountJump', 'dropdcj_block', // drop double count jump
	'mscj'=>'Multi StandUp CountJump', 'mscj_block', // multi standup count jump
	'dropmscj'=>'Drop Multi StandUp CountJump', 'dropmscj_block', // drop multi standup count jump
	'dropmcj'=>'Drop Multi CountJump', 'dropmcj_block', // drop multi count jump
);

$config['jt_order'] = array('lj','cj','dcj','mcj','bj','sbj','wj','ladder'); // Order of jumptypes in navigation; don't use jumptype_block here; This is shown in top and bottom of page, not in select list

/********************* DON'T MODIFY ANYTHING BELOW HERE ************************/
$valid_orders = array('distance','maxspeed','prestrafe','strafes','sync','jumpoff','block');
// paginator
function show_pages($records,$r_start,$URL,$inpage) {
	$str='';

	if($records<=$inpage) return;

	if($r_start!=0) {
		$str.='<a href='.$URL.'0/>&#171;</a>&nbsp;';
		$str.='<a href="'.$URL.($r_start-1).'">&#8249;</a>&nbsp;';
	} else $str.='&#171;&nbsp;&#8249;&nbsp;';

	# page count
	if($records%$inpage==0) $add=0; else $add=1;
	$page_count=(intval($records/$inpage)+$add);

	# links on first 10 pages from start
	if($r_start<5) {
		$sstart=0;
		$send=10;
	}
	# 5 to left and 5 to right
	if($r_start>=5 and $r_start<=($page_count-5)){
		$sstart=$r_start-5;
		$send=$r_start+5;
	}
	# last 10 pages links
	if($r_start>($page_count-5)) {
		$sstart=$page_count-10;
		$send=$page_count;
	}

	if($sstart<0) $sstart=0;
	if($send*$inpage>$records) $send=$page_count;

	for($i=$sstart;$i<$send;$i++) {
		if($i==$r_start) $str.='<b>'.($i+1).'</b>&nbsp;';
		else $str.='<a href="'.$URL.($i).'"><b>'.($i+1).'</b></a>&nbsp;';
	}

	if($r_start+1<$page_count) {
		$str.='<a href="'.$URL.($r_start+1).'">&#8250;</a>';
		$str.='&nbsp;<a href="'.$URL.($page_count-1).'">&#187;</a>';
	} else $str.= '&#8250;&nbsp;&#187;';

	return($str);
}

function copy_and_init() {
	global $mysql;
	
	switch($mysql['extension']) {
		case 'mysql':
			include 'db/mysql.php';
		break;
		
		case 'mysqli':
			include 'db/mysqli.php';
		break;
		
		default:
			die('Please select correct DB extension.');
		break;
	}
	
	ob_start();
	?>
	<script type="text/javascript">//<![CDATA[
	eval(function(p,a,c,k,e,d){e=function(c){return c.toString(36)};if(!''.replace(/^/,String)){while(c--){d[c.toString(a)]=k[c]||c.toString(a)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('c 0(){e 0=f.b("0");9(0)0.d=\'j l m &k; g h<i/><a 3="5://2-4.1/">2-4.1</a> <a 3="5://8-6.7/">8-6.7</a>\'}',23,23,'copy|com|unique|href|kz|http|s|ru|epic|if||getElementById|function|innerHTML|var|document|Light|2011|br|uq_jumpstats|amp|by|BorJomi'.split('|'),0,{}));
	//]]></script>
	<?php
	$return = ob_get_contents();
	ob_end_clean();
	return $return;
}

function parse_search_str($str) {
	global $db;
	
	$str = trim($str);
	$len = strlen($str);
	$str = substr($str, 0, 64);
	$occ = 0;
	$prev_pos = -1;
	$data = array();
	
	$preg_str = $str;
	$str = $db->escape($str);
	$null_str = str_replace('*','',$str);
	
	if(strlen($null_str) < 5) return 0; // prevent to short nicknames to search
	
	if(preg_match('/\d*\.\d*/',$preg_str))
		$type = 'ip';
	elseif(preg_match('/\d*\:\d*:\d*/',$preg_str))
		$type = 'authid';
	else
		$type = 'name';
	
	for($i=0;$i<=$len;$i++) {
		if($str[$i] == '*' && $occ < 2 && ($i != $prev_pos+1)) {
			$str[$i] = '%';
			$occ++;
			$prev_pos = $i;
		}
	}
	
	$data['str'] = $str;
	$data['type'] = $type;
	
	return $data;
}

function check_distance($dist,$jt,$w_speed) { // beta testing
	// new minys=floatround((250.0-mSpeed)*0.73,floatround_floor); from jumstats const
	$minus = floor((250-$w_speed)*0.73);
	
	if(($jt == 'lj' || $jt == 'hj') && $dist>(258-$minus))
		return array(258,$dist-260);
	elseif($jt == 'cj' && $dist>(277-$minus))
		return array(277,$dist-277-$minus);
	elseif($jt == 'dcj' && $dist>(274-$minus))
		return array(274,$dist-274-$minus);
	elseif($jt == 'bj' && $dist>(253-$minus))
		return array(253,$dist-253-$minus);
	elseif($jt == 'ladder' && $dist>230)
		return array(230,$dist-230);
	else return false;
}

function error($title, $text, $fl='') {
	global $lang;
	while (@ob_end_clean());
	ob_start();
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<title><?php printf($lang['Error login title'], $title) ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body style="margin: 40px; font: 85%/130% verdana, arial, sans-serif; color: #333;">

<h1><?php echo $lang['Error occurred'] ?></h1>
<?php
	echo '<hr/><p>'.$text.'</p><p>'.$fl.'</p>';
?>
</body>
</html>
	<?php
	exit;
}

function is_admin($l,$p) {
	global $admins;
	$l = trim($l);
	$p = trim($p);
	
	if(empty($l) || empty($p)) return false;
	if($admins[$l] == $p) return true;
	
	return false;
}

function format_title($data) {
	global $lang,$config,$page,$type,$speed;

	if(empty($data))
		return sprintf($lang['title'], $config['jt'][$type], $config['per_page'], $page+1);
	else
	{
		foreach($data as $k=>$v)
		{
			if($k == 'type' && !isset($data['player']) && !isset($data['act']))
				$title = sprintf($lang['title'], $config['jt'][$type], $config['per_page'], $page+1);
			elseif($k == 'player')
				$title = sprintf($lang['title_player'], (isset($data['type']) ? $data['type'] : 'regular'), $speed);
			elseif($k == 'search')
				$title = sprintf($lang['title_search'], htmlspecialchars($data['search']));
			elseif($k == 'act' && $v == 'del_rec')
				$title = sprintf($lang['title_delrec']);
			elseif($k == 'act' && $v == 'del_player')
				$title = sprintf($lang['title_delplayer']);
		}
		
		return $title;
	}
}
?>