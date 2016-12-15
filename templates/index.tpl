<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="{$baseUrl}/templates/css/default.css">
		<link rel="stylesheet" href="{$baseUrl}/templates/css/{$action}.css">
		<link rel="stylesheet" href="{$baseUrl}/templates/css/theme_{$theme}.css">
		<script type="text/javascript" src="{$baseUrl}/templates/js/jquery.min.js"></script>
		<script type="text/javascript" src="{$baseUrl}/templates/js/main.js"></script>
		<script type="text/javascript" src="{$baseUrl}/templates/js/{$action}.js"></script>
		<title>{#langTitle#} :: {$langAction}</title>
	</head>
	
	<body>
	<div id="network">
		<div class="center-wrapper">
			<div class="left">
				<ul class="tabbed" id="menu-tabs">
					<li>
						<form method="post" id="customForm" style="padding:7px 8px 0 0;margin:0;" action="">
							<img src="{$baseUrl}/img/country/{$lang}.png">
							<select id="lang" name="lang" onchange="document.getElementById('customForm').submit();">
							{foreach from=$langselect key=name item=desc}
								<option value="{$name}" {if $lang==$name}selected{/if}>{$desc}</option>
							{/foreach}
							</select>
						</form>
					</li>
					
				{foreach from=$menulist key=key item=i}
					<li><a title="{$i.name}" href="{$baseUrl}{$i.url}"><img src="img/menu/{$key}.png"><text>{$i.name}</text></a></li>
				{/foreach}
				{if isset($user)}
					<li><span>{$user.name|escape}</span></li>
				{/if}
				</ul>
			</div>
			<div class="clearer">&nbsp;</div>
		</div>
	</div>
<!--	{if $user.webadmin == 1}
		<div id="adminmenu">
			Админцентр:
			<a href="achiev_admin">{#lang_achiev_admin#}</a>
		</div>
	{/if} -->
	<div class="head_bg">
		<div style="float:right;"><img src="{$baseUrl}/img/cake/{php}echo ''.mt_rand(1, 5).'.';{/php}png" alt="" border="0" /></div>
	</div>
	<div class="majic">
		<div id="page" style="border-radius: 20px;">
		
			{* PAGE *}
			{if $action!="index"}
				{include file="$action.tpl"}
			{else}
				{include file="home.tpl"}
			{/if}
			{* PAGE OFF *}
		
		</div>
		<form method="post" id="themeForm" style="padding:2px 8px 0 0;margin:0;" action="">				
			<div align="right" style="margin-right: 60px;">

			{if !isset($cs)}
				<a href="#" style="margin-left:50px;" target="_blank">Gm# Staff</a>
				<a href="http://klan-hub.ru/index.php?page=feedback" style="margin-left:50px;" target="_blank">PomanoB</a>
				<a href="http://leopold-soft.narod.ru" style="margin-left:50px;" target="_blank">Jeronimo.</a>
				
				<select style="margin-left:50px;" id="theme" name="theme" onchange="document.getElementById('themeForm').submit();">
				{foreach from=$themeselect key=name item=desc}
					<option value="{$name}" {if $theme==$name}selected{/if}>{$desc}</option>
				{/foreach}
				</select>
			{else}
				<a href="#" style="margin-left:50px;" target="_blank">Gm# Staff</a>
				<a href="#" style="margin-left:50px;" target="_blank">PomanoB</a>
				<a href="#" style="margin-left:50px;" target="_blank">Jeronimo.</a>	
			{/if}	
			</div>
			<br>
		</form>
	</body>
</html>