{if $user}
	<center>
	<div style="display: inline-table; margin: 0 auto;">
		<div class="titles">{langs('Game account')} :: <a title="{langs('Logout')}" href="{$baseUrl}/logout/">{langs('Logout')}</a></div><br>
	{if $player.active == 0}
		<div class="message">{langs('Account inactive!')}</div>
	{elseif $player.active == 2}
		<div class="message">{langs('You are banned!!!')}</div>
	{elseif $player.active == 1}
		{if isset($message.msg)}<div class="err_message">{$message.msg}</div>{/if}
		
		<div style="float: left; padding: 10px;">
			<a href="#" target="_blank">
				<img src="{$player.avatar.img}" class="image_c" alt="{$player.name|escape}" />
			</a>
			<form action="" method="post">
				<p><button name="avatarUpdate">{langs('Update')}</button>
			</form>
		</div>
		<div style="float: left; padding: 10px;">
			<form action="" method="post">
			<div cellpadding="5">
				<div>
					<div align="right"><label for="name">{langs('Name')}</label>: </div>
					<div><input type="text" class="bigform" name="name" id="name" value="{$player.name|escape}" /></div>
				</div>
				{if $player.steam_id_64}
				<div>
					<div align="right"><label for="steam_id">{langs('Steam ID')}</label>: </div>
					<div><input type="text" class="bigform" name="steam_id" id="steam_id" value="{$player.steam_id}" placeholder="{langs('Steam ID')}" readonly /></div>
				</div>
				{else}
				<div>
					<div align="right"><label for="password">{langs('Password')}</label>: </div>
					<div><input type="password" class="bigform" name="password" id="password" placeholder="{langs('Password')}" /></div>
				</div>
				<div>
					<div align="right"><label for="ip">{langs('IP')}</label>: </div>
					<div><input type="text" class="bigform" name="ip" id="ip" value="{$player.ip}" placeholder="{langs('IP')}" /></div>
				</div>
				<div>
					<div align="right"><label for="steam_id">{langs('Steam ID')}</label>: </div>
					<div><input type="text" class="bigform" name="steam_id" id="steam_id" value="{$player.steam_id}" placeholder="{langs('Steam ID')}"/></div>
				</div>
				{* // Choose auth
				<div>
					<div align="right"><label for="authType">{langs('The type of authorization')}</label>: </div>
					<div>
						<select name="authType" id="authType" class="bigform" style="width: 225px;">
							<option value="0" style="">{langs('Username and password')}</option>
							<option value="1" {if $player.auth==1}selected="selected"{/if}>{langs('Steam ID')}</option>
							<option value="2" {if $player.auth==2}selected="selected"{/if}>{langs('IP')}</option>
						</select>
					</div>
				</div>
				*}
				{/if}
			
			{foreach from=$addFlags item=flag}
				<div>
					<div align="right"><label for="{$flag.flag}">{$flag.lang}</label></div>
					<div><input type="checkbox" name="{$flag.flag}" {if $flag.checked}checked="checked"{/if} /></div>
				</div>
			{foreachelse}
			{/foreach}
				<div>
					<div align="center" colspan="2"><br><h2>{langs('Personal Data')}</h2></div>
				</div>
				<div>
					<div align="right"><label for="icq">{langs('ICQ')}</label>: </div>
					<div><input type="text" class="bigform" name="icq" id="icq" value="{$player.icq}" placeholder="{langs('ICQ')}"></div>
				</div>
			</div>
			
			<p><div><button>{langs('Update')}</button></div></p>
			</form>
		</div>
	{/if}
	</div>
	</center>
{else}
	<div align="center">	
		<div class="titles">
			{langs('Authorization')}
		</div><br>
		<a href="{$baseUrl}/steam/"><img src="{$baseUrl}/{$dimg}/singsteam.png"/></a>
		
		{if isset($message.msg)}<div style="padding: 5px; color: red;">{$message.msg}</div>{/if}
		
		<div align="center" style="">
			<div class="auth_wrapper">
				<h2>{langs('Login')}</h2>
				<p>
				<form action="" method="post">
				<div class="table">
					<div class="tr">
						<div>
							<input type="text" class="bigform" name="login_user" id="login_user" value="{if isset($info.login_user)}{$info.login_user}{/if}"
								placeholder=" {langs('Name')} / {langs('Email')}"/>
							{if isset($message.login_user)}<div style="text-align: right; color: red;">{$message.login_user}</div>{/if}
						</div>
					</div><br>
					<div class="tr">
						<div>
							<input type="password" class="bigform" name="login_password" id="login_password"
								placeholder=" {langs('Password')}"/>
						</div>
					</div>
					{if isset($message.login_password)}<div><div colspan="2" style="text-align: right; color: red;">{$message.login_password}</div></div>{/if}
				</div>
				{if isset($message.login)}<div style="padding: 5px; color: red;">{$message.login}</div>{/if}
				<div style="padding: 10px;">
					<button name="act" value="login">{langs('Login')}</button>
				</div>
				</form>
				
				
				{*<div class="sing_steam">
					<div class="caption">
						<a href="{$baseUrl}/steam/">{langs("Sing in through<br>STEAM")}</a>
					</div>
					<div class="icon">
						<i class="fa fa-steam-square fa-3x"></i>
					</div>
				</div>*}
			</div>
			
			<div class="auth_wrapper">
				<h2>{langs('Registration')}</h2>
				<p>
				<form action="" method="post">
				<div class="table">
					<div class="tr">
						<div align="right"><label for="new_nick"></label></div>
						<div>
							<input type="text" class="bigform" name="new_nick" id="new_nick" value="{if isset($info.new_nick)}{$info.new_nick}{/if}"
								placeholder="{langs('Name')}"/>
							{if isset($message.nick)}<div style="text-align: right; color: red;">{$message.nick}</div>{/if}
						</div>
					</div>
					<br>
					<div class="tr">
						<div align="right"><label for="new_email"></label></div>
						<div>
							<input type="text" class="bigform" name="new_email" id="new_email" value="{if isset($info.new_email)}{$info.new_email}{/if}"
								placeholder="{langs('Email')}" />
							{if isset($message.email)}<div style="text-align: right; color: red;">{$message.email}</div>{/if}
						</div>
						
					</div>
					<br>
					<div class="tr">
						<div align="right"><label for="new_password"></label></div>
						<div>
							<input type="password" class="bigform" name="new_password" id="new_password" placeholder="{langs('Password')}"/>
							{if isset($message.password)}<div style="text-align: right; color: red;">{$message.password}</div>{/if}
						</div>
					</div>
				</div>
				{if isset($message.reg)}<div style="padding: 5px; color: red; word-break: break-all;">{$message.reg}</div>{/if}
				<div style="padding: 10px;">
					<button name="act" value="reg">{langs('Register')}</button>
					{*<button name="act" value="reset">{langs('Reset')} {langs('Password')}</button>*}
				</div>
				</form>
			</div>
		</div>
	</div>
{/if}