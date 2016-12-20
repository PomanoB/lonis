			<div class="wrapper">		
				<div class="titles left_block">
					{$lang_kz_maps}
				</div>
		{if !isset($cs)}
				<div class=" right_block">
					<form action="" method="post" id="search_map_form">
						{*<label for="map">{$langSearch}</label>*}
						<input type="text" name="map" id="map" value="{$map}"/>
						<input type="image" name=”picture” src="{$baseUrl}/img/find.png" />
						{*<input type="submit" value="{$langSearch}" />*}
						&nbsp;
					</form>
				</div>
		{/if}
			</div>
			
			<br><br>
			<div>
				<div><b>{$langTotal}: {$total}</b></div>

	{if $rec == "norec"}
				<p><div><a href="{$baseUrl}/kreedz/{$type}">{$langKzRec}</a></div>
				
				<p>{generate_pages page=$page totalPages=$totalPages pageUrl=$pageUrl}
				
				<div style="padding:10px;">
				<table>
					<tr class="title">
						<td>{$langMap}</td>
						{*<td>{$langWorldRecord}</td>*}
					</tr>
		{foreach from=$maps item=map}
					<tr class="list">
						<td><a href="{$baseUrl}/kreedz/map/{$map.mapname}">{$map.mapname}</a></td>
						{*<td class="th_numeric">{$map.timerec} {$map.plrrec} {$map.country}</td>*}
					</tr>
		{/foreach}
				</table>
				</div>
	{else}
				<p><div>
					<a href="{$baseUrl}/kreedz/pro" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{$langKzPro}</a>
					<a href="{$baseUrl}/kreedz/noob" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{$langKzNoob}</a>
					<a href="{$baseUrl}/kreedz/all" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{$langKzAll}</a>
					:: <a href="{$baseUrl}/kreedz/{$type}/norec">{$langKzNoRec}</a>
				</div>
				<p><div class="err_message">{$message}</div>
				<p>{generate_pages page=$page totalPages=$totalPages pageUrl=$pageUrl}
				
				<div style="padding:10px;">
				<table class="table-list">
					<tr class="title">
						<td>{$langMap}</td>
						<td>{$langWorldRecord}</td>
						<td>{$lang_player}</td>
						<td>{$langTime}</td>
						<td>{$langCp}</td>
						<td>{$langGoCp}</td>
						<td>{$langWeapon}</td>
				{if $webadmin==1}
						<td>#</td>
				{/if}
					</tr>
		{foreach from=$maps item=map}
					<tr class="list">
						<td><a href="{$baseUrl}/kreedz/map/{$map.map}">{$map.map}</a></td>
						<td class="th_numeric">{$map.timerec} {$map.playerrec} <i>{$map.country}</i></td>
						<td><a href="{$baseUrl}/{$map.name|replace:' ':'_'}/kreedz">{$map.name|escape}</a></td>
						<td class="th_numeric">{$map.time}</td>
						<td class="th_numeric color{if !$map.go_cp}-nogc{/if}">{$map.cp}</td>
						<td class="th_numeric color{if !$map.go_cp}-nogc{/if}">{$map.go_cp}</td>
						<td class="color{if $map.weapon == 16 && $map.weapon == 29}-wpn{/if}">{$map.weapon_name}</td>
			{if $webadmin==1}
						<form action="{$baseUrl}/kreedz" method="post">			
						<td>
							<input type="hidden" name="confirm" value="0">
							<input type="checkbox" name="confirm" value="1">
							<button class="but" name="act" value="delete">
								<img src="{$baseUrl}/img/delete.png" border=0 alt="{$langDelete}">
							</button>
							<input name="delmap" type="hidden" value="{$map.map}" />
						</td>
						</form>
			{/if}			
					</tr>
		{/foreach}
				</table>
				</div>
	{/if}
			</div>