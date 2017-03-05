		
{if $map}
	<div class="wrapper">
		<div class="titles left_block">
			{langs('Map')} :: <i>{$map|escape:html}</i>
			&nbsp;<i class="fa fa-circle" style="color: {$mapinfo.dcolor};" title="{$mapinfo.dname}"></i>		
		</div>
		<div class="right_block" align="center">
			{if file_exists("img/cstrike/{$map}.jpg")}
				<img class="map_image" src="{$baseUrl}/img/cstrike/{$map}.jpg" alt="" title="{$map}" oncontextmenu="return false;">
			{else}
				<i class="fa fa-picture-o" style="font-size: 9em; color: grey;"></i><br>
			{/if}
			<p>
		</div>
	</div><br>
	
	{if isset($maprec)}
	<div class="table-list">
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
		<div class="titles left_block">{langs('Last Records on Kreedz')}</div>
	</div><br><br>
{/if}
	
	{if $message}<div class="err_message">{$message}</div>{/if}

	<div  class="table-list">
		<a href="{$baseUrl}/kreedz/pro/{$map}" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{langs('Pro')}</a>
		<a href="{$baseUrl}/kreedz/noob/{$map}" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{langs('Noob')}</a>
		<a href="{$baseUrl}/kreedz/all/{$map}" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{langs('All')}</a>
	</div><br>

	{$pages.output}
			
	<table class="table-list">
		<tr class="title" >
		{if $map}
			<td width="30" align="center">№</td>
		{else}
			<td>{langs('Map')}</td>
		{/if}
			<td>{langs('Player')}</td>
			<td>{langs('Time')}</td>
			<td>{langs('Checkpoints')}</td>
			<td>{langs('Teleports')}</td>
			<td>{langs('Weapon')}</td>
		{if $admin==1}
				<td>#</td>
		{/if}
		</tr>

	{$num = $pages.start}
	{foreach from=$maps item=row}
		{$num=$num+1}
		<tr class="list">
		{if $map}
			<td align="center">
				{if $num<4}
					<i class="fa fa-trophy" style="color: {$cup_color[$num]};" title="{$num}" alt="{$num}"></i>
				{else}
					{$num}
				{/if}
			</td>	
		{else}
			<td>
				<i class="fa fa-circle diff-dot" style="color: {$row.dcolor};" title="{$row.dname}"></i>
				<a href="{$baseUrl}/kreedz/{$row.map}/">{$row.map}</a>
			</td>
		{/if}
			<td>
				<a href="{$baseUrl}/{url_replace($row.name)}/kreedz">{$row.name|escape}</a>
			</td>
			<td>{timed($row.time, 5)}</td>
			<td class="{if $row.go_cp==0}color_nogc{/if}">{$row.cp}</td>
			<td class="{if $row.go_cp==0}color_nogc{/if}">{$row.go_cp}</td>
			<td class="{if $row.wname != 'USP' && $row.wname != 'KNIFE'}color_wpn{/if}">
				<div class="wpn wpn-{$row.weapon}">&nbsp;</div>
			</td>
		{if $admin==1}
			<form action="" method="post">			
			<td>
				<input type="hidden" name="confirm" value="0">
				<input type="checkbox" name="confirm" value="1">
				<button class="fa fa-trash-o" name="act" value="delete" title="{langs('Delete')}"></button>
				<input name="id" type="hidden" value="{$row.id}" />
			</td>
			</form>
		{/if}
		</tr>
	{foreachelse}
	{/foreach}

	</table>