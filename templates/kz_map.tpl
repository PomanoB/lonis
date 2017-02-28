		
{if $map}
	<div class="wrapper">
		<div class="titles left_block">{$langs[$parent]} :: {$langs.Map} :: <i>{$map|escape:html}</i></div>
		<div class="right_block" align="center">
			{if isset($imgmap)}
				<img class="map_image" src="{$imgmap}" oncontextmenu="return false;" /><br>
			{/if}
			<p>
		</div>
	</div><br><br>
	
	{if isset($maprec)}

	<div class="table-list">
		{foreach from=$maprec item=rec}
			{if $rec.part}<p><b><a href="{$rec.url}" target="_blank">{$rec.fullname}</a></b>:{/if}
			<b>{$rec.mappath}</b> {$rec.time} <i>{$rec.player}</i> <img src="{$baseUrl}/img/country/{$rec.country}.png">;
		{/foreach}
	</div>
	{/if}
{else}	
	<div class="wrapper">
		<div class="titles left_block">{$langs.lastRecKZ}</div>
	</div><br><br>
{/if}
	
	{if $message}<div class="err_message">{$message}</div>{/if}

	{if $total}	
	<div  class="table-list">
		<a href="{$baseUrl}/kreedz/{$map}/pro" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{$langs.kzpro}</a>
		<a href="{$baseUrl}/kreedz/{$map}/noob" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{$langs.kznoob}</a>
		<a href="{$baseUrl}/kreedz/{$map}/all" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{$langs.kzall}</a>
	</div>
	{/if}

	{$pages.output}</p>
			
	<table class="table-list">
		<tr class="title" >
		{if $map}
			<td width="30" align="center">№</td>
		{else}
			<td>{$langs.Map}</td>
		{/if}
			<td>{$langs.player}</td>
			<td>{$langs.Time}</td>
			<td>{$langs.Cp}</td>
			<td>{$langs.GoCp}</td>
			<td>{$langs.Weapon}</td>
	{if $admin==1}
			<td>#</td>
	{/if}
		</tr>
{if $total}
{foreach from=$players item=player}
		<tr class="list">
		{if $map}
			<td align="center">
				{if $player.number<4}
					<img src="{$baseUrl}/img/top{$player.number}.png" width="22" height="16" title="{$player.number}" alt="{$player.number}" />
				{else}
					{$player.number}
				{/if}
			</td>	
		{else}
			<td><a href="{$baseUrl}/kreedz/{$player.map}/">{$player.map}</a></td>
		{/if}
			<td>
				<a href="{$baseUrl}/{$player.name_url}/kreedz">{$player.name|escape}</a>
			</td>
			<td>{$player.time}</td>
			<td class="{if $player.go_cp==0}color_nogc{/if}">{$player.cp}</td>
			<td class="{if $player.go_cp==0}color_nogc{/if}">{$player.go_cp}</td>
			<td class="{if $player.wname != 'USP' && $player.wname != 'KNIFE'}color_wpn{/if}">
				<img src="{$baseUrl}/img/weapons/{$player.weapon}.gif" alt="{$player.wname}" />
			</td>
{if $admin==1}
			<form action="" method="post">			
			<td>
				<input type="hidden" name="confirm" value="0">
				<input type="checkbox" name="confirm" value="1">
				<button class="but" name="act" value="delete">
					<img src="{$baseUrl}/img/delete.png" border=0 alt="{$langs.Delete}">
				</button>
				<input name="id" type="hidden" value="{$player.id}" />
			</td>
			</form>
{/if}
		</tr>
{/foreach}
{/if}
	</table>