	<div class="wrapper">		
		<div class="titles left_block">
			{$langs.servers} {if $addr} :: <i>{$addr}</i>{/if}
		</div>
{if !$cs}
		<div class="right_block">
			<form action="{$baseUrl}/servers/" method="post">
				<input type="text" name="addr" value="{if isset($map)}{$map}{/if}" placeholder="{$langs.Check} {$langs.IP}" />
				<input type="image" name="picture" src="{$baseUrl}/img/find.png" title="{$langs.Check} {$langs.IP}" alt="{$langs.Check} {$langs.IP}"/>
			</form>
			&nbsp;
		</div>
{/if}
	</div><br>
	
	<center>
{if $addr && $addr!="vip"}
	{if $message}
		<p><div class="err_message">{$message}</div>
	{else}
		<p><table id="servers">
			<tr style="vertical-align: top;">
				<td width="400" align="center">	
					{if isset($info.img)}<img src="{$info.img}" id="mapimg" oncontextmenu="return false;" >{/if}
					<table class="sinfo" align="center">
						<tr><td class="th" width="100">{$langs.IP}</td><td>{$info.ip}</td></tr>
						<tr><td class="th">{$langs.Name}</td><td>{$info.name}</td>
						<tr><td class="th">{$langs.Map}</td><td>{$info.map}</td>
						<tr><td class="th">{$langs.Mod}</td><td>{$info.mod}</td>
						<tr><td class="th">{$langs.Descriptor}</td><td>{$info.descriptor}</td>
						<tr><td class="th">{$langs.players}</td><td>{$info.players} / {$info.max_players}</td>
						<tr><td class="th">{$langs.Type}</td><td>{$info.type}</td>
						<tr><td class="th">{$langs.OS}</td><td>{$info.os}</td>
						<tr><td class="th">{$langs.Bots}</td><td>{$info.bots}</td>
					</table>
				</td>
				<td>
				
					<table class="splayers">
						<tr>
							<td width=200><b>{$langs.player}</b></td>
							<td><b>{$langs.Frags}</b></td>
						</tr>
				{if $players}
					{foreach from=$players item=plr}
						<tr>
							<td>{$plr.name}</td>
							<td>{$plr.frag}</td>
						</tr>
					{/foreach}
				{else}
					<tr><td colspan="2">{$langs.Error}</td></tr>
				{/if}
					</table>
				</td>
			</tr>
		</table>
	{/if}
{else}

	<p>&nbsp;{$generate_page}
	
	<p><table class="table-list">
		<tr class="title">
			<td>{$langs.Name}</td>
			<td>{$langs.Type}</td>
			<td>{$langs.IP}</td>
			<td>{$langs.Map}</td>
			<td>{$langs.players}</td>
			<td>{$langs.Time}</td>
			<td>&nbsp;</td>
		{if $webadmin}
			<td></td>
		{/if}
		</tr>
	{foreach from=$servers key=key item=serv}
		<tr class="list">
			<td>{$serv.name}</td>			
			<td>{$serv.modname}</td>
			<td><a href='{$baseUrl}/servers/{$serv.addres}'><b>{$serv.addres}</b></a></td>
			<td>{$serv.map}</td>			
			<td>{if $serv.max_players}{$serv.players} / {$serv.max_players}{/if}</td>
			<td><i>{$serv.update}</i></td>
			<td>{if $serv.vip==1}<img src="{$baseUrl}/img/vip.png" title="VIP" alt="VIP"/>{/if}</td>
		</tr>
	{/foreach}
	</table>
{/if}
	</center><br>