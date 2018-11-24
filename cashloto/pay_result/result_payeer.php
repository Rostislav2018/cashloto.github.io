<?php 
include("../inc/inc_db.php");
include ("../inc/inc_payeer.php");

//настройки
$skybasenastr = mysql_query("SELECT `nas_par`,`nas_znach` FROM `p_settings`",$db) or die(mysql_error());
$skyrownastr = mysql_fetch_array($skybasenastr);
do {
$$skyrownastr['nas_par'] = $skyrownastr['nas_znach'];
   }
while ($skyrownastr = mysql_fetch_array($skybasenastr));


function save_error($text) {
$file = $_SERVER['DOCUMENT_ROOT'].'/error.txt';
file_put_contents($file,$text. PHP_EOL, FILE_APPEND | LOCK_EX);
}
$date_error = date("Y-m-d H:i:s");

/*
function getIP() {
if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
   return $_SERVER['REMOTE_ADDR'];
}
if (!in_array(getIP(), array('185.71.65.92', '185.71.65.189', '149.202.17.210'))) {
 
    $text = 'DATE: ['.$date_error.'] - ERR: BAD IP PAYEER';
    save_error($text);
    die("hacking attempt!");
}
*/

if (isset($_POST['m_operation_id']) && isset($_POST['m_sign']))
{ 
	$m_key = $payeerShopKey;
	$arHash = array($_POST['m_operation_id'],
			$_POST['m_operation_ps'],
			$_POST['m_operation_date'],
			$_POST['m_operation_pay_date'],
			$_POST['m_shop'],
			$_POST['m_orderid'],
			$_POST['m_amount'],
			$_POST['m_curr'],
			$_POST['m_desc'],
			$_POST['m_status'],
			$m_key);
				
	$sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));
	if ($_POST['m_sign'] == $sign_hash && $_POST['m_status'] == 'success')
	{
		echo $_POST['m_orderid'].'|success';
		
		$summ_update_user = $_POST['m_amount'];
		$order_update_user = $_POST['m_orderid'];
		
		//проверяем данные
		$select_order = mysql_query("SELECT `user_id` FROM `p_update_balance` WHERE `order_id`='{$order_update_user}' AND `summa`='{$summ_update_user}' LIMIT 1",$db) or die(mysql_error());
        $rov = mysql_fetch_array($select_order);
		
		$update_adv_balance = mysql_query("UPDATE `p_users` SET `user_balance`=`user_balance`+'{$summ_update_user}' WHERE `user_id`='{$rov['user_id']}' LIMIT 1",$db) 
									or die(mysql_error());
		//кто привел сюда этого господина							
		$chek_user_ref = mysql_query("SELECT * FROM `p_users` WHERE `user_id`='{$rov['user_id']}'") or die(mysql_error());
        $row_user_ref = mysql_fetch_array($chek_user_ref);
        //отчисление рефереру
		if ($row_user_ref['user_ref'] >0) {
		//расчет реф %

        $referer_percent = $summ_update_user/100 * $ref_percent;
       
		
		$ref_procent = mysql_query("UPDATE `p_users` SET `user_balance`=`user_balance`+'{$referer_percent}', `user_total_zarabotok`=`user_total_zarabotok`+'{$referer_percent}'  WHERE `user_id`='{$row_user_ref['user_ref']}' LIMIT 1",$db) 
									or die(mysql_error());
									
		$total_ref_money = mysql_query("UPDATE `p_users` SET `total_ref_money`=`total_ref_money`+'{$referer_percent}' WHERE `user_id`='{$rov['user_id']}' LIMIT 1",$db) or die(mysql_error());							
        }

		//в общую таблицу пополнений добавим
        $pay_date = date("Y-m-d H:i:s");		
		$add_pay_tab = mysql_query ("INSERT INTO `p_update` (`user_id`, `summa`, `data`, `status`, `pay_system`, `bonus`) VALUES ('{$rov['user_id']}', '{$summ_update_user}', '{$pay_date}', 'проведен', 'Payeer', '0')",$db) or die(mysql_error());
				
		//удаляем ордер
		$del_order = mysql_query ("DELETE FROM `p_update_balance` WHERE `order_id`='{$order_update_user}' AND `user_id`='{$rov['user_id']}'") or die(mysql_error());
		exit;
	}
	
	else{

	$text = 'DATE: ['.$date_error.'] - ERR: BAD SIGN PAYEER';
    save_error($text);
	
	echo $_POST['m_orderid'].'|error';
	}
}
?>