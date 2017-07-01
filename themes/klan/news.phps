<? if($id): ?>
	<section id="news">
		<div class="wrapper">
			<div class="left_block">
				<div class="titles"><?=langs('News')?> :: <?=$post['caption']?></div>
			</div>
			<div class="right_block">
				<form id="search" method="get"><input type="text" name="search" value="<?=$search?>" placeholder="<?=langs('Search')?>"/><button></form>
			</div>
		</div>
		<br><br>
		
		
		<div style="margin: 40px;">
			<div><?=$post['text']?></div>
			<br>
			<div style="font-size: 11px; font-style: italic;"><?=$post['date']?></div>
		</div>
		
		
	</section>
<? else: ?>
	<section id="news">
		<div class="wrapper">
			<div class="left_block">
				<div class="titles"><?=langs('News')?></div>
			</div>
			<div class="right_block">
				<form id="search" method="get"><input type="text" name="search" value="<?=$search?>" placeholder="<?=langs('Search')?>"/><button></form>
			</div>
		</div>
		<br><br>
		<? if($admin==1): ?><center><h3><a href="#newpost"><?=langs('Add News')?></a></h3></center><? endif; ?>
		<p>
		<div class="table list">
			<div class="tr title">
				<div>&nbsp;</div>
				<div></div>
				<div></div>
				<div></div>
			</div>
		<? foreach($news as $row): ?>
			<div class="tr row">
				<div class="date"><?=date("d.m.y h:m", strtotime($row['date']))?></div>
				<div class="caption" ><?=$row['caption']?></div>
				<div class="text">
					<?=$row['text']?>
				</div>
				<div class="button">
					<a class="readmore" href="<?=$bUrl?>/news/post<?=$row['id']?>"><?=langs("More")?></a>
				</div>
			</div>
		<? endforeach; ?>
		</div>
	
	<? $pages['url'] = "$bUrl/news/page%page%/$search"; ?>
	<? include("generate_page.phps"); ?>
	
	</section>
<? endif; ?>

<? if($admin==1): ?>
	<a href="<?=$bUrl?>/#" class="overlay" id="newpost"></a>
	<div class="popup">
		<div id="wrapper">

			<form id="paper" method="get" action="">

				<div id="margin">Title: <input id="title" type="text" name="title"></div>
				<textarea placeholder="Enter something funny." id="text" name="text" rows="4" style="overflow: hidden; word-wrap: break-word; height: 160px; "></textarea>  
				<br>
				<input id="button" type="submit" value="Create">
				
			</form>

		</div>
	</div>

	<script>
	$(document).ready(function(){ $('#title').focus(); $('#text').autosize(); });
	</script>
<? endif; ?>