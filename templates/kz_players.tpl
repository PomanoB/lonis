			<div class="wrapper">		
				<div class="titles left_block">{langs('Players')}</div>
				<div class=" right_block">
					{$form_search}
				</div>
			</div><br><br>
			
			<div class="table-list">
				<a href="{$baseUrl}/kreedz/players/pro/{$sort}/{$search}" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{langs('Pro')}</a>
				<a href="{$baseUrl}/kreedz/players/noob/{$sort}/{$search}" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{langs('Noob')}</a>
				<a href="{$baseUrl}/kreedz/players/all/{$sort}/{$search}" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{langs('All')}</a>
				::
				<a href="{$baseUrl}/kreedz/players/{$type}/all/{$search}" {if $sort == "all"}style="font-weight:bold;"{else}{/if}>{langs('Total')}</a>
				<a href="{$baseUrl}/kreedz/players/{$type}/top1/{$search}" {if $sort == "top1"}style="font-weight:bold;"{else}{/if}>{langs('First')}</a>
			</div><br>
			
			{$pages.output}
			
				<table class="table-list">
					<tr class="title">
						<td width="30" align="center">№</td>
						<td>{langs('Player')}</td>
						<td>{if $sort=="all"}{langs('Total')}{else}{langs('First')}{/if}</td>
						<td>{if $sort=="all"}{langs('First')}{else}{langs('Total')}{/if}</td>
					</tr>
	{if isset($players)}
	{foreach from=$players item=player}
					<tr class="list">
						<td align="center">
							{if $player.number<4}
								<img src="{$baseUrl}/img/top{$player.number}.png" width="22" height="16" title="{$player.number}" alt="{$player.number}" />
							{else}
								{$player.number}
							{/if}
						</td>
						<td><a href="{$baseUrl}/{$player.name_url}/kreedz">{$player.name|escape}</a></td>
						<td>{$player.col1}</td>
						<td>{$player.col2}</td>
					<tr>
	{/foreach}
	{/if}
				</table>