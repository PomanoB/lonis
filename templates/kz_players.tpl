{if !isset($cs)}
			<h2>{#langPlayers#}</h2>
			<div>
				<a href="{$baseUrl}/kreedz/pro">{#langKzPro#}</a>
				<a href="{$baseUrl}/kreedz/noob">{#langKzNoob#}</a>
				<a href="{$baseUrl}/kreedz/all">{#langKzAll#}</a>
			</div>
{/if}
			<div>
				<span>{#langStats#} {$langType}</span>
			</div>
			{generate_pages page=$page totalPages=$totalPages pageUrl=$pageUrl}
			<div style="padding:10px;">
				<table>
					<tr>
						<th>№</th>
						<th>{#langPlayer#}</th>
						<th>{#langRecords#}</th>
					</tr>
{foreach from=$players item=player}
					<tr>
						<td>{$player.number}</td>
						<td>
							<a href="{$baseUrl}/{$player.name|replace:' ':'_'}/kreedz">{$player.name|escape}</a>
						</td>
						<td class="th_numeric">{$player.records}</td>
					<tr>
{/foreach}
				</table>
			</div>