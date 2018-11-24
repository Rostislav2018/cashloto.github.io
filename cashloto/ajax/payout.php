<?
session_start();
include("../inc/inc_db.php");
include("../inc/lib.php");
if ($prava>0) { 

$error = 0;
//$min_summa_out = 10;
//сумма
$summa = $_POST['pay_summ'];

//поле сумма не должно быть пустым
if(empty($summa)) {
$error = 1;		
$oshibka = 'Пожалуйста, введите сумму!';   
} 
	
//проверка суммы, только числа 0-9	
elseif(preg_match("/[^0-9]/",$summa)) {	
$error = 2;			
$oshibka = 'Сумма указана неверно!'; 
}
	
//проверка на минимальную сумму вывода	
elseif($summa <$min_summa_out) {		
$error = 3;			
$oshibka = 'Минимальная сумма для вывода - '.$min_summa_out.' руб!';	
} 

elseif(empty($payeer_purse)) {	
$error = 4;	
$oshibka = 'Кошелек не указан!'; 	 
}
	
elseif($user_balance_global <$summa) {	
$error = 5;	
$oshibka = 'На балансе не достаточно средств для вывода!'; 	 
}

elseif($set_payments == 'off') {	
$error = 6;	
$oshibka = 'Вывод временно не доступен. Попробуйте заказать вывод позже.'; 	 
}




	
				

//если нет ошибок, то идем далее	
if ($error == 0) {

//поплнял ли баланс этот господин
function check_add_money_user($db)
{		
$baseuser = mysql_query("SELECT COUNT(`user_id`) FROM `p_update` WHERE `user_id`='{$_SESSION['ses_user']}'",$db) or die(mysql_error());
$row = mysql_fetch_row($baseuser);
return $total = $row[0];
}

if (check_add_money_user($db) >0) {

//выводил ли он деньгу
function check_money_out($db)
{		
$baseuser = mysql_query("SELECT COUNT(`user_id`) FROM `p_payments` WHERE `user_id`='{$_SESSION['ses_user']}'",$db) or die(mysql_error());
$row = mysql_fetch_row($baseuser);
return $total = $row[0];
}


$new_balance = $user_balance_global - $summa;

$commission = $summa/100 * $commission_pay_out;
if (check_money_out($db) == 0) {
$summa_out = $summa - $commission - 2;
} else {
$summa_out = $summa - $commission;
}

include('../inc/inc_payeer.php');
include('../inc/cpayeer.php');

$payeer = new CPayeer($accountNumber, $apiId, $apiKey);
if ($payeer->isAuth())
{


$arTransfer = $payeer->transfer(array(
		'curIn' => ' RUB',
		'sum' => ''.round($summa_out, 2).'',
		'curOut' => ' RUB',
		'to' => ''.$payeer_purse.'',
		'comment' => 'Выплата с сайта '.$_SERVER['SERVER_NAME'].'',
	));


	if (empty($arTransfer['errors']))
	{





//списываем сумму у юзера
$ip = $_SERVER["REMOTE_ADDR"];	
$pay_date = date("Y-m-d H:i:s");
$minus_summa = mysql_query("UPDATE `p_users` SET `user_balance`='{$new_balance}',`last_payout`='{$time}' WHERE `user_id`='{$_SESSION['ses_user']}' LIMIT 1",$db) 
									or die(mysql_error());
//добавляем выплату в таблицу выплат
$add_pay_tab = mysql_query ("INSERT INTO `p_payments` (`payeer_purse`, `summa`,`summa_commission`, `user_id`, `ip`, `date`) VALUES ('{$payeer_purse}', '{$summa}','{$summa_out}','{$_SESSION['ses_user']}', '{$ip}', '{$pay_date}')",$db);

//стата для админа
$add_roulette_stat_admin = mysql_query("UPDATE `p_roulette_stat` SET `admin_profit`=`admin_profit`+'{$commission}' WHERE `id`='1' LIMIT 1",$db) or die(mysql_error());

$res = 'ok';
    } else {$oshibka = 'Запрос не выполнен! Ошибка на стороне PAYEER!'; }
	
} else {$oshibka = 'Нет соединения с PAYEER!'; }


} else {$oshibka = 'Для вывода средств необходимо хотябы раз пополнить баланс через PAYEER или FREE-KASSA!'; }


}


// массив для ответа
$result = array(
	'error' => $oshibka,
    'html' => '',
	'res' => $res,
    'new_balance' => '<b>'.round($new_balance,2).' RUB</b>',
);
echo json_encode($result);

}
?> 