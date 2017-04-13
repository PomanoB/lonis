{if $act=="achievs"}
	
	<div class="titles" align="center">
		<a href="{$baseUrl}/achiev/">{langs('Achievs')}</a>
		::
		{langs('Achievs players')}
	</div>
	
	<div class="achiev_wrapper">
		<div style="margin: 10px;">
			{$pages.output}
		</div>

	{foreach from=$rows item=player}
		<div class="achiev">
			<img src="{$player.avatar.img}" width="50" height="50" class="image_c" alt="{$player.plname|escape}" />
			<b><a href="{$baseUrl}/{$player.name}/achiev/">{$player.name|escape}</a></b>
			<br />
			<span>{langs('Just completed the achievements:')} {$player.achiev_total}</span>
		</div>
	{foreachelse}
	{/foreach}
	</div>
{else}
{if $aname && $aname!=""}
	<div class="achiev_wrapper">
		<div class="titles">
			{langs('Achievs')}
		</div><br>
		
		<div class="achiev achiev_completed">
			<img src="{achievImg($achiev.id)}" />
			<b>{$achiev.name}</b>
			<br />
			<text>{$achiev.desc}</text>
		</div>
		
		<div style="margin: 10px;">
			{$pages.output}
		</div>
		
	{foreach from=$rows item=player}
		<div class="achiev">
			<img src="{$player.avatar.img}" class="image_c" alt="{$player.plname|escape}" />
			<b><a href="{$baseUrl}/{$player.plname_url}/achiev/">{$player.plname|escape}</a></b>
			<br />
			<span>{langs('Just completed the achievements:')} {$player.achiev_total}</span>
		</div>
	{foreachelse}
	{/foreach}
	</div>
{elseif $name && $name!=""}

	<div class="titles" align="center">
		{langs('Achievs')} :: <i>{$name|escape}</i>
	</div><br>

	<div class="achiev_wrapper" align="center">	
	{foreach from=$rows item=achiev}
		<div class="achiev {if $achiev.count == $achiev.progress}achiev_completed{/if}">
			<img src="{achievImg($achiev.id)}" />
			<b><a href="{$baseUrl}/achiev/{$achiev.name}">{$achiev.name}</a></b>
			<br>
			<text>{$achiev.desc}</text>
			<br>
		
		{if isset($achiev.width)}
			<div class="progress_background">
				<div class="progress_bar" style="width:{$achiev.width}%"></div>
			</div>
			<span class="progress_counter">{$achiev.progress}/{$achiev.count}</span>
		{elseif isset($achiev.unlocked)}
			<div class="unlocekd_time">
				{langs('Unlocked')}{$achiev.unlocked|date_format:"%d.%m.%Y %H:%M"}
			</div>
		{/if}
		
		</div>
	{foreachelse}
	{/foreach}
	</div>
{else}
	<div class="titles" align="center">
		{langs('Achievs')} :: <a href="{$baseUrl}/achievs/">{langs('Achievs players')}</a>
	</div><br>
	
	<div style="margin: 10px;">
		{$pages.output}
	</div>
	
	<div class="achiev_wrapper">
	{foreach from=$rows item=achiev}
		<div class="achiev">
			<img src="{achievImg($achiev.aId)}"/>
			<b><a href="{$baseUrl}/achiev/{$achiev.name}">{$achiev.name}</a></b>
			<br />
			<span style="width:450px;display: inline-block;">{$achiev.desc}</span>
			
			<div class="progress_background">
				<div class="progress_bar" style="width:{$achiev.completed}%"></div>
			</div>
			<span class="progress_counter">{$achiev.completed}%</span>
		</div>
	{foreachelse}
	{/foreach}
	</div>
{/if}
{/if}