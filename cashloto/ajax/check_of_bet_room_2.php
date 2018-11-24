<?session_start();
    include("../inc/inc_db.php");
    include ("../inc/lib.php");


    $error = 0;
	
	$users_roulette_koll = mysql_query("SELECT * FROM `p_roulette_users_game_2`",$db) or die(mysql_error());
    $koll_users_roulette = mysql_num_rows($users_roulette_koll);
	
	//есть ли юзер в рулетке
	$user_roulette_test = mysql_query("SELECT * FROM `p_roulette_users_game_2` WHERE `user_id`='{$_SESSION['ses_user']}'",$db) or die(mysql_error());
    $test_users_roulette = mysql_num_rows($user_roulette_test);
	

	$pay_method = 1;
    
	if ($prava == 0){

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
	
	//
	elseif($pay_method == 1 and $user_balance_global <5) {	

    $error = 3;	
    $oshibka = 'На балансе не достаточно средств для ставки!'; 	 
	}

	
	elseif($koll_users_roulette >9) {
	
    $error = 5;	
    $oshibka = 'Подождите пару секунд до следующей игры, в рулетке уже есть 10 игроков!'; 	 
	}	
	
	
	elseif($test_users_roulette != 0) {
    $error = 6;	
    $oshibka = 'Вы уже сделали ставку в этой игре!'; 	 
	}	
	

	//если нет ошибок, то идем далее	
	if ($error == 0) {	
    
    if($pay_method == 1) {
    $take_money_osn_balance = mysql_query("UPDATE `p_users` SET `user_balance`=`user_balance`-'5'  WHERE `user_id`='{$_SESSION['ses_user']}' LIMIT 1",$db) or die(mysql_error());
	$new_balance = $user_balance_global - 5;
	$res = 'ok';
	}
	

	$row_roulette_users_finish = mysql_fetch_array($users_roulette_koll);
	
	$finish_time = $row_roulette_users_finish['finish'];
	
	if ($finish_time == 0) {$finish = time() + 10;} else {$finish = $finish_time + 5;}
	

	$data_roulette = time();
	$add_users_roulette_tab = mysql_query("INSERT INTO `p_roulette_users_game_2` SET `user_id`='{$_SESSION['ses_user']}',`user_login`='{$name}',`avatar`='{$vk_avatar}',`data`='{$data_roulette}'",$db) or die(mysql_error());

	
	if($user_ref_set >0) {
	$referer_percent = 5/100 * $ref_percent_bet;
       
	$ref_procent = mysql_query("UPDATE `p_users` SET `user_balance`=`user_balance`+'{$referer_percent}', `user_total_zarabotok`=`user_total_zarabotok`+'{$referer_percent}'  WHERE `user_id`='{$user_ref_set}' LIMIT 1",$db) or die(mysql_error());
								
	$total_ref_money = mysql_query("UPDATE `p_users` SET `total_ref_money`=`total_ref_money`+'{$referer_percent}' WHERE `user_id`='{$_SESSION['ses_user']}' LIMIT 1",$db) or die(mysql_error());							
        
	}
	
	
	
	$users_roulette_koll_now = mysql_query("SELECT * FROM `p_roulette_users_game_2`",$db) or die(mysql_error());
    $koll_users_roulette_now = mysql_num_rows($users_roulette_koll_now);
	
if ($koll_users_roulette_now == 10) {
	
//выигрывает
$win_num_users = 7;
//ставка	
$bet_room_2 = 5;	
//проигрывает
$lost_num_users = 3;

	
$limit = 10;
$sql_limit = $limit - $lost_num_users;
$query_users_roulette = mysql_query("SELECT * FROM `p_roulette_users_game_2` order by rand() limit $sql_limit ",$db) or die(mysql_error());
$num_users_roulette = mysql_num_rows($query_users_roulette);


//чистим таблицу юзеров рулетки
$cleaning_roulette_tab = mysql_query("TRUNCATE TABLE `p_roulette_users_stat_2`",$db) or die(mysql_error());


$users = array(); 
while($rov = mysql_fetch_assoc($query_users_roulette)){				 
$users[] = $rov['user_id'];
$users2 = implode(",", $users);	
$data_roulette = date("Y-m-d H:i:s");

$formula = $bet_room_2 * $limit/100 * $site_commission_loto;
$stavka = $limit * $bet_room_2;
$bank = $stavka - $formula;

$user_profit = $bank/($limit - $lost_num_users);


//добавим победителей в стату
$add_ref_link_trek = mysql_query("INSERT INTO `p_roulette_users_stat_2` SET `user_id`='{$rov['user_id']}',`user_login`='{$rov['user_login']}',`avatar`='{$rov['avatar']}',`data`='{$data_roulette}',`sum`='{$user_profit}',`lost`='0'",$db) or die(mysql_error());
$del = mysql_query ("DELETE FROM `p_roulette_users_game_2` WHERE `user_id`='{$rov['user_id']}'",$db)  or die(mysql_error());
$update_winners = mysql_query("UPDATE `p_users` SET `user_balance`=`user_balance`+'{$user_profit}',`user_total_zarabotok`=`user_total_zarabotok`+'{$user_profit}',`total_roulette_money`=`total_roulette_money`+'{$user_profit}',`total_roulette_win`=`total_roulette_win`+'1'  WHERE `user_id`='{$rov['user_id']}' LIMIT 1",$db) or die(mysql_error());
}

//тащим лузеров
$query_users_roulette2 = mysql_query("SELECT * FROM `p_roulette_users_game_2` WHERE `user_id` NOT IN ($users2) limit $lost_num_users ",$db) or die(mysql_error());

while($rov2 = mysql_fetch_assoc($query_users_roulette2)){	

//добавим в стату лузера
$add_roulette_users = mysql_query("INSERT INTO `p_roulette_users_stat_2` SET `user_id`='{$rov2['user_id']}',`user_login`='{$rov2['user_login']}',`avatar`='{$rov2['avatar']}',`data`='{$data_roulette}',`sum`='0.00',`lost`='1'",$db) or die(mysql_error());
$del = mysql_query ("DELETE FROM `p_roulette_users_game_2` WHERE `user_id`='{$rov2['user_id']}'",$db)  or die(mysql_error());
$update_luser = mysql_query("UPDATE `p_users` SET `total_roulette_lost`=`total_roulette_lost`+'1'  WHERE `user_id`='{$rov2['user_id']}' LIMIT 1",$db) or die(mysql_error());

}

//стата для админа
$add_roulette_stat_admin = mysql_query("UPDATE `p_roulette_stat` SET `last_game_data`='{$data_roulette}',`admin_profit`=`admin_profit`+'{$formula}',`total_game`=`total_game`+'1'  WHERE `id`='1' LIMIT 1",$db) or die(mysql_error());


//чистим таблицу юзеров рулетки
$cleaning_roulette_tab = mysql_query("TRUNCATE TABLE `p_roulette_users_game_2`",$db) or die(mysql_error());

//ожидание в течениe 5 секунд
sleep(5);
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