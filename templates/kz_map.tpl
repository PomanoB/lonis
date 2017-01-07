			<div class="wrapper">		
				<div class="titles left_block">{$langs.Map} <i>{$mapname|escape:html}</i></div>

				<div class="right_block" align="center">
					<img src="{$imgmap}" oncontextmenu="return false;" /><br>
					<a href="{$wrs.download}" alt="{$langs.Download} {$mapname}">{$langs.Download}</a>
					<p>
				</div>
			</div>
			<br>		
			<div style="padding:10px;">
				<p><b><a href="{$wrs.map}" target="_blank">{$langs.WorldRecord}:</a></b>
{foreach from=$maprec item=wr}
				{$wr.mappath} {$wr.time} {$wr.player} <i>{$wr.country}</i>;
{/foreach}				

				<p><b><a href="{$kzru.map}" target="_blank">{$langs.RuRecord}:</a>&nbsp;</b>
{foreach from=$mapcomm item=ru}
				{$ru.mappath} {$ru.time} {$ru.player};
{/foreach}

				<p><div class="err_message">{$message}</div>
				
{if isset($players)}
				<div>
					<a href="{$baseUrl}/kreedz/{$mapname}/pro" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{$langs.kzpro}</a>
					<a href="{$baseUrl}/kreedz/{$mapname}/noob" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{$langs.kznoob}</a>
					<a href="{$baseUrl}/kreedz/{$mapname}/all" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{$langs.kzall}</a>
				</div>
			
				{$generate_page}
				
				<p><table class="table-list">
					<tr class="title" >
						<td>№</td>
						<td>{$langs.player}</td>
						<td>{$langs.Time}</td>
						<td>{$langs.Cp}</td>
						<td>{$langs.GoCp}</td>
						<td>{$langs.Weapon}</td>
				{if $webadmin==1}
						<td>#</td>
				{/if}
						</tr>
	{foreach from=$players item=player}
					<tr class="list">
						<td>{$player.number}</td>
						<td>
							<a href="{$baseUrl}/{$player.name|replace:' ':'_'}/kreedz">{$player.name|escape}</a>
						</td>
						<td>{$player.time}</td>
						<td class="{if $player.go_cp==0}color_nogc{/if}">{$player.cp}</td>
						<td class="{if $player.go_cp==0}color_nogc{/if}">{$player.go_cp}</td>
						<td class="{if $player.wname != 'USP' && $player.wname != 'KNIFE'}color_wpn{/if}">{$player.wname}</td>
			{if $webadmin==1}
						<form action="{$baseUrl}/kreedz/{$mapname}" method="post">			
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
			<tr>
	{/foreach}
				</table>
{/if}
			</div>