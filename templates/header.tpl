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
							{foreach from=$langselect item=value}
								<option value="{$value.name}" {if $lang==$value.name}selected{/if}>{$value.desc}</option>
							{/foreach}
							</select>
						</form>
					</li>
					{if !isset($cs)}
					<li><a title="{#langStart#}" href="{$baseUrl}">{#imgStart#}<text>{#langStart#}</text></a></li>
					<li><a title="{#langPlayers#}"href="{$baseUrl}/players">{#imgPlayers#}<text>{#langPlayers#}</text></a></li>
					<li><a title="{#langAchievPlayers#}" href="{$baseUrl}/achiev/players">{#imgAchievPlayers#}<text>{#langAchievPlayers#}</text></a></li>
					<li><a title="{#langAchiev#}" href="{$baseUrl}/achiev">{#imgAchiev#}<text>{#langAchiev#}</text></a></li>
					{/if}
					<li><a title="{#langKzPlayers#}" href="{$baseUrl}/kreedz/players">{#imgKzPlayers#}<text>{#langKzPlayers#}</text></a></li>
					<li><a title="{#langKzMaps#}" href="{$baseUrl}/kreedz">{#imgKzMaps#}<text>{#langKzMaps#}</text></a></li>
					<li><a title="{#langKzDuel#}" href="{$baseUrl}/kz_duels">{#imgKzDuel#}<text>{#langKzDuel#}</text></a></li>
					{if !isset($cs)}
						{if !isset($user)}
							{*<li><a title="{#langRegister#}" href="{$baseUrl}/reg">{#imgRegister#}<text>{#langRegister#}</text></a></li>
							<li><a title="{#langLogin#}" href="{$baseUrl}/login">{#imgLogin#}<text>{#langLogin#}</text></a></li>*}
							<li><a title="{#langLogin#}" href="{$baseUrl}/login">{#imgLogin#}<text>{#langLoginReg#}</text></a></li>
						{else}
							<li><a title="{#langUcp#}" href="{$baseUrl}/ucp">{#imgUcp#}<text>{#langUcp#}</text></a></li>
							<li><a title="{#langLogOut#}" href="{$baseUrl}/logout">{#imgLogOut#}<text>{#langLogOut#}</text></a></li>
							<li><span>{$user.name|escape}</span></li>
						{/if}
					{/if}
				</ul>
			</div>
			<div class="clearer">&nbsp;</div>
		</div>
	</div>
<!--	{if $user.webadmin == 1}
		<div id="adminmenu">
			Админцентр:
			<a href="achiev_admin">{#langAchievAdmin#}</a>
		</div>
	{/if} -->
	<div class="head_bg">
		<div style="float:right;"><img src="{$baseUrl}/img/cake/{php}echo ''.mt_rand(1, 5).'.';{/php}png" alt="" border="0" /></div>
	</div>
	<div class="majic">
		<div id="page" style="border-radius: 20px;">