			<div class="wrapper">		
				<div class="titles left_block">{$langs.players}</div>
		{if !$cs}
				<div class=" right_block">
					<form action="{$baseUrl}/players" method="post">
						<input type="text" name="search" id="search" class="form" {if isset($search)}value="{$search}"{/if} placeholder="{$langs.Search}" />
						<input type="image" name="picture" src="{$baseUrl}/img/find.png" alt="{$langs.Search}"/>
						&nbsp;
					</form>
				</div>
		{/if}
			</div><br>
			
			{$generate_page}
			
			<div style="padding:10px;">
				<table class="table-list">
					<tr class="title">
						<td>#</td>
						<td><a href="{$baseUrl}/players/name/page{$pages.page}">{$langs.player}</td>
						<td><a href="#">{$langs.Country}</td>
						<td><a href="{$baseUrl}/players/achiev/page{$pages.page}">{$langs.achiev}</td>
						<td>{$langs.KzStats}</td>
					</tr>
				{foreach from=$players item=player}
					<tr class="list">
						<td>
							<a href="{$player.avatarLink}" target="_blank"><img src="{$player.avatar}" alt="{$player.name|escape}" /></a>
						<td>
							<a href="{$baseUrl}/{$player.name_url}">{$player.name|escape}</a>
						</td>
						<td style="width: 20%;">
							{if $player.countryImg}
							<img src="{$baseUrl}/{$player.countryImg}" />
							{/if}
							{$player.countryName}
						</td>
						<td>
							<a href="{$baseUrl}/{$player.name_url}/achiev">{$player.achiev}</a>
						</td>
						<td>
							<a href="{$baseUrl}/{$player.name_url}/kreedz">{$langs.View}</a>
						</td>
					</tr>
				{/foreach}
				</table>
			</div>