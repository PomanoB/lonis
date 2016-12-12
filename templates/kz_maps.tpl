{if !isset($cs)}
			<p><h2>{#langKzMaps#}</h2>
			<div align="right">
				<form action="" method="post" id="search_map_form">
					{*<label for="map">{#langSearch#}</label>*}
					<input type="text" name="map" id="map" value="{$map}"/>
					<input type="image" name=”picture” src="{$baseUrl}/img/find.png" />
					{*<input type="submit" value="{#langSearch#}" />*}
					&nbsp;
				</form>
			</div>
{/if}			
			<div>
	{if $rec == "norec"}
				<a href="{$baseUrl}/kreedz/{$type}">{#langKzRec#}</a>
	{else}
				<a href="{$baseUrl}/kreedz/{$type}/norec">{#langKzNoRec#}</a>
				<div><br>
				<a href="{$baseUrl}/kreedz/pro" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{#langKzPro#}</a>
				<a href="{$baseUrl}/kreedz/noob" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{#langKzNoob#}</a>
				<a href="{$baseUrl}/kreedz/all" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{#langKzAll#}</a>
				</div>
	{/if}
			</div><br>

			{*<div>
				<span>{#langStats#} {$langType}</span>
			</div>*}
			{generate_pages page=$page totalPages=$totalPages pageUrl=$pageUrl}
{if $rec == "norec"}
			<div style="padding:10px;">
				<table>
					<tr class="title">
						<td>{#langMap#}</td>
						{*<td>{#langWorldRecord#}</td>*}
					</tr>
{foreach from=$maps item=map}
					<tr class="list">
						<td><a href="{$baseUrl}/kreedz/{$map.mapname}">{$map.mapname}</a></td>
						{*<td class="th_numeric">{$map.timerec} {$map.plrrec} {$map.country}</td>*}
					</tr>

{/foreach}				
			</div>
{else}		
			<div style="padding:10px;">
				<table>
					<tr class="title">
						<td>{#langMap#}</td>
						<td>{#langWorldRecord#}</td>
						<td>{#langPlayer#}</td>
						<td>{#langTime#}</td>
						<td>{#langCp#}</td>
						<td>{#langGoCp#}</td>
						<td>{#langWeapon#}</td>
					</tr>
{foreach from=$maps item=map}
					<tr class="list">
						<td><a href="{$baseUrl}/kreedz/{$map.map}">{$map.map}</a></td>
						<td class="th_numeric">{$map.timerec} {$map.plrrec} <i>{$map.country}</i></td>
						<td><a href="{$baseUrl}/{$map.name|replace:' ':'_'}/kreedz">{$map.name|escape}</a></td>
						<td class="th_numeric">{$map.time}</td>
						<td class="th_numeric" style="color:{if $map.go_cp}#ff0000{else}#006400{/if}">{$map.cp}</td>
						<td class="th_numeric" style="color:{if $map.go_cp}#ff0000{else}#006400{/if}">{$map.go_cp}</td>
						<td style="color:{if $map.weapon != 16 && $map.weapon != 29}#ff0000{else}#006400{/if}">{$map.weapon_name}</td>
					<tr>
{/foreach}
				</table>
			</div>
{/if}