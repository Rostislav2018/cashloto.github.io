<?php
//вход, если запомнили
if (isset($_COOKIE['u_id']) && isset($_COOKIE['u_pass']))
	{
		$_SESSION['ses_user'] = $_COOKIE['u_id'];
		$_SESSION['pass'] = $_COOKIE['u_pass'];
	}

//выход
if (isset($_GET['logout']))
{
	if (isset($_SESSION['ses_user'])) { unset($_SESSION['ses_user']); }
	if (isset($_SESSION['pass'])) { unset($_SESSION['pass']); }
	setcookie('u_id', '', 0, "/");
	setcookie('u_pass', '', 0, "/");
	header('Location: /index.php');
	exit;
}



//проверка
if (isset($_SESSION['ses_user']) && isset($_SESSION['pass']))
	{
	
	$ses_user = (isset($_SESSION['ses_user'])) ? mysql_real_escape_string($_SESSION['ses_user']) : '';
	$pass = (isset($_SESSION['pass'])) ? mysql_real_escape_string($_SESSION['pass']) : '';
	$skybase = mysql_query("SELECT `user_id`,`vk_id`,`vk_avatar`,`vk_avatar_100`,`user_login`,`user_pass`,`user_prava`,`user_ref`,`user_email`,`user_balance`,`user_payeer`,`chek_ban`
	FROM `p_users` WHERE  `user_pass`='{$pass}' AND `user_id`='{$ses_user}' LIMIT 1",$db) or die(mysql_error());
		if (mysql_num_rows($skybase) == 1)
		{
			$skyrow = mysql_fetch_array($skybase);
            $prava = $skyrow['user_prava'];
			$name =  $skyrow['user_login'];
			$user_email = $skyrow['user_email'];
			
			$user_ref_set = $skyrow['user_ref'];
			
			$payeer_purse = $skyrow['user_payeer'];
			$vk_avatar = $skyrow['vk_avatar'];
			$vk_user_id_global = $skyrow['vk_id'];
			$vk_avatar_100 = $skyrow['vk_avatar_100'];
			
			$user_balance_global = $skyrow['user_balance'];
			
			
		}
		else { echo '<link href="st.css" rel="stylesheet" type="text/css"><center><br /><div class="alert">Попытка взлома. За тобой уже выехали!  </div><br /></center>'; exit(); }
	
	
	}

//настройки
 $skybasenastr = mysql_query("SELECT `nas_par`,`nas_znach` FROM `p_settings`",$db) or die(mysql_error());
 $skyrownastr = mysql_fetch_array($skybasenastr);
 do {
	 $$skyrownastr['nas_par'] = $skyrownastr['nas_znach'];
	}
while ($skyrownastr = mysql_fetch_array($skybasenastr));	
	
if($skyrow['chek_ban'] >0){
exit('<br/><center><b>Ваш аккаунт заблокирован!</b><br/> Одна из самых распространенных причин блокировки - это мультоводство (регистрация более одного аккаунта).<br/>Если вы считаете, что произошла нелепая ошибка, то пожалуйста, напишите Админу - Email: '.$admin_email.'</center>');
}

include ('inc_set.php');
?>