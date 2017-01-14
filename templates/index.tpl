{capture generate_page assign=generate_page}
	<p>&nbsp;{generate_pages page=$pages.page totalPages=$pages.totalPages pageUrl=$pages.pageUrl}</p>
{/capture}

{capture generate_page assign=generate_page}
	{if isset($pages)}
		{$page = $pages.page}
		{$totalPages = $pages.totalPages}
		{$pageUrl = $pages.pageUrl}
	{/if}
	
	{if $totalPages > 1}
		{if $page > 2}
			{$aHref = str_replace("%page%", "1", $pageUrl)}
			<a href="{$aHref}">1 </a>
		{/if}
		{if $page > 1}
			{$aHref = str_replace("%page%", $page-1, $pageUrl)}
			<a href="{$aHref}">{$page-1} </a>
		{/if}
		
		<b>{$page}</b>
		
		{if $page < $totalPages}
			{$aHref = str_replace("%page%", $page+1, $pageUrl)}
			<a href="{$aHref}">{$page+1} </a>
		{/if}

		{if $page < $totalPages-1}
			{$aHref = str_replace("%page%", $totalPages, $pageUrl)}
			<a href="{$aHref}"> {$totalPages}</a>
		{/if}
	{/if}
{/capture}

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
	<div id="top_nav0">
		<div id="network">
			<div class="center-wrapper">
				<div class="tabbed" id="menu-tabs">
					<div class="menu" >
				{foreach from=$menu item=i}
						<div class="item">
							<a title="{$i.name}" href="{$baseUrl}{$i.url}">
								<img src="{$baseUrl}/img/menu/{$i.action}.png" alt="{$i.name}" title="{$i.name}">&nbsp;{$i.name}
							</a>
						</div>
				{/foreach}


				{if !isset($user)}
						<div class="item">
							<a title="{$langs.auth}" href="{$baseUrl}/auth/">
								<img src="{$baseUrl}/img/menu/auth.png" alt="{$i.name}" title="{$langs.auth}">&nbsp;{$langs.auth}
							</a>
						</div>
				{else}
						<div class="item">
							<a title="{{$user.name|escape}}" href="{$baseUrl}/ucp/">
								<img src="{$baseUrl}/img/menu/reg.png" alt="{{$user.name|escape}}" title="{{$user.name|escape}}">
							</a>
						</div>	
						<div class="item">
							<a title="{$langs.logout}" href="{$baseUrl}/logout/">
								<img src="{$baseUrl}/img/menu/logout.png" alt="{$i.name}" title="{$langs.logout}">&nbsp;{$langs.logout}
							</a>
						</div>			
				{/if}

					</div>
					
					<div class="clearer">&nbsp;</div>
					
			{if $webadmin}
					<div class="adminmenu">
					{foreach from=$menuAdmin item=i}
						<div class="item">
							<a title="{$i.name}" href="{$baseUrl}{$i.url}">
								<img src="{$baseUrl}/img/menu/{$i.action}.png">{$i.name}
							</a>
						</div>
					{/foreach}
					</div>
			{/if}
				</div>
			</div>
			<div class="clearer">&nbsp;</div>
		</div>
	</div>
	{/if}
	
	<div class="head_bg">
		<div style="float:right;"> {* padding-right: 25px; *}
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
		</div><br>
		
		<div align="center" style="color: #ffffff">
			{*<sub>({gentime start=$starttime})</sub>*}
			<sub>({$gentime = microtime(true)-$starttime}{$gentime})</sub>
		</div>
		<br>
	</body>
</html>