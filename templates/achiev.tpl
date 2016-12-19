{capture name=player_achive}
			<h2>{$langAchievs}</h2>
			<div style="padding:10px;">
				<p><h1>{$langAchievsPlayer} {$playerName|escape}</h1><br>
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
		{elseif $achiev.unlocked}
					<div class="unlocekd_time">
						{$langAchievsUnlocked}{$achiev.unlocked|date_format:"%d.%m.%Y %H:%M"}
					</div>
	{/if}
				</div>
	{/foreach}
				
			</div>
{/capture}

{capture name=achive}
			<h2>{$lang_achievs}</h2>
			<div style="padding:10px;">
				<span>{$lang_achievsPlayer} {$playerName}</span>
				{foreach from=$achievs item=achiev}
					<div class="achiev{if $achiev.count == $achiev.progress} achiev_completed{/if}">
						<a href="{$baseUrl}/achiev/{$achiev.name|replace:' ':'_'}">{$achiev.name}</a>
						<br />
						<span style="color: #dddddd">{$achiev.description}</span>
						{if isset($achiev.width)}
							<div>
								<div class="progress_background">
									<div class="progress_bar" style="width:{$achiev.width}%">
									</div>
								</div>
								<span class="progress_counter">{$achiev.progress}/{$achiev.count}</span>
							</div>
						{/if}
					</div>
				{/foreach}
			</div>
{/capture}

{capture name=achive_list}			
			<p><h2>{$lang_achievs}</h2>
				<span>{$lang_achievs}</span><br />
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
	{$smarty.capture.achive}
{elseif $plrs==1}
	{$smarty.capture.player_achive}
{else}
	{$smarty.capture.achive_list}
{/if}
