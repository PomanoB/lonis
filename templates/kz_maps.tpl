			<div class="wrapper">		
				<div class="titles left_block">
					{$lang_kz_maps}{if $rec=="norec"} - {$langKzNoRec}{/if} ({$total})
				</div>
		{if !$cs}
				<div class="right_block">
					<form action="" method="get" id="search_map_form">
						<input type="text" name="map" id="map" value="{if isset($map)}{$map}{/if}" placeholder="{$langSearch}"/>
						<input type="image" name="picture" src="{$baseUrl}/img/find.png" alt="{$langSearch}"/>
						&nbsp;
					</form>
				</div>
		{/if}
			</div>
			
			<br>
			<div>
	{if $rec=="norec"}				
				<p><div><a href="{$baseUrl}/kreedz/maps/{$type}">{$langKzRec}</a></div>
				
				<p>{generate_pages page=$page totalPages=$totalPages pageUrl=$pageUrl}</p>
				
				<div class="inline">
		{foreach from=$maps key=key item=map}
					<a href="{$baseUrl}/kreedz/{$map.map}">{$map.map}</a><br>
		{/foreach}
				</div>
	{else}
				<p><div>
					<a href="{$baseUrl}/kreedz/maps/pro" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{$langKzPro}</a>
					<a href="{$baseUrl}/kreedz/maps/noob" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{$langKzNoob}</a>
					<a href="{$baseUrl}/kreedz/maps/all" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{$langKzAll}</a>
					:: <a href="{$baseUrl}/kreedz/maps/{$type}/norec">{$langKzNoRec}</a>
				</div>
				<p><div class="err_message">{$message}</div>
				<p>{generate_pages page=$page totalPages=$totalPages pageUrl=$pageUrl}
				
				<div style="padding:10px;">
				<table class="table-list">
					<tr class="title">
						<td>{$langMap}</td>
						<td>{$lang_player}</td>
						<td>{$langTime}</td>
						<td>{$langCp}</td>
						<td>{$langGoCp}</td>
						<td>{$langWeapon}</td>
				{if $webadmin==1}
						<td	>#</td>
				{/if}
					</tr>
		{foreach from=$maps item=map}
					<tr class="list">
						<td><a href="{$baseUrl}/kreedz/{$map.map}">{$map.map}</a></td>
						<td><a href="{$baseUrl}/{$map.name|replace:' ':'_'}/kreedz">{$map.name|escape}</a></td>
						<td>{$map.time}</td>
						<td class="{if $map.go_cp==0}color_nogc{/if}">{$map.cp}</td>
						<td class="{if $map.go_cp==0}color_nogc{/if}">{$map.go_cp}</td>
						<td class="{if $map.wname != 'USP' && $map.wname != 'KNIFE'}color_wpn{/if}">{$map.wname}</td>
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