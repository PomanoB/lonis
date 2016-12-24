			<div class="wrapper">		
				<div class="titles left_block">{$lang_kz_players}</div>
		{if !isset($cs)}
				<div class=" right_block">
					<form action="" method="post" id="search_map_form" class="">
						{*<label for="player">{$langSearch}</label>*}
						<input type="text" name="player" id="player" value="{$player}"/ >
						{*<input type="submit" value="{$langSearch}" />*}
						<input type="image" name=”picture” src="{$baseUrl}/img/find.png" />
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
			</div><br>
			
			{generate_pages page=$page totalPages=$totalPages pageUrl=$pageUrl}
			<div style="padding:10px;">
				<table class="table-list">
					<tr class="title">
						<td>№</td>
						<td>{$langPlayer}</td>
						<td>{$langRecords}</td>
					</tr>
	{foreach from=$players item=player}
					<tr class="list">
						<td>{$player.number}</td>
						<td>
							<a title="unrid{$player.id}" href="{$baseUrl}/{$player.name|replace:' ':'_'|replace:'#':'%23'}/kreedz">{$player.name|escape}</a>
						</td>
						<td class="th_numeric">{$player.records}</td>
					<tr>
	{/foreach}
				</table>
			</div>