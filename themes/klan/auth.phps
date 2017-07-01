	<a href="<?=$bUrl?>/#" class="overlay" id="auth"></a>
	<div class="popup">
		<div align="center">
			<div class="titles">
				<?=langs('Authorization')?>
			</div><br>
			<a href="<?=$bUrl?>/steam/"><img src="<?=$bTheme?>/img/singsteam.png"/></a><br>
			
			<div class="auth_wrapper">
				<h2><?=langs('Login')?></h2>
				<p>
				<form action="" method="post">
				<div class="table">
					<div class="tr">
						<div align="right"><label for="login_user"></label></div>
						<div>
							<input type="text" class="bigform" name="login_user" id="login_user" value="<? if(isset($login_user)):?><?=$login_user?><? endif; ?>"
								placeholder=" <?=langs('Name')?> / <?=langs('Email')?>"/>
							<? if(isset($fmsg['login_user'])): ?><div style="text-align: right; color: red;"><?=$fmsg['login_user']?></div><? endif; ?>
						</div>
					</div>
					<div class="tr">
						<div align="right"><label for="login_password"></label></div>
						<div>
							<input type="password" class="bigform" name="login_password" id="login_password"
								placeholder=" <?=langs('Password')?>"/>
							<? if(isset($fmsg['login_password'])): ?><div style="text-align: right; color: red;"><?=$fmsg['login_password']?></div><? endif; ?>
						</div>
					</div>
				</div>
				<? if(isset($fmsg['login'])): ?><div style="padding: 5px; color: red;"><?=$fmsg['login']?></div><? endif; ?>
				<button style="margin-top: 10px;" name="act" value="login"><?=langs('Login')?></button>
				</form>
				
				
				<!--<div class="sing_steam">
					<div class="caption">
						<a href="<?=$bUrl?>/steam/"><?=langs("Sing in through<br>STEAM")?></a>
					</div>
					<div class="icon">
						<i class="icon icon-steam fa-3x"></i>
					</div>
				</div>-->
			</div>
			
			<div class="auth_wrapper">
				<h2><?=langs('Registration')?></h2>
				<p>
				<form action="" method="post">
				<div class="table">
					<div class="tr">
						<div align="right"><label for="new_nick"></label></div>
						<div>
							<input type="text" class="bigform" name="new_nick" id="new_nick" value="<? if(isset($new_nick)):?><?=$new_nick?><? endif; ?>" placeholder=" <?=langs('Name')?>"/>
							<? if(isset($fmsg['nick'])): ?><div style="text-align: right; color: red;"><?=$fmsg['nick']?></div><? endif; ?>
						</div>
					</div>
					<div class="tr">
						<div align="right"><label for="new_email"></label></div>
						<div>
							<input type="text" class="bigform" name="new_email" id="new_email" value="<? if(isset($new_email)):?><?=$new_email?><? endif; ?>"
								placeholder=" <?=langs('Email')?>" />
							<? if(isset($fmsg['email'])):?><div style="text-align: right; color: red;"><?=$fmsg['email']?></div><? endif; ?>
						</div>
						
					</div>
					<div class="tr">
						<div align="right"><label for="new_password"></label></div>
						<div>
							<input type="password" class="bigform" name="new_password" id="new_password" 
								placeholder=" <?=langs('Password')?>"/>
							<? if(isset($fmsg['password'])): ?><div style="text-align: right; color: red;"><?=$fmsg['password']?></div><? endif; ?>
						</div>
					</div>
				</div>
				<? if(isset($fmsg['reg'])): ?><div style="padding: 5px; color: red; word-break: break-all;"><?=$fmsg['reg']?></div><? endif; ?>

				<button style="margin-top: 10px;" name="act" value="reg"><?=langs('Register')?></button>
				<!--<button name="act" value="reset"><?=langs('Reset')?> <?=langs('Password')?></button>-->

				</form>
			</div>
		</div>
		
		<a class="close" href="<?=$bUrl?>/#"></a>
	</div>