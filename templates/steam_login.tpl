			<p><div class="settingsPanel">
				<h2>{$langs.regTitle}</h2>
{if isset($error)}
				<div>{$langs.AlreadyUsed}</div>
{/if}
				<table border="0">
					<form action="{$baseUrl}/steam_login" method="post">
					<tr>
						<td class="info">
							<label for="reg_nick">{$langs.Name}</label>
						</td>
						<td>
							<input type="text" class="ucp" name="reg_nick" id="reg_nick" value="{if isset($steamName)}{$steamName}{/if}" />
						</td>
					</tr>
				</table>
				<div align="right"><input type="submit" value="{$langs.reg}" /></div>
			</div>