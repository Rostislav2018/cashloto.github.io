<? 
include("../inc/inc_db.php");
include ("../inc/inc_free-kassa.php");

//настройки
$skybasenastr = mysql_query("SELECT `nas_par`,`nas_znach` FROM `p_settings`",$db) or die(mysql_error());
$skyrownastr = mysql_fetch_array($skybasenastr);
do {
$$skyrownastr['nas_par'] = $skyrownastr['nas_znach'];
   }
while ($skyrownastr = mysql_fetch_array($skybasenastr));

$merchant_id = $free_merchant_id;
$merchant_secret = $free_merchant_secret;
$merchant_secret2 = $free_merchant_secret2;
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
if (!in_array(getIP(), array('136.243.38.147', '136.243.38.149', '136.243.38.150', '136.243.38.151', '136.243.38.189', '88.198.88.98'))) {
 
    $text = 'DATE: ['.$date_error.'] - ERR: BAD IP free-kassa';
    save_error($text);
    die("hacking attempt!");
}


*/

$sign = md5($merchant_id.':'.$_REQUEST['AMOUNT'].':'.$merchant_secret2.':'.$_REQUEST['MERCHANT_ORDER_ID']);

if ($sign != $_REQUEST['SIGN']) {
   
    $text = 'DATE: ['.$date_error.'] - ERR: BAD SIGN free-kassa';
    save_error($text);
   die('wrong sign');
}

		/////////////////////////////////////////////
		$summ_update_user = $_REQUEST['AMOUNT'];
		$order_update_user = $_REQUEST['us_order'];
		
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
        
		
		$ref_procent = mysql_query("UPDATE `p_users` SET `user_balance`=`user_balance`+'{$referer_percent}', `user_total_zarabotok`=`user_total_zarabotok`+'{$referer_percent}'  WHERE `user_id`='{$row_user_ref['user_ref']}' LIMIT 1",$db) or die(mysql_error());
        
		$total_ref_money = mysql_query("UPDATE `p_users` SET `total_ref_money`=`total_ref_money`+'{$referer_percent}' WHERE `user_id`='{$rov['user_id']}' LIMIT 1",$db) or die(mysql_error());							
         
	   }

		//в общую таблицу пополнений добавим
        $pay_date = date("Y-m-d H:i:s");		
		$add_pay_tab = mysql_query ("INSERT INTO `p_update` (`user_id`, `summa`, `data`, `status`, `pay_system`, `bonus`) VALUES ('{$rov['user_id']}', '{$summ_update_user}', '{$pay_date}', 'проведен', 'Free-kassa', '0')",$db) or die(mysql_error());
				
		//удаляем ордер
		$del_order = mysql_query ("DELETE FROM `p_update_balance` WHERE `order_id`='{$order_update_user}' AND `user_id`='{$rov['user_id']}'") or die(mysql_error());

die('YES');
?>