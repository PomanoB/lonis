	<div class="wrapper">
		<div class="titles left_block">
			{langs('Player')} {if isset($name)} :: <i>{$name}</i>{/if}</i>
			{if !$cs}<a href="{$baseUrl}/{$name_url}"><img src="{$baseUrl}/img/menu/players.png"></a>{/if}
		</div>
		<div class="right_block" align="center">
			{if isset($avatar)}
				<a href="#" target="_blank">
					<img src="{$avatar.img}" width="{$avatar.size}" height="{$avatar.size}" oncontextmenu="return false;" /><br>
				</a>
			{/if}
			<p>
		</div>
	</div><br><br>

{if $name}
	{if $rec != "norec"}
	<div class="table-list">
		<a href="{$baseUrl}/{$name_url}/kreedz/pro/{$rec}/{$sort}" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{langs('Pro')}</a>
		<a href="{$baseUrl}/{$name_url}/kreedz/noob/{$rec}/{$sort}" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{langs('Noob')}</a>
		<a href="{$baseUrl}/{$name_url}/kreedz/all/{$rec}/{$sort}" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{langs('All')}</a>
		:: <a href="{$baseUrl}/{$name_url}/kreedz/{$type}/norec">{langs('Not jumped')}</a>
		
		<br><a href="{$baseUrl}/{$name_url}/kreedz/all/{$rec}/num" {if $sort == "num"}style="font-weight:bold;"{else}{/if}>{langs('Total')}:</a> {$map_num} 
		:: 
		<a href="{$baseUrl}/{$name_url}/kreedz/all/{$rec}/top1" {if $sort == "top1"}style="font-weight:bold;"{else}{/if}>{langs('First')}:</a> {$map_top1}
	</div><br>
	{else}
	<div class="table-list">
		<b>{langs('Passed')}</b> :: <a href="{$baseUrl}/{$name_url}/kreedz/{$type}">{langs('Passed')}</a>
		
		<br><b>{langs('Total')}</b>: {$map_norec}
	</div><br>
	{/if}	
	
		{$pages.output}
		
		<br>
		<table class="table-list">
			<tr class="title">
				<td>{langs('Map')}</td>
				{if $rec=="norec"}<td>{langs('Player')}</td>{/if}
				<td>{langs('Time')}</td>
				<td>{langs('Checkpoints')}</td>
				<td>{langs('Teleports')}</td>
				<td>{langs('Weapon')}</td>
			</tr>
	{if $total}
	{foreach from=$maps key=key item=map}
			<tr class="list">
				<td>
					<a href="{$baseUrl}/kreedz/{$map.map}/">{$map.map}</a>
					{for $i=0 to $map.ddot-1}
						<i class="fa fa-circle diff-dot" style="color: {$map.dcolor};"></i>
					{/for}
				</td>
				{if $rec=="norec"}<td><a href="{$baseUrl}/{$map.name_url}/kreedz">{$map.name|escape}</a></td>{/if}
				<td>{$map.time}</td>
				<td class="{if $map.go_cp==0}color_nogc{/if}">{$map.cp}</td>
				<td class="{if $map.go_cp==0}color_nogc{/if}">{$map.go_cp}</td>
				<td class="{if $map.wname != 'USP' && $map.wname != 'KNIFE'}color_wpn{/if}">
					<img src="{$baseUrl}/img/weapons/{$map.weapon}.gif" alt="{$map.wname}" />
				</td>
			</tr>
	{/foreach}
	{/if}
		</table>
{else}
	
{/if}