{if $act=="achievs"}
	<p><div class="titles">
		<a href="{$baseUrl}/achiev/">{$langs.achiev}</a>
		::
		{$langs.achiev_players}
	</div>
	
	{if isset($rows)}
	<p>&nbsp;{$pages.output}
	
	<div style="padding:10px;">
		{foreach from=$rows item=player}
		<div class="achiev">
			<b><a href="{$baseUrl}/{$player.name}/achiev/">{$player.name|escape}</a></b>
			<br />
			<span>{$langs.achievPlayerTotal} {$player.achiev_total}</span>
		</div>
		{/foreach}
	</div>
	{/if}	
{else}
{if $aname && $aname!=""}

	<p><div class="titles">
		{$langs.achiev}
	</div>
	
	<div style="padding:10px;">
		<p></p>
		<div class="achiev achiev_completed">
			<b>{$achiev.name}</b>
			<br />
			<span>{$achiev.desc}</span>
		</div>
		
	{if isset($rows)}
		<p>&nbsp;{$pages.output}
		
	{foreach from=$rows item=player}
		<div class="achiev">
			<b><a href="{$baseUrl}/{$player.plname_url}/achiev/">{$player.plname|escape}</a></b>
			<br />
			<span>{$langs.achievPlayerTotal} {$player.achiev_total}</span>
		</div>
	{/foreach}
	{/if}
	</div>

	
{elseif $name && $name!=""}

	<p><div class="titles">
		{$langs.achiev} :: <i>{$name|escape}</i>
	</div>

	{if isset($rows)}
	<div style="padding:10px;">
	<p>&nbsp;{$pages.output}
		
	{foreach from=$rows item=achiev}
		<div class="achiev{if $achiev.count == $achiev.progress} achiev_completed{/if}">
			<b><a href="{$baseUrl}/achiev/{$achiev.name}">{$achiev.name}</a></b>
			<br />
			<span>{$achiev.desc}</span>
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
	{/if}
	
{else}

	<p><div class="titles">
		{$langs.achiev} :: <a href="{$baseUrl}/achievs/">{$langs.achiev_players}</a>
	</div>
	
	{if isset($rows)}
	<p>&nbsp;{$pages.output}
	
	<table>
	{foreach from=$rows item=achiev}
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
					<div style="background-color: #464647; width: {$achiev.completed}%;overflow: visible;">
						<div style="width: 550px;padding: 10px;">
							<span style="float:right;margin-top:10px;margin-right:20px">{$achiev.completed}%</span>
							<b><a href="{$baseUrl}/achiev/{$achiev.name}">{$achiev.name}</a></b>
							<br />
							<span style="width:450px;display: inline-block;">{$achiev.desc}</span>
						</div>
					</div>
				</div>
			</td>
		</tr>
	{/foreach}
	</table>	
	{/if}
{/if}
{/if}