<? if($user): ?>
	<center>
	<div style="display: inline-table; margin: 0 auto;">
		<div class="titles"><?=langs('Game account')?> :: <a title="<?=langs('Logout')?>" href="<?=$bUrl?>/logout/"><?=langs('Logout')?></a></div><br>
	<? if($player['active'] == 0): ?>
		<div class="message"><?=langs('Account inactive!')?></div>
	<? elseif($player['active'] == 2): ?>
		<div class="message"><?=langs('You are banned!!!')?></div>
	<? elseif($player['active'] == 1): ?>
		<? if(isset($message['msg'])): ?><div class="err_message"><?=$message['msg']?></div><? endif; ?>
		
		<div style="float: left; padding: 10px;">
			<a href="<?=$bUrl?>/#" target="_blank">
				<img src="<?=$bTheme?>/img/players/avatarfull/<?=$player['id']?>.jpg" class="image_c" alt="<?=$player['name']?>" />
			</a>
			<form action="" method="post">
				<p><button name="avatarUpdate"><?=langs('Update')?></button>
			</form>
		</div>
		<div style="float: left; padding: 10px;">
			<form action="" method="post">
			<div cellpadding="5">
				<div>
					<div align="right"><label for="name"><?=langs('Name')?></label>: </div>
					<div><input type="text" class="bigform" name="name" id="name" value="<?=$player['name']?>" /></div>
				</div>
				<? if($player['steam_id_64']): ?>
				<div>
					<div align="right"><label for="steam_id"><?=langs('Steam ID')?></label>: </div>
					<div><input type="text" class="bigform" name="steam_id" id="steam_id" value="<?=$player['steam_id']?>" placeholder="<?=langs('Steam ID')?>" readonly /></div>
				</div>
				<? else: ?>
				<div>
					<div align="right"><label for="password"><?=langs('Password')?></label>: </div>
					<div><input type="password" class="bigform" name="password" id="password" placeholder="<?=langs('Password')?>" /></div>
				</div>
				<div>
					<div align="right"><label for="ip"><?=langs('IP')?></label>: </div>
					<div><input type="text" class="bigform" name="ip" id="ip" value="<?=$player['ip']?>" placeholder="<?=langs('IP')?>" /></div>
				</div>
				<div>
					<div align="right"><label for="steam_id"><?=langs('Steam ID')?></label>: </div>
					<div><input type="text" class="bigform" name="steam_id" id="steam_id" value="<?=$player['steam_id']?>" placeholder="<?=langs('Steam ID')?>"/></div>
				</div>
				<!-- // Choose auth
				<div>
					<div align="right"><label for="authType"><?=langs('The type of authorization')?></label>: </div>
					<div>
						<select name="authType" id="authType" class="bigform" style="width: 225px;">
							<option value="0" style=""><?=langs('Username and password')?></option>
							<option value="1" <? if($player.auth==1): ?>selected="selected"<? endif; ?>><?=langs('Steam ID')?></option>
							<option value="2" <? if($player.auth==2): ?>selected="selected"<? endif; ?>><?=langs('IP')?></option>
						</select>
					</div>
				</div>
				-->
				<? endif; ?>
			
			<? foreach($addFlags as $flag): ?>
				<div>
					<div align="right"><label for="<?=$flag['flag']?>"><?=$flag['lang']?></label></div>
					<div><input type="checkbox" name="<?=$flag['flag']?>" <? if($flag['checked']): ?>checked="checked"<? endif; ?> /></div>
				</div>
			<? endforeach; ?>
			
				<div>
					<div align="center" colspan="2"><br><h2><?=langs('Personal Data')?></h2></div>
				</div>
				<div>
					<div align="right"><label for="icq"><?=langs('ICQ')?></label>: </div>
					<div><input type="text" class="bigform" name="icq" id="icq" value="<?=$player['icq']?>" placeholder="<?=langs('ICQ')?>"></div>
				</div>
			</div>
			
			<p><div><button><?=langs('Update')?></button></div></p>
			</form>
		</div>
	<? endif; ?>
	</div>
	</center>
<? endif; ?>