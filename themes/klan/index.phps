<!DOCTYPE html>
<html class="no-js" lang="<?=$lang.'_'.strtoupper($lang)?>" prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="description" content="K-Lan Counter-Strike статистика"/>
		<link rel="canonical" href="<?=$_SERVER['PHP_SELF']?>" />
		<meta property="og:locale" content="<?=$lang.'_'.strtoupper($lang)?>" />
		<meta property="og:type" content="statistics" />
		<meta property="og:title" content="<?=$menu['Main'][$action]?>" />
		<meta property="og:description" content="K-Lan Counter-Strike статистика" />
		<meta property="og:url" content="<?=$_SERVER['PHP_SELF']?>" />
		<meta property="og:site_name" content="<?=$server_name?>" />
		<meta property="article:section" content="<?=$menu['Main'][$action]?>" />
		<meta property="article:published_time" content="" />
		<meta property="article:modified_time" content="" />
		<meta property="og:updated_time" content="" />
		<meta name="twitter:card" content="summary" />
		<meta name="twitter:description" content="K-Lan Counter-Strike статистика" />
		<meta name="twitter:title" content="<?=$menu['Main'][$action]?>" />

		<meta charset="UTF-8">
		<link rel="shortcut icon" href="<?=$bTheme?>/img/favicon.ico" type="image/x-icon">
		<!--<link rel="stylesheet" href="<?=$bTheme?>/css/font-awesome.css"/>-->
		<link rel="stylesheet" href="<?=$bTheme?>/css/icoMoon.css"/>
		<link rel="stylesheet" href="<?=$bTheme?>/css/images.css"/>
		<link rel="stylesheet" href="<?=$bTheme?>/css/flags.css"/>
		<link rel="stylesheet" href="<?=$bTheme?>/css/tooltip.css"/>
		<link rel="stylesheet" href="<?=$bTheme?>/css/modal.css"/>
		
		<link rel="stylesheet" href="<?=$bTheme?>/css/default.css"/>
		<link rel="stylesheet" href="<?=$bTheme?>/css/style_<?=$style?>.css"/>
		
		<title><?=$server_name?></title>
		
		
	</head>
	
	<body>
	
	<? if(!$user) include("auth.phps"); ?>
	
	<div id="main">
	<? if($action!="setup"): ?>
		<nav id="menu">
		<? if(!$cs): ?>		
			<div class="tabbed wrap" id="menu-tabs">
				<div class="centered">
				
				<!-- Main menu-->
				<? if(isset($menu['Main'])): ?>
				<? foreach($menu['Main'] as $i): ?>
					<? if($i['mname']=="Admin" && $admin==0): continue; endif; ?>
					<div class="item">
						<a title="<?=$i['name']?>" href="<?=$bUrl?><?=$i['url']?>">
							<i class="icon-menu icon-<?=$i['action']?>"></i><text><?=$i['name']?></text>
						</a>
					</div>
				<? endforeach; ?>
				<? endif; ?>
				
				<!-- Auth or Account-->
				<? if(!$user): ?>
					<div class="item">
						<a title="<?=langs('Login')?>" href="<?=$bUrl?>/#auth">
							<i class="icon-menu icon-account"></i><text><?=langs('Login')?></text>
						</a>
					</div>
				<? else: ?>
					<div class="item">
						<a title="<?=langs('Account')?>" href="<?=$bUrl?>/account/">
							<i class="icon-menu icon-account"></i><text><i><?=$username?></i></text>
						</a>
					</div>
				<? endif; ?>
				
				</div>
			</div>
			<div class="clearer line">&nbsp;</div>
		<? endif; ?>

			<? if($parent): ?>			
			<div class="tabbed wrap" id="menu-tabs">
				<div class="centered">
				<? foreach($menu[$parent] as $i): ?>
					<div class="item">
						<a title="<?=$i['name']?>" href="<?=$bUrl?><?=$i['url']?>">
							<i class="icon-menu icon-<?=$i['action']?>"></i><text><?=$i['name']?></text>
						</a>
					</div>
				
				<? endforeach; ?>
				</div>
			</div>
			<div class="clearer line">&nbsp;</div>
			<? endif; ?>
			
		</nav>
	<? endif; ?>
		<div class="head_bg">
			<div style="float:right;">
				<i class="cake" style="background-image:url('<?=$bTheme?>/img/cake/cake-<?=$cake?>.png');"></i>
			</div>
		</div>
		<div class="majic">
			<div id="page">
				
<!-------------------------------------------------------------------------------------------------------------------->
	<? include("{$action}.phps"); ?>
<!-------------------------------------------------------------------------------------------------------------------->		
			</div>
		</div>
		
		<div class="wrapper">
			<div class="left_block" style="margin-left: 50px;">
				<? foreach($social as $key=>$value): ?>
					<a href="<?=$value?>" target="_blank" style="padding: 0 5px;">
					<i class="icon icon-<?=$key?>" style="font-size: 1.5em;"></i></a>
				<? endforeach; ?>
				
				<? foreach($menu_footer as $key=>$value): ?>
					<a style="margin-left:10px;"><i class="icon icon-<?=$key?>" style="font-size: 1.5em;"></i>
					<?=$value?></a>
				<? endforeach; ?>
			</div>
		
			<div class="right_block">
			<? if(!$errno && !$cs): ?>
				<div class="flags-med flag-<?=$lang?>" title="$lang" alt="" style="vertical-align: top; margin-top: 5px;">&nbsp;</div>
				<form class="select" method="post" id="langForm">
					<select id="lang" name="lang" onchange="document.getElementById('langForm').submit();">
					<? foreach($langselect as $l): ?>
						<option value="<?=$l['lang']?>" <? if($lang==$l['lang']): ?>selected<? endif; ?>><?=$l['name']?></option>
					
					<? endforeach; ?>
					</select>
				</form>
				
				<? if(count($styleselect)>1): ?>
				<form class="select" method="post" id="styleForm">			
					<select id="style" name="style" onchange="document.getElementById('styleForm').submit();">
						<option value="" hidden disabled selected><?=langs('Style')?>:</option>
					<? foreach($styleselect as $t): ?>
						<option value="<?=$t['style']?>"><?=$t['name']?></option>
					
					<? endforeach; ?>
					</select>
				</form>
				<? endif; ?>
			<? endif; ?>
			</div>
		</div><br><br>
		
		<div align="center" class="genpage">(<?=(microtime(true)-$starttime)?>)</div>
			
		<div style="position: fixed; bottom: 10px; right: 10px;" onclick="window.scrollTo(0,0);return!1;">
			<i class="icon icon-circle-up" style="font-size: 4em; color: rgba( 80, 80, 80, 0.5);"></i>
		</div>
		<br>
	</body>
	
	<? include("ya-metrika.html"); ?>
</html>