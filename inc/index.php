<?
$filename = $_SERVER["SCRIPT_FILENAME"];
$pos = strripos($filename, "/");
$len = strlen($filename);
$filename = substr($filename, $pos-$len, $len);

$baseUrl = str_replace($filename, "", $_SERVER["PHP_SELF"]);
$pos = strripos($baseUrl, "/");
$len = strlen($baseUrl);
echo $baseUrl = substr($baseUrl, 0, $pos+1);
$endUrl = substr($baseUrl, $pos-$len, $len);
header("Location: $baseUrl");
?>