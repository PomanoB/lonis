		
{if $map}
	<div class="wrapper">
		<div class="titles left_block">
			{langs('Map')} :: 
			<span class="tooltip down">
				{$map|escape:html}
				<span class="mapinfo">{if isset($mapinfo.type)} {$mapinfo.type} {else} {langs("Unknown type")} {/if}</span>
			</span>
			<span class="tooltip down">
				<i class="fa fa-circle" style="color: {$mapinfo.dcolor};"></i>
			<span class="mapinfo" style="color: {$mapinfo.dcolor};">{$mapinfo.dname}</span></span>
		</div>
		
		<div class="right_block" align="center">
			{if file_exists("$dimg/cstrike/{$map}.jpg")}
				<img class="map_image" src="{$dimg}/cstrike/{$map}.jpg" alt="" title="{$map}" oncontextmenu="return false;">
			{else}
				<i class="fa fa-picture-o" style="font-size: 9em; color: grey;"></i><br>
			{/if}
			<p>
		</div>
	</div><br>
	
	{if isset($maprec)}
	<div style="margin: 0 20px;">
		{foreach from=$maprec item=rec}
			{if $rec.part}<br><b><a href="{$rec.url}" target="_blank">{$rec.fullname}</a></b>:{/if}
			<b>{$rec.mappath}</b> {$rec.time} <i>{$rec.player}</i>&nbsp;
			<span class="flags flag-{strtolower($rec.country)}" title="{$rec.country}" alt="">&nbsp;</span>
		{foreachelse}
		{/foreach}
	</div><br>
	{/if}	
{else}	
	<div class="wrapper">
		<div class="titles left_block">
			{langs('Last Records on Kreedz')}
		</div>
		<div class="right_block">
			{$form_search}
		</div>
	</div><br><br>
{/if}
	
	{if $message}<div class="err_message">{$message}</div>{/if}

	<div style="margin: 0 20px;">
		<a href="{$baseUrl}/kreedz/pro/{$map}" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{langs('Pro')}</a>
		<a href="{$baseUrl}/kreedz/noob/{$map}" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{langs('Noob')}</a>
		<a href="{$baseUrl}/kreedz/all/{$map}" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{langs('All')}</a>
	</div>

	<div align="center">
		{$pages.output}
	</div>
			
	<div class="table list">
		<div class="tr title" >
		{if $map}
			<div width="30" align="center">№</div>
		{else}
			<div>{langs('Map')}</div>
		{/if}
			<div>{langs('Player')}</div>
			<div>{langs('Time')}</div>
			<div>{langs('Checkpoints')}</div>
			<div>{langs('Teleports')}</div>
			<div>{langs('Weapon')}</div>
		{if $admin==1}
				<div>#</div>
		{/if}
		</div>

	{$num = $pages.start}
	{foreach from=$maps item=row}
		{$num=$num+1}
		<div class="tr row">
		{if $map}
			<div align="center">
				{if $num<4}
					<i class="fa fa-trophy" style="color: {$cup_color[$num]};" title="{$num}" alt="{$num}"></i>
				{else}
					{$num}
				{/if}
			</div>	
		{else}
			<div>
				<i class="fa fa-circle diff-dot" style="color: {$row.dcolor};" title="{$row.dname}"></i>
				<a href="{$baseUrl}/kreedz/{$row.map}/">{$row.map}</a>
			</div>
		{/if}
			<div>
				<a href="{$baseUrl}/{url_replace($row.name)}/kreedz">{$row.name|escape}</a>
			</div>
			<div>{timed($row.time, 5)}</div>
			<div class="{if $row.go_cp==0}color_nogc{/if}">{$row.cp}</div>
			<div class="{if $row.go_cp==0}color_nogc{/if}">{$row.go_cp}</div>
			<div class="{if $row.wname != 'USP' && $row.wname != 'KNIFE'}color_wpn{/if}">
				<div class="wpn wpn-{$row.weapon}">&nbsp;</div>
			</div>
		{if $admin==1}
			<form action="" method="post">			
			<div>
				<input type="hidden" name="confirm" value="0">
				<input type="checkbox" name="confirm" value="1">
				<button class="fa fa-trash-o" name="act" value="delete" title="{langs('Delete')}"></button>
				<input name="id" type="hidden" value="{$row.id}" />
			</div>
			</form>
		{/if}
		</div>
	{foreachelse}
	{/foreach}

	</div>