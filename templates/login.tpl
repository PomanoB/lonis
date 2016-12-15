			<center>
			<p><h2>{#langTitleGameAcc#}</h2>
			<p><div style="color: red;">{$message}</div>
			<p><a href="{$baseUrl}/?action=steam_login">{#imgSteamLogin#}</a>
			
			<form action="index.php?action=login" method="post">
				<table border="0" style="width: 50%;" align="center" cellpadding=2>
					<tr>
						<td colspan="2" align="center"><h2>{#lang_login#}</h2></td>
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
						<td colspan="2" align="center"><br><button>{#lang_login#}</button></td> 
					</tr>
				</table>	
			</form><br>
			<p><h3><a href="{$baseUrl}/reg">{#lang_reg#}</a></h3>
			</center>