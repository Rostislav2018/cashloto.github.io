<?session_start();
    include("../inc/inc_db.php");
    include ("../inc/lib.php");


    $error = 0;
	
	$users_roulette_koll = mysql_query("SELECT * FROM `p_roulette_users_game`",$db) or die(mysql_error());
    $koll_users_roulette = mysql_num_rows($users_roulette_koll);
	
	//есть ли юзер в рулетке
	$user_roulette_test = mysql_query("SELECT * FROM `p_roulette_users_game` WHERE `user_id`='{$_SESSION['ses_user']}'",$db) or die(mysql_error());
    $test_users_roulette = mysql_num_rows($user_roulette_test);
	

	$pay_method = 1;
    
	
	if ($prava==0){
	$act = 'roulette';
    $error = 7;	
    $oshibka = '7';
	}
    //метод не может быть пустым
    elseif (!isset($pay_method)) {
    $act = 'roulette';
    $error = 999;	
    $oshibka = 'Иди уроки учи!'; 	 
	}	 	

	//метод число 1 или 6 и один символ
	elseif(!preg_match("/[1-2]{1}/",$pay_method)) {	
    $act = 'roulette';
    $error = 2;	
    $oshibka = 'У тебя почти получилось!'; 	 
	}	 
	
	//
	elseif($pay_method == 1 and $user_balance_global <2) {	
    $act = 'roulette';
    $error = 3;	
    $oshibka = 'На балансе не достаточно средств для ставки!'; 	 
	}


	elseif($koll_users_roulette >9) {
	
	$act = 'roulette';
    $error = 5;	
    $oshibka = 'Подождите пару секунд до следующей игры, в рулетке уже есть 10 игроков!'; 	 
	}	
	
	
	elseif($test_users_roulette != 0) {
	$act = 'roulette';
    $error = 6;	
    $oshibka = 'Вы уже сделали ставку в этой игре!'; 	 
	}	
	

	//если нет ошибок, то идем далее	
	if ($error == 0) {	
    
    if($pay_method == 1) {
    $take_money_osn_balance = mysql_query("UPDATE `p_users` SET `user_balance`=`user_balance`-'2'  WHERE `user_id`='{$_SESSION['ses_user']}' LIMIT 1",$db) or die(mysql_error());
	$new_balance = $user_balance_global - 2;
	$res = 'ok';
	}
	
	$row_roulette_users_finish = mysql_fetch_array($users_roulette_koll);
	
	$finish_time = $row_roulette_users_finish['finish'];
	
	if ($finish_time == 0) {$finish = time() + 10;} else {$finish = $finish_time + 5;}
	

	$data_roulette = time();
	$add_users_roulette_tab = mysql_query("INSERT INTO `p_roulette_users_game` SET `user_id`='{$_SESSION['ses_user']}',`user_login`='{$name}',`avatar`='{$vk_avatar_100}',`data`='{$data_roulette}'",$db) or die(mysql_error());

	
	if($user_ref_set >0) {
	$referer_percent = 2/100 * $ref_percent_bet;
       
	$ref_procent = mysql_query("UPDATE `p_users` SET `user_balance`=`user_balance`+'{$referer_percent}', `user_total_zarabotok`=`user_total_zarabotok`+'{$referer_percent}'  WHERE `user_id`='{$user_ref_set}' LIMIT 1",$db) or die(mysql_error());
								
	$total_ref_money = mysql_query("UPDATE `p_users` SET `total_ref_money`=`total_ref_money`+'{$referer_percent}' WHERE `user_id`='{$_SESSION['ses_user']}' LIMIT 1",$db) or die(mysql_error());							
        
	}
	
	
	
	//если юзеров больше этого количества, то рулетка будет запущена
    $user_num_start_roulette = 1;
	
	
	if ($koll_users_roulette +1 > $user_num_start_roulette) {
	$add_finish_time  = mysql_query("UPDATE `p_roulette_users_game` SET `finish`='{$finish}'",$db) or die(mysql_error());
	}
	

	}


    // массив для ответа
    $result = array(
	'error' => $oshibka,
    'html' => '',
	'res' => $res,
	'new_balance' => '<b>'.round($new_balance,2).' RUB</b>',
    );
    echo json_encode($result);
?> 