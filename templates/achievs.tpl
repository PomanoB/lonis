{if $act=="achievs"}
	<p><div class="titles" align="center">
		<a href="{$baseUrl}/achiev/">{langs('Achievs')}</a>
		::
		{langs('Achievs players')}
	</div><br>
	{if isset($rows)}
	{$pages.output}
	
	
	<div class="achiev_wrapper" align="center">
	<table>
	{foreach from=$rows item=player}
		<tr>
			<td>
				<img src="{$player.avatar}" width="60" height="60" class="image_c" alt="{$player.plname|escape}" />
			</td>
			<td>
				<div class="achiev">
					<b><a href="{$baseUrl}/{$player.name}/achiev/">{$player.name|escape}</a></b>
					<br />
					<span>{langs('Just completed the achievements:')} {$player.achiev_total}</span>
				</div>
			</td>
		</tr>
	{/foreach}
	</table>
	</div>
	{/if}	
{else}
{if $aname && $aname!=""}

	<p><div class="titles" align="center">
		{langs('Achievs')}
	</div><br>
	
	<div class="achiev_wrapper" align="center">
	<table>
		<tr>
			<td>
				<img src="http://gravatar.com/avatar/{md5($achiev.id)}?d=identicon&s=60" />
				{*<i class="fa fa-4x {$achiev.icon}">*}
				{*<img src="{$achiev.img}" width="60" height="60"/>*}
			</td>
			<td>
				<div class="achiev achiev_completed">
					<b>{$achiev.name}</b>
					<br />
					<span>{$achiev.desc}</span>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				{$pages.output}
			</td>
		</tr>
	{foreach from=$rows item=player}
		<tr>
			<td>
				<img src="{$player.avatar}" width="60" height="60" class="image_c" alt="{$player.plname|escape}" />
			</td>
			<td>
				<div class="achiev">
					<b><a href="{$baseUrl}/{$player.plname_url}/achiev/">{$player.plname|escape}</a></b>
					<br />
					<span>{langs('Just completed the achievements:')} {$player.achiev_total}</span>
				</div>
			</td>
		</tr>
	{/foreach}
	</table>
	</div>

	
{elseif $name && $name!=""}

	<p><div class="titles" align="center">
		{langs('Achievs')} :: <i>{$name|escape}</i>
	</div><br>

	{if isset($rows)}
	<div class="achiev_wrapper" align="center">	
	<table>	
	{foreach from=$rows item=achiev}
		<tr>
			<td>
				<img src="http://gravatar.com/avatar/{md5($achiev.id)}?d=identicon&s=50" />
				{*<i class="fa fa-4x {$achiev.icon}">*}
				{*<img src="{$achiev.img}" width="60" height="60"/>*}
			</td>
			<td>
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
						{langs('Unlocked')}{$achiev.unlocked|date_format:"%d.%m.%Y %H:%M"}
					</div>
				{/if}
				</div>
			</td>
		</tr>
	{/foreach}
	</table>
	</div>
	{/if}
	
{else}

	<p><div class="titles" align="center">
		{langs('Achievs')} :: <a href="{$baseUrl}/achievs/">{langs('Achievs players')}</a>
	</div>
	
	{if isset($rows)}
	{$pages.output}
	
	<div class="achiev_wrapper" align="center">
		<table>
		{foreach from=$rows item=achiev}
			<tr>
				<td>
					<img src="http://gravatar.com/avatar/{md5($achiev.aId)}?d=identicon&s=50" />
					{*<i class="fa fa-4x {$achiev.icon}">*}
					{*<img src="{$achiev.img}" width="60" height="60"/>*}
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
	</div>
{/if}
{/if}