			<div class="wrapper">		
				<div class="titles left_block">{$langMap} {$mapname|escape:html}</div>

				<div class="right_block" align="center">
					<img src="{$imgmap}" onerror="this.src='{$baseUrl}/img/noimage.png'" /><br>
					<a href="{$downmap}" alt="{$langDownload} {$mapname}">{$langDownload}</a>
					<p>
				</div>
			</div>
			<br><br>			
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
				
{if isset($players)}
				<div>
					<a href="{$baseUrl}/kreedz/{$mapname}/pro" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{$langKzPro}</a>
					<a href="{$baseUrl}/kreedz/{$mapname}/noob" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{$langKzNoob}</a>
					<a href="{$baseUrl}/kreedz/{$mapname}/all" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{$langKzAll}</a>
				</div>
			
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
								<img src="{$baseUrl}/img/delete.png" border=0 alt="{$langDelete}">
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