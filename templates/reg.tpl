			<script type="text/javascript" src="templates/js/reg.js"></script>
			<div class="settingsPanel">
				<h2>{#langRegisterTitle#}</h2>
				
				
				<form action="reg" method="post">
					<table border="0">
						<tr>
							<td>{#langSteamLogin#}</td>
							<td>
								<a href="{$baseUrl}/?action=steam_login">
									<img src="http://steamcommunity.com/public/images/signinthroughsteam/sits_small.png" />
								</a>
							</td>
						</tr>
						<tr>
							<td colspan="2">{#langNoSteamLogin#}</td>
						</tr>
						<tr>
							<td class="info">
								<label for="reg_nick">{#langName#}</label>
							</td>
							<td>
								<input type="text" class="ucp" name="reg_nick" id="reg_nick" />
							</td>
						</tr>
						<tr>
							<td class="info">
								<label for="reg_password">{#langPassword#}</label>
							</td>
							<td>
								<input type="password" class="ucp" name="reg_password" id="reg_password" />
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="checkbox" id="showPassword"/><label for="showPassword">Показать пароль</label>
							</td>
						</tr>
						<tr>
							<td class="info">
								<label for="email">{#langEmail#}</label>
							</td>
							<td>
								<input type="text" class="ucp" name="email" id="email" />
							</td>
						</tr>
					</table>
					<div align="right"><input type="submit" value="{#langRegister#}" /></div>
				</form>
			</div>