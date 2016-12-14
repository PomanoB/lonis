			<center>
			<p><h2>{#langTitleGameAcc#}</h2>
			<p><div style="color: red;">{$message}</div>
			<p><a href="{$baseUrl}/?action=steam_login">{#imgSteamLogin#}</a>
			
{if $action=="login"}
			<form action="index.php?action=login" method="post">
				<table border="0" style="width: 50%;" align="center" cellpadding=2>
					<tr>
						<td colspan="2" align="center"><h2>{#langLogin#}</h2></td>
					</tr>
					<tr>
						<td class="info">
							<label for="reg_nick">{#langName#}</label>
						</td>
						<td>
							<input type="text" class="bigform" name="reg_nick" id="reg_nick" />
						</td>
					</tr>
					<tr>
						<td class="info">
							<label for="reg_password">{#langPassword#}</label>
						</td>
						<td>
							<input type="password" class="bigform" name="reg_password" id="reg_password" />
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center"><br><button>{#langLogin#}</button></td> 
					</tr>
				</table>	
			</form><br>
			<p><h3><a href="{$baseUrl}/reg">{#langRegister#}</a></h3>
{/if}

{if $action=="reg"}			
			<script type="text/javascript" src="templates/js/reg.js"></script>
			<p><h2>{#langRegisterTitle#}</h2>
			
			<form action="{$baseUrl}/reg" method="post">
				<p><table border="0" style="width: 50%;" align="center" cellpadding=2>
					<tr>
						<td class="info">
							<label for="reg_nick">{#langName#}</label>
						</td>
						<td>
							<input type="text" class="bigform" name="reg_nick" id="reg_nick" />
						</td>
					</tr>
					<tr>
						<td class="info">
							<label for="reg_password">{#langPassword#}</label>
						</td>
						<td>
							<input type="password" class="bigform" name="reg_password" id="reg_password" />
							<input type="checkbox" id="showPassword"/><label for="showPassword" class="info">Показать пароль</label>
						</td>
					</tr>
					<tr>
						<td class="info">
							<label for="email">{#langEmail#}</label>
						</td>
						<td>
							<input type="text" class="bigform" name="email" id="email" />
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center"><br><button>{#langRegister#}</button></td>
					</tr>
				</table>
			</form>
{/if}
			</center>