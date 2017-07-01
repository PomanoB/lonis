<? 

$text = isset($_POST["text"]) ? $_POST["text"] : ""; $md5 = md5($text);

$iHtml = '
<h2>Generate md5 password.</h2>
<form method="post">
	<p><b>Text:</b> <input type="text" name="text" value="{$text}"> <input type="submit" value="Генерировать">
	<p><b>md5:</b> {$md5}
</form>
';

foreach($GLOBALS as $var=>$value) if(!is_array($value)) $iHtml = str_replace('{$'.$var.'}', $$var, $iHtml);

echo $iHtml;