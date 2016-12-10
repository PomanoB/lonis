{if !isset($cs)}
			<h2>{#langKzMaps#}</h2>
			<form action="kreedz" method="post" id="search_map_form">
				<label for="map">{#langSearch#}</label>
				<input type="text" name="map" id="map" />
				<input type="submit" value="{#langSearch#}" />
			</form>
			<div>
				<a href="{$baseUrl}/kreedz/pro">{#langKzPro#}</a>
				<a href="{$baseUrl}/kreedz/noob">{#langKzNoob#}</a>
				<a href="{$baseUrl}/kreedz/all">{#langKzAll#}</a>
			</div>
{/if}
			<div>
				<span>{#langStats#} {$langType}</span>
			</div>
			{generate_pages page=$page totalPages=$totalPages pageUrl=$pageUrl}
			<div style="padding:10px;">
				<table>
					<tr>
						<th>{#langMap#}</th>
						<th>{#langPlayer#}</th>
						<th>{#langTime#}</th>
						<th>{#langCp#}</th>
						<th>{#langGoCp#}</th>
						<th>{#langWeapon#}</th>
					</tr>
{foreach from=$maps item=map}
					<tr>
						<td>
							<a href="{$baseUrl}/kreedz/{$map.map}">{$map.map}</a>
						</td>
						<td>
							<a href="{$baseUrl}/{$map.name|replace:' ':'_'}/kreedz">{$map.name|escape}</a>
						</td>
						<td class="th_numeric">{$map.time}</td>
						<td class="th_numeric">{$map.cp}</td>
						<td class="th_numeric" style="background-color:{if $map.go_cp}#300{else}#030{/if}">{$map.go_cp}</td>
						<td style="background-color:{if $map.weapon != 16 && $map.weapon != 29}#300{else}#030{/if}">{$map.weapon_name}</td>
					<tr>
{/foreach}
				</table>
			</div>