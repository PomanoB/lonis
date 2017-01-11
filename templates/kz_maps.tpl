	<div class="wrapper">		
		<div class="titles left_block">
			{$langs.kz_maps} ({$total})
		</div>
{if !$cs}
		<div class="right_block">
			<form action="{$baseUrl}/kreedz/maps/" method="post" id="search_map_form">
				<input type="text" name="map" id="map" value="{if isset($map)}{$map}{/if}" placeholder="{$langs.Search}"/>
				<input type="image" name="picture" src="{$baseUrl}/img/find.png" title="{$langs.Search}" alt="{$langs.Search}" />
				&nbsp;
			</form>
		</div>
{/if}
	</div><br>
	
	<div>
{if $rec=="norec"}				
		<p><div>
			<b>{$langs.kznorec}</b> :: <a href="{$baseUrl}/kreedz/maps/{$type}">{$langs.kzrec}</a>
		</div>
		
		<p>&nbsp;{$generate_page}
		
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
{else}
		<p><div>
			<a href="{$baseUrl}/kreedz/maps/pro" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{$langs.kzpro}</a>
			<a href="{$baseUrl}/kreedz/maps/noob" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{$langs.kznoob}</a>
			<a href="{$baseUrl}/kreedz/maps/all" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{$langs.kzall}</a>
			:: <a href="{$baseUrl}/kreedz/maps/{$type}/norec">{$langs.kznorec}</a>
		</div>
		<p><div class="err_message">{$message}</div>
		
		<p>&nbsp;{$generate_page}
		
		<table class="table-list">
			<tr class="title">
				<td>{$langs.Map}</td>
				<td>{$langs.player}</td>
				<td>{$langs.Time}</td>
				<td>{$langs.Cp}</td>
				<td>{$langs.GoCp}</td>
				<td>{$langs.Weapon}</td>
	{if $webadmin==1}
				<td	>#</td>
	{/if}
			</tr>

	{if isset($maps)}
	{foreach from=$maps item=map}
			<tr class="list">
				<td><a href="{$baseUrl}/kreedz/{$map.mapname}">{$map.mapname}</a></td>
				<td><a href="{$baseUrl}/{$map.name_url}/kreedz">{$map.name|escape}</a></td>
				<td>{$map.time}</td>
				<td class="{if $map.go_cp==0}color_nogc{/if}">{$map.cp}</td>
				<td class="{if $map.go_cp==0}color_nogc{/if}">{$map.go_cp}</td>
				<td class="{if $map.wname != 'USP' && $map.wname != 'KNIFE'}color_wpn{/if}">
					<img src="{$baseUrl}/img/weapons/{$map.weapon}.gif" alt="{$map.wname}" />
				</td>
	{if $webadmin==1}
				<form action="{$baseUrl}/kreedz" method="post">			
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