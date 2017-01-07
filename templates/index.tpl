{capture generate_page assign=generate_page}<p>{generate_pages page=$pages.page totalPages=$pages.totalPages pageUrl=$pages.pageUrl}</p>{/capture}

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="UTF-8">
		<link rel="shortcut icon" href="{$baseUrl}/img/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="{$baseUrl}/templates/css/default.css">
		<link rel="stylesheet" href="{$baseUrl}/templates/css/theme_{$theme}.css">
		<link rel="stylesheet" href="{$baseUrl}/templates/css/{$action}.css">
		<script type="text/javascript" src="{$baseUrl}/templates/js/jquery.min.js"></script>
		<script type="text/javascript" src="{$baseUrl}/templates/js/main.js"></script>
		<script type="text/javascript" src="{$baseUrl}/templates/js/{$action}.js"></script>
		<title>{$langs.Title}{if isset($langs[$action])} :: {$langs[$action]}{/if}</title>
	</head>
	
	<body>
	{if $action!="setup"}
	<div id="network">
		<div class="center-wrapper">
			<div class="tabbed" id="menu-tabs">
				<div class="menu">
				{foreach from=$menulist key=key item=i}
					<div class="item">
						<a title="{$i.name}" href="{$baseUrl}{$i.url}">
							<img src="{$baseUrl}/img/menu/{$i.item}.png"><text class="name">{$i.name}</text>
						</a>
					</div>
				{/foreach}
				{if isset($user)}
					<div class="item">
						<a title="{$i.name}" href="{$baseUrl}/ucp">
							<img src="{$baseUrl}/img/menu/reg.png"><text class="username">{$user.name|escape}</text>
						</a>
					</div>				
				{/if}
				</div>
				
				<div class="clearer">&nbsp;</div>
				
		{if $webadmin}
				<div class="adminmenu">
				{foreach from=$menuadminlist key=key item=i}
					<div class="item">
						<a title="{$i.name}" href="{$baseUrl}{$i.url}">
							<img src="{$baseUrl}/img/menu/{$i.item}.png"><text class="name">{$i.name}</text>
						</a>
					</div>
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
				<form method="post" id="langForm" style="padding:7px 8px 0 0; margin:0; display:inline;" action="">
					<img src="{$baseUrl}/img/country/{$lang}.png">
					<select id="lang" name="lang" onchange="document.getElementById('langForm').submit();">
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
		<div align="center" style="color: #ffffff">
			<sub>({gentime start=$starttime})</sub>
		</div>
		<br>
	</body>
</html>