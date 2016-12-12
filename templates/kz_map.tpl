			<h2>{#langMap#} {$mapname|escape:html}</h2><br>
			<div>
				<a href="{$baseUrl}/kreedz/{$mapname}/pro" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{#langKzPro#}</a>
				<a href="{$baseUrl}/kreedz/{$mapname}/noob" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{#langKzNoob#}</a>
				<a href="{$baseUrl}/kreedz/{$mapname}/all" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{#langKzAll#}</a>
			</div>
			{*<div>
				<span>{#langStats#} {$langType}</span>
			</div>*}	
			{generate_pages page=$page totalPages=$totalPages pageUrl=$pageUrl}			
			<div style="padding:10px;">
				<p><b>{#langWorldRecord#}:</b>
{foreach from=$maprec item=wr}
				{$wr.mappath} {$wr.time} {$wr.player} <i>{$wr.country}</i>;
{/foreach}				

				<p><b>{#langRuRecord#}:&nbsp;</b>
{foreach from=$mapcomm item=ru}
				{$ru.mappath} {$ru.time} {$ru.player};
{/foreach}
				
				<p><table>
					<tr class="title" >
						<td>№</td>
						<td>{#langPlayer#}</td>
						<td>{#langTime#}</td>
						<td>{#langCp#}</td>
						<td>{#langGoCp#}</td>
						<td>{#langWeapon#}</td>
					</tr>
{foreach from=$players item=player}
					<tr class="list">
						<td>{$player.number}</td>
						<td>
							<a href="{$baseUrl}/{$player.name|replace:' ':'_'}/kreedz">{$player.name|escape}</a>
						</td>
						<td class="th_numeric">{$player.time}</td>
						<td class="th_numeric" style="color:{if $map.go_cp}#ff0000{else}#006400{/if}">{$player.cp}</td>
						<td class="th_numeric" style="color:{if $map.go_cp}#ff0000{else}#006400{/if}">{$player.go_cp}</td>
						<td style="color:{if $map.weapon != 16 && $map.weapon != 29}#006400{else}#ff0000{/if}">{$player.weapon_name}</td>
					<tr>
{/foreach}
				</table>
			</div>