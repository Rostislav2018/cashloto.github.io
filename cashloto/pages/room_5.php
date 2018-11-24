<?
if ($mode == 'room_5') {
$site_commission_loto_room_5 = 10;
function up_bank($db)
{
global $site_commission_loto_room_5;

$query = mysql_query("select SUM(`sum_bet`) from `p_roulette_users_game_5`",$db) or die(mysql_error());
$result = mysql_fetch_array($query);
$real_bank = $result[0]+0;

$formula = $real_bank/100 * $site_commission_loto_room_5;

$bank = $real_bank - $formula;

return round($bank,2);

}


//кол-во юзеров в рулетке
function up_users($db,$q)
{

$users_roulette_koll = mysql_query("SELECT * FROM `p_roulette_users_game_5` $q",$db) or die(mysql_error());
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
    

	$users_roulette_koll = mysql_query("SELECT * FROM `p_roulette_users_game_5` $qx ",$db) or die(mysql_error());
	
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
    

	$users_roulette_koll = mysql_query("SELECT * FROM `p_roulette_users_stat_5` ORDER BY `data` DESC LIMIT 10",$db) or die(mysql_error());
	

	
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

?>

<div class="content">

<script>	

$(function() {

var mess_interval;

		function displayMessage(text, color) {
		clearTimeout(mess_interval);
		$('#message').css('color', color);
		$('#message').html(text);
		mess_interval = setTimeout(function() { $('#message').html(''); }, 5000);
	}		
			
				
				
      $( "#betForm" ).submit(function( event ) {
	  event.preventDefault();

		displayMessage('Подождите....', '#fff');
		$('#betForm').css('opacity', 0.3);
		
		$.ajax({
			url: '/ajax/check_of_bet_room_5.php',
			type: "POST",
			data: $('#betForm').serialize(),
			dataType: 'json',
			cache: false,
			success: function(res) {
                    if (res['error']=='7') {
					window.location = "/login";
					return;
					}
				if (res['error']!=undefined) {
					displayMessage('ОШИБКА: '+res['error'], '#ff6b80');
				}

					if (res['res'] =='ok') {
					displayMessage('Ставка принята!', '#5cb85c');
					$('.user_balance_osn').each(function () { $(this).html(res['new_balance']) } );
                    
				};
				

				$('#betForm').css('opacity', 1);
			}, error: function(res) {
				$('#message').html( 'Запрос не удался. Попробуйте еще раз.' );
					$('#message').css('color', '#ff6b80');
			}
		});
			
	});
	
	
	});

var fack = 0;


function update_page(){
$.ajax({
type: "POST",
url: "/ajax/up_info_room_5.php",
cache: false,

success: function(html) {
			data = JSON.parse(html);
			$("#all_users_ruletka").html(data.total_users);
			$("#vusers").html(data.vusers);
			$("#last_game").html(data.last_game);
			$("#timer").html(data.time_to_show);
			//$(".user_balance_osn").html(data.new_balance);
			$("#bank").html(data.bank);
			$("#win_block").html(data.win);
			$('#window').css({right: data.win_r});
			$(".list").html(data.winner_animation);
			var n_balance = data.new_balance;
            var kk = data.user;
	        var ww = data.total_users;
			var we = data.time_to_show;
			var fi = data.time_to_finish;
			var win = data.win;
			var win_time = data.win_time;
            var winner_animation = data.winner_animation;
			hide_wait(fi,ww);
			hide_win(win);
			win_animate(winner_animation,n_balance);
			start_win_animate(winner_animation);
		}
	
	});
	
}






function win_animate(winner_animation,n_balance) {

if(winner_animation == 0) {

$('#win_animate').css( 'display', 'none' );

$(".user_balance_osn").html(n_balance);

} else {

fack = 1;

$('#win_animate').css( 'display', 'block' );


}

}


function hide_wait(fi,ww) {

if(fi == 0 || ww >1) {
$('#wait').hide();


}


else {
$('#wait').show();
$('#tab_bet').show();



}

}


function hide_win(win) {

if( win == 0) {
$('#win_block').hide();



$('#num_users').show();

$('#game_users').show();

$('#last_game_users').show();
} else {
$('#win_block').show();
$('#wait').hide();
$('#tab_bet').hide();
$('#num_users').hide();


$('#last_game_users').hide();

$('#game_users').hide();




}

}



if (fack == 0) {

setInterval("update_page();",2000);

} else {

setInterval("update_page();",15000);
}



	
</script>	



<div class="decs_text" style="padding: 0px;"><center>Максимальное количество участников - без ограничений. <br>Розыгрыш начинается после ставок 2-х участников.<br> Выигрывает только один участник и забирает себе весь банк. <br>  </center></div>
	

<img src="/img/10.png"  />


<center>
<span id='message'>&nbsp;</span>
<br/>
<span id="timer">

</span>

<div id="win_block"></div>	

<style>

#window {
    overflow: hidden;
    position: relative;
    max-width: 25000px;
	width: 25000px;
    height: 108px;
    right: 0px;
}

.wr {
    position: relative;
    margin: auto;
    margin-top: 2px;
    width: 500px;
    overflow-x: hidden;
    overflow-y: hidden;
    border: 2px solid #1088ee;
    border-radius: 2px;
}

.list {
    position: relative;
    display: inline-block;
}


.list li {
border: 4px solid transparent ;

    list-style: none;
    display: inline-block;
    float: left;
}

.list li img {
    width: 100px;
    height: 100px;
}

.arrowup {
    position: absolute;
    bottom: 0;
    right: 244px;
    z-index: 1;
    width: 0;
    height: 0;
    border-bottom: 20px solid #1088ee;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
}

.arrowdown {
    position: absolute;
    top: 0;
    right: 244px;
    z-index: 1;
    width: 0;
    height: 0;
    border-top: 20px solid #1088ee;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
}

</style> 

<div id="win_animate" style="display: none;">

<div style="margin-bottom: 10px;">ВЫБОР ПОБЕДИТЕЛЯ</div>

<div class="wr">
<div class="arrowup"></div>
<div class="arrowdown"></div>
<div id="window">

<ul class="list" style="width: 25000px;">
           
</ul>

</div>
</div>


<script>
function start_win_animate(winner_animation) {
if(winner_animation == 0) {

$("#window").stop(true);
$('#window').css({right:"0"});


} else {


$('#window').animate({ right: ($('#win').position().left) - 197}, 11000);
 

}

}

</script>

<br/><br/><br/><br/>
</div>	

<div id="wait"><div id="man"><div id="eye-l"></div><div id="eye-r"></div><div id="nose"></div><div id="mouth"></div></div><div id="wall">ОЖИДАНИЕ ИГРОКОВ</div></div>
	
<br/>
<div id="num_users">
УЧАСТНИКОВ В ИГРЕ: <span align="center" id="all_users_ruletka"><? echo up_users($db,'ORDER BY `sum_bet` DESC limit 10');?></span>
<br/>
БАНК: <span align="center" id="bank"><? echo up_bank($db);?> RUB</span>
<br/>
</div>
</center>

<center>
<div style="margin: 0 auto;">
<?//if (up_users($db,'where `user_id`='.$_SESSION['ses_user'].'')==0) {?>
<span id="tab_bet">
<form method="post" id="betForm">
<table align="center" style="width: 100%;">
<tr>

<td valign="center" id="sub" style="text-align: center;">
<input type="text" placeholder="Сумма" style="width:100px;" value="10" name="sum_bet">
<input class="knop" style="width:207px;" type="submit" value="Сделать ставку" >

</td>
</tr>
</table>
</form>
</span>
<?//}?>
</div>
</center>

<table width="100%" align="center">

<tr>

<td width="50%" align="center" id="game_users">

<br/>
<center>ТЕКУЩАЯ ИГРА</center>

<br/>
<span id="vusers"><? echo up_users_num($db,'ORDER BY `sum_bet` DESC LIMIT 10',3)?></span>

</td>

</tr>

<tr>

<td width="50%" align="center" id="last_game_users">
<br/>
<center>ПОБЕДИТЕЛИ ПРЕДЫДУЩИХ ИГР</center>
<br/>

<span id="last_game"><? echo up_users_stats($db)?></span>
</td>

</tr>

</table>

</div><!--content end-->
<?}?>