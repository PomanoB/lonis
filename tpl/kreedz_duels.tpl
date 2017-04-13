<div class="wrapper">
	<div class="titles left_block">{langs('Duels')}</div>
	<div class="right_block" align="center">
		{$form_search}
	</div>
</div><br><br>
	
{$pages.output}

<div class="table list">
	<div class="tr title">
		<div>{langs('Map')}</div>
		<div>{langs('Winner')}</div>
		<div>{langs('Looser')}</div>
		<div>{langs('Winner Point')}</div>
		<div>{langs('Looser Point')}</div>
	</div>
{foreach from=$rows item=duel}
	<div class="tr row">
		<div>
			<a href="{$baseUrl}/kreedz/{$duel.map}/">{$duel.map}</a>
		</div>
		<div>
			<a href="{$baseUrl}/{$duel.winnerName_url}/kreedz/">{$duel.winnerName|escape}</a>
		</div>
		<div>
			<a href="{$baseUrl}/{$duel.looserName_url}/kreedz/">{$duel.looserName|escape}</a>
		</div>
		<div class="th_numeric">{$duel.winnerPoints}</div>
		<div class="th_numeric">{$duel.looserPoints}</div>
	</div>
{foreachelse}
{/foreach}
</div>