			<center>
			<p><h2>{$langs.login}</h2>
			<p><div style="color: red;">{$message}</div>
			<p><a href="{$baseUrl}/?action=steam_login"><img src='{$baseUrl}/img/sits_small_{$lang}.png'></a>
			
			<form action="{$baseUrl}/login" method="post">
				<table border="0" align="center" cellpadding=2>
					<tr>
						<td class="info">
							<label for="reg_nick">{$langs.Name}</label>
						</td>
						<td>
							<input type="text" class="bigform" name="reg_nick" id="reg_nick" />
						</td>
					</tr>
					<tr>
						<td class="info">
							<label for="reg_password">{$langs.Password}</label>
						</td>
						<td>
							<input type="password" class="bigform" name="reg_password" id="reg_password" />
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center"><br><button>{$langs.login}</button></td> 
					</tr>
				</table>	
			</form><br>
			</center>