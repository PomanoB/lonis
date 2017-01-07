			<p><div class="titles">{$langs.player} <i>{$name|escape}</i></div><br>
	
{if !$plr} 

{else}
	{if $rec != "norec"}
				<a href="{$baseUrl}/{$name_url}/kreedz/pro/{$rec}/{$sort}" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{$langs.kzpro}</a>
				<a href="{$baseUrl}/{$name_url}/kreedz/noob/{$rec}/{$sort}" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{$langs.kznoob}</a>
				<a href="{$baseUrl}/{$name_url}/kreedz/all/{$rec}/{$sort}" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{$langs.kzall}</a>
				:: <a href="{$baseUrl}/{$name_url}/kreedz/{$type}/norec">{$langs.kznorec}</a>
				
				<p><a href="{$baseUrl}/{$name_url}/kreedz/all/{$rec}/num" {if $sort == "num"}style="font-weight:bold;"{else}{/if}>{$langs.kznum}:</a> {$map_num} 
				:: 
				<a href="{$baseUrl}/{$name_url}/kreedz/all/{$rec}/top1" {if $sort == "top1"}style="font-weight:bold;"{else}{/if}>{$langs.kztop1}:</a> {$map_top1}
			
				{$generate_page}
				
				<table class="table-list">
					<tr class="title">
						<td>{$langs.Map}</td>
						<td>{$langs.Time}</td>
						<td>{$langs.Cp}</td>
						<td>{$langs.GoCp}</td>
						<td>{$langs.Weapon}</td>
					</tr>
		{foreach from=$maps key=key item=map}
					<tr class="list">
						<td>
							<a href="{$baseUrl}/kreedz/{$map.map}">{$map.map}</a>
						</td>
						<td>{$map.time}</td>
						<td class="{if $map.go_cp==0}color_nogc{/if}">{$map.cp}</td>
						<td class="{if $map.go_cp==0}color_nogc{/if}">{$map.go_cp}</td>
						<td class="{if $map.wname != 'USP' && $map.wname != 'KNIFE'}color_wpn{/if}">{$map.wname}</td>
					</tr>
		{/foreach}
				</table>
	{else}
				<a href="{$baseUrl}/{$name_url}/kreedz/{$type}">{$langs.kzrec}</a>
				
				{$generate_page}
				
				<div class="inline">
		{foreach from=$maps key=key item=map}
					<a href="{$baseUrl}/kreedz/{$map.map}">{$map.map}</a><br>
		{/foreach}
				</div>
	{/if}
{/if}