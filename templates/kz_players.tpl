			<div class="wrapper">		
				<div class="titles left_block">{$lang_kz_players}</div>
		{if !$cs}
				<div class=" right_block">
					<form action="" method="get" id="search_map_form" class="">
						<input type="text" name="player" id="player" value="{if isset($player)}{$player}{/if}" placeholder="{$langSearch}"/ >
						<input type="image" name="picture" src="{$baseUrl}/img/find.png" alt="{$langSearch}"/>
						&nbsp;
					</form>
				</div>
		{/if}
			</div>
			
			<br><br>
			<div>
				<a href="{$baseUrl}/kreedz/players/pro/{$sort}" {if $type == "pro"}style="font-weight:bold;"{else}{/if}>{$langKzPro}</a>
				<a href="{$baseUrl}/kreedz/players/noob/{$sort}" {if $type == "noob"}style="font-weight:bold;"{else}{/if}>{$langKzNoob}</a>
				<a href="{$baseUrl}/kreedz/players/all/{$sort}" {if $type == "all"}style="font-weight:bold;"{else}{/if}>{$langKzAll}</a>
				::
				<a href="{$baseUrl}/kreedz/players/{$type}/num" {if $sort == "num"}style="font-weight:bold;"{else}{/if}>{$langKzNum}</a>
				<a href="{$baseUrl}/kreedz/players/{$type}/top1" {if $sort == "top1"}style="font-weight:bold;"{else}{/if}>{$langKzTop1}</a>
			</div>
			
			<p>{generate_pages page=$page totalPages=$totalPages pageUrl=$pageUrl}</p>
			<div style="padding:10px;">
				<table class="table-list">
					<tr class="title">
						<td>№</td>
						<td>{$lang_player}</td>
						<td>{$langRecords}</td>
					</tr>
	{foreach from=$players item=player}
					<tr class="list">
						<td>{$player.number}</td>
						<td>
							<a href="{$baseUrl}/{$player.name_url}/kreedz">{$player.name|escape}</a>
						</td>
						<td class="th_numeric">{$player.records}</td>
					<tr>
	{/foreach}
				</table>
			</div>