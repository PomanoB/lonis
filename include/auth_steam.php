<?php
require 'openid.php';
$steamAIP = "FA568BC0A00A41BE5ADCEB161829770E";
try 
{
    $openid = new LightOpenID('http://leo.apmt.ru/');
    if(!$openid->mode) 
    {
        if(isset($_GET['login'])) 
        {
            $openid->identity = 'http://steamcommunity.com/openid/?l=english'; 
            header('Location: ' . $openid->authUrl());
        }
?>
<form action="?login" method="post">
    <input type="image" src="http://cdn.steamcommunity.com/public/images/signinthroughsteam/sits_small.png">
</form>
<?php
    } 
    elseif($openid->mode == 'cancel') 
    {
        echo 'User has canceled authentication!';
    } 
    else 
    {
        if($openid->validate()) 
        {
                $id = $openid->identity;
                // identity is something like: http://steamcommunity.com/openid/id/76561197960435530
                // we only care about the unique account ID at the end of the URL.
                $ptn = "/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
                preg_match($ptn, $id, $matches);
 
                $url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key={$steamAPI}&steamids=$matches[1]";
                $json_object= file_get_contents($url);
                $json_decoded = json_decode($json_object);
 
                foreach ($json_decoded->response->players as $player)
                {
                    echo "
                    <br/>Player ID: $player->steamid
                    <br/>Player Name: $player->personaname
                    <br/>Profile URL: $player->profileurl
                    <br/>SmallAvatar: <img src='$player->avatar'/> 
                    <br/>MediumAvatar: <img src='$player->avatarmedium'/> 
                    <br/>LargeAvatar: <img src='$player->avatarfull'/> 
                    ";
                }
 
        } 
        else 
        {
                echo "User is not logged in.\n";
        }
    }
} 
catch(ErrorException $e) 
{
    echo $e->getMessage();
}
?>