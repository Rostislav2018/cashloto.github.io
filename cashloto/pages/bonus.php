<?
if ($mode == 'bonus') {


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

?>

<div class="content">

<div class="h1_content">БОНУС ОТ ПРОЕКТА</div>
<div style="text-align: left; margin-bottom: 30px;">
Для получения бонуса от нашего проекта, Вы должны быть подписаны на нашу <a style="color: #FF6A00;" href="<? echo $site_vk_pub?>" target="_blank">группу вконтакте</a><br> Бонус можно получать 1 раз в час. Сумма бонуса от 1 копейки до 1 рубля.
</div>
<?
//id группы вк
$vk_site_pub_id = 151600998;


if ($_POST['bonus']) {

$user_zapros = mysql_query("SELECT `last_bonus` FROM `p_users` WHERE `user_id`='{$_SESSION['ses_user']}' LIMIT 1",$db) or die(mysql_error());
$row = mysql_fetch_array($user_zapros);
$lastbonustime = $row['last_bonus'];

$nowtime = time();
$nowdate = time();
$data_today = date("Y-m-d");
$user_lucky_ip = $_SERVER['REMOTE_ADDR'];
$date_winner = time();
$amplitude = $nowdate - $lastbonustime;
if($amplitude > $bonus_interval or $lastbonustime == '')
{

$resp = file_get_contents('https://api.vk.com/method/groups.isMember?group_id='.$vk_site_pub_id.'&user_id='.$vk_user_id_global.'');
$data = json_decode($resp, true);
if($data['response']=='1'){

$bonus_min = $bonus_min_summ;
$bonus_max = $bonus_max_summ;


//$bonus_min = 1;
//$bonus_max = 100;


$sum_b = rand($bonus_min, rand($bonus_min, $bonus_max));
$sum_winner = $sum_b/100;

//добавим бонус
$userbonus = mysql_query("UPDATE `p_users` SET `user_balance`=`user_balance`+'{$sum_winner}', `last_bonus`='{$nowtime}' WHERE `user_id`='{$_SESSION['ses_user']}' LIMIT 1",$db) or die(mysql_error());


//добавим в таблицу с статой
$add_stat_tab = mysql_query ("INSERT INTO `p_stat_bonus` (`user_id`, `summa`, `data`, `ip`) VALUES ('{$_SESSION['ses_user']}', '{$sum_winner}','{$date_winner}','{$user_lucky_ip}')",$db);
echo '<center><div style="padding: 10px; color: #FF6A00;">Вы получили бонус в размере - '.$sum_winner.' RUB</div></center>';	

}

else {echo '<center><div style="padding: 10px; color: #FF6A00;">Для получения бонуса подпишитесь на наш паблик - <a style="color: #1088ee;" href="'.$site_vk_pub.'" target="_blank">'.$site_vk_pub.'</a></div></center>';}

}

else { echo '<center><div style="padding: 10px; color: #FF6A00;">Вы уже получали бонус за последние 24 часа!</div></center>';}

}


//проверяем когда юзер получал бонус

$user_zapros = mysql_query("SELECT `last_bonus` FROM `p_users` WHERE `user_id`='{$_SESSION['ses_user']}' LIMIT 1",$db) or die(mysql_error());
$row = mysql_fetch_array($user_zapros);
$lastbonustime = $row["last_bonus"];

$time = time();

$formula = $lastbonustime + $bonus_interval;

$diff = $formula - $time;

$amplitude = $time - $lastbonustime;
if($amplitude > $bonus_interval or $lastbonustime =='')
{

echo'
<div style="padding: 20px;">
<form action="" method="post">

<input class="knop" name="bonus" style="width: 207px;" type="submit" value="Получить бонус" />

</form>
</div>
';

}

else {
?>

 <p style="text-align: center;">До следующего бонуса осталось:</p>
            <div style="width: 240px; margin: 0px auto; margin-top: 10px; text-align: center; margin-bottom: 30px;">
       
      	
      			<div id="clock"></div>
      		
      </div>
<br/>
	

      <script>
	  jQuery("#clock").flipcountdown({
      size:"md"
	  });
	  
      $(function() {
      $('#clock').flipcountdown({
	  
      beforeDateTime:new Date(<?=$diff;?>+(new Date()).valueOf()/1000)
         });
      });
      </script>


<?
}

echo' <div style="text-align: center; margin-bottom: 15px;">Последние 100 начислений</div>';


$viplati = mysql_query("SELECT * FROM `p_stat_bonus` ORDER BY `id` DESC LIMIT 100",$db) or die(mysql_error());
$rowviplati = mysql_fetch_array($viplati);
				
if ($rowviplati>0) {	
echo'<table align="left" border="0" style="margin-top: 0px;" width="100%" class="stat_tab"  cellpadding="5" cellspacing="0">
<tr>
<td align="left" colspan="2" bgcolor="#2F343A" style="color: #FF6A00; font-size: 17px;">Пользователь</td>
<td align="left" bgcolor="#2F343A" style="color: #FF6A00; font-size: 17px;">Сумма</td>
<td align="left" bgcolor="#2F343A" style="color: #FF6A00; font-size: 17px;">Когда</td>
</tr>';
do {

$zapros = mysql_query("SELECT * FROM `p_users` WHERE `user_id`='{$rowviplati['user_id']}' LIMIT 1",$db) or die(mysql_error());
$row = mysql_fetch_array($zapros);
$lucky_user = $row["user_login"];

$lucky_user_avatar = $row["vk_avatar"];

$data = date('j F Y',$rowviplati['data']);
$vrem = time();
$seg = date('j F Y',$vrem);
if ($data == $seg) { $data = 'Сегодня, в'; }
$chas = date('G:i',$rowviplati['data']);

if ($cv == 1) { $bg_color = "2F343A"; $td_color = "ffffff"; $cv=0; } else { $bg_color = "2F343A"; $td_color = "ffffff"; $cv++; }

echo'
<tr>
<td bgcolor="'.$bg_color.'" align="center" style="color: #141518 !important;" width="50px"><img class="table_avatar" src="'.$lucky_user_avatar.'" /></td>
<td bgcolor="'.$bg_color.'" align="left" style="color: #141518 !important;" width="200px"><span style="font-size: 17px; color: #'.$td_color.';">'.$lucky_user.'</span> </td>
<td bgcolor="'.$bg_color.'" style="color: #141518 !important;" width="150px"> <span style="font-size: 17px; color: #'.$td_color.';">'.$rowviplati['summa'].' RUB</span></td>
<td bgcolor="'.$bg_color.'" style="color: #141518;" width="150px"> <span style="font-size: 17px; color: #'.$td_color.';">'.showDate($rowviplati['data']).'</span></td>
</tr>';}
while($rowviplati = mysql_fetch_array($viplati));
echo'</table>';
	
} else {echo '<center>Бонус еще никто не получал</center>';}

?>


</div>

<?}?>