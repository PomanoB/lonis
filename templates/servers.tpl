	<div class="wrapper">		
		<div class="titles left_block">
			{langs('Servers')} {if $addr} :: <i>{$addr}</i>{/if}
		</div>
		<div class="right_block">
			<div id="search">
				<form action="" method="post">
					<input type="text" name="addr" value="{if isset($addr)}{$addr}{/if}" placeholder="{langs('Check IP')}" />
					<button title="{langs('Check IP')}" alt="{langs('Check IP')}"/>
				</form>
			</div>
		</div>
	</div><br><br>
	
	<center>
{if $addr && $addr!="vip"}
	{if $message}
		<p><div class="err_message">{$message}</div>
	{else}
		<p><table id="servers">
			<tr style="vertical-align: top;">
				<td width="400" align="center">	
					{if isset($info.img)}<img class="map_image" src="{$info.img}" id="mapimg" oncontextmenu="return false;" >{/if}
					<table class="sinfo" align="center">
						<tr><td class="th" width="100">{langs('IP')}</td><td>{$info.ip}</td></tr>
						<tr><td class="th">{langs('Name')}</td><td>{$info.name}</td>
						<tr><td class="th">{langs('Map')}</td><td>{$info.map}</td>
						<tr><td class="th">{langs('Mod')}</td><td>{$info.mod}</td>
						<tr><td class="th">{langs('Descriptor')}</td><td>{$info.descriptor}</td>
						<tr><td class="th">{langs('Players')}</td><td>{$info.players} / {$info.max_players}</td>
						<tr><td class="th">{langs('Type')}</td><td>{$info.type}</td>
						<tr><td class="th">{langs('OS')}</td><td>{$info.os}</td>
						<tr><td class="th">{langs('Bots')}</td><td>{$info.bots}</td>
					</table>
				</td>
				<td>
				
					<table class="splayers">
						<tr>
							<td width=200><b>{langs('Player')}</b></td>
							<td><b>{langs('Frags')}</b></td>
						</tr>
				{if $players}
					{foreach from=$players item=plr}
						<tr>
							<td>{$plr.name}</td>
							<td>{$plr.frag}</td>
						</tr>
					{/foreach}
				{else}
					<tr><td colspan="2">{langs('Error')}</td></tr>
				{/if}
					</table>
				</td>
			</tr>
		</table>
	{/if}
{else}

	{$pages.output}
	
	<table class="table-list">
		<tr class="title">
			<td>{langs('Name')}</td>
			<td>{langs('Type')}</td>
			<td>{langs('IP')}</td>
			<td>{langs('Map')}</td>
			<td>{langs('Players')}</td>
			<td>{langs('Time')}</td>
		{if $admin}
			<td></td>
		{/if}
		</tr>
	{foreach from=$servers item=row}
		<tr class="list">
			<td>{if $row.vip==1}<i class="fa fa-star" style="color: gold;" title="VIP" alt="VIP"/></i> {/if}{$row.name}</td>			
			<td>{$row.modname}</td>
			<td><a href='{$baseUrl}/servers/{$row.addres}'><b>{$row.addres}</b></a></td>
			<td>{$row.map}</td>			
			<td>{if $row.max_players}{$row.players} / {$row.max_players}{/if}</td>
			<td><i>{$row.updatef}</i></td>
		</tr>
	{foreachelse}
	{/foreach}
	</table>
{/if}
	</center>