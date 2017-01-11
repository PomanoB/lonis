	<div align="center">	
		<div class="titles">
		{$langs.Authorization} :: <a href="{$baseUrl}/steam/"><img src='{$baseUrl}/img/sits_small_{$lang}.png'></a>
		</div>
		<p><div style="color: red;">{$message}</div></p>
		
		<div align="center" style="">
			<div style="display: inline-block; vertical-align: top; background: #f5f5f5; padding: 10px; margin: 10px; border-radius: 20px;">
				<h2>{$langs.login}</h2>
				<p>
				<form action="{$baseUrl}/auth/" method="post">
					<table cellpadding="5">
						<tr>
							<td align="right"><label for="reg_nick">{$langs.Name}</label>:</td>
							<td><input type="text" class="bigform" name="nick" id="nick" /></td>
						</tr>
						<tr>
							<td align="right"><label for="reg_password">{$langs.Password}</label>:</td>
							<td><input type="password" class="bigform" name="password" id="password" /></td>
						</tr>
					</table>
					<br>
					<div><button name="act" value="login">{$langs.login}</button></div>
				</form>
			</div>
			
			<div style="display: inline-block; background: #f5f5f5; padding: 10px; margin: 10px; border-radius: 20px;">
				<h2>{$langs.regTitle}</h2>
				<p>
				<form action="{$baseUrl}/auth/" method="post">
					<table cellpadding="5">
						<tr>
							<td align="right"><label for="reg_nick">{$langs.Name}</label>:</td>
							<td><input type="text" class="bigform" name="reg_nick" id="reg_nick" /></td>
						</tr>
						<tr>
							<td align="right"><label for="email">{$langs.Email}</label>:</td>
							<td><input type="text" class="bigform" name="email" id="email" /></td>
						</tr>
						<tr>
							<td align="right"><label for="reg_password">{$langs.Password}</label>:</td>
							<td><input type="password" class="bigform" name="reg_password" id="reg_password" /></td>
						</tr>
					</table>
					<br>
					<div><button name="act" value="reg">{$langs.reg}</button></div>
				</form>
			</div>
		</div>
	</div>