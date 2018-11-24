<?
session_start();
include("../inc/inc_db.php");
include ("../inc/lib.php");

$site_commission_loto_room_4 = 10;
    $error = 0;
	
	
	
	function showDate( $date )
{
    $stf      = 0;
    $cur_time = time();
    $diff     = $cur_time - $date;
 
 if ($diff<6) {$value ='только что';} else {
 
 
 
    $seconds = array( 'секунду назад', 'секунды назад', 'секунд назад' );
    $minutes = array( 'минуту назад', 'минуты назад', 'минут назад' );
    $hours   = array( 'час назад', 'часа назад', 'часов назад' );
    $days    = array( 'день назад', 'дня назад', 'дней назад' );
    $weeks   = array( 'неделю назад', 'недели назад', 'недель назад' );
    $months  = array( 'месяц назад', 'месяца назад', 'месяцев назад' );
    $years   = array( 'год назад', 'года назад', 'лет назад' );
    $decades = array( 'десятилетие назад', 'десятилетия назад', 'десятилетий назад' );
 
    $phrase = array( $seconds, $minutes, $hours, $days, $weeks, $months, $years, $decades );
    $length = array( 1, 60, 3600, 86400, 604800, 2630880, 31570560, 315705600 );
 
    for ( $i = sizeof( $length ) - 1; ( $i >= 0 ) && ( ( $no = $diff / $length[ $i ] ) <= 1 ); $i -- ) {
        ;
    }
    if ( $i < 0 ) {
        $i = 0;
    }
    $_time = $cur_time - ( $diff % $length[ $i ] );
    $no    = floor( $no );
    $value = sprintf( "%d %s ", $no, getPhrase( $no, $phrase[ $i ] ) );
 
    if ( ( $stf == 1 ) && ( $i >= 1 ) && ( ( $cur_time - $_time ) > 0 ) ) {
        $value .= time_ago( $_time );
    }
 
 }
    return $value;
}
 
function getPhrase( $number, $titles ) {
    $cases = array( 2, 0, 1, 1, 1, 2 );
 
    return $titles[ ( $number % 100 > 4 && $number % 100 < 20 ) ? 2 : $cases[ min( $number % 10, 5 ) ] ];
}
	
	

	
	
	function up_users_num($db,$qx,$w)
{
    

	$users_roulette_koll = mysql_query("SELECT * FROM `p_roulette_users_game_4` $qx ",$db) or die(mysql_error());
	
	if ($w == 1) {
	
    $result = mysql_num_rows($users_roulette_koll);

	} elseif ($w == 2) {
	
    $qwe = mysql_fetch_array($users_roulette_koll);
    $result = $qwe['finish'];
	}
	
	elseif ($w == 3) {
	
$result .= '<table align="left" border="0" style="margin-top: 0px;" width="100%" class="stat_tab"  cellpadding="5" cellspacing="0">';
if(mysql_num_rows($users_roulette_koll) >0) {
$result .= '<tr>';
$result .= '<td align="left" colspan="2" bgcolor="#2F343A" style="color: #FF6A00; font-size: 17px;" >Пользователь</td>';
$result .= '<td align="left" bgcolor="#2F343A" style="color: #FF6A00; font-size: 17px;" >Ставка</td>';
$result .= '<td align="left" bgcolor="#2F343A" style="color: #FF6A00; font-size: 17px;" >Шанс</td>';
$result .= '<td align="left" bgcolor="#2F343A" style="color: #FF6A00; font-size: 17px;" >Когда</td>';
$result .= '</tr>';
	
	
	while($row = mysql_fetch_array($users_roulette_koll))
	{
	
	
	if ($cv == 1) { $bg_color = "2F343A"; $td_color = "ffffff"; $cv=0; } else { $bg_color = "2F343A"; $td_color = "ffffff"; $cv++; }
	$result .= '<tr class="user_row">';
	
	$result .= '<td bgcolor="'.$bg_color.'" align="center" style="color: #141518 !important;" width="50px"><img class="table_avatar" src="'.$row['avatar'].'" /></td>';
	$result .= '<td bgcolor="'.$bg_color.'" align="left" style="color: #141518 !important;" width="200px"><span style="font-size: 17px; color: #'.$td_color.';">'.$row['user_login'].'</span> </td>';
	$result .= '<td bgcolor="'.$bg_color.'" style="color: #141518 !important;" width="100px"> <span style="font-size: 17px; color: #'.$td_color.';">'.$row['sum_bet'].' RUB</span></td>';
	$result .= '<td bgcolor="'.$bg_color.'" style="color: #141518 !important;" width="100px"> <span style="font-size: 17px; color: #'.$td_color.';">'.$row['percent'].'%</span></td>';
	$result .= '<td bgcolor="'.$bg_color.'" style="color: #141518;" width="150px"> <span style="font-size: 17px; color: #'.$td_color.';">'.showDate($row['data']).'</span></td>';
	$result .= '</tr>';

	}
	
	} else {$result .= '<tr class="user_row"><td bgcolor="2F343A" align="center" width="100%"><span style="text-align: center; font-size: 17px; color: #fff;">Ожидание игроков...</span></td></tr>';}
	
	
$result .= '</table>';
	}
	
	 elseif ($w == 4) {
	
    $qwe = mysql_fetch_array($users_roulette_koll);
    $result = $qwe['check_finish'];
	}
	
	
	
	return $result;
	

}


	function up_users_stats($db)
{
    

	$users_roulette_koll = mysql_query("SELECT * FROM `p_roulette_users_stat_4` ORDER BY `data` DESC LIMIT 10",$db) or die(mysql_error());
	

	
$result .= '<table align="left" border="0" style="margin-top: 0px;" width="100%" class="stat_tab" cellpadding="5" cellspacing="0">';
$result .= '<tr>';
$result .= '<td align="left" colspan="2" bgcolor="#2F343A" style="color: #FF6A00; font-size: 17px;" >Пользователь</td>';
$result .= '<td align="left" bgcolor="#2F343A" style="color: #FF6A00; font-size: 17px;">Выигрыш</td>';
$result .= '<td align="left" bgcolor="#2F343A" style="color: #FF6A00; font-size: 17px;">Шанс</td>';
$result .= '<td align="left" bgcolor="#2F343A" style="color: #FF6A00; font-size: 17px;">Ставка</td>';
$result .= '</tr>';
	
	
	while($row = mysql_fetch_array($users_roulette_koll))
	{
	if ($cv == 1) { $bg_color = "2F343A"; $td_color = "ffffff"; $cv=0; } else { $bg_color = "2F343A"; $td_color = "ffffff"; $cv++; }
	
	if($row['lost'] == 0) {$win ='да';} else {$win ='нет'; $bg_color ='#F5DEB3'; $td_color = "2F343A";}
	
    $result .= '<tr class="user_row">';
	$result .= '<td bgcolor="'.$bg_color.'" align="center" style="color: #141518 !important;" width="50px"><img class="table_avatar" src="'.$row['avatar'].'" /></td>';
	$result .= '<td bgcolor="'.$bg_color.'" align="left" style="color: #141518 !important;" width="200px"><span style="font-size: 17px; color: #'.$td_color.';">'.$row['user_login'].'</span></td>';
	$result .= '<td bgcolor="'.$bg_color.'" style="color: #141518 !important;" width="150px"><span style="font-size: 17px; color: #'.$td_color.';">'.$row['sum'].' RUB </span></td>';
	$result .= '<td bgcolor="'.$bg_color.'" style="color: #141518 !important;" width="150px"><span style="font-size: 17px; color: #'.$td_color.';">'.$row['percent'].'% </span></td>';
	$result .= '<td bgcolor="'.$bg_color.'" style="color: #141518 !important;" width="150px"><span style="font-size: 17px; color: #'.$td_color.';">'.$row['sum_bet'].' RUB </span></td>';
	$result .= '</tr>';

	}
$result .= '</table>';
	
	return $result;
	

}


function up_bank($db)
{
global $site_commission_loto_room_4;
$query = mysql_query("select SUM(`sum_bet`) from `p_roulette_users_game_4`",$db) or die(mysql_error());
$result = mysql_fetch_array($query);
$real_bank = $result[0]+0;

$formula = $real_bank/100 * $site_commission_loto_room_4;

$bank = $real_bank - $formula;

return round($bank,2);

}




$time_to_show = up_users_num($db,' WHERE `id`=1',2) - time();
$total_users_in = up_users_num($db,'ORDER BY `data` DESC LIMIT 10',1);



if ($total_users_in == 2) {
$max_users_progress = 30;
} 

elseif ($total_users_in == 3) {
$max_users_progress = 35;
}

elseif ($total_users_in == 4) {
$max_users_progress = 40;
}

elseif ($total_users_in == 5) {
$max_users_progress = 45;
}

elseif ($total_users_in == 6) {
$max_users_progress = 50;
}

elseif ($total_users_in == 7) {
$max_users_progress = 55;
}

elseif ($total_users_in == 8) {
$max_users_progress = 60;
}

elseif ($total_users_in == 9) {
$max_users_progress = 65;
}

elseif ($total_users_in == 10) {
$max_users_progress = 70;
}




if ($time_to_show <0) {

//$progress_bar = '<div id="man"><div id="eye-l"></div><div id="eye-r"></div><div id="nose"></div><div id="mouth"></div></div><div id="wall">ОЖИДАНИЕ ИГРОКОВ</div>'; 
$time_to_finish = 1;

}

else {

$formula_progressa = floor(($time_to_show * 100)/$max_users_progress);

$progress_bar = '<div style="color: #fff;">Подождите...</div><progress title="осталось '.$time_to_show.' сек." value="'.$formula_progressa.'" max="100"></progress>';

//$time_to_finish = 0;
$win_name = 0;
}


//если юзеров больше этого количества, то рулетка будет запущена
$user_num_start_roulette = 1;


if ($time_to_finish == 1 and up_users_num($db,' WHERE `id`=1',4) == 0) {


//если юзеров больше 1, то запускаем рулетку
if (up_users_num($db,'ORDER BY `data` DESC LIMIT 10',1) > $user_num_start_roulette) {

$update_check_finish = mysql_query("UPDATE `p_roulette_users_game_4` SET `check_finish`=`check_finish`+'1' WHERE `id`='1' LIMIT 1",$db) or die(mysql_error());
//ожидание
sleep(1);
$finish_num = mysql_query("SELECT `check_finish` FROM `p_roulette_users_game_4` WHERE `id`='1' ",$db) or die(mysql_error());
	
$finish_num_rov = mysql_fetch_array($finish_num);
//////
if ($finish_num_rov['check_finish'] == 1) {


$query_users_roulette = mysql_query("SELECT * FROM `p_roulette_users_game_4`",$db) or die(mysql_error());


$query = mysql_query("select SUM(`sum_bet`) from `p_roulette_users_game_4`",$db) or die(mysql_error());
$result = mysql_fetch_array($query);
$bank = $result[0] + 0;


while($rov = mysql_fetch_assoc($query_users_roulette)){		

//$kolvo = 1000 * $rov['sum_bet']/100;
$kolvo = 2000 * $rov['sum_bet']/100;
$percent = $rov['sum_bet'] * 100/$bank;


  for ($i = 0; $i < $kolvo; $i++) {

  $massiv[] = $rov['user_id'];
  $avatars[] = '<li><img src="'.$rov['avatar'].'"></li>';
}

}

shuffle($massiv);
shuffle($avatars);




$input = $massiv;
$rand_keys = array_rand($input, 1);

//кто выиграл
$winner_id = $input[$rand_keys];



$query_user_winner = mysql_query("SELECT * FROM `p_roulette_users_game_4` WHERE `user_id`='{$winner_id}'",$db) or die(mysql_error());
$rov_winner = mysql_fetch_assoc($query_user_winner);
$data_roulette = date("Y-m-d H:i:s");

//
array_splice($avatars, 30, 0, '<li id="win"><img src="'.$rov_winner['avatar'].'"></li>');

$str = '';
$i = 0;
 
foreach($avatars as $key => $val)
{
   $str .= $val."\n";
if (++$i == 62) break;
}

file_put_contents('p.php', '');

file_put_contents('p.php', $str, FILE_APPEND);
//


//банк без того кто выиграл
$query2 = mysql_query("select SUM(`sum_bet`) from `p_roulette_users_game_4` WHERE `user_id` NOT IN ($winner_id)",$db) or die(mysql_error());
$result2 = mysql_fetch_array($query2);
$bank2 = $result2[0];


$formula = $bank2/100 * $site_commission_loto_room_4;
$bank_and_bet = $bank2 + $rov_winner['sum_bet'];
$user_profit = $bank_and_bet - $formula;



//добавим победителей в стату
$add_ref_link_trek = mysql_query("INSERT INTO `p_roulette_users_stat_4` SET `user_id`='{$winner_id}',`user_login`='{$rov_winner['user_login']}',`avatar`='{$rov_winner['avatar']}',`data`='{$data_roulette}',`sum`='{$user_profit}',`sum_bet`='{$rov_winner['sum_bet']}',`percent`='{$rov_winner['percent']}'",$db) or die(mysql_error());

$update_winners = mysql_query("UPDATE `p_users` SET `user_balance`=`user_balance`+'{$user_profit}',`user_total_zarabotok`=`user_total_zarabotok`+'{$user_profit}',`total_roulette_money`=`total_roulette_money`+'{$user_profit}',`total_roulette_win`=`total_roulette_win`+'1'  WHERE `user_id`='{$winner_id}' LIMIT 1",$db) or die(mysql_error());




//стата для админа
$add_roulette_stat_admin = mysql_query("UPDATE `p_roulette_stat` SET `last_game_data`='{$data_roulette}',`admin_profit`=`admin_profit`+'{$formula}',`total_game`=`total_game`+'1'  WHERE `id`='1' LIMIT 1",$db) or die(mysql_error());


//чистим таблицу юзеров рулетки
$cleaning_roulette_tab = mysql_query("TRUNCATE TABLE `p_roulette_users_game_4`",$db) or die(mysql_error());

//}


} else {

$update_check_finish = mysql_query("UPDATE `p_roulette_users_game` SET `check_finish`='0' WHERE `id`='1' LIMIT 1",$db) or die(mysql_error());

}


}

}


//время
function last_game_time_win($db,$q)
{

	$query = mysql_query("select * from `p_roulette_users_stat_4` ORDER BY `id` DESC LIMIT 1",$db) or die(mysql_error());
	$result = mysql_fetch_array($query);
	return $result[$q];
}


  list($date, $time) = explode(" ", last_game_time_win($db,4)); 
  list($year,$month,$day) = explode("-", $date); 
  list($hour, $minute, $second) = explode(":", $time); 
  $time_last_win = mktime($hour, $minute, $second, $month, $day, $year);


$period_time = time() - $time_last_win;

if ($period_time < 20){

$winner_animation = file_get_contents('p.php');

} else {

$winner_animation = 0;

$win_r = 0;


//показываем победителя
if ($period_time <26){
$p = 0;
$win_name = '
<div class="user user-sidebar" style="background: #2F343A; width: 95%; margin: 0 auto; border: 2px solid #1088ee; padding: 15px;">
<div class="user-avatar-top">
<img width="90" height="90" src="'.last_game_time_win($db,3).'" class="win_avatar">
</div>

<div class="user-info-top">
<div class="user-name-top" style="padding-left: 30px;">Победитель: '.last_game_time_win($db,2).' с шансом '.last_game_time_win($db,7).'%</div>
<div class="user_balance-top" style="color: #fff; padding-left: 30px; padding-top: 1px; font-size: 15px;">Ставка: '.last_game_time_win($db,6).' RUB</div>
<div class="user_balance-top" style="color: #fff; padding-left: 30px; padding-top: 1px; font-size: 18px;">Выигрыш: '.last_game_time_win($db,5).' RUB</div>
</div>
</div>

<br/><br/><br/><br/><br/><br/>
';

} else {$period_time = 0; $win_name = 0; $p = 1; $winner_animation = 0;}



}


if ($prava >0) {
if (up_users_num($db,'where `user_id`='.$_SESSION['ses_user'].'',1) == 0) {$user_in = 0;} else {$user_in = 1;}
} else {$user_in = 0;}	

// массив для ответа
$result = array(
	'total_users' => $total_users_in,
    'vusers' => up_users_num($db,'ORDER BY `data` DESC LIMIT 10',3),
	'last_game' => up_users_stats($db),
	'res' => $res,
	'new_balance' => '<b>'.round($user_balance_global,2).' RUB</b>',
	'time_to_show' => $progress_bar,
	'time_to_finish' => $p,
	'user' => $user_in,
	'bank' => up_bank($db).' RUB',
	'win' => $win_name,
	'win_time'=> $period_time,
	'win_r' =>$win_r,
	'winner_animation' => $winner_animation,
);
echo json_encode($result);

?> 