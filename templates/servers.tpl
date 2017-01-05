	<center>
{if $addr}
	<p><h2>{$lang_servers}</h2>
	{if $message}
		<p><div class="error_message">{$message}</div>
	{else}
	<p><table id="servers">
		<tr style="vertical-align: top;">
			<td width="400" align="center">	
				<img src="{$info.img}" id='mapimg'>
				<table class="sinfo" align="center">
					<tr><td class="th" width="100">{$langIP}</td><td>{$addr}</td></tr>
					<tr><td class="th" width="100">{$langIP}</td><td>{$info.ip}</td></tr>
					<tr><td class="th">{$langName}</td><td>{$info.name}</td>
					<tr><td class="th">{$langMap}</td><td>{$info.map}</td>
					<tr><td class="th">{$langMod}</td><td>{$info.mod}</td>
					<tr><td class="th">{$langDescriptor}</td><td>{$info.descriptor}</td>
					<tr><td class="th">{$lang_players}</td><td>{$info.players} / {$info.max_players}</td>
					<tr><td class="th">{$langType}</td><td>{$info.type}</td>
					<tr><td class="th">{$langOS}</td><td>{$info.os}</td>
					<tr><td class="th">{$langBots}</td><td>{$info.bots}</td>
				</table>
			</td>
			<td>
				<table class="splayers">
					<tr>
						<td width=200><b>{$lang_player}</b></td>
						<td><b>{$langFrags}</b></td>
					</tr>	
				{foreach from=$players item=plr}
					<tr>
						<td>{$plr.name}</td>
						<td>{$plr.frag}</td>
					</tr>
				{/foreach}
				</table>
			</td>
		</tr>
	</table>
	{/if}
{else}
	<p><h2>{$langWelcome}<br><i>{$server_name}</i></h2>
	
	<p><table class="table-list">
		<tr class="title">
			<td>#</td>
			<td>{$langIP}</td>
			<td>{$langType}</td>
			<td>{$langName}</td>
			<td>{$langMap}</td>
			<td>{$lang_players}</td>
			<td>{$langTime}</td>
		</tr>
	{foreach from=$servers key=key item=serv}
		<tr class="list">
			<td>{$key+1}</td>
			<td><a href='{$baseUrl}/servers/{$serv.addres}'><b>{$serv.addres}</b></a></td>
			<td>{$serv.modname}</td>
			<td>{$serv.name}</td>
			<td>{$serv.map}</td>			
			<td>{$serv.players} / {$serv.max_players}</td>
			<td><i>{$serv.update}</i></td>
		</tr>
	{/foreach}
	</table>
	
	<form action="{$baseUrl}/servers" method="post">
	<p><div align="center"><input type="text" name="addr" />&nbsp;<button class="but">{$langCheck} {$langIP}</button></div>
	</form>
{/if}
	</center>

