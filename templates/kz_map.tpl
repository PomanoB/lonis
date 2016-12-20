			<div class="wrapper">		
				<div class="titles left_block">{$langMap} {$mapname|escape:html}</div>

				<div class=" right_block">
					<img src="{$imgmap}" onerror="this.src='{$baseUrl}/img/maps/noimage.png'" />
				</div>
			</div>
			
			<br><br>
			<div>
				<a href="{$baseUrl}/kreedz/map/{$mapname}/pro" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{$langKzPro}</a>
				<a href="{$baseUrl}/kreedz/map/{$mapname}/noob" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{$langKzNoob}</a>
				<a href="{$baseUrl}/kreedz/map/{$mapname}/all" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{$langKzAll}</a>
			</div>
			
			<div style="padding:10px;">
				<p><b>{$langWorldRecord}:</b>
{foreach from=$maprec item=wr}
				{$wr.mappath} {$wr.time} {$wr.player} <i>{$wr.country}</i>;
{/foreach}				

				<p><b>{$langRuRecord}:&nbsp;</b>
{foreach from=$mapcomm item=ru}
				{$ru.mappath} {$ru.time} {$ru.player};
{/foreach}

				<p><div class="err_message">{$message}</div>
				<p>{generate_pages page=$page totalPages=$totalPages pageUrl=$pageUrl}	
			
				<p><table class="table-list">
					<tr class="title" >
						<td>№</td>
						<td>{$lang_player}</td>
						<td>{$langTime}</td>
						<td>{$langCp}</td>
						<td>{$langGoCp}</td>
						<td>{$langWeapon}</td>
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
						<td class="th_numeric">{$player.time}</td>
						<td class="th_numeric color{if !$player.go_cp}-nogc{/if}">{$player.cp}</td>
						<td class="th_numeric color{if !$player.go_cp}-nogc{/if}">{$player.go_cp}</td>
						<td class="color{if $player.weapon == 16 && $player.weapon == 29}-wpn{/if}">{$player.weapon_name}</td>
			{if $webadmin==1}
						<form action="{$baseUrl}/kreedz/map/{$mapname}" method="post">			
						<td>
							<input type="hidden" name="confirm" value="0">
							<input type="checkbox" name="confirm" value="1">
							<button class="but" name="act" value="delete">
								<img src="{$baseUrl}/img/delete.png" border=0 alt="{$langDelete}">
							</button>
							<input name="id" type="hidden" value="{$player.id}" />
						</td>
						</form>
			{/if}
			<tr>
{/foreach}
				</table>
			</div>