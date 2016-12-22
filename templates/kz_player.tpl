			<p><div class="titles">{$lang_player} {$name|escape}</div><br>
			
	{if $rec != "norec"}
				<a href="{$baseUrl}/{$name|replace:' ':'_'}/kreedz/pro/{$rec}" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{$langKzPro}</a>
				<a href="{$baseUrl}/{$name|replace:' ':'_'}/kreedz/noob/{$rec}" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{$langKzNoob}</a>
				<a href="{$baseUrl}/{$name|replace:' ':'_'}/kreedz/all/{$rec}" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{$langKzAll}</a>
				:: <a href="{$baseUrl}/{$name|replace:' ':'_'}/kreedz/{$type}/norec">{$langKzNoRec}</a>
				
				<p><b>{$langTotal}:</b> {$map_num}
				<br><b>{$langKzTop1}:</b> {$map_top1}
			
				{generate_pages page=$page totalPages=$totalPages pageUrl=$pageUrl}
				
				<table class="table-list">
					<tr class="title">
						<td>{$langMap}</td>
						<td>{$langWorldRecord}</td>
						<td>{$langTime}</td>
						<td>{$langCp}</td>
						<td>{$langGoCp}</td>
						<td>{$langWeapon}</td>
					</tr>
		{foreach from=$maps item=map}
					<tr class="list">
						<td>
							<a href="{$baseUrl}/kreedz/{$map.map}">{$map.map}</a>
						</td>
						<td class="th_numeric">{$map.timerec} {$map.plrrec} <i>{$map.country}</i></td>
						<td class="th_numeric">{$map.time}</td>
						<td class="th_numeric color{if !$map.go_cp}-nogc{/if}">{$map.cp}</td>
						<td class="th_numeric color{if !$map.go_cp}-nogc{/if}">{$map.go_cp}</td>
						<td class="color{if $map.wname == "USP" && $map.wname == "KNIFE"}-wpn{/if}">{$map.wname}</td>
					</tr>
		{/foreach}
				</table>
	{else}
				<a href="{$baseUrl}/{$name|replace:' ':'_'}/kreedz/{$type}">{$langKzRec}</a>
				<p>
				{generate_pages page=$page totalPages=$totalPages pageUrl=$pageUrl}
				<br>
				<table class="table-list">
					<tr class="title">
						<td>{$langMap}</td>
					</tr>
		{foreach from=$maps item=map}
					<tr class="list">
						<td>
							<a href="{$baseUrl}/kreedz/{$map.map}">{$map.map}</a>
						</td>
					<tr>
		{/foreach}
				</table>

	{/if}