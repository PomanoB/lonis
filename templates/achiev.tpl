{* /achiev/%aname% *}
{capture name=achiev assign=achiev}
			<h2>{$langs.achiev}</h2>
			<div style="padding:10px;">
				<p>{$langs.achievsPlayers}</p>
				<div class="achiev achiev_completed">
					<b>{$achiev.name}</b>
					<br />
					<span>{$achiev.description}</span>
				</div>
	{foreach from=$players item=player}
				<div class="achiev">
					<b><a href="{$baseUrl}/{$player.plname_url}/achiev">{$player.plname|escape}</a></b>
					<br />
					<span>{$langs.achievPlayerTotal} {$player.achiev_total}</span>
				</div>
	{/foreach}</div>
{/capture}

{* /%name%/achiev/ *}
{capture name=player_achiev assign=player_achiev}
			<h2>{$langs.achiev}</h2>
			<div style="padding:10px;">
				<p><h1>{*{$langs.AchievsPlayer}*} {$playerName|escape}</h1>
				
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
{/capture}

{* /achiev *}
{capture name=achiev_list assign=achiev_list}			
				<p><h2>{$langs.achiev}</h2>
				
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
										<b><a href="{$baseUrl}/achiev/{$achiev.name|replace:' ':'_'}">{$achiev.name}</a></b>
										<br />
										<span style="width:450px;display: inline-block;">{$achiev.description}</span>
									</div>
								</div>
							</div>
						</td>
					</tr>
	{/foreach}
				</table>
			</div>
{/capture}

{if isset($aname)}
	{$achiev}
{elseif isset($plId)}
	{$player_achiev}
{else}
	{$achiev_list}
{/if}
