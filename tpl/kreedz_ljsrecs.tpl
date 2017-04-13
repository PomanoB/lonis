	<div class="titles" align="center">
		<p>.: {langs('LJ Records')} :. 
	</div>
	
	<div class="titles" align="center">:: 
	{foreach from=$titles key=k item=t}
		{$uline=""}{if $comm==$t.name}{$uline = 'style="text-decoration: underline;"'}{/if}
		<a href="{$baseUrl}/kreedz/ljsrecs/{$t.name}" {$uline}>{$t.fullname}</a> ::
	{foreachelse}
	{/foreach}
	</div>
	
{foreach from=$jumps item=j}
	{if $lasttype!=$j.type}
	<div class="titles" align="center">
		<p><i>{$j.type_name}</i>&nbsp;<i class="ljs ljs-{$j.type}" title="{$j.type}"></i></p>
	</div>
	{/if}
	
	<div class="table list" style="width: 75%">
	{if $lasttype!=$j.type}
	{$num=0}
		<div class="tr title">
			<div>№</div>
			<div>{langs('Name')}</div>
			<div>{langs('Distance')}</div>
			<div>{langs('Block')}</div>
			<div>{langs('Prestrafe')}</div>
			<div>{langs('Speed')}</div>
		</div>
	{/if}
	{$lasttype = $j.type}
		<div class="tr row" align="left">
			<div style="width:5%;">
			{$num=$num+1}
			{if $num<4}
				<i class="fa fa-trophy" style="color: {$cup_color[$num]};" title="{$num}" alt="{$num}"></i>
			{else}
				{$num}
			{/if}
			</div>
			<div style="width:35%;">{$j.plname}</div>
			<div style="width:15%;">{$j.distance}</div>
			<div style="width:15%;">{$j.block}</div>
			<div style="width:15%;">{$j.prestrafe}</div>
			<div style="width:15%;">{$j.speed}</div>	
		</div>
	</div>
{foreachelse}
{/foreach}