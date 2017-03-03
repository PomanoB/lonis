{capture name=search assign=form_search}
	<div id="search">
		<form action="" method="get">
			<input type="text" name="search" id="search" value="{if isset($search)}{$search}{/if}" placeholder="{langs('Search')}"/><button>
		</form>
	</div>
{/capture}

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="UTF-8">
		<link rel="shortcut icon" href="{$baseUrl}/img/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="{$baseUrl}/templates/css/font-awesome.css"/>
		<link rel="stylesheet" href="{$baseUrl}/templates/css/iconic-font.css"/>
		<link rel="stylesheet" href="{$baseUrl}/templates/css/default.css">
		<link rel="stylesheet" href="{$baseUrl}/templates/css/theme_{$theme}.css">
		<link rel="stylesheet" href="{$baseUrl}/templates/css/{$action}.css">

		<script type="text/javascript" src="{$baseUrl}/templates/js/jquery.min.js"></script>
		<script type="text/javascript" src="{$baseUrl}/templates/js/default.js"></script>
		<script type="text/javascript" src="{$baseUrl}/templates/js/{$action}.js"></script>
		<title>
			Lonis {if isset($langs[$parent])} :: {langs($parent)} {/if}
			{if isset($langs[$action])} :: {langs($action)}{/if}
		</title>
	</head>
	
	<body>
	<div id="main">
	{if $action!="setup"}
		<div id="network">
			<div class="tabbed wrap" id="menu-tabs">
				
		{if !$cs}
				<div class="centered">
			{foreach from=$menu["Main"] item=i}
				{if $i.mname=="Admin" && $admin==0} {continue} {/if}
					<div class="item">
						<a title="{$i.name}" href="{$baseUrl}{$i.url}">
							<img src="{$baseUrl}/img/menu/{$i.action}.png" alt="{$i.name}" /><text>&nbsp;{$i.name}</text>
						</a>
					</div>
			{/foreach}
				</div>
		{/if}
		
			</div>
			
			<div class="clearer line">&nbsp;</div>
			
			<div class="tabbed wrap" id="menu-tabs">
			{if $parent}
				<div class="centered">
				{foreach from=$menu[$parent] item=i}
					<div class="item">
						<a title="{$i.name}" href="{$baseUrl}{$i.url}">
							<img src="{$baseUrl}/img/menu/{$i.action}.png"><text>&nbsp;{$i.name}</text>
						</a>
					</div>
				{/foreach}
				</div>
			{/if}
			
			</div>
			
			<div class="clearer line">&nbsp;</div>
			
		</div>
	{/if}
	
		<div class="head_bg">
			<div style="float:right;">
				<img src="{$baseUrl}/img/cake/cake{$cake}.png" alt="" border="0" />
			</div>
		</div>
		<div class="majic">
			<div id="page" style="border-radius: 20px; padding: 15px;">
		
<!-------------------------------------------------------------------------------------------------------------------->

			{if isset($action) && file_exists("templates/$action.tpl")}
				{include file="$action.tpl"}
			{/if}
			
<!-------------------------------------------------------------------------------------------------------------------->		
			</div>
		
			<div class="wrapper">
				<div class="left_block">
					{foreach from=$menu_footer key=key item=href}
						<a href="{$href}" style="margin-left:50px;" target="_blank">{$key}</a>
					{/foreach}
				</div>
				<div class="right_block">
				{if !$errno}
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
			</div><br>
			
			<div align="center" class="genpage">
				{*<sub>({gentime start=$starttime})</sub>*}
				<sub>({$gentime = microtime(true)-$starttime}{$gentime})</sub>
			</div>
		</div>
		<br>
	</body>
</html>