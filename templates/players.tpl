	<div class="wrapper">		
		<div class="titles left_block">{$langs.players}</div>
{if !$cs}
		<div class=" right_block">
			<form action="" method="post">
				<input type="text" name="search" id="search" class="form" }value="{if isset($search)}{$search}{/if}" placeholder="{$langs.Search}" />
				<input type="image" name="picture" src="{$baseUrl}/img/find.png" alt="{$langs.Search}"/>
				&nbsp;
			</form>
		</div>
{/if}
	</div><br>

	<p>&nbsp;{$generate_page}
	
	<div style="padding:10px;">
		<table class="table-list">
			<tr class="title">
				<td>&nbsp;</td>
				<td><a href="{$baseUrl}/players/name/page{$pages.page}/{$search}">{$langs.player}</a></td>
				<td><a href="{$baseUrl}/players/country/page{$pages.page}/{$search}">{$langs.Country}</a></td>
				<td><a href="{$baseUrl}/players/achiev-desc/page{$pages.page}/{$search}">{$langs.achiev}</a></td>
				<td>{$langs.MapCompleted}</td>
			</tr>
	{if $total}
		{foreach from=$players item=player}
			<tr class="list">
				<td>
					<a href="{$player.avatarLink}" target="_blank"><img src="{$player.avatar}" alt="{$player.name|escape}" /></a>
				<td>
					<a href="{$baseUrl}/{$player.name_url}">{$player.name|escape}</a>
				</td>
				<td style="width: 20%;">
					{if $player.countryImg}
						<img src="{$baseUrl}/{$player.countryImg}" title="{$rec.countryName}" alt="{$rec.countryName}" />
					{/if}
					{$player.countryName}
				</td>
				<td>
					<a href="{$baseUrl}/{$player.name_url}/achiev">{$player.achiev}</a>
				</td>
				<td>
					<a href="{$baseUrl}/{$player.name_url}/kreedz">{$player.mapCompleted}</a>
				</td>
			</tr>
		{/foreach}
	{/if}
		</table>
	</div>
