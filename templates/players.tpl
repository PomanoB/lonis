			<div class="wrapper">		
				<div class="titles left_block">{$lang_players}</div>
		{if !isset($cs)}
				<div class=" right_block">
					<form action="{$baseUrl}/players" method="post">
						<input type="text" name="search" id="search" class="form" {if isset($search)}value="{$search}"{/if} placeholder="{$langSearch}" /> {*<input type="submit" value="{$langSearch}" />*}
						<input type="image" name=”picture” src="{$baseUrl}/img/find.png" />
						&nbsp;
					</form>
				</div>
		{/if}
			</div>
			
			<p>{generate_pages page=$page totalPages=$totalPages pageUrl=$pageUrl}
			
			<div>
				<table class="table-list">
					<tr class="title">
						<td>{$langPlayer}</td>
						<td>{$langCountry}</td>
						<td>{$lang_achiev}</td>
						<td>{$langKzStats}</td>
						<!--
						<td>{$langDRStats}</td>-->
					</tr>
				{foreach from=$players item=player}
					<tr class="list">
						<td>
							<a href="{$baseUrl}/{$player.name|replace:' ':'_'|replace:'#':'%23'}">{$player.name|escape}</a>
						</td>
						<td style="width: 20%;">
							{if $player.countryImg}
							<img src="{$baseUrl}/{$player.countryImg}" />
							{/if}
							{$player.countryName}
						</td>
						<td>
							<a href="{$baseUrl}/{$player.name|replace:' ':'_'|replace:'#':'%23'}/achiev">{$langView}</a>
						</td>
						<td>
							<a href="{$baseUrl}/{$player.name|replace:' ':'_'|replace:'#':'%23'}/kreedz">{$langView}</a>
						</td>
						<!--
						<td>
							<a href="{$baseUrl}/{$player.name|replace:' ':'_'|replace:'#':'%23'}/deatdrun">{$langView}</a>
						</td>
						-->
					</tr>
				{/foreach}
				</table>
			</div>