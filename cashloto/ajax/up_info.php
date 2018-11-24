<?
session_start();
include("../inc/inc_db.php");
include ("../inc/lib.php");


    $error = 0;
	
	
	
	function showDate( $date ) // $date --> время в формате Unix time
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
    

	$users_roulette_koll = mysql_query("SELECT * FROM `p_roulette_users_game` $qx ",$db) or die(mysql_error());
	
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
//$result .= '<td bgcolor="#464646" style="border-bottom: 1px solid #ccc; color: #fff;">id</td>';
$result .= '<td align="left" colspan="2" bgcolor="#2F343A" style="color: #FF6A00; font-size: 17px;" >Пользователь</td>';
$result .= '<td align="left" bgcolor="#2F343A" style="color: #FF6A00; font-size: 17px;" >Ставка</td>';
$result .= '<td align="left" bgcolor="#2F343A" style="color: #FF6A00; font-size: 17px;" >Когда</td>';
$result .= '</tr>';
	
	
	while($row = mysql_fetch_array($users_roulette_koll))
	{
	if ($cv == 1) { $bg_color = "2F343A"; $td_color = "ffffff"; $cv=0; } else { $bg_color = "2F343A"; $td_color = "ffffff"; $cv++; }
	$result .= '<tr class="user_row">';
	//$result .= '<td bgcolor="'.$bg_color.'"  style="border-bottom: 1px solid #ccc;" width="50px"><span style="font-size: 17px;">'.$row['user_id'].'</span></td>'; 
	$result .= '<td bgcolor="'.$bg_color.'" align="center" style="color: #141518 !important;" width="50px"><img class="table_avatar" src="'.$row['avatar'].'" /></td>';
	$result .= '<td bgcolor="'.$bg_color.'" align="left" style="color: #141518 !important;" width="200px"><span style="font-size: 17px; color: #'.$td_color.';">'.$row['user_login'].'</span> </td>';
	$result .= '<td bgcolor="'.$bg_color.'" style="color: #141518 !important;" width="150px"> <span style="font-size: 17px; color: #'.$td_color.';">2.00 RUB</span></td>';
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
    

	$users_roulette_koll = mysql_query("SELECT * FROM `p_roulette_users_stat` ORDER BY `data` DESC LIMIT 10",$db) or die(mysql_error());
	

	
$result .= '<table align="left" border="0" style="margin-top: 0px;" width="100%" class="stat_tab" cellpadding="5" cellspacing="0">';
$result .= '<tr>';
//$result .= '<td bgcolor="#464646" style="border-bottom: 1px solid #ccc; color: #fff;">id</td>';
$result .= '<td align="left" colspan="2" bgcolor="#2F343A" style="color: #FF6A00; font-size: 17px;" >Пользователь</td>';
$result .= '<td align="left" bgcolor="#2F343A" style="color: #FF6A00; font-size: 17px;">Выиграл?</td>';
$result .= '<td align="left" bgcolor="#2F343A" style="color: #FF6A00; font-size: 17px;">Выигрыш</td>';
$result .= '</tr>';
	
	
	while($row = mysql_fetch_array($users_roulette_koll))
	{
	if ($cv == 1) { $bg_color = "2F343A"; $td_color = "ffffff"; $cv=0; } else { $bg_color = "2F343A"; $td_color = "ffffff"; $cv++; }
	
	if($row['lost'] == 0) {$win ='да';} else {$win ='нет'; $bg_color ='#F5DEB3'; $td_color = "2F343A";}
	
    $result .= '<tr class="user_row">';
	//$result .= '<td bgcolor="'.$bg_color.'" style="border-bottom: 1px solid #ccc;" width="50px"><span style="font-size: 17px;">'.$row['user_id'].'</span></td>';
	$result .= '<td bgcolor="'.$bg_color.'" align="center" style="color: #141518 !important;" width="50px"><img class="table_avatar" src="'.$row['avatar'].'" /></td>';
	$result .= '<td bgcolor="'.$bg_color.'" align="left" style="color: #141518 !important;" width="200px"><span style="font-size: 17px; color: #'.$td_color.';">'.$row['user_login'].'</span></td>';
	$result .= '<td bgcolor="'.$bg_color.'" style="color: #141518 !important;" width="150px"><span style="font-size: 17px; color: #'.$td_color.';">'.$win.'</span></td>';
	$result .= '<td bgcolor="'.$bg_color.'" style="color: #141518 !important;" width="150px"><span style="font-size: 17px; color: #'.$td_color.';">'.$row['sum'].' RUB</span></td>';
	$result .= '</tr>';

	}
$result .= '</table>';
	
	return $result;
	

}






$time_to_show = up_users_num($db,' WHERE `id`=1',2) - time();
$total_users_in = up_users_num($db,'ORDER BY `data` DESC LIMIT 10',1);



if ($total_users_in == 2) {
$max_users_progress = 10;
} 

elseif ($total_users_in == 3) {
$max_users_progress = 15;
}

elseif ($total_users_in == 4) {
$max_users_progress = 20;
}

elseif ($total_users_in == 5) {
$max_users_progress = 25;
}

elseif ($total_users_in == 6) {
$max_users_progress = 30;
}

elseif ($total_users_in == 7) {
$max_users_progress = 35;
}

elseif ($total_users_in == 8) {
$max_users_progress = 40;
}

elseif ($total_users_in == 9) {
$max_users_progress = 45;
}

elseif ($total_users_in == 10) {
$max_users_progress = 50;
}




























if ($time_to_show <0) {

$time_to_finish = 1;

}

else {

//$progress_bar; 
$formula_progressa = floor(($time_to_show * 100)/$max_users_progress);

$progress_bar = '<div style="color: #fff;">Подождите...</div><progress title="осталось '.$time_to_show.' сек." value="'.$formula_progressa.'" max="100"></progress>';

//$time_to_finish = 0;
$luser_name = 0;
}

























//если юзеров больше этого количества, то рулетка будет запущена
$user_num_start_roulette = 1;


if ($time_to_finish == 1 and up_users_num($db,' WHERE `id`=1',4) == 0) {


//если юзеров больше 1, то запускаем рулетку
if (up_users_num($db,'ORDER BY `data` DESC LIMIT 10',1) > $user_num_start_roulette) {

$update_check_finish = mysql_query("UPDATE `p_roulette_users_game` SET `check_finish`=`check_finish`+'1' WHERE `id`='1' LIMIT 1",$db) or die(mysql_error());
//ожидание
sleep(1);
$finish_num = mysql_query("SELECT `check_finish` FROM `p_roulette_users_game` WHERE `id`='1' ",$db) or die(mysql_error());
	
$finish_num_rov = mysql_fetch_array($finish_num);
//////
if ($finish_num_rov['check_finish'] == 1) {

include("../ajax/cron.php");

} else {

$update_check_finish = mysql_query("UPDATE `p_roulette_users_game` SET `check_finish`='0' WHERE `id`='1' LIMIT 1",$db) or die(mysql_error());

}


}

}















//проигравший

//время
function last_game_time_luser($db,$q)
{

	$query = mysql_query("select * from `p_roulette_users_stat` where `lost`='1'",$db) or die(mysql_error());
	$result = mysql_fetch_array($query);
	return $result[$q];
}




  list($date, $time) = explode(" ", last_game_time_luser($db,4)); 
  list($year,$month,$day) = explode("-", $date); 
  list($hour, $minute, $second) = explode(":", $time); 
  $time_last_luser = mktime($hour, $minute, $second, $month, $day, $year);



$period_time = time() - $time_last_luser;


if ($period_time <8){
$pizda = 0;
$luser_name = '<div style="color: #FF6A00; font-size: 18px;">Проиграл:</div><br/>
<div class="user user-sidebar" style="background: #2F343A; width: 370px; margin: 0 auto; border: 1px solid #FF6A00; padding: 10px;">
<div class="user-avatar-top">
<img width="70" height="70" src="'.last_game_time_luser($db,3).'" class="sidebar_avatar">
</div>

<div class="user-info-top">
<div class="user-name-top" style="padding-left: 10px;">'.last_game_time_luser($db,2).'</div>
<div class="user_balance-top" style="color: #fff; padding-left: 10px; padding-top: 3px; font-size: 15px;">- 2.00 RUB</div>
</div>
</div>';

} else {$period_time = 0; $luser_name = 0; $pizda = 1;}

//
















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
	'time_to_finish' => $pizda,
	//'user' => ''.up_users_num($db,'where `user_id`='.$_SESSION['ses_user'].'',1).'',
	'user' => $user_in,
	'luser' => $luser_name,
	'luser_time'=> $period_time,
);
echo json_encode($result);


//}
?> 