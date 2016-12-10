				<h2>{#langTitleGameAcc#}</h2>
				<form action="index.php?action=login" method="post">
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
					</table>
					<div align="right"><input type="submit" value="{#langLogin#}" /></div> 
				</form>