			<div class="wrapper">		
				<div class="titles left_block">{$langs.kz_players}</div>
		{if !$cs}
				<div class=" right_block">
					<form action="" method="post" id="search_map_form" class="">
						<input type="text" name="search" id="search" value="{if isset($search)}{$search}{/if}" placeholder="{$langs.Search}"/ >
						<input type="image" name="picture" src="{$baseUrl}/img/find.png" alt="{$langs.Search}"/>
						&nbsp;
					</form>
				</div>
		{/if}
			</div>
			
			<br><br>
			<div>
				<a href="{$baseUrl}/kreedz/players/pro/{$sort}/{$search}" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{$langs.kzpro}</a>
				<a href="{$baseUrl}/kreedz/players/noob/{$sort}/{$search}" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{$langs.kznoob}</a>
				<a href="{$baseUrl}/kreedz/players/all/{$sort}/{$search}" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{$langs.kzall}</a>
				::
				<a href="{$baseUrl}/kreedz/players/{$type}/all/{$search}" {if $sort == "all"}style="font-weight:bold;"{else}{/if}>{$langs.kznum}</a>
				<a href="{$baseUrl}/kreedz/players/{$type}/top1/{$search}" {if $sort == "top1"}style="font-weight:bold;"{else}{/if}>{$langs.kztop1}</a>
			</div>
			
			<p>&nbsp;{$pages.output}
			<div style="padding:10px;">
				<table class="table-list">
					<tr class="title">
						<td width="30" align="center">№</td>
						<td>{$langs.player}</td>
						<td>{if $sort=="all"}{$langs.kznum}{else}{$langs.kztop1}{/if}</td>
						<td>{if $sort=="all"}{$langs.kztop1}{else}{$langs.kznum}{/if}</td>
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
			</div>