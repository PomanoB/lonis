	<div class="wrapper">		
		<div class="titles left_block">
			{$langs[$parent]} :: {$langs.kz_maps} ({$total})
		</div>
{if !$cs}
		<div class="right_block">
			{$form_search}
		</div>
{/if}
	</div><br><br>
	
	<div>
{if $rec=="norec"}	
			<div class="table-list">
				<b>{$langs.kznorec}</b> :: <a href="{$baseUrl}/kreedz/maps/{$type}/{$search}">{$langs.kzrec}</a>
			</div>
			
			{$pages.output}
			
	{if !isset($style)}
			<ul class='map-list'>
		{if isset($maps)}
		{foreach from=$maps key=key item=map}	
				<li class="map-list-item" title="{$map.mapname}">
						<span class="map-diff 0"></span>
						<img src="{$baseUrl}/img/cstrike/{$map.mapname}.jpg" alt="" title="{$map.mapname}"
						onerror="this.src='{$baseUrl}/img/noimage.jpg'".>{$map.mapname}
				</li>
		{/foreach}
		{/if}
			</ul>
	{else}	
			<div>
				<table class="table-list">
					<tr class="title">
						<td>{$langs.Map}</td>
					</tr>
		{if isset($maps)}
		{foreach from=$maps key=key item=map}
					<tr class="list">
						<td><a href="{$baseUrl}/kreedz/{$map.mapname}">{$map.mapname}</a></td>
					</tr>
		{/foreach}
		{/if}
				</table>
			</div>
	{/if}
{else}
		<div class="table-list">
			<a href="{$baseUrl}/kreedz/maps/pro/{$rec}/{$search}" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{$langs.kzpro}</a>
			<a href="{$baseUrl}/kreedz/maps/noob/{$rec}/{$search}" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{$langs.kznoob}</a>
			<a href="{$baseUrl}/kreedz/maps/all/{$rec}/{$search}" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{$langs.kzall}</a>
			:: <a href="{$baseUrl}/kreedz/maps/{$type}/norec/{$search}">{$langs.kznorec}</a>
		</div><br>
		
		<div class="err_message">{$message}</div>
		
		{$pages.output}
		
		<table class="table-list">
			<tr class="title">
				<td>{$langs.Map}</td>
				<td>{$langs.player}</td>
				<td>{$langs.Time}</td>
				<td>{$langs.Cp}</td>
				<td>{$langs.GoCp}</td>
				<td>{$langs.Weapon}</td>
	{if $admin==1}
				<td	>#</td>
	{/if}
			</tr>

	{if isset($maps)}
	{foreach from=$maps item=map}
			<tr class="list">
				<td><a href="{$baseUrl}/kreedz/{$map.mapname}/">{$map.mapname}</a></td>
				<td><a href="{$baseUrl}/{$map.name_url}/kreedz">{$map.name|escape}</a></td>
				<td>{$map.time}</td>
				<td class="{if $map.go_cp==0}color_nogc{/if}">{$map.cp}</td>
				<td class="{if $map.go_cp==0}color_nogc{/if}">{$map.go_cp}</td>
				<td class="{if $map.wname != 'USP' && $map.wname != 'KNIFE'}color_wpn{/if}">
					<img src="{$baseUrl}/img/weapons/{$map.weapon}.gif" alt="{$map.wname}" />
				</td>
	{if $admin==1}
				<form action="" method="post">			
				<td>
					<input type="hidden" name="confirm" value="0">
					<input type="checkbox" name="confirm" value="1">
					<button class="but" name="act" value="delete">
						<img src="{$baseUrl}/img/delete.png" border=0 alt="{$langs.Delete}">
					</button>
					<input name="delmap" type="hidden" value="{$map.map}" />
				</td>
				</form>
	{/if}			
			</tr>
	{/foreach}
	{/if}
		</table>
{/if}
	</div>