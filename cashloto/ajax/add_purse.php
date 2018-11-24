<?
session_start();
include("../inc/inc_db.php");
include ("../inc/lib.php");



//изменения кошелька
if ($prava>0) { 

$postpayeer = $_POST['purse'];
//проверяем совпадение кошельков
$test_payeer = mysql_query("SELECT `user_login` FROM `p_users` WHERE `user_payeer`='{$postpayeer}' LIMIT 1") or die(mysql_error());
if(empty($postpayeer)) {
$error = 1;		
$oshibka = 'Пожалуйста, введите кошелек!';   
} 

elseif(!preg_match("#P[0-9]{7,8}#i", $postpayeer)) {
$error = 2;
$oshibka = 'Кошелек должен начинаться с большой буквы Р и 7-ми или 8-ми цифер!';	
		
}
	

elseif (mysql_num_rows($test_payeer) > 0)
{
$skyrow = mysql_fetch_array($test_payeer);
$error = 3;
$oshibka = 'Пользователь <strong>'.$skyrow['user_login'].' </strong>уже зарегистрировал кошелек — '.$postpayeer.'';

} 


//если нет ошибок, то идем далее	
if ($error == 0) {	
//сохраняем кошелек     
$save_payeer = mysql_query("UPDATE `p_users` SET `user_payeer`='{$postpayeer}' WHERE `user_id`='{$_SESSION['ses_user']}'",$db) or die(mysql_error());
$new_purse = '<div class="user_purse">'.$postpayeer.'</div>';
$res = 'ok';    
	
	}

  
 
// массив для ответа
$result = array(
	'error' => $oshibka,
    'html' => '',
	'res' => $res,
	'purse' => $new_purse,
);
echo json_encode($result);  
}
?>