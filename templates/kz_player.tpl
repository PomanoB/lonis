	<p><div class="titles">{$langs.player} {if isset($player.name)} :: <i>{$player.name|escape}</i>{/if}
		<a href="{$baseUrl}/{$player.name}"><img src="{$baseUrl}/img/menu/players.png"></a>
	</div><br>

{if $player.id}
	{if $rec != "norec"}
		<a href="{$baseUrl}/{$player.name_url}/kreedz/pro/{$rec}/{$sort}" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{$langs.kzpro}</a>
		<a href="{$baseUrl}/{$player.name_url}/kreedz/noob/{$rec}/{$sort}" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{$langs.kznoob}</a>
		<a href="{$baseUrl}/{$player.name_url}/kreedz/all/{$rec}/{$sort}" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{$langs.kzall}</a>
		:: <a href="{$baseUrl}/{$player.name_url}/kreedz/{$type}/norec">{$langs.kznorec}</a>
		
		<p><a href="{$baseUrl}/{$player.name_url}/kreedz/all/{$rec}/num" {if $sort == "num"}style="font-weight:bold;"{else}{/if}>{$langs.kznum}:</a> {$map_num} 
		:: 
		<a href="{$baseUrl}/{$player.name_url}/kreedz/all/{$rec}/top1" {if $sort == "top1"}style="font-weight:bold;"{else}{/if}>{$langs.kztop1}:</a> {$map_top1}
	{else}
		<b>{$langs.kznorec}</b> :: <a href="{$baseUrl}/{$player.name_url}/kreedz/{$type}">{$langs.kzrec}</a>
		
		<p>{$langs.kznum}: {$map_norec}
	{/if}	
	
		<p>&nbsp;{$generate_page}
		
		<table class="table-list">
			<tr class="title">
				<td>{$langs.Map}</td>
				{if $rec=="norec"}<td>{$langs.player}</td>{/if}
				<td>{$langs.Time}</td>
				<td>{$langs.Cp}</td>
				<td>{$langs.GoCp}</td>
				<td>{$langs.Weapon}</td>
			</tr>
	{if $total}
	{foreach from=$maps key=key item=map}
			<tr class="list">
				<td><a href="{$baseUrl}/kreedz/{$map.map}">{$map.map}</a></td>
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