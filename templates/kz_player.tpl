			<h2>{#lang_player#} {$name|escape}</h2><br>
			<div>
				<a href="{$baseUrl}/{$name|replace:' ':'_'}/kreedz/pro/{$rec}" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{#langKzPro#}</a>
				<a href="{$baseUrl}/{$name|replace:' ':'_'}/kreedz/noob/{$rec}" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{#langKzNoob#}</a>
				<a href="{$baseUrl}/{$name|replace:' ':'_'}/kreedz/all/{$rec}" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{#langKzAll#}</a>
			</div>

			{*<div>
				<span>{#langStats#} {$langType}</span>
			</div>*}
			<div>
				<p><b>{#langKzNum#}:</b> {$map_num}
				<br><b>{#langKzTop1#}:</b> {$map_top1}
			</div>
			
			<div>
{if $rec == "norec"}
				<a href="{$baseUrl}/{$name|replace:' ':'_'}/kreedz/{$type}">{#langKzRec#}</a>
{else}
				<a href="{$baseUrl}/{$name|replace:' ':'_'}/kreedz/{$type}/norec">{#langKzNoRec#}</a>				
{/if}
			</div>
			
			{generate_pages page=$page totalPages=$totalPages pageUrl=$pageUrl}
			<div style="padding:10px;">
{if $rec == "norec"}
				<table class="table-list">
					<tr class="title">
						<td>{#langMap#}</td>
					</tr>
{foreach from=$maps item=map}
					<tr class="list">
						<td>
							<a href="{$baseUrl}/kreedz/{$map.mapname}">{$map.mapname}</a>
						</td>
					<tr>
{/foreach}
				</table>					
{else}
				<table>
					<tr class="title">
						<td>{#langMap#}</td>
						<td>{#langWorldRecord#}</td>
						<td>{#langTime#}</td>
						<td>{#langCp#}</td>
						<td>{#langGoCp#}</td>
						<td>{#langWeapon#}</td>
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
						<td class="color{if $map.weapon == 16 && $map.weapon == 29}-wpn{/if}">{$map.weapon_name}</td>
					<tr>
{/foreach}
				</table>
{/if}
			</div>