<div class="page_wrapper">
<? if($pages['total']>1): ?>
	<? if($pages['page']>2): ?> 
		<div class="page_num"><a href="<?=str_replace("%page%", 1, $pages['url'])?>">1</a></div>
	<? endif; ?>
	<? if($pages['page']>1): ?>
		<div class="page_num"><a href="<?=str_replace("%page%", ($pages['page']-1), $pages['url'])?>"><?=($pages['page']-1)?></a></div>
	<? endif; ?>
		<div class="page_num"><?=$pages['page']?></div>
	<? if($pages['page']<$pages['total']): ?>
		<div class="page_num"><a href="<?=str_replace("%page%", ($pages['page']+1), $pages['url'])?>"><?=($pages['page']+1)?></a></div>
	<? endif; ?>
	<? if($pages['page']<($pages['total']-1)): ?>
		<div class="page_num"><a href="<?=str_replace("%page%", $pages['total'], $pages['url'])?>"><?=$pages['total']?></a></div>
	<? endif; ?>
<? endif ?>
</div>