		
{if $map}
	<div class="wrapper">
		<div class="titles left_block">
			{langs('Map')} :: <i>{$map|escape:html}</i>
			&nbsp;<i class="fa fa-circle" style="color: {$mapinfo.dcolor};" title="{$mapinfo.dname}"></i>		
		</div>
		<div class="right_block" align="center">
			{if isset($imgmap)}
				<img class="map_image" src="{$imgmap}" oncontextmenu="return false;" /><br>
			{/if}
			<p>
		</div>
	</div><br><br>
	
	{if isset($maprec)}

	<div class="table-list">
		{foreach from=$maprec item=rec}
			{if $rec.part}<p><b><a href="{$rec.url}" target="_blank">{$rec.fullname}</a></b>:{/if}
			<b>{$rec.mappath}</b> {$rec.time} <i>{$rec.player}</i> <img src="{$baseUrl}/img/country/{$rec.country}.png">;
		{foreachelse}
		{/foreach}
	</div>
	{/if}
{else}	
	<div class="wrapper">
		<div class="titles left_block">{langs('Last Records on Kreedz')}</div>
	</div><br><br>
{/if}
	
	{if $message}<div class="err_message">{$message}</div>{/if}

	{if $total}	
	<div  class="table-list">
		<a href="{$baseUrl}/kreedz/{$map}/pro/" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{langs('Pro')}</a>
		<a href="{$baseUrl}/kreedz/{$map}/noob/" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{langs('Noob')}</a>
		<a href="{$baseUrl}/kreedz/{$map}/all/" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{langs('All')}</a>
	</div>
	{/if}

	{$pages.output}</p>
			
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
{if $total}
{foreach from=$players item=player}
		<tr class="list">
		{if $map}
			<td align="center">
				{if $player.number<4}
					<img src="{$baseUrl}/img/top{$player.number}.png" width="22" height="16" title="{$player.number}" alt="{$player.number}" />
				{else}
					{$player.number}
				{/if}
			</td>	
		{else}
			<td>
				<i class="fa fa-circle diff-dot" style="color: {$player.dcolor};" title="{$player.dname}"></i>
				<a href="{$baseUrl}/kreedz/{$player.map}/">{$player.map}</a>
			</td>
		{/if}
			<td>
				<a href="{$baseUrl}/{$player.name_url}/kreedz">{$player.name|escape}</a>
			</td>
			<td>{$player.time}</td>
			<td class="{if $player.go_cp==0}color_nogc{/if}">{$player.cp}</td>
			<td class="{if $player.go_cp==0}color_nogc{/if}">{$player.go_cp}</td>
			<td class="{if $player.wname != 'USP' && $player.wname != 'KNIFE'}color_wpn{/if}">
				<img src="{$baseUrl}/img/weapons/{$player.weapon}.gif" alt="{$player.wname}" />
			</td>
{if $admin==1}
			<form action="" method="post">			
			<td>
				<input type="hidden" name="confirm" value="0">
				<input type="checkbox" name="confirm" value="1">
				<button class="fa fa-trash-o" name="act" value="delete" title="{langs('Delete')}"></button>
				<input name="id" type="hidden" value="{$player.id}" />
			</td>
			</form>
{/if}
		</tr>
{foreachelse}
{/foreach}
{/if}
	</table>