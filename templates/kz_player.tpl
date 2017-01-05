			<p><div class="titles">{$lang_player} <i>{$name|escape}</i></div><br>
	
{if !$plr} 

{else}
	{if $rec != "norec"}
				<a href="{$baseUrl}/{$name_url}/kreedz/pro/{$rec}/{$sort}" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{$langKzPro}</a>
				<a href="{$baseUrl}/{$name_url}/kreedz/noob/{$rec}/{$sort}" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{$langKzNoob}</a>
				<a href="{$baseUrl}/{$name_url}/kreedz/all/{$rec}/{$sort}" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{$langKzAll}</a>
				:: <a href="{$baseUrl}/{$name_url}/kreedz/{$type}/norec">{$langKzNoRec}</a>
				
				<p><a href="{$baseUrl}/{$name_url}/kreedz/all/{$rec}/num" {if $sort == "num"}style="font-weight:bold;"{else}{/if}>{$langKzNum}:</a> {$map_num} 
				:: 
				<a href="{$baseUrl}/{$name_url}/kreedz/all/{$rec}/top1" {if $sort == "top1"}style="font-weight:bold;"{else}{/if}>{$langKzTop1}:</a> {$map_top1}
			
				<p>{generate_pages page=$page totalPages=$totalPages pageUrl=$pageUrl}</p>
				
				<table class="table-list">
					<tr class="title">
						<td>{$langMap}</td>
						<td>{$langTime}</td>
						<td>{$langCp}</td>
						<td>{$langGoCp}</td>
						<td>{$langWeapon}</td>
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
				<a href="{$baseUrl}/{$name_url}/kreedz/{$type}">{$langKzRec}</a>
				
				<p>{generate_pages page=$page totalPages=$totalPages pageUrl=$pageUrl}</p>
				
				<div class="inline">
		{foreach from=$maps key=key item=map}
					<a href="{$baseUrl}/kreedz/{$map.map}">{$map.map}</a><br>
		{/foreach}
				</div>
	{/if}
{/if}