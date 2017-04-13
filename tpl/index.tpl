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
		<link rel="shortcut icon" href="{$dimg}/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="{$baseUrl}/{$dtpl}/css/font-awesome.css"/>
		<link rel="stylesheet" href="{$baseUrl}/{$dtpl}/css/images.css"/>
		<link rel="stylesheet" href="{$baseUrl}/{$dtpl}/css/flags.css"/>
		<link rel="stylesheet" href="{$baseUrl}/{$dtpl}/css/tooltip.css"/>
		
		<link rel="stylesheet" href="{$baseUrl}/{$dtpl}/css/default.css"/>
		<link rel="stylesheet" href="{$baseUrl}/{$dtpl}/css/theme_{$theme}.css"/>
		<link rel="stylesheet" href="{$baseUrl}/{$dtpl}/css/{$action}.css"/>
		
		<script type="text/javascript" src="{$baseUrl}/{$dtpl}/js/jquery.min.js"></script>
		<script type="text/javascript" src="{$baseUrl}/{$dtpl}/js/default.js"></script>
		<script type="text/javascript" src="{$baseUrl}/{$dtpl}/js/{$action}.js"></script>
		<title>
			{$server_name}
		</title>
	</head>
	
	<body>
	<div id="main" {if !$cs}style="width:1024px;"{/if}>
	{if $action!="setup"}
		<div id="menu">
		{if !$cs}		
			<div class="tabbed wrap" id="menu-tabs">
				<div class="centered">
			{if isset($menu["Main"])}
			{foreach from=$menu["Main"] item=i}
				{if $i.mname=="Admin" && $admin==0} {continue} {/if}
					<div class="item">
						<a title="{$i.name}" href="{$baseUrl}{$i.url}">
							<i class="img-menu menu-{$i.action}"></i><text>{$i.name}</text>
						</a>
					</div>
			{foreachelse}
			{/foreach}
			{/if}
				</div>
			</div>
			<div class="clearer line">&nbsp;</div>
		{/if}
			{if $parent}			
			<div class="tabbed wrap" id="menu-tabs">
				<div class="centered">
				{foreach from=$menu[$parent] item=i}
					<div class="item">
						<a title="{$i.name}" href="{$baseUrl}{$i.url}">
							<i class="img-menu menu-{$i.action}"></i><text>{$i.name}</text>
						</a>
					</div>
				{foreachelse}
				{/foreach}
				</div>
			</div>
			<div class="clearer line">&nbsp;</div>
			{/if}
			
		</div>
	{/if}
		<div class="head_bg">
			<div style="float:right;">
				<i class="cake cake-{$cake}"></i>
			</div>
		</div>
		<div class="majic">
			<div id="page">
		
<!-------------------------------------------------------------------------------------------------------------------->

			{if isset($action) && file_exists("$dtpl/$action.tpl")}
				{include file="$action.tpl"}
			{/if}
			
<!-------------------------------------------------------------------------------------------------------------------->		
			</div>
		</div>
		
		<div class="footer">
			<div class="inline w33">
				{foreach from=$menu_footer key=key item=href}
					<a href="{$href}" style="margin-left:50px;" target="_blank">{$key}</a>
				{foreachelse}
				{/foreach}
			</div>
			
			<div align="center" class="inline w33 genpage">
				{*<sub>({gentime start=$starttime})</sub>*}
				<sub>({$gentime = microtime(true)-$starttime}{$gentime})</sub>
			</div>
		
			<div class="inline w33">
			{if !$errno}
				{if !$cs}
				<form method="post" id="langForm" style="padding:7px 8px 0 0; margin:0; display:inline;" action="">
					<div class="flags flag-{$lang}" title="$lang" alt="">&nbsp;</div>
					<select id="lang" name="lang" onchange="document.getElementById('langForm').submit();">
					{foreach from=$langselect item=l}
						<option value="{$l.lang}" {if $lang==$l.lang}selected{/if}>{$l.name}</option>
					{foreachelse}
					{/foreach}
					</select>
				</form>
				
				{if count($themeselect)>1}
				<form method="post" id="themeForm" style="padding:2px 8px 0 0; margin:0; display:inline;" action="">			
					<select style="margin-left:50px;" id="theme" name="theme" onchange="document.getElementById('themeForm').submit();">
					{foreach from=$themeselect item=t}
						<option value="{$t.theme}" {if $theme==$t.theme}selected{/if}>{$t.name}</option>
					{foreachelse}
					{/foreach}
					</select>
				</form>
				{/if}
				{/if}
			{/if}
			</div>
		</div>
		
		<div style="position: fixed; bottom: 10px; right: 10px;" onclick="window.scrollTo(0,0);return!1;">
			<i class="fa fa-4x fa-arrow-circle-o-up" style="color: rgba( 80, 80, 80, 0.5);"></i>
		</div>
		<br>
	</body>
</html>