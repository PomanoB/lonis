			<center>
			<p><h2>{$lang_regTitle}</h2>
			<p><div style="color: red;">{$message}</div>
			<p><a href="{$baseUrl}/steam/"><img src='{$baseUrl}/img/sits_small_{$lang}.png'></a>
			
			<form action="{$baseUrl}/reg" method="post">
				<p><table border="0" align="center" cellpadding=2>
					<tr>
						<td class="info">
							<label for="reg_nick">{$langName}</label>
						</td>
						<td>
							<input type="text" class="bigform" name="reg_nick" id="reg_nick" />
						</td>
					</tr>
					<tr>
						<td class="info">
							<label for="reg_password">{$langPassword}</label>
						</td>
						<td>
							<input type="password" class="bigform" name="reg_password" id="reg_password" /><br>
							<input type="checkbox" id="showPassword"/><label for="showPassword" class="info">Показать пароль</label>
							<p>
						</td>
					</tr>
					<tr>
						<td class="info">
							<label for="email">{$langEmail}</label>
						</td>
						<td>
							<input type="text" class="bigform" name="email" id="email" />
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center"><br><button>{$lang_reg}</button></td>
					</tr>
				</table>
			</form>
			</center>