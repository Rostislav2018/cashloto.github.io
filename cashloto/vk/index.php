<?php
session_start();
include("../inc/inc_db.php");
include("../inc/lib.php");

if ($prava ==0) {

$client_id = $vk_app_id; // ID приложения
$client_secret = $vk_secret; // Защищённый ключ
$redirect_uri = $vk_login_url; // Адрес сайта

function get_curl($url) {
if(function_exists('curl_init')) {
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$output = curl_exec($ch);
echo curl_error($ch);
curl_close($ch);
return $output;
} else {
return file_get_contents($url);
}
}


if (isset($_GET['code'])) {
    $result = false;
    $params = array(
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'code' => $_GET['code'],
        'redirect_uri' => $redirect_uri
    );

    $token = json_decode(get_curl('https://oauth.vk.com/access_token'.'?'.urldecode(http_build_query($params))), true);

    if (isset($token['access_token'])) {
        $params = array(
			'v' 		   => 5.4,
            'uids'         => $token['user_id'],
            'fields'       => 'id,first_name,last_name,screen_name,sex,bdate,photo_50,photo_100',
            'access_token' => $token['access_token']
        );

        $userInfo = json_decode(get_curl('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
        if (isset($userInfo['response'][0]['id'])) {
            $userInfo = $userInfo['response'][0];
            $result = true;
        }
    }
if ($result) {
$user_login_vk = $userInfo['first_name'].$userInfo['last_name'];
	
$skybaselogin = mysql_query("SELECT * FROM `p_users` WHERE `vk_id`='{$userInfo['id']}' LIMIT 1",$db) or die(mysql_error());
mysql_query("SET NAMES utf8");	
$result = mysql_num_rows($skybaselogin);
	
if ($result == 1) {
	
$skyrowlogin = mysql_fetch_array($skybaselogin);

$time = 2592000;
setcookie('u_id', $skyrowlogin['user_id'], time()+$time, "/");
setcookie('u_pass', $skyrowlogin['user_pass'], time()+$time, "/");
header('Location: /index.php');
exit;

}
	
else {//reg
	

if (intval($_COOKIE['ref']) >0){
		
//ищем такой ip в базе
function user_ip_chek($db) {
$user_ip = $_SERVER['REMOTE_ADDR'];
$query = mysql_query("SELECT * FROM `p_users` WHERE `user_ip` LIKE '{$user_ip}'") or die(mysql_error());
$num = mysql_num_rows($query);
if($num > 0) 
{
$result = 0;
} else {
$result = intval($_COOKIE['ref']);
}
return $result;
}
$user_referer = user_ip_chek($db);		
} else {$user_referer = 0;}
	
	
$user_ip = $_SERVER['REMOTE_ADDR'];
$ot_kuda_prishel = $_COOKIE['httpref']; 
$data = time();
$data_today = date("Y-m-d");
	
$user_login_vk = $userInfo['first_name'].' '.$userInfo['last_name'];
$user_pass_gen = md5(uniqid(rand(),true));	
$skybase = mysql_query("INSERT INTO `p_users` SET `vk_id`='{$userInfo['id']}',`vk_avatar`='{$userInfo['photo_50']}',`vk_avatar_100`='{$userInfo['photo_100']}',`user_login`='{$user_login_vk}',`user_pass`='{$user_pass_gen}',`user_email`='0',`user_regtime`='{$data}',`reg_date`='{$data_today}',`user_sol`='0',`user_prava`='1',`user_ip`='{$user_ip}',`user_ref`='{$user_referer}',`ot_kuda_prishel`='{$ot_kuda_prishel}',`user_balance`='{$bonus_reg}'",$db) or die(mysql_error());

$skybaselogin = mysql_query("SELECT `user_id`,`user_pass` FROM `p_users` WHERE `vk_id`='{$userInfo['id']}' LIMIT 1",$db) or die(mysql_error());
$skyrowlogin = mysql_fetch_assoc($skybaselogin);
$time = 2592000;
setcookie('u_id', $skyrowlogin['user_id'], time()+$time, "/");
setcookie('u_pass', $skyrowlogin['user_pass'], time()+$time, "/");
header('Location: /index.php');
exit;
}
}
 

}
 
 
}//права 0
?>