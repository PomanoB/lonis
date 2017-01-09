{if $act=="achievs"}
	<p><div class="titles">
		<a href="{$baseUrl}/achiev/">{$langs.achiev}</a>
		::
		{$langs.achiev_players}
	</div>
	
	{if isset($players)}
	{$generate_page}
	
	<div style="padding:10px;">
		{foreach from=$players item=player}
		<div class="achiev">
			<b><a href="{$baseUrl}/{$player.name|replace:' ':'_'}/achiev">{$player.name|escape}</a></b>
			<br />
			<span>{$langs.achievPlayerTotal} {$player.achiev_total}</span>
		</div>
		{/foreach}
	</div>
	{/if}	
{else}
{if $aname && $aname!=""}
	<p><div class="titles">
		{$langs.achiev} :: <i>{$langs.achievsPlayers}</i>
	</div>
	
	<div style="padding:10px;">
		<p></p>
		<div class="achiev achiev_completed">
			<b>{$achiev.name}</b>
			<br />
			<span>{$achiev.description}</span>
		</div>
		
		{$generate_page}
		
	{foreach from=$players item=player}
		<div class="achiev">
			<b><a href="{$baseUrl}/{$player.plname_url}/achiev">{$player.plname|escape}</a></b>
			<br />
			<span>{$langs.achievPlayerTotal} {$player.achiev_total}</span>
		</div>
	{/foreach}
	</div>
	
{elseif $player.id}

	<p><div class="titles">
		{$langs.achiev} :: <i>{$player.name|escape}</i>
	</div>

	<div style="padding:10px;">
	{$generate_page}
		
	{foreach from=$achievs item=achiev}
		<div class="achiev{if $achiev.count == $achiev.progress} achiev_completed{/if}">
			<b><a href="{$baseUrl}/achiev/{$achiev.name|replace:' ':'_'}">{$achiev.name}</a></b>
			<br />
			<span>{$achiev.description}</span>
		{if isset($achiev.width)}
			<div>
				<div class="progress_background">
					<div class="progress_bar" style="width:{$achiev.width}%">
					</div>
				</div>
				<span class="progress_counter">{$achiev.progress}/{$achiev.count}</span>
			</div>
		{elseif isset($achiev.unlocked)}
			<div class="unlocekd_time">
				{$langs.AchievsUnlocked}{$achiev.unlocked|date_format:"%d.%m.%Y %H:%M"}
			</div>
		{/if}
		</div>
	{/foreach}
	</div>
	
{else}

	<p><div class="titles">
		{$langs.achiev}
		::
		<a href="{$baseUrl}/achievs/">{$langs.achiev_players}</a>
	</div>
	
	{$generate_page}
	
	<table>
	{foreach from=$achievs item=achiev}
		<tr>
			<td style="width:65px;">
		{if file_exists($achiev.aId)}
				<img src="{$baseUrl}/img/achiev/{$achiev.aId}.png" />
		{else}
				<img src="{$baseUrl}/img/achiev/dead_from_sky.png" />
		{/if}
			</td>
			<td>
				<div class="achiev" style="padding: 0px;">
					<div style="background-color: #464647;width: {$achiev.completed}%;overflow: visible;">
						<div style="width: 550px;padding: 10px;">
							<span style="float:right;margin-top:10px;margin-right:20px">{$achiev.completed}%</span>
							<b><a href="{$baseUrl}/achiev/{$achiev.name}">{$achiev.name}</a></b>
							<br />
							<span style="width:450px;display: inline-block;">{$achiev.description}</span>
						</div>
					</div>
				</div>
			</td>
		</tr>
	{/foreach}
	</table>	
{/if}
{/if}