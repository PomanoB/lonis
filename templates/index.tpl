<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="UTF-8">
		<link rel="shortcut icon" href="{$baseUrl}/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="{$baseUrl}/templates/css/default.css">
		<link rel="stylesheet" href="{$baseUrl}/templates/css/{$action}.css">
		<link rel="stylesheet" href="{$baseUrl}/templates/css/theme_{$theme}.css">
		<script type="text/javascript" src="{$baseUrl}/templates/js/jquery.min.js"></script>
		<script type="text/javascript" src="{$baseUrl}/templates/js/main.js"></script>
		<script type="text/javascript" src="{$baseUrl}/templates/js/{$action}.js"></script>
		<title>{$langTitle} :: {$langAction}</title>
	</head>
	
	<body>
	{if $action!="setup"}
	<div id="network">
		<div class="center-wrapper">
			<div class="tabbed" id="menu-tabs">
				<div class="menu">
				{foreach from=$menulist key=keyey item=i}
					<text class="item">
						<a title="{$i.name}" href="{$baseUrl}{$i.url}">
							<img src="{$baseUrl}/img/menu/{$i.item}.png"><text class="name">{$i.name}</text>
						</a>
					</text>
				{/foreach}
				{if isset($user)}
					<text class="item">
						<a title="{$i.name}" href="{$baseUrl}/ucp"><text class="username">{$user.name|escape}</text></a>
					</text>				
				{/if}
				</div>
				
				<div class="br"><div class="clearer">&nbsp;</div></div>	
				
		{if $webadmin}
				<div class="adminmenu">
				{foreach from=$menuadminlist key=keyey item=i}
					<text class="item">
						<a title="{$i.name}" href="{$baseUrl}{$i.url}">
							<img src="{$baseUrl}/img/menu/{$i.item}.png"><text class="name">{$i.name}</text>
						</a>
					</text>
				{/foreach}
				</div>
		{/if}
			</div>
		</div>
		<div class="clearer">&nbsp;</div>
	</div>
	{/if}
	
	<div class="head_bg">
		<div style="float:right;"><img src="{$baseUrl}/img/cake/{$cake}.png" alt="" border="0" /></div>
	</div>
	<div class="majic">
		<div id="page" style="border-radius: 20px;">
		
			{* PAGE *}
			{if isset($action)}
				{include file="$action.tpl"}
			{/if}
			{* PAGE OFF *}
		
		</div>
			<div class="wrapper">
				<div class="left_block">
					{foreach from=$menu_footer key=key item=href}
						<a href="{$href}" style="margin-left:50px;" target="_blank">{$key}</a>
					{/foreach}				
				</div>
				<div class="right_block">
				{if $conn}
					{if !$cs}
					<form method="post" id="customForm" style="padding:7px 8px 0 0; margin:0; display:inline;" action="">
						<img src="{$baseUrl}/img/country/{$lang}.png">
						<select id="lang" name="lang" onchange="document.getElementById('customForm').submit();">
						{foreach from=$langselect key=key item=desc}
							<option value="{$key}" {if $lang==$key}selected{/if}>{$desc}</option>
						{/foreach}
						</select>
					</form>
					
					<form method="post" id="themeForm" style="padding:2px 8px 0 0; margin:0; display:inline;" action="">			
						<select style="margin-left:50px;" id="theme" name="theme" onchange="document.getElementById('themeForm').submit();">
						{foreach from=$themeselect key=key item=desc}
							<option value="{$key}" {if $theme==$key}selected{/if}>{$desc}</option>
						{/foreach}
						</select>
					</form>
					{/if}
				{/if}
				</div>
			</div>
			<br><br>
	</body>
</html>