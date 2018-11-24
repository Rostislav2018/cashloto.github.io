<?

$limit = up_users_num($db,'',1);
$sql_limit = $limit - 1;
$query_users_roulette = mysql_query("SELECT * FROM `p_roulette_users_game` order by rand() limit $sql_limit ",$db) or die(mysql_error());
$num_users_roulette = mysql_num_rows($query_users_roulette);


//чистим таблицу юзеров рулетки
$cleaning_roulette_tab = mysql_query("TRUNCATE TABLE `p_roulette_users_stat`",$db) or die(mysql_error());


$users = array(); 
while($rov = mysql_fetch_assoc($query_users_roulette)){				 
$users[] = $rov['user_id'];
$users2 = implode(",", $users);	
$data_roulette = date("Y-m-d H:i:s");

$formula = 2 * $limit/100 * $site_commission_loto;
$stavka = $limit * 2;
//$bank = $limit - $formula;
$bank = $stavka - $formula;

$user_profit = $bank/($limit-1);

$query_users_stat = mysql_query("SELECT * FROM `p_roulette_users_stat` WHERE `user_id`='{$rov['user_id']}'",$db) or die(mysql_error());
$num_users_stat = mysql_num_rows($query_users_stat);

if ($num_users_stat == 0) {

//добавим победителей в стату
$add_ref_link_trek = mysql_query("INSERT INTO `p_roulette_users_stat` SET `user_id`='{$rov['user_id']}',`user_login`='{$rov['user_login']}',`avatar`='{$rov['avatar']}',`data`='{$data_roulette}',`sum`='{$user_profit}',`lost`='0'",$db) or die(mysql_error());
$del = mysql_query ("DELETE FROM `p_roulette_users_game` WHERE `user_id`='{$rov['user_id']}'",$db)  or die(mysql_error());	
$update_winners = mysql_query("UPDATE `p_users` SET `user_balance`=`user_balance`+'{$user_profit}',`user_total_zarabotok`=`user_total_zarabotok`+'{$user_profit}',`total_roulette_money`=`total_roulette_money`+'{$user_profit}',`total_roulette_win`=`total_roulette_win`+'1'  WHERE `user_id`='{$rov['user_id']}' LIMIT 1",$db) or die(mysql_error());
}

}

//тащим одного лузера
$query_users_roulette2 = mysql_query("SELECT * FROM `p_roulette_users_game` WHERE `user_id` NOT IN ($users2) limit 1 ",$db) or die(mysql_error());
$rov2 = mysql_fetch_assoc($query_users_roulette2);


//добавим в стату лузера
$add_roulette_users = mysql_query("INSERT INTO `p_roulette_users_stat` SET `user_id`='{$rov2['user_id']}',`user_login`='{$rov2['user_login']}',`avatar`='{$rov2['avatar']}',`data`='{$data_roulette}',`sum`='0.00',`lost`='1'",$db) or die(mysql_error());
$del = mysql_query ("DELETE FROM `p_roulette_users_game` WHERE `user_id`='{$rov2['user_id']}'",$db)  or die(mysql_error());
$update_luser = mysql_query("UPDATE `p_users` SET `total_roulette_lost`=`total_roulette_lost`+'1'  WHERE `user_id`='{$rov2['user_id']}' LIMIT 1",$db) or die(mysql_error());



//стата для админа
$add_roulette_stat_admin = mysql_query("UPDATE `p_roulette_stat` SET `last_game_data`='{$data_roulette}',`admin_profit`=`admin_profit`+'{$formula}',`total_game`=`total_game`+'1'  WHERE `id`='1' LIMIT 1",$db) or die(mysql_error());


//чистим таблицу юзеров рулетки
$cleaning_roulette_tab = mysql_query("TRUNCATE TABLE `p_roulette_users_game`",$db) or die(mysql_error());
//ожидание в течениe 5 секунд
sleep(5);
?>