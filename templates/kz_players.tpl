			<div class="wrapper">		
				<div class="titles left_block">{$langs.kz_players}</div>
		{if !$cs}
				<div class=" right_block">
					<form action="" method="post" id="search_map_form" class="">
						<input type="text" name="name" id="name" value="" placeholder="{$langs.Search}"/ >
						<input type="image" name="picture" src="{$baseUrl}/img/find.png" alt="{$langs.Search}"/>
						&nbsp;
					</form>
				</div>
		{/if}
			</div>
			
			<br><br>
			<div>
				<a href="{$baseUrl}/kreedz/players/pro/{$sort}" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{$langs.kzpro}</a>
				<a href="{$baseUrl}/kreedz/players/noob/{$sort}" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{$langs.kznoob}</a>
				<a href="{$baseUrl}/kreedz/players/all/{$sort}" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{$langs.kzall}</a>
				::
				<a href="{$baseUrl}/kreedz/players/{$type}/num" {if $sort == "num"}style="font-weight:bold;"{else}{/if}>{$langs.kznum}</a>
				<a href="{$baseUrl}/kreedz/players/{$type}/top1" {if $sort == "top1"}style="font-weight:bold;"{else}{/if}>{$langs.kztop1}</a>
			</div>
			
			{$generate_page}
			<div style="padding:10px;">
				<table class="table-list">
					<tr class="title">
						<td width="30" align="center">№</td>
						<td>{$langs.player}</td>
						<td>{$langs.Records}</td>
					</tr>
	{foreach from=$players item=player}
					<tr class="list">
						<td align="center">
							{if $player.number<4}
								<img src="{$baseUrl}/img/top{$player.number}.png" width="22" height="16" title="{$player.number}" alt="{$player.number}" />
							{else}
								{$player.number}
							{/if}
						</td>
						<td>
							<a href="{$baseUrl}/{$player.name_url}/kreedz">{$player.name|escape}</a>
						</td>
						<td class="th_numeric">{$player.records}</td>
					<tr>
	{/foreach}
				</table>
			</div>