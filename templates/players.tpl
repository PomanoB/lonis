			<div class="wrapper">		
				<div class="titles left_block">{$lang_players}</div>
		{if !$cs}
				<div class=" right_block">
					<form action="{$baseUrl}/players" method="post">
						<input type="text" name="search" id="search" class="form" {if isset($search)}value="{$search}"{/if} placeholder="{$langSearch}" />
						<input type="image" name="picture" src="{$baseUrl}/img/find.png" alt="{$langSearch}"/>
						&nbsp;
					</form>
				</div>
		{/if}
			</div><br>
			
			<p>{generate_pages page=$page totalPages=$totalPages pageUrl=$pageUrl}
			
			<div style="padding:10px;">
				<table class="table-list">
					<tr class="title">
						<td>{$lang_player}</td>
						<td>{$langCountry}</td>
						<td>{$lang_achiev}</td>
						<td>{$langKzStats}</td>
						<!--
						<td>{$langDRStats}</td>-->
					</tr>
				{foreach from=$players item=player}
					<tr class="list">
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
							<a href="{$baseUrl}/{$player.name_url}/achiev">{$langView}</a>
						</td>
						<td>
							<a href="{$baseUrl}/{$player.name_url}/kreedz">{$langView}</a>
						</td>
						<!--
						<td>
							<a href="{$baseUrl}/{$player.name_url}/deatdrun">{$langView}</a>
						</td>
						-->
					</tr>
				{/foreach}
				</table>
			</div>