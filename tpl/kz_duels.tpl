<div class="wrapper">
	<div class="titles left_block">{langs('Duels')}</div>
	<div class="right_block" align="center">
		{$form_search}
	</div>
</div><br><br>
	
{$pages.output}

<div style="padding:10px;">
	<table class="table-list">
		<tr class="title">
			<td>{langs('Map')}</td>
			<td>{langs('Winner')}</td>
			<td>{langs('Looser')}</td>
			<td>{langs('Winner Point')}</td>
			<td>{langs('Looser Point')}</td>
		</tr>
{foreach from=$rows item=duel}
		<tr class="list">
			<td>
				<a href="{$baseUrl}/kreedz/{$duel.map}/">{$duel.map}</a>
			</td>
			<td>
				<a href="{$baseUrl}/{$duel.winnerName_url}/kreedz/">{$duel.winnerName|escape}</a>
			</td>
			<td>
				<a href="{$baseUrl}/{$duel.looserName_url}/kreedz/">{$duel.looserName|escape}</a>
			</td>
			<td class="th_numeric">{$duel.winnerPoints}</td>
			<td class="th_numeric">{$duel.looserPoints}</td>
		<tr>
{foreachelse}
{/foreach}
	</table>
</div>