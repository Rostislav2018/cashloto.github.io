<?

if ($mode == 'room_default') {
//кол-во юзеров в рулетке
function up_users($db,$q)
{

$users_roulette_koll = mysql_query("SELECT * FROM `p_roulette_users_game` $q",$db) or die(mysql_error());
$koll_users_roulette = mysql_num_rows($users_roulette_koll);

return $koll_users_roulette;
}

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
	$result .= '<td bgcolor="'.$bg_color.'" style="color: #141518 !important;" width="150px"><span style="font-size: 17px; color: #'.$td_color.';">'.$win.' </span></td>';
	$result .= '<td bgcolor="'.$bg_color.'" style="color: #141518 !important;" width="150px"><span style="font-size: 17px; color: #'.$td_color.';">'.$row['sum'].' RUB </span></td>';
	$result .= '</tr>';

	}
$result .= '</table>';
	
	return $result;
	

}


?>

<div class="content">

<center>
Здесь разместить видео о проекте

 </center> 

<div class="decs_text" style="padding: 0px;">



<br><br>
<? echo $site_title_main?> - сервис моментальных лотерей между живыми людьми на реальные деньги!<br>


Чтобы играть с другими людми, Вам нужно авторизоваться, выбрать комнату и сделать ставку! <br>

После завершения всех ставок, система автоматически через 30 секунд выбирает победителя, который забирает все деньги находящиеся в банке комнаты себе!<br>

Удачной игры на нашем проекте <? echo $site_title_main?>!






</div>
	









</div><!--content end-->


<?}?>