			<p><div class="settingsPanel">
				<h2>{#langRegisterTitle#}</h2>
{if isset($error)}
				<div>{#langAlreadyUsed#}</div>
{/if}
				<table border="0">
					<form action="{$baseUrl}/steam_login" method="post">
					<tr>
						<td class="info">
							<label for="reg_nick">{#langName#}</label>
						</td>
						<td>
							<input type="text" class="ucp" name="reg_nick" id="reg_nick" value="{$steamName}" />
						</td>
					</tr>
				</table>
				<div align="right"><input type="submit" value="{#langRegister#}" /></div>
			</div>