{if !isset($cs)}
			<h2>{#langMap#} {$mapname|escape:html}</h2>
			<div>
				<a href="{$baseUrl}/kreedz/{$mapname}/pro">{#langKzPro#}</a>
				<a href="{$baseUrl}/kreedz/{$mapname}/noob">{#langKzNoob#}</a>
				<a href="{$baseUrl}/kreedz/{$mapname}/all">{#langKzAll#}</a>
			</div>
{/if}
			{generate_pages page=$page totalPages=$totalPages pageUrl=$pageUrl}
			<div>
				<span>{#langStats#} {$langType}</span>
			</div>

			<div style="padding:10px;">
				<table>
					<tr>
						<th>№</th>
						<th>{#langPlayer#}</th>
						<th>{#langTime#}</th>
						<th>{#langCp#}</th>
						<th>{#langGoCp#}</th>
						<th>{#langWeapon#}</th>
					</tr>
{foreach from=$players item=player}
					<tr>
						<td>{$player.number}</td>
						<td>
							<a href="{$baseUrl}/{$player.name|replace:' ':'_'}/kreedz">{$player.name|escape}</a>
						</td>
						<td class="th_numeric">{$player.time}</td>
						<td class="th_numeric">{$player.cp}</td>
						<td class="th_numeric" style="background-color:{if $player.go_cp}#300{else}#030{/if}">{$player.go_cp}</td>
						<td style="background-color:{if $player.weapon != 16 && $player.weapon != 29}#300{else}#030{/if}">{$player.weapon_name}</td>
					<tr>
{/foreach}
				</table>
			</div>