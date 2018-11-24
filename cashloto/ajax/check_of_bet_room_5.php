<?session_start();
    include("../inc/inc_db.php");
    include ("../inc/lib.php");


    $error = 0;
	
	$users_roulette_koll = mysql_query("SELECT * FROM `p_roulette_users_game_5`",$db) or die(mysql_error());
    $koll_users_roulette = mysql_num_rows($users_roulette_koll);
	
	$pay_method = 1;
    $sum_bet = $_POST['sum_bet'];
	
	if ($prava==0){
    $error = 7;	
    $oshibka = '7';
	}
    //метод не может быть пустым
    elseif (!isset($pay_method)) {
    $error = 999;	
    $oshibka = 'Иди уроки учи!'; 	 
	}	 	

	//метод число 1 или 6 и один символ
	elseif(!preg_match("/[1-2]{1}/",$pay_method)) {	
    $error = 2;	
    $oshibka = 'У тебя почти получилось!'; 	 
	}	 
	
	//проверка суммы
	elseif(!preg_match("/^\d+(?:[.]\d{1,2}|)$/",$sum_bet)) {	
    $error = 8;	
    $oshibka = 'Сумма введена не верно '.$sum_bet.'!'; 	 
	}	
	
	//
	elseif($pay_method == 1 and $user_balance_global <$sum_bet) {	
    $error = 3;	
    $oshibka = 'На балансе не достаточно средств для ставки!'; 	 
	}

	
	//
	elseif($sum_bet <10) {	
    $error = 10;	
    $oshibka = 'Минимальная сумма ставки 10 рублей!'; 	 
	}
	
	
	elseif($koll_users_roulette >100) {
	
    $error = 5;	
    $oshibka = 'Подождите пару секунд до следующей игры!'; 	 
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
	//if (check_add_money_user($db) >0) {

	
    
    if($pay_method == 1) {
    $take_money_osn_balance = mysql_query("UPDATE `p_users` SET `user_balance`=`user_balance`-'{$sum_bet}'  WHERE `user_id`='{$_SESSION['ses_user']}' LIMIT 1",$db) or die(mysql_error());
	$new_balance = $user_balance_global - $sum_bet;
	$res = 'ok';
	}
	

	
	$row_roulette_users_finish = mysql_fetch_array($users_roulette_koll);
	
	$finish_time = $row_roulette_users_finish['finish'];
	
	if ($finish_time == 0) {$finish = time() + 30;} 
	
	//есть ли юзер в рулетке
	$user_roulette_test = mysql_query("SELECT * FROM `p_roulette_users_game_5` WHERE `user_id`='{$_SESSION['ses_user']}'",$db) or die(mysql_error());
    $test_users_roulette = mysql_num_rows($user_roulette_test);
	
	if ($test_users_roulette == 0){

	$data_roulette = time();
	$add_users_roulette_tab = mysql_query("INSERT INTO `p_roulette_users_game_5` SET `user_id`='{$_SESSION['ses_user']}',`user_login`='{$name}',`sum_bet`='{$sum_bet}',`avatar`='{$vk_avatar_100}',`data`='{$data_roulette}'",$db) or die(mysql_error());
/*
	if($user_ref_set >0) {
	$referer_percent = $sum_bet/100 * $ref_percent_bet;
       
	$ref_procent = mysql_query("UPDATE `p_users` SET `user_balance`=`user_balance`+'{$referer_percent}', `user_total_zarabotok`=`user_total_zarabotok`+'{$referer_percent}'  WHERE `user_id`='{$user_ref_set}' LIMIT 1",$db) or die(mysql_error());
								
	$total_ref_money = mysql_query("UPDATE `p_users` SET `total_ref_money`=`total_ref_money`+'{$referer_percent}' WHERE `user_id`='{$_SESSION['ses_user']}' LIMIT 1",$db) or die(mysql_error());							
        
	}
	*/
	
	if ($koll_users_roulette +1 == 2) {
	$add_finish_time  = mysql_query("UPDATE `p_roulette_users_game_5` SET `finish`='{$finish}'",$db) or die(mysql_error());
	}
	
	
	
	} else {
	
	$update_user_bet  = mysql_query("UPDATE `p_roulette_users_game_5` SET `sum_bet`=`sum_bet`+'{$sum_bet}' WHERE `user_id`='{$_SESSION['ses_user']}' ",$db) or die(mysql_error());
	/*
	if($user_ref_set >0) {
	$referer_percent = $sum_bet/100 * $ref_percent_bet;
       
	$ref_procent = mysql_query("UPDATE `p_users` SET `user_balance`=`user_balance`+'{$referer_percent}', `user_total_zarabotok`=`user_total_zarabotok`+'{$referer_percent}'  WHERE `user_id`='{$user_ref_set}' LIMIT 1",$db) or die(mysql_error());
								
	$total_ref_money = mysql_query("UPDATE `p_users` SET `total_ref_money`=`total_ref_money`+'{$referer_percent}' WHERE `user_id`='{$_SESSION['ses_user']}' LIMIT 1",$db) or die(mysql_error());							
        
	}
	*/
	}
	
	$query_users_roulette = mysql_query("SELECT * FROM `p_roulette_users_game_5`",$db) or die(mysql_error());
	
	$query = mysql_query("select SUM(`sum_bet`) from `p_roulette_users_game_5`",$db) or die(mysql_error());
	$result = mysql_fetch_array($query);
	$bank = $result[0] + 0;
	
	while($rov = mysql_fetch_assoc($query_users_roulette)){		

    $percent_update = $rov['sum_bet'] * 100/$bank;

    //$percent_update[] = round($percent,2);

	$update_user_percent  = mysql_query("UPDATE `p_roulette_users_game_5` SET `percent`='{$percent_update}' WHERE `user_id`='{$rov['user_id']}'",$db) or die(mysql_error());
	
	
    }
	
	
    //} else {$oshibka = 'Вам необходимо хотябы раз пополнить баланс через PAYEER или FREE-KASSA!'; }
	

	}


    // массив для ответа
    $result = array(
	'error' => $oshibka,
    'html' => '',
	'res' => $res,
	'new_balance' => '<font color="#FFD800"><b>'.round($new_balance,2).' RUB</b></font>',
    );
    echo json_encode($result);
?> 