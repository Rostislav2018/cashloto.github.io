<? session_start();
include("../inc/inc_db.php");
include('../inc/cpayeer.php');
include('../inc/inc_payeer.php');

function russian_date() {
$translation = array("am" => "дп", "pm" => "пп", "AM" => "ДП", "PM" => "ПП", "Monday" => "Пн:", "Mon" => "Пн", "Tuesday" => "Вт.", "Tue" => "Вт", "Wednesday" => "Среда", "Wed" => "Ср", "Thursday" => "Чт.", "Thu" => "Чт", "Friday" => "Пт.", "Fri" => "Пт", "Saturday" => "Сб.", "Sat" => "Сб", "Sunday" => "Вс.", "Sun" => "Вс", "January" => "Января", "Jan" => "Янв", "February" => "Фев.", "Feb" => "Фев", "March" => "Марта", "Mar" => "Мар", "April" => "Апреля", "Apr" => "Апр", "May" => "Мая", "May" => "Мая", "June" => "Июня", "Jun" => "Июн", "July" => "Июля", "Jul" => "Июл", "August" => "Августа", "Aug" => "Авг", "September" => "Сентября", "Sep" => "Сен", "October" => "Октября", "Oct" => "Окт", "November" => "Ноября", "Nov" => "Ноя", "December" => "Декабря", "Dec" => "Дек", "st" => "ое", "nd" => "ое", "rd" => "е", "th" => "ое",);
   if (func_num_args() > 1) {
      $timestamp = func_get_arg(1);
      return strtr(date(func_get_arg(0), $timestamp), $translation);
   } else {
      return strtr(date(func_get_arg(0)), $translation);
   };
}





function globper($a) 
{
if (isset($_REQUEST[$a])) { $per = $_REQUEST[$a]; 
$per = trim($per);  $per = htmlspecialchars($per); 
$per = mysql_real_escape_string($per); return $per;}	
else { return null; }
}

$act = globper('act');
$mod = globper('mod');
$page = globper('page');
if (empty($page)) $page=1;

$page2 = globper('p');
if (empty($page2)) $page2=1;

$acom = globper('acom');

function al($a){ echo '<script type="text/javascript">$(document).ready(function() { alert("'.$a.'"); });</script>'; }



function postr($num,$link,$p,$count,$db,$sk) 
{
$skybase1 = mysql_query("SELECT COUNT(*) FROM ".$count."",$db);
$temp = mysql_fetch_array($skybase1);
$rezult[30] = $temp[0];
$vsegop = (($rezult[30]-1)/$num)+1;
$vsegop =  intval($vsegop);
$p = intval($p);
if(empty($p) or $p <= 0) $p = 1;
if($p > $vsegop) $p = $vsegop;
$start = $p * $num - $num;
if ($start < 0) { $start = 0;}
if ($p > $sk) $rezult[0] = '<a class="nav" href="'.$link.'&page=1">1</a> ';
if ($p !=1) $rezult[20] = '<a class="nav" title=предидущая  href="'.$link.'&page='. ($p-1) .'"><</a> ';
if ($vsegop > 1 and ($p-1) > $sk) { $rezult[1] = '<span class="ser"> ... </span> '; }
$p2 = $vsegop - $p;
if ($vsegop > 1 and ($p2-1) >= $sk) { $rezult[2] = ' <span class="ser"> ... </span>'; }
if ((($p-1)+$sk) < $vsegop) $rezult[14] = ' <a class="nav" href="'.$link.'&page=' .$vsegop. '">'.$vsegop.'</a>';
if ($p != $vsegop) $rezult[21] =' <a class="nav" title="следующая" href='.$link.'&page='. ($p+1) .'>></a> ';
if($p-5 > 0 && $sk >= 6) $rezult[3] = ' <a class="nav" href='.$link.'&page='.($p-5).'>'.($p-5).'</a> ';
if($p-4 > 0 && $sk >= 5) $rezult[4] = ' <a class="nav" href='.$link.'&page='.($p-4).'>'.($p-4).'</a> ';
if($p-3 > 0 && $sk >= 4) $rezult[5] = ' <a class="nav" href='.$link.'&page='.($p-3).'>'.($p-3).'</a> ';
if($p-2 > 0 && $sk >= 3) $rezult[6] = ' <a class="nav" href='.$link.'&page='.($p-2).'>'.($p-2).'</a> ';
if($p-1 > 0 && $sk >= 2) $rezult[7] = ' <a class="nav" href='.$link.'&page='.($p-1).'>'.($p-1).'</a> ';
if($p+5 <= $vsegop && $sk >= 6) $rezult[8] = ' <a class="nav" href='.$link.'&page='.($p+5).'>'.($p+5).'</a> ';
if($p+4 <= $vsegop && $sk >= 5) $rezult[9] = ' <a class="nav" href='.$link.'&page='.($p+4).'>'.($p+4).'</a> ';
if($p+3 <= $vsegop && $sk >= 4) $rezult[10] = ' <a class="nav" href='.$link.'&page='.($p+3).'>'.($p+3).'</a> ';
if($p+2 <= $vsegop && $sk >= 3) $rezult[11] = ' <a class="nav" href='.$link.'&page='.($p+2).'>'.($p+2).'</a> ';
if($p+1 <= $vsegop && $sk >= 2) $rezult[12] = ' <a class="nav" href='.$link.'&page='.($p+1).'>'.($p+1).'</a> ';
$rezult[15] = $start; $rezult[16] = $num; $rezult[17] = $vsegop;
return $rezult;
}

function vpostr($rezult,$p) 
{
Error_Reporting(E_ALL & ~E_NOTICE);
echo '<center><div class="navbar">';
echo $rezult[20].$rezult[0].$rezult[1].$rezult[3].$rezult[4].$rezult[5].$rezult[6].$rezult[7].'<span class="nav"><strong>'.$p.'</strong></span>'.$rezult[12].$rezult[11].$rezult[10].$rezult[9].$rezult[8].$rezult[2].$rezult[14].$rezult[21];
echo '</div><br />';
}











include ("../inc/lib.php");
$ok = globper('ok'); $cat_id = globper('cat_id'); $ob_id = globper('ob_id'); $acton = globper('acton');
$ob_text = globper('ob_text'); $ob_url = globper('ob_url'); $ob_tema = globper('ob_tema'); $ob_do = globper('ob_do'); $kol = globper('kol'); $mestoxy = globper('mestoxy');

$mesege_text = $_POST['mesege_text'];

$user_id = globper('user_id');
$user_search_post = globper('search');


//вход, если запомнили
if (isset($_COOKIE['u_id']) && isset($_COOKIE['u_pass']))
	{
		$_SESSION['ses_user'] = $_COOKIE['u_id'];
		$_SESSION['pass'] = $_COOKIE['u_pass'];
	}
//проверка
if (isset($_SESSION['ses_user']) && isset($_SESSION['pass']))
	{
	$ses_user = (isset($_SESSION['ses_user'])) ? mysql_real_escape_string($_SESSION['ses_user']) : '';
	$pass = (isset($_SESSION['pass'])) ? mysql_real_escape_string($_SESSION['pass']) : '';
	$skybase = mysql_query("SELECT `user_id`,`user_login`,`user_pass`,`user_prava`
	FROM `p_users` WHERE `user_pass`='{$pass}' AND `user_id`='{$ses_user}' LIMIT 1",$db) or die(mysql_error());
		if (mysql_num_rows($skybase) == 1)
		{	$skyrow = mysql_fetch_array($skybase);
			$prava = $skyrow['user_prava'];
			$name =  $skyrow['user_login'];
		}
		else { echo '<link href="st.css" rel="stylesheet" type="text/css"><center><br /><div class="alert">Попытка взлома. Работа скрипта остановлена</div><br /></center>'; exit(); }
	}
if ($prava != 5) { echo '<link href="st.css" rel="stylesheet" type="text/css">
<center><br /><div class="alert">Извините, раздел только для администратора</div><br /></center>'; exit(); }

   
	
	
	//ЗАБАНИТЬ ЮЗЕРА
	if ($act=='start_ban' && !empty($user_id))
	{
									
	$start_user_ban = mysql_query("UPDATE `p_users` SET `chek_ban`='1' WHERE `user_id`='{$user_id}' LIMIT 1",$db) 
									or die(mysql_error());

	header('Location: /admin/index.php?act=users&page='.$page.'');
									
	}
	
	//РАЗБАНИТЬ ЮЗЕРА
	if ($act=='stop_ban' && !empty($user_id))
	{
	
					
	$stop_user_ban = mysql_query("UPDATE `p_users` SET `chek_ban`='0' WHERE `user_id`='{$user_id}' LIMIT 1",$db) 
									or die(mysql_error());
									
	header('Location: /admin/index.php?act=users&page='.$page.'');							
	}
	
	
	
    //ЗАБАНИТЬ ЮЗЕРА В ПРОФИЛЕ
	if ($act=='start_ban_profile' && !empty($user_id))
	{
									
	$start_user_ban = mysql_query("UPDATE `p_users` SET `chek_ban`='1' WHERE `user_id`='{$user_id}' LIMIT 1",$db) 
									or die(mysql_error());

	header('Location: /admin/index.php?act=user&user_id='.$user_id.'');
									
	}
	
	//РАЗБАНИТЬ ЮЗЕРА В ПРОФИЛЕ
	if ($act=='stop_ban_profile' && !empty($user_id))
	{
	
					
	$stop_user_ban = mysql_query("UPDATE `p_users` SET `chek_ban`='0' WHERE `user_id`='{$user_id}' LIMIT 1",$db) 
									or die(mysql_error());
									
	header('Location: /admin/index.php?act=user&user_id='.$user_id.'');							
	}
	
	
	
	
	//ЗАБАНИТЬ ЮЗЕРА В ПОИСКЕ
	if ($act=='start_ban_search' && !empty($user_id) && $user_search_post)
	{
									
	$start_user_ban = mysql_query("UPDATE `p_users` SET `chek_ban`='1' WHERE `user_id`='{$user_id}' LIMIT 1",$db) 
									or die(mysql_error());

	header('Location: /admin/index.php?act=users_search&search='.$user_search_post.'');
									
	}
	
	//РАЗБАНИТЬ ЮЗЕРА В ПОИСКЕ
	if ($act=='stop_ban_search' && !empty($user_id) && $user_search_post)
	{
	
					
	$stop_user_ban = mysql_query("UPDATE `p_users` SET `chek_ban`='0' WHERE `user_id`='{$user_id}' LIMIT 1",$db) 
									or die(mysql_error());
									
	header('Location: /admin/index.php?act=users_search&search='.$user_search_post.'');							
	}
	
	
	//ЗАБАНИТЬ ЮЗЕРА В СПИСКЕ МУЛЬТИАККОВ
	if ($act=='start_ban_check_ip' && !empty($user_id))
	{
									
	$start_user_ban = mysql_query("UPDATE `p_users` SET `chek_ban`='1' WHERE `user_id`='{$user_id}' LIMIT 1",$db) 
									or die(mysql_error());

	header('Location: /admin/index.php?act=users_check_ip&page='.$page.'');
									
	}
	
	//РАЗБАНИТЬ ЮЗЕРА В СПИСКЕ МУЛЬТИАККОВ
	if ($act=='stop_ban_check_ip' && !empty($user_id))
	{
	
					
	$stop_user_ban = mysql_query("UPDATE `p_users` SET `chek_ban`='0' WHERE `user_id`='{$user_id}' LIMIT 1",$db) 
									or die(mysql_error());
									
	header('Location: /admin/index.php?act=users_check_ip&page='.$page.'');							
	}
	
	
	





?>
<html xml:lang="ru" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Админка</title>
<link href="/css/st.css" rel="stylesheet" type="text/css">




<style type="text/css">

html, body, #container {height: 100%; background-color:#fbfbfb;}
body > #container { height: auto; min-height: 100%; background-color:#fbfbfb; } 

#footer {
clear: both;
position: relative;
z-index: 10;
height: 3em;
margin-top: -3em;
} 

#content { padding-bottom: 3em; } 

</style>
</head>

<body>
<div id="container">
<div id="content">


<table style="margin-top: 20px;" align="center" width="884" border="0" cellspacing="0" cellpadding="0">


<?
//админ меню
if ($prava==5) 
	{
	echo '<tr><td colspan="3" align="right" height="50">
	
	<a href="/admin/index.php?act=payments" class="nav">Выплаты</a>
	<a href="/admin/index.php?act=pay_in" class="nav">Пополнения</a>
	<a href="/admin/index.php?act=stat" class="nav">Статистика</a>
	
	<a href="/admin/index.php?act=users" class="nav">Пользователи</a>
	<a href="/admin/index.php" class="nav">Настройки</a>
	<span style="padding-left: 100px; padding-right: 10px;">'.$name.'</span>
	<a class="nav" href="/exit" title="Выход">Выход</a>
	</td></tr>';
	}
?>
</table>

<?
if (isset($oshibka)) { echo $oshibka; }
if (isset($ok)) { echo $ok; }
?>
<table style='margin-top:20px;' align='center' width='884' border='0' cellspacing='0' cellpadding='0'>

<? 
//  редактирование общих настроек
	if ($act == "rednas")
	{
	if (isset($_POST['user_pass']) && !empty($_POST['user_pass'])) 
	{ $user_pass = globper('user_pass'); 
				function usersol($n=3)
				{	$key = '';
					$pattern = '1234567890abcdefghijklmnopqrstuvwxyz.,*_-=+';
					$counter = strlen($pattern)-1;
					for($i=0; $i<$n; $i++)
					{ $key .= $pattern{rand(0,$counter)}; }
					return $key;
				}
				$user_sol = usersol();
				$newpass = $user_pass;
				$code_pass = md5(md5($newpass) . $user_sol);
				$newpass=",`user_pass`='{$code_pass}',`user_sol`='{$user_sol}'";
				$_SESSION['pass'] = $code_pass;
		}
	else { $newpass=""; }
	$user_email = globper('user_email'); 
	if (empty($user_email)) { al("обязательно введите адрес электронной почты"); unset($act);}
	else
		{ 
	$skybase = mysql_query("UPDATE `p_users` SET `user_email`='{$user_email}'".$newpass." WHERE `user_id`='{$_SESSION['ses_user']}'",$db) or die(mysql_error());
		echo '<div align="center"><div class="ok">изменения внесены</div></div>'; 
		unset($act);
		}
	}


//  редактирование остальных настроек
	if ($act == "rednasvse")
	{
		$skybasenastr = mysql_query("SELECT `nas_par` FROM `p_settings`",$db) or die(mysql_error());
		$skyrownastr = mysql_fetch_array($skybasenastr);
		do { if (isset ($_POST[$skyrownastr['nas_par']])) { $$skyrownastr['nas_par'] = globper($skyrownastr['nas_par']); } }
		while ($skyrownastr = mysql_fetch_array($skybasenastr));
			$skybasenastr = mysql_query("SELECT `nas_par`,`nas_znach` FROM `p_settings`",$db) or die(mysql_error());
			$skyrownastr = mysql_fetch_array($skybasenastr);
			do {
				if (!empty($$skyrownastr['nas_par']))
				{ $skybase = mysql_query("UPDATE `p_settings` SET `nas_znach`='{$$skyrownastr['nas_par']}'
			WHERE `nas_par`='{$skyrownastr['nas_par']}'",$db) or die(mysql_error()); }
				}
			while ($skyrownastr = mysql_fetch_array($skybasenastr));
			echo '<div align="center"><div class="ok">изменения внесены</div></div>';
			unset($act);
	}
	
//редактирование общих настроек
if ($prava==5 && !isset($act) or $prava==5 && $act=="reddos")
{
echo '<tr><td>';
echo '<div class="zag2" style="margin:0 0 5px 0;">Настройки</div>';	

	

//настройки
 $skybasenastr = mysql_query("SELECT `nas_par`,`nas_znach` FROM `p_settings`",$db) or die(mysql_error());
 $skyrownastr = mysql_fetch_array($skybasenastr);
 do {
	 $$skyrownastr['nas_par'] = $skyrownastr['nas_znach'];
	 }
while ($skyrownastr = mysql_fetch_array($skybasenastr));	
if ($set_payments!='on') { $sel ='selected="selected"'; } else { $sel =''; }

if ($ref_link_trek_type!='adv') { $select ='selected="selected"'; } else { $select =''; }

if ($if_payments!='sbt') { $sel_if_payments ='selected="selected"'; } else { $sel_if_payments =''; }



?>


<fieldset class="nas">
<legend class="ser"> Финансовые настройки </legend>
<form action="index.php" method="post">
<table border="0" width="100%" class="tbl" cellpadding="4" cellspacing="0">
<tr><td width="150">Минималка для вывода<br /><span class="sm2">например 5</span></td><td>
<input style="width:500px" name="min_summa_out" value="<? echo $min_summa_out; ?>" type="text" /></td><td width="100">
</td></tr>

<tr><td width="150">Минималка для ввода<br /><span class="sm2">например 10</span></td><td>
<input style="width:500px" name="min_summa_in" value="<? echo $min_summa_in; ?>" type="text" /></td>
</tr>

<tr><td width="150">Комиссия с каждой игры (в %)<br /><span class="sm2">например 5</span></td><td>
<input style="width:500px" name="site_commission_loto" value="<? echo $site_commission_loto; ?>" type="text" /></td>
</tr>


<tr><td width="150">Комиссия при выводе средств (в %)<br /><span class="sm2">например 7</span></td><td>
<input style="width:500px" name="commission_pay_out" value="<? echo $commission_pay_out; ?>" type="text" /></td>
</tr>

<tr><td width="150">Бонус для новичков после регистрации<br /><span class="sm2">например 2 руб</span></td><td>
<input style="width:500px" name="bonus_reg" value="<? echo $bonus_reg; ?>" type="text" /></td>
</tr>


<tr><td width="150">Ежедневный бонус для юзеров (интервал выдачи)<br /><span class="sm2">в секундах, например 86400 - это 24 часа</span></td><td>
<input style="width:500px" name="bonus_interval" value="<? echo $bonus_interval; ?>" type="text" /></td>
</tr>

<tr><td width="150">Ежедневный бонус для юзеров (от)<br /><span class="sm2">в копейках, например 1</span></td><td>
<input style="width:500px" name="bonus_min_summ" value="<? echo $bonus_min_summ; ?>" type="text" /></td>
</tr>

<tr><td width="150">Ежедневный бонус для юзеров (до)<br /><span class="sm2">в копейках, например 100</span></td><td>
<input style="width:500px" name="bonus_max_summ" value="<? echo $bonus_max_summ; ?>" type="text" /></td>
</tr>

<tr><td width="150">Выплаты вкл/выкл<br />
<span class="sm2">при необходимости можно выкл. автомат. выплаты</span></td><td>
<select style="width:500px" name="set_payments">
<option value="on">Включены</option>
<option value="off"  <? echo $sel; ?>>Отключены</option>
</select>
</td><td width="100">

</td></tr>

<tr><td width="150">Реф отчисление с каждой ставки (в %)<br /><span class="sm2">например 1%</span></td><td>
<input style="width:500px" name="ref_percent_bet" value="<? echo $ref_percent_bet; ?>" type="text" /></td>
</tr>


<tr><td width="150">Реф отчисление пополн. баланса (в %)<br />
<span class="sm2">например 3</span></td><td>
<input style="width:500px" name="ref_percent" value="<? echo $ref_percent; ?>" type="text" />
</td>



<td width="100">
<input type="hidden" name="mod" value="nas" />
<input type="hidden" name="act" value="rednasvse" /> 
<input class="knop" type="submit" value="Изменить" />
</td></tr>
</table></form>
</fieldset> 

<?
echo '</td></tr>';
}

//пользователи
if ($prava==5 && $act=="users")
{
	echo "<tr><td>";
	
	$rezult = postr(10,'?act=users',$page,"`p_users` WHERE `user_id`>'1'",$db,3);
	$vsego_users = $rezult[30];
	
	$check_makk = mysql_query("SELECT `user_id`,`vk_avatar`,`user_login`,`user_regtime`,`user_ip`,`user_email`,`chek_ban` FROM `p_users` WHERE `user_ip` IN (SELECT `user_ip` FROM `p_users` GROUP BY `user_ip` HAVING count(*)>1)",$db) or die(mysql_error());
	$num_makk = mysql_num_rows($check_makk);
	
	echo "
	<table width='100%' border='0' cellspacing='0' cellpadding='7'>
	<tr>
	<td>
	<div class='zag2' style='width: 350px; float: left; padding-top: 5px;'>Всего пользователей: <span class='ser'>".$vsego_users."</span></div>
	</td>
	<td>
	<div><form action='/admin/index.php?act=users_search' method='post' name='form2'>
	<input style='width: 200px;' name='search' placeholder='Логин, email или ip адрес' value='".$user_search_post."' type='text' />
	<input class='knop' type='submit' value='Поиск' />
	</form>
	</div>
	</td>
	<td align='right' width='20%'>
	<div style='margin-bottom: 1px;'><a class='nav' style='border-radius: 4px; padding: 7px; font-size: 13px;' href='/admin/index.php?act=users_check_ip' title='Просмотр мультиаккаунтов'>Мультиаккаунты (".$num_makk.")</a></div>
	</td>
	</tr>
	</table>
	<div style='float:right; padding-right:40px; margin-top:15px;' class='sm2'>зарегистрирован</div>";
			$skybaseuser = mysql_query("SELECT `user_id`,`vk_id`,`vk_avatar`,`user_login`,`user_regtime`,`user_ip`,`user_email`,`chek_ban` FROM `p_users` WHERE `user_id`>'1' ORDER BY `user_regtime` DESC LIMIT $rezult[15], $rezult[16]",$db) or die(mysql_error());
			
				if (mysql_num_rows($skybaseuser) > 0)
				{
					$skyrowuser = mysql_fetch_array($skybaseuser);
					echo"<table width='100%' border='0' cellspacing='0' cellpadding='7' class='tbl'>";
					do { 
						if ($cv == 1) { $bgzapis = "#ffffff"; $cv=0; } else { $bgzapis = "#f5f5f5"; $cv++; }
						if ($skyrowuser['chek_ban'] >0) {$bgzapis = "#A52A2A";}
						$user_reg = russian_date('d.m.Y, в H:i:s',$skyrowuser['user_regtime']);
						echo"<tr bgcolor='".$bgzapis."'>
						
						<td class='tbl' width='50' style='border-bottom:1px solid #cccccc;'>
						<a title='перейти на страницу вк пользователя: ".$skyrowuser['user_login']."' 
						href='https://vk.com/id".$skyrowuser['vk_id']."'><img class='table_avatar' src='".$skyrowuser['vk_avatar']."' /></a>
						</td>
						
						
						
						
						<td class='tbl' width='300' align='left' style='border-bottom:1px solid #cccccc;'>
						<a title='Полная информация о пользователе ".$skyrowuser['user_login']."' 
						href='index.php?act=user&user_id=".$skyrowuser['user_id']."'>
						<span class='ch'>".$skyrowuser['user_login']."</span></a></td>";
								
						//забанить нахуй
						if ($skyrowuser['chek_ban']==0) {
						echo "<td width='24' style='border-bottom:1px solid #cccccc;'>";
						echo "<form action='/admin/index.php?act=users&page=".$page."' method='post'>";
						echo "<input class='top' title='ЗАБАНИТЬ' style=' background:none; border:0; cursor:pointer; margin:0;' type='image'  src='/img/start.png' width='24'>";
						echo "<INPUT type='hidden' name='user_id' value='".$skyrowuser['user_id']."' /><INPUT type='hidden' name='act' value='start_ban' /></form>";
						echo "</td>";
						}
						else{ 
						echo "<td width='24' style='border-bottom:1px solid #cccccc;'>";
						echo "<form action='/admin/index.php?act=users&page=".$page."' method='post'>";
						//разбанить 
						echo "<input class='top' title='РАЗБАНИТЬ' style=' background:none; border:0; cursor:pointer; margin:0;' type='image'  src='/img/stop.png' width='24'>";
						echo "<INPUT type='hidden' name='user_id' value='".$skyrowuser['user_id']."' /><INPUT type='hidden' name='act' value='stop_ban' /></form>";
						echo "</td>";
						}
			
						echo "
						
						<td align='center' class='data2' width='90' 
						style='border-bottom:1px solid #cccccc;'>".$skyrowuser['user_ip']."</td>
						<td align='center' align='right' class='data2' width='150' 
						style='border-bottom:1px solid #cccccc;'>".$user_reg."</td>
						</tr>";
					}
					while($skyrowuser = mysql_fetch_array($skybaseuser));
					echo"</table>";
					// Вывод меню если страниц больше одной
					if ($rezult[17] > 1) { vpostr($rezult,$page); }
	
				}
				else 
				{
				echo "<br /><br /><br /><center>Нет пользователей</center><br /><br />"; 	
				}
	echo "</td></tr>";
}



//пользователи поиск
if ($prava==5 && $act=="users_search" && isset($user_search_post))
{
	         
			 
			$check_makk = mysql_query("SELECT `user_id`,`vk_id`,`vk_avatar`,`user_login`,`user_regtime`,`user_ip`,`user_email`,`chek_ban` FROM `p_users` WHERE `user_ip` IN (SELECT `user_ip` FROM `p_users` GROUP BY `user_ip` HAVING count(*)>1)",$db) or die(mysql_error());
	        $num_makk = mysql_num_rows($check_makk); 
			 
			 
			//ищем юзера по мылу
			if (preg_match('/^[ёа-яА-Яa-zA-Z0-9_\.\-]+\@([ёа-яА-Яa-zA-Z0-9\-]+\.)+[ёа-яА-Яa-zA-Z0-9]{2,4}$|^$/', $user_search_post)) {
			$skybaseuser = mysql_query("SELECT `user_id`,`vk_id`,`vk_avatar`,`user_login`,`user_regtime`,`user_ip`,`user_email`,`chek_ban` FROM `p_users` WHERE `user_email`='{$user_search_post}' ORDER BY `user_regtime` DESC",$db) or die(mysql_error());
				
			}
			//ищем по ip адресу
			elseif (preg_match('/^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/', $user_search_post)) {
			
			$skybaseuser = mysql_query("SELECT `user_id`,`vk_id`,`vk_avatar`,`user_login`,`user_regtime`,`user_ip`,`user_email`,`chek_ban` FROM `p_users` WHERE `user_ip`='{$user_search_post}' ORDER BY `user_regtime` DESC",$db) or die(mysql_error());
			}
			
			
			//ищем по ip адресу IPv6
			elseif (preg_match('/((^|:)([0-9a-fA-F]{0,4})){1,8}$/', $user_search_post)) {
			
			$skybaseuser = mysql_query("SELECT `user_id`,`vk_id`,`vk_avatar`,`user_login`,`user_regtime`,`user_ip`,`user_email`,`chek_ban` FROM `p_users` WHERE `user_ip`='{$user_search_post}' ORDER BY `user_regtime` DESC",$db) or die(mysql_error());
			}
			
            //ищем по ip адресу MAC
			elseif (preg_match('/([0-9a-fA-F]{2}([:-]|$)){6}$|([0-9a-fA-F]{4}([.]|$)){3}/', $user_search_post)) {
			
			$skybaseuser = mysql_query("SELECT `user_id`,`vk_id`,`vk_avatar`,`user_login`,`user_regtime`,`user_ip`,`user_email`,`chek_ban` FROM `p_users` WHERE `user_ip`='{$user_search_post}' ORDER BY `user_regtime` DESC",$db) or die(mysql_error());
			}
			
			
			
            //ищем по логину
            else {
			
			$skybaseuser = mysql_query("SELECT `user_id`,`vk_id`,`vk_avatar`,`user_login`,`user_regtime`,`user_ip`,`user_email`,`chek_ban` FROM `p_users` WHERE `user_login`='{$user_search_post}' ORDER BY `user_regtime` DESC",$db) or die(mysql_error());
			}

				
				if (mysql_num_rows($skybaseuser) > 0)
				{
				
				
	echo "<tr><td>";
	$vsego_users = mysql_num_rows($skybaseuser);
    echo "
	<table width='100%' border='0' cellspacing='0' cellpadding='7'>
	<tr>
	<td>
	<div class='zag2' style='width: 350px; float: left; padding-top: 5px;'>Найдено пользователей: <span class='ser'>".$vsego_users."</span></div>
	</td>
	<td>
	<div><form action='/admin/index.php?act=users_search' method='post' name='form2'>
	<input style='width: 200px;' name='search' placeholder='Логин, email или ip адрес' value='".$user_search_post."' type='text' />
	<input class='knop' type='submit' value='Поиск' />
	</form>
	</div>
	</td>
	<td align='right' width='20%'>
	<div style='margin-bottom: 1px;'><a class='nav' style='border-radius: 4px; padding: 7px; font-size: 13px;' href='/admin/index.php?act=users_check_ip' title='Просмотр мультиаккаунтов'>Мультиаккаунты (".$num_makk.")</a></div>
	</td>
	</tr>
	</table>
	<div style='float:right; padding-right:40px; margin-top:15px;' class='sm2'>зарегистрирован</div>";


					$skyrowuser = mysql_fetch_array($skybaseuser);
					echo"<table width='100%' border='0' cellspacing='0' cellpadding='7' class='tbl'>";
					do { 
						if ($cv == 1) { $bgzapis = "#ffffff"; $cv=0; } else { $bgzapis = "#f5f5f5"; $cv++; }
						if ($skyrowuser['chek_ban'] >0) {$bgzapis = "#A52A2A";}
						
						$user_reg = russian_date('d.m.Y, в H:i:s',$skyrowuser['user_regtime']);
						echo"<tr bgcolor='".$bgzapis."'>
						
						<td class='tbl' width='50' style='border-bottom:1px solid #cccccc;'>
						<a title='перейти на страницу вк пользователя: ".$skyrowuser['user_login']."' 
						href='https://vk.com/id".$skyrowuser['vk_id']."'><img class='table_avatar' src='".$skyrowuser['vk_avatar']."' /></a>
						</td>
						
						
						
						
						<td class='tbl' width='300' align='left' style='border-bottom:1px solid #cccccc;'>
						<a title='Полная информация о пользователе ".$skyrowuser['user_login']."' 
						href='/admin/index.php?act=user&user_id=".$skyrowuser['user_id']."'>
						<span class='ch'>".$skyrowuser['user_login']."</span></a></td>";
								
						//забанить нахуй
						if ($skyrowuser['chek_ban']==0) {
						echo "<td width='24' style='border-bottom:1px solid #cccccc;'>";
						echo "<form action='/admin/index.php?act=users_search&search=".$user_search_post."' method='post'>";
						echo "<input class='top' title='ЗАБАНИТЬ' style=' background:none; border:0; cursor:pointer; margin:0;' type='image'  src='/img/start.png' width='24'>";
						echo "<INPUT type='hidden' name='user_id' value='".$skyrowuser['user_id']."' /><INPUT type='hidden' name='act' value='start_ban_search' /></form>";
						echo "</td>";
						}
						else{ 
						echo "<td width='24' style='border-bottom:1px solid #cccccc;'>";
						echo "<form action='/admin/index.php?act=users_search&search=".$user_search_post."' method='post'>";
						//разбанить 
						echo "<input class='top' title='РАЗБАНИТЬ' style=' background:none; border:0; cursor:pointer; margin:0;' type='image'  src='/img/stop.png' width='24'>";
						echo "<INPUT type='hidden' name='user_id' value='".$skyrowuser['user_id']."' /><INPUT type='hidden' name='act' value='stop_ban_search' /></form>";
						echo "</td>";
						}
			
						echo "
						
						<td align='center' class='data2' width='90' 
						style='border-bottom:1px solid #cccccc;'>".$skyrowuser['user_ip']."</td>
						<td align='center' align='right' class='data2' width='150' 
						style='border-bottom:1px solid #cccccc;'>".$user_reg."</td>
						</tr>";
					}
					while($skyrowuser = mysql_fetch_array($skybaseuser));
					echo"</table>";
					echo "<br /><br />";
					
	
				}
				else 
				{
								
    echo "<tr><td>";
	$vsego_users = mysql_num_rows($skybaseuser);
    echo "
	<table width='100%' border='0' cellspacing='0' cellpadding='7'>
	<tr>
	<td>
	<div class='zag2' style='width: 350px; float: left; padding-top: 5px;'>Найдено пользователей: <span class='ser'>".$vsego_users."</span></div>
	</td>
	<td>
	<div><form action='/admin/index.php?act=users_search' method='post' name='form2'>
	<input style='width: 200px;' name='search' placeholder='Логин, email или ip адрес' value='".$user_search_post."' type='text' />
	<input class='knop' type='submit' value='Поиск' />
	</form>
	</div>
	</td>
	<td align='right' width='20%'>
	<div style='margin-bottom: 1px;'><a class='nav' style='border-radius: 4px; padding: 7px; font-size: 13px;' href='/admin/index.php?act=users_check_ip' title='Просмотр мультиаккаунтов'>Мультиаккаунты (".$num_makk.")</a></div>
	</td>
	</tr>
	</table>";
							
				echo "<br /><br /><br /><center>Нет пользователей</center><br /><br />"; 	
				}
	echo "</td></tr>";
}



//пользователи мультиаккаунты
if ($prava==5 && $act=="users_check_ip")
{
	echo "<tr><td>";
	

    $rezult = postr(10,'?act=users_check_ip',$page,"`p_users` WHERE `user_ip` IN (SELECT `user_ip` FROM `p_users` GROUP BY `user_ip` HAVING count(*)>1)",$db,3);
	
	$vsego_users = $rezult[30];
	$skybaseuser = mysql_query("SELECT `user_id`,`vk_id`,`vk_avatar`,`user_login`,`user_regtime`,`user_ip`,`user_email`,`chek_ban` FROM `p_users` WHERE `user_ip` IN (SELECT `user_ip` FROM `p_users` GROUP BY `user_ip` HAVING count(*)>1) ORDER BY `user_regtime` DESC LIMIT $rezult[15], $rezult[16]",$db) or die(mysql_error());
				
				
				if (mysql_num_rows($skybaseuser) > 0)
				{
				
	echo "<tr><td>";
    echo "
	<table width='100%' border='0' cellspacing='0' cellpadding='7'>
	<tr>
	<td>
	<div class='zag2' style='width: 350px; float: left; padding-top: 5px;'>Найдено мультиаккаунтов: <span class='ser'>".$vsego_users."</span></div>
	</td>
	<td>
	<div><form action='/admin/index.php?act=users_search' method='post' name='form2'>
	<input style='width: 200px;' name='search' placeholder='Логин, email или ip адрес' value='".$user_search_post."' type='text' />
	<input class='knop' type='submit' value='Поиск' />
	</form>
	</div>
	</td>
	<td align='right' width='20%'>
	<div style='margin-bottom: 1px;'><a class='nav' style='border-radius: 4px; padding: 7px; font-size: 13px;' href='/admin/index.php?act=users_check_ip' title='Просмотр мультиаккаунтов'>Мультиаккаунты (".$vsego_users.")</a></div>
	</td>
	</tr>
	</table>
	<div style='float:right; padding-right:40px; margin-top:15px;' class='sm2'>зарегистрирован</div>";
				

					$skyrowuser = mysql_fetch_array($skybaseuser);
					echo"<table width='100%' border='0' cellspacing='0' cellpadding='7' class='tbl'>";
					do { 
						if ($cv == 1) { $bgzapis = "#ffffff"; $cv=0; } else { $bgzapis = "#f5f5f5"; $cv++; }
						if ($skyrowuser['chek_ban'] >0) {$bgzapis = "#A52A2A";}
						$user_reg = russian_date('d.m.Y, в H:i:s',$skyrowuser['user_regtime']);
						echo"<tr bgcolor='".$bgzapis."'>
						
						<td class='tbl' width='50' style='border-bottom:1px solid #cccccc;'>
						<a title='перейти на страницу вк пользователя: ".$skyrowuser['user_login']."' 
						href='https://vk.com/id".$skyrowuser['vk_id']."'><img class='table_avatar' src='".$skyrowuser['vk_avatar']."' /></a>
						</td>
						
						
						
						
						<td class='tbl' width='300' align='left' style='border-bottom:1px solid #cccccc;'>
						<a title='Полная информация о пользователе ".$skyrowuser['user_login']."' 
						href='/admin/index.php?act=user&user_id=".$skyrowuser['user_id']."'>
						<span class='ch'>".$skyrowuser['user_login']."</span></a></td>";
								
						//забанить нахуй
						if ($skyrowuser['chek_ban']==0) {
						echo "<td width='24' style='border-bottom:1px solid #cccccc;'>";
						echo "<form action='/admin/index.php?act=users_check_ip&page=".$page."' method='post'>";
						echo "<input class='top' title='ЗАБАНИТЬ' style=' background:none; border:0; cursor:pointer; margin:0;' type='image'  src='/img/start.png' width='24'>";
						echo "<INPUT type='hidden' name='user_id' value='".$skyrowuser['user_id']."' /><INPUT type='hidden' name='act' value='start_ban_check_ip' /></form>";
						echo "</td>";
						}
						else{ 
						echo "<td width='24' style='border-bottom:1px solid #cccccc;'>";
						echo "<form action='/admin/index.php?act=users_check_ip&page=".$page."' method='post'>";
						//разбанить 
						echo "<input class='top' title='РАЗБАНИТЬ' style=' background:none; border:0; cursor:pointer; margin:0;' type='image'  src='/img/stop.png' width='24'>";
						echo "<INPUT type='hidden' name='user_id' value='".$skyrowuser['user_id']."' /><INPUT type='hidden' name='act' value='stop_ban_check_ip' /></form>";
						echo "</td>";
						}
			
						echo "
						
						<td align='center' align='right' class='data2' width='90' 
						style='border-bottom:1px solid #cccccc;'>".$skyrowuser['user_ip']."</td>
						<td align='center' align='right' class='data2' width='150' 
						style='border-bottom:1px solid #cccccc;'>".$user_reg."</td>
						</tr>";
					}
					while($skyrowuser = mysql_fetch_array($skybaseuser));
					echo"</table>";
					// Вывод меню если страниц больше одной
					if ($rezult[17] > 1) { vpostr($rezult,$page); }
	
				}
				else 
				{
				
				echo "<tr><td>";
	$vsego_users = mysql_num_rows($skybaseuser);
    echo "
	<table width='100%' border='0' cellspacing='0' cellpadding='7'>
	<tr>
	<td>
	<div class='zag2' style='width: 350px; float: left; padding-top: 5px;'>Найдено мультиаккаунтов: <span class='ser'>".$vsego_users."</span></div>
	</td>
	<td>
	<div><form action='/admin/index.php?act=users_search' method='post' name='form2'>
	<input style='width: 200px;' name='search' placeholder='Логин, email или ip адрес' value='".$user_search_post."' type='text' />
	<input class='knop' type='submit' value='Поиск' />
	</form>
	</div>
	</td>
	<td align='right' width='20%'>
	<div style='margin-bottom: 1px;'><a class='nav' style='border-radius: 4px; padding: 7px; font-size: 13px;' href='/admin/index.php?act=users_check_ip' title='Просмотр мультиаккаунтов'>Мультиаккаунты (".$num_makk.")</a></div>
	</td>
	</tr>
	</table>";
				
	echo "<br /><br /><br /><center>Нет пользователей</center><br /><br />"; 	
				}
	echo "</td></tr>";
}



//информация о пользователе
if ($prava==5 && $act=="user" && isset($user_id))
{
	$skybaseuser = mysql_query("SELECT * FROM `p_users` WHERE `user_id`='{$user_id}' LIMIT 1",$db) or die(mysql_error());
	$skyrowuser = mysql_fetch_array($skybaseuser);
		
															
	////колво рефералов

    $kolvo_ref_user = mysql_query("SELECT `user_ref` FROM `p_users` WHERE `user_ref`='{$user_id}'",$db) or die(mysql_error());
	$kolvo_ref = $kolvo_ref + mysql_num_rows($kolvo_ref_user);
															
	//
	$user_ref = mysql_query("SELECT * FROM `p_users` WHERE `user_id`='{$skyrowuser['user_ref']}' LIMIT 1",$db) 
									or die(mysql_error());
	$rowuser_ref = mysql_fetch_array($user_ref);
	//	
	$last_vizit = date("d.m.Y, в H:i:s", $skyrowuser['last_game']);

	if ($skyrowuser['chek_ban'] >0) { $chekk_ban = 'ЗАБАНЕН!';} else {$chekk_ban = 'НЕТ!';}
	$otkuda = $skyrowuser['ot_kuda_prishel'];
		
    $total_play = $skyrowuser['total_roulette_win'] + $skyrowuser['total_roulette_lost'];

		
	echo "<tr><td><div class='zag2'>Личная информация пользователя <strong>".$skyrowuser['user_login']."</strong></div>";
			echo "<table width='100%' border='0' cellspacing='0' cellpadding='5' class='tbl' style='border: 1px solid #ccc; border-radius: 4px; padding: 10px; background-color: #fff;'>
			
			<tr>
			
			<td width='150' style='border-bottom:1px solid#f2f2f2;'>Аватар</td>
			<td style='border-bottom:1px solid#f2f2f2;'>
			<a title='перейти на страницу вк пользователя: ".$skyrowuser['user_login']."' href='https://vk.com/id".$skyrowuser['vk_id']."'><img class='table_avatar' src='".$skyrowuser['vk_avatar']."' /></a>
			</td></tr>
			
			<td width='80' style='border-bottom:1px solid#f2f2f2;'>Имя</td>
			<td style='border-bottom:1px solid#f2f2f2;'>".$skyrowuser['user_login']."</td></tr>
			
			<tr><td width='80' style='border-bottom:1px solid#f2f2f2;'>Payeer кошелек</td>
			<td style='border-bottom:1px solid#f2f2f2;'>".$skyrowuser['user_payeer']."</td></tr>
			
			
			<tr><td width='80' style='border-bottom:1px solid#f2f2f2;'>Рефералов</td>
			<td style='border-bottom:1px solid#f2f2f2;'>".$kolvo_ref."</td></tr>
			
			<tr><td width='80'  style='border-bottom:1px solid#f2f2f2;'>От куда?</td>
			<td style='border-bottom:1px solid#f2f2f2;'>".$otkuda."</td></tr>
					
				
			<tr><td width='80'  style='border-bottom:1px solid#f2f2f2;'>ЗАБАНЕН?</td>
			<td width='80' style='border-bottom:1px solid#f2f2f2;'>".$chekk_ban."</td>
			
			</tr>
			
			<tr><td width='80'  style='border-bottom:1px solid#f2f2f2;'>Реферер</td>
			<td style='border-bottom:1px solid#f2f2f2;'><a href='/admin/index.php?act=user&user_id=".$skyrowuser['user_ref']."'>".$rowuser_ref['user_login']."</a></td></tr>
			
			<tr><td width='80'  style='border-bottom:1px solid#f2f2f2;'>Играл (кол. раз)</td>
			<td style='border-bottom:1px solid#f2f2f2;'>".$total_play."</td></tr>
			
			<tr><td width='80'  style='border-bottom:1px solid#f2f2f2;'>Выиграл (кол. раз)</td>
			<td style='border-bottom:1px solid#f2f2f2;'>".$skyrowuser['total_roulette_win']."</td></tr>
			
			<tr><td width='80'  style='border-bottom:1px solid#f2f2f2;'>Проиграл (кол. раз)</td>
			<td style='border-bottom:1px solid#f2f2f2;'>".$skyrowuser['total_roulette_lost']."</td></tr>
			
			<tr><td width='80'  style='border-bottom:1px solid#f2f2f2;'>Заработал всего</td>
			<td style='border-bottom:1px solid#f2f2f2;'>".$skyrowuser['user_total_zarabotok']." руб</td></tr>

			
		    <tr><td width='80'  style='border-bottom:1px solid#f2f2f2;'>Баланс:</td>
			<td style='border-bottom:1px solid#f2f2f2;'><b>".$skyrowuser['user_balance']."</b> руб</td></tr>
		
		    
			
			<tr><td width='80'  style='border-bottom:1px solid#f2f2f2;'>ЗАБАНИТЬ/РАЗБАНИТЬ</td>
			<td width='80' style='border-bottom:1px solid#f2f2f2;'>";
			
			if ($skyrowuser['chek_ban']==0) {
			echo "<form action='/admin/index.php?act=user&user_id=".$skyrowuser['user_id']."' method='post'>";
			echo "<input class='top' title='ЗАБАНИТЬ' style=' background:none; border:0; cursor:pointer; margin:0;' type='image'  src='/img/start.png' width='24'>";
			echo "<INPUT type='hidden' name='user_id' value='".$skyrowuser['user_id']."' /><INPUT type='hidden' name='act' value='start_ban_profile' /></form>";
			
			}
			else{
			
			echo "<form action='/admin/index.php?act=user&user_id=".$skyrowuser['user_id']."' method='post'>";
			//разбанить 
			echo "<input class='top' title='РАЗБАНИТЬ' style=' background:none; border:0; cursor:pointer; margin:0;' type='image'  src='/img/stop.png' width='24'>";
			echo "<INPUT type='hidden' name='user_id' value='".$skyrowuser['user_id']."' /><INPUT type='hidden' name='act' value='stop_ban_profile' /></form>";
			
			}
			
        echo "</td></tr></table>";
		echo "<br/>";
		echo "</td>";
		echo "</tr>";
}



if ($prava==5 && $act=='stat') 
{ echo'
<table class="tbl" align="center" style="border: 1px solid #ccc; border-radius: 4px; padding: 10px; background-color: #fff;" width="875" cellpadding="5" cellspacing="0"><tr>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc; border-top: 1px solid #cccccc;" bgcolor="#ffffff" class="sm2" align="center">Параметр</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc; border-top: 1px solid #cccccc; border-right: 1px solid #cccccc;" bgcolor="#ffffff" class="sm2" align="center">Значение</td></tr>';


//Общая сумма поплнений баланса
function users_total_money_in($db)
{
	$query = mysql_query("select SUM(`summa`) from `p_update`",$db) or die(mysql_error());
	$result = mysql_fetch_array($query);
	return $result[0] + 0;
}



//Общая сумма выплат юзерам
function users_total_money_out($db)
{
	$query = mysql_query("select SUM(`summa`) from `p_payments`",$db) or die(mysql_error());
	$result = mysql_fetch_array($query);
	return $result[0];
}

//Сумма денег на балансах у юзеров
function users_total_money_balance($db)
{
	$query = mysql_query("select SUM(`user_balance`) from `p_users`",$db) or die(mysql_error());
	$result = mysql_fetch_array($query);
	return $result[0];
}

//Всего заработали юзеры
function users_total_zarabotok($db)
{
	$query = mysql_query("select SUM(`user_total_zarabotok`) from `p_users`",$db) or die(mysql_error());
	$result = mysql_fetch_array($query);
	return $result[0];
}

//количество юзеров с балансом больше или ровно 10 руб
function balance_uses_num_10_rub($db)
{

	$query = mysql_query("SELECT `user_id` FROM `p_users` where `user_balance`>='10' ",$db) or die(mysql_error());
	$num = mysql_num_rows($query);
	if($num > 0) 
	{
		$result = $num;
	} else
	{
		$result = 0;
	}
	return $result;
}



//сумма пополнений через паеер
function sum_pay_in_payeer($db)
{

	$query = mysql_query("select SUM(`summa`) from `p_update` where `pay_system`='Payeer'",$db) or die(mysql_error());
	$result = mysql_fetch_array($query);
	return $result[0] + 0;
}		



//сумма пополнений через мегакуссу
function sum_pay_in_free_kassa($db)
{

	$query = mysql_query("select SUM(`summa`) from `p_update` where `pay_system`='Free-kassa'",$db) or die(mysql_error());
	$result = mysql_fetch_array($query);
	return $result[0] + 0;
}



//сумма дохода админа с рулетки
function sum_admin_profit_roulette($db,$q)
{

	$query = mysql_query("select * from `p_roulette_stat` where `id`='1'",$db) or die(mysql_error());
	$result = mysql_fetch_array($query);
	return $result[$q];
}
		



//баланс аккаунта проекта 
$payeer = new CPayeer($accountNumber, $apiId, $apiKey);
if ($payeer->isAuth())
{
	$arBalance = $payeer->getBalance();
    $payeer_money_balance = $arBalance[balance][RUB][DOSTUPNO].' руб';
}
else
{
	$payeer_money_balance = '<span style="color: red;">нет соединения с Payeer!</span>';
}

?>



<tr>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc;" align="center" width="300">Доход Админа</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc; border-right: 1px solid #cccccc;" align="center" width="300"><?=sum_admin_profit_roulette($db,2)?> руб.</td>
</tr>


<tr>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc;" align="center" width="300">Последняя игра</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc; border-right: 1px solid #cccccc;" align="center" width="300"><?=sum_admin_profit_roulette($db,1)?></td>
</tr>


<tr>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc;" align="center" width="300">Кол-во игр</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc; border-right: 1px solid #cccccc;" align="center" width="300"><?=sum_admin_profit_roulette($db,3)?></td>
</tr>


<tr>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc;" align="center" width="300">Баланс Payeer</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc; border-right: 1px solid #cccccc;" align="center" width="300">
<?=$payeer_money_balance;?> </td>
</tr>

<tr>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc;" align="center" width="300">Денег на счетах</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc; border-right: 1px solid #cccccc;" align="center" width="300"><?=users_total_money_balance($db)?> руб</td>
</tr>

<tr>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc;" align="center" width="300">Пользователей с балансом >=10 руб</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc; border-right: 1px solid #cccccc;" align="center" width="300"><?=balance_uses_num_10_rub($db)?></td>
</tr>

<tr>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc;" align="center" width="300">Заработано всего (пользователями)</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc; border-right: 1px solid #cccccc;" align="center" width="300"><?=users_total_zarabotok($db)?> руб</td>
</tr>

<tr>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc;" align="center" width="300">Выплат на сумму</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc; border-right: 1px solid #cccccc;" align="center" width="300"><?=users_total_money_out($db)?> руб</td>
</tr>


<tr>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc;" align="center" width="300">Пополнений на сумму</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc; border-right: 1px solid #cccccc;" align="center" width="300"><?=users_total_money_in($db)?> руб</td>
</tr>



<tr>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc;" align="center" width="300">Сумма пополнений через Payeer</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc; border-right: 1px solid #cccccc;" align="center" width="300"><?=sum_pay_in_payeer($db)?> руб</td>
</tr>


<tr>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc;" align="center" width="300">Сумма пополнений через Free-kassa</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc; border-right: 1px solid #cccccc;" align="center" width="300"><?=sum_pay_in_free_kassa($db)?> руб</td>
</tr>


</table>
<br>

<?}?>


<?
//вывод выплат
if ($prava==5 && $act=='payments') { 
$rezult = postr(10,'?act=payments',$page,"`p_payments` WHERE `id`>'1' ORDER BY `id` DESC",$db,3);
$viplati = mysql_query("SELECT * FROM `p_payments` ORDER BY `id` DESC limit $rezult[15], $rezult[16]",$db) or die(mysql_error());
			$rowviplati = mysql_fetch_array($viplati);
			

//
$user_ref = mysql_query("SELECT * FROM `p_users` WHERE `user_id`='{$rowviplati['user_id']}'  LIMIT 1",$db) 
									or die(mysql_error());
		$rowuser_ref = mysql_fetch_array($user_ref);
		
echo'<table align="center" style="border: 1px solid #cccccc; border-radius: 4px; padding: 10px; margin-top: 5px; font-size: 15px; background-color: #fff;" width="875" class="tbl" cellpadding="5" cellspacing="0">

<tr>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc; border-top: 1px solid #cccccc;" bgcolor="#ffffff" class="sm2" align="center">ID</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc; border-top: 1px solid #cccccc;" bgcolor="#ffffff" class="sm2" align="center">Кошелек</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc; border-top: 1px solid #cccccc;" bgcolor="#ffffff" class="sm2" align="center">Сумма</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc; border-top: 1px solid #cccccc;" bgcolor="#ffffff" class="sm2" align="center">Пользователь</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc; border-top: 1px solid #cccccc;" bgcolor="#ffffff" class="sm2" align="center">Дата</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc; border-top: 1px solid #cccccc; border-right: 1px solid #cccccc;" bgcolor="#ffffff" class="sm2" align="center">IP</td>
</tr>';
do { 

$user_ref = mysql_query("SELECT * FROM `p_users` WHERE `user_id`='{$rowviplati['user_id']}' LIMIT 1",$db) 
									or die(mysql_error());
		$rowuser_ref = mysql_fetch_array($user_ref);

echo'
<tr>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc;" align="center" width="50">'.$rowviplati['id'].'</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc;" align="center" width="200">'.$rowviplati['payeer_purse'].'</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc;" align="center" width="300">'.$rowviplati['summa'].' руб</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc;" align="center" width="300"><b><a href="/admin/index.php?act=user&user_id='.$rowviplati['user_id'].'">'.$rowuser_ref['user_login'].'</a></b></td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc;" align="center" width="300">'.$rowviplati['date'].'</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc; border-right: 1px solid #cccccc;" align="center" width="300">'.$rowviplati['ip'].'</td>
</tr>
';}

while($rowviplati = mysql_fetch_array($viplati));

echo'</table>';
if ($rezult[17] > 1) { vpostr($rezult,$page); }
}




//вывод пополнений баланса
if ($prava==5 && $act=='pay_in') { 
$rezult = postr(10,'?act=pay_in',$page,"`p_update` WHERE `id`>'1' ORDER BY `id` DESC",$db,3);
$viplati = mysql_query("SELECT * FROM `p_update` ORDER BY `id` DESC limit $rezult[15], $rezult[16]",$db) or die(mysql_error());
			$rowviplati = mysql_fetch_array($viplati);
			
//
	$user_ref = mysql_query("SELECT * FROM `p_users` WHERE `user_id`='{$rowviplati['user_id']}' LIMIT 1",$db) 
									or die(mysql_error());
		$rowuser_ref = mysql_fetch_array($user_ref);
			
	 		
echo'<table class="tbl" align="center" style="border: 1px solid #cccccc; border-radius: 4px; padding: 10px; margin-top: 5px; font-size: 15px; background-color: #fff;" width="875" cellpadding="5" cellspacing="0">

<tr>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc; border-top: 1px solid #cccccc;" bgcolor="#ffffff" class="sm2" align="center">ID</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc; border-top: 1px solid #cccccc;" bgcolor="#ffffff" class="sm2" align="center">Сумма</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc; border-top: 1px solid #cccccc;" bgcolor="#ffffff" class="sm2" align="center">Пользователь</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc; border-top: 1px solid #cccccc;" bgcolor="#ffffff" class="sm2" align="center">ПС</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc; border-top: 1px solid #cccccc; border-right: 1px solid #cccccc;" bgcolor="#ffffff" class="sm2" align="center">Дата</td>
</tr>';

do { 

$user_ref = mysql_query("SELECT * FROM `p_users` WHERE `user_id`='{$rowviplati['user_id']}' LIMIT 1",$db) 
									or die(mysql_error());
		$rowuser_ref = mysql_fetch_array($user_ref);

echo'
<tr>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc;" align="center" width="50">'.$rowviplati['id'].'</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc;" align="center" width="200">'.$rowviplati['summa'].' руб</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc;" align="center" width="300"><a href="/admin/index.php?act=user&user_id='.$rowviplati['user_id'].'">'.$rowuser_ref['user_login'].'</a></td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc;" align="center" width="200">'.$rowviplati['pay_system'].'</td>
<td style="border-bottom: 1px solid #cccccc; border-left: 1px solid #cccccc; border-right: 1px solid #cccccc;" align="center" width="300">'.$rowviplati['data'].'</td>
</tr>
';}

while($rowviplati = mysql_fetch_array($viplati));

echo'</table>';
if ($rezult[17] > 1) { vpostr($rezult,$page); }
}

?>



</table>
</div>
</div>

</body>
</html>