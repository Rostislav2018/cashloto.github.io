<?
session_start();
include("../inc/inc_db.php");
include ("../inc/lib.php");
if ($prava>0) { 

$error = 0;
//сумма
$summa = $_POST['pay_summ'];
//платежная система
$pay_system = $_POST['pay_system'];
    
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
	
//проверка на минимальную сумму пополнения	
elseif($summa <$min_summa_in) {		
$error = 3;			
$oshibka = 'Минимальная сумма пополнения - '.$min_summa_in.' руб!';	
} 
	
//$pay_system не может быть пустым
elseif (!isset($pay_system)) {
$error = 4;				
$oshibka = 'Иди уроки учи!'; 	 
}	 	

//$pay_system число 1 или 6 и один символ
elseif(!preg_match("/[1-6]{1}/",$pay_system)) {	
$error = 5;			
$oshibka = 'У тебя почти получилось!'; 	 
}	 
				

//если нет ошибок, то идем далее	
if ($error == 0) {	
    
// 1 - Payeer
if ($pay_system == 1) {	
$res = 'ok';
$rsdns = rand(11,99);
$order_time = date("His");
$order = '1'.$_SESSION['ses_user'].''.$order_time.''.$rsdns.'';
	
$user_id = $_SESSION['ses_user'];
$status = 0;
$pay_date = date("Y-m-d H:i:s");
$add_pay_tab = mysql_query ("INSERT INTO `p_update_balance` (`order_id`, `user_id`, `summa`, `date`, `status`,`pay_system`) VALUES ('{$order}', '{$user_id}', '{$summa}', '{$pay_date}', '{$status}','Payeer')",$db);
//

$p_update_balance = mysql_query("SELECT `id` FROM `p_update_balance` WHERE `order_id`='{$order}'",$db) or die(mysql_error());
$row_p_update_balance = mysql_fetch_array($p_update_balance);

$go_pay = '/pay/'.$row_p_update_balance['id'].'/';

}

	
//2 - Фри-касса
if ($pay_system == 2) {	
$res = 'ok';
$rsdns = rand(11,99);
$order_time = date("His");
$order = '1'.$_SESSION['ses_user'].''.$order_time.''.$rsdns.'';
$user_id = $_SESSION['ses_user'];
$status = 0;
$pay_date = date("Y-m-d H:i:s");
$add_pay_tab = mysql_query ("INSERT INTO `p_update_balance` (`order_id`, `user_id`, `summa`, `date`, `status`,`pay_system`) VALUES ('{$order}', '{$user_id}', '{$summa}', '{$pay_date}', '{$status}','Free-kassa')",$db);
//
	
$p_update_balance = mysql_query("SELECT `id` FROM `p_update_balance` WHERE `order_id`='{$order}'",$db) or die(mysql_error());
$row_p_update_balance = mysql_fetch_array($p_update_balance);
$go_pay = '/pay/'.$row_p_update_balance['id'].'/';
	
}

}

// массив для ответа
$result = array(
	'error' => $oshibka,
    'html' => '',
	'res' => $res,
	'go_pay'=> $go_pay,
);
echo json_encode($result);

}
?> 