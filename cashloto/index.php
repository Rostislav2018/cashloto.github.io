<a href="http://<? echo $_SERVER['SERVER_NAME'];?>/" class="superoc"> </a>
<?php
session_start();
if (isset($_GET['ref'])) {
$ref = $_GET['ref'];
setcookie("ref",$ref,time()+31622400);
}
//////от куда пришел к нам
if (empty($_COOKIE['httpref'])) {
function getHttpReferer(){
    global $_SERVER;
if(!empty($_SERVER['HTTP_REFERER'])){
$came=$_SERVER['HTTP_REFERER'];}else{$came='Unknown';}
		if (!preg_match('/(?:[^:]*:\/\/)?(?:www)?\.?([^\/]+\.[^\/]+.*)/i',$came)) {
                $came = "Unknown";
                } else {
                preg_match('/(?:[^:]*:\/\/)?(?:www)?\.?([^\/]+\.[^\/]+.*)/i',$came,$match);
                $site = explode("/", $match[1]);
$hostb=$_SERVER['HTTP_HOST'];

			if ($site[0] == $hostb) {
                $came = "Unknown";
                } else {
                $came = $site[0];
                }
}
    return $came;
}
setcookie("httpref",getHttpReferer(),time()+259200);
}
include("inc/inc_db.php");
include ("inc/lib.php");	
	

//контент
$mode = htmlspecialchars($_GET['mode']);
if(empty($mode)) {$mode = 'room_default';}


switch($mode) {

case 'room_default':

$title = 'LOTO';
$description = 'ВАШЕ НАЗВАНИЕ игры с друзьями на деньги, моментальные лотереи, fast loto, играть с друзьями на деньги, сайт моментальных лотерей, лото Россия, играть в лото Россия';  
include ("pages/meta.php");
include ("pages/head.php");
include ("pages/left_sidebar.php");
include ("pages/room_default.php");
include ("pages/right_sidebar.php");
include ("pages/footer.php"); 
break;


case 'rules':
$title = 'Правила';
$description = '';
include ("pages/meta.php");
include ("pages/head.php");
include ("pages/left_sidebar.php");
include ("pages/rules.php");
include ("pages/right_sidebar.php");
include ("pages/footer.php"); 
break;








case 'game':
$title = 'Как играть';
$description = '';
include ("pages/meta.php");
include ("pages/head.php");
include ("pages/left_sidebar.php");
include ("pages/game.php");
include ("pages/right_sidebar.php");
include ("pages/footer.php"); 
break;








case 'faq':
$title = 'Часто задаваемые вопросы';
$description = '';
include ("pages/meta.php");
include ("pages/head.php");
include ("pages/left_sidebar.php");
include ("pages/faq.php");
include ("pages/right_sidebar.php");
include ("pages/footer.php"); 
break;


case 'deposit':
$title = 'Пополнить баланс';
$description = '';
include ("pages/meta.php");
include ("pages/head.php");
include ("pages/left_sidebar.php");
include ("pages/deposit_money.php");
include ("pages/right_sidebar.php");
include ("pages/footer.php"); 
break;



case 'pay':
$title = 'Подождите...';
$description = '';
include ("pages/meta.php");
include ("pages/head.php");
include ("pages/left_sidebar.php");
include ("pages/pay.php");
include ("pages/right_sidebar.php");
include ("pages/footer.php"); 
break;

case 'payout':
$title = 'Вывод';
$description = '';
include ("pages/meta.php");
include ("pages/head.php");
include ("pages/left_sidebar.php");
include ("pages/pay_out.php");
include ("pages/right_sidebar.php");
include ("pages/footer.php"); 
break;


case 'purse':
$title = 'Добавление кошелька';
$description = '';
include ("pages/meta.php");
include ("pages/head.php");
include ("pages/left_sidebar.php");
include ("pages/purse.php");
include ("pages/right_sidebar.php");
include ("pages/footer.php"); 
break;

case 'login':
$title = 'Регистрация/Вход';
$description = '';
include ("pages/meta.php");
include ("pages/head.php");
include ("pages/left_sidebar.php");
include ("pages/login.php");
include ("pages/right_sidebar.php");
include ("pages/footer.php"); 
break;

case 'refs':
$title = 'Рефералы';
$description = '';
include ("pages/meta.php");
include ("pages/head.php");
include ("pages/left_sidebar.php");
include ("pages/refs.php");
include ("pages/right_sidebar.php");
include ("pages/footer.php"); 
break;

case 'contacts':
$title = 'Контакты';
$description = '';
include ("pages/meta.php");
include ("pages/head.php");
include ("pages/left_sidebar.php");
include ("pages/contacts.php");
include ("pages/right_sidebar.php");
include ("pages/footer.php"); 
break;

case 'room_2':
$title = 'Комната №2';
$description = '';
include ("pages/meta.php");
include ("pages/head.php");
include ("pages/left_sidebar.php");
include ("pages/room_2.php");
include ("pages/right_sidebar.php");
include ("pages/footer.php"); 
break;

case 'room_3':
$title = 'Комната №3';
$description = '';
include ("pages/meta.php");
include ("pages/head.php");
include ("pages/left_sidebar.php");
include ("pages/room_3.php");
include ("pages/right_sidebar.php");
include ("pages/footer.php"); 
break;




case 'room_4':
$title = 'ИГРА от 1 RUB';
$description = '';
include ("pages/meta.php");
include ("pages/head.php");
include ("pages/left_sidebar.php");
include ("pages/room_4.php");
include ("pages/right_sidebar.php");
include ("pages/footer.php"); 
break;



case 'room_5':
$title = 'ИГРА от 10 RUB';
$description = '';
include ("pages/meta.php");
include ("pages/head.php");
include ("pages/left_sidebar.php");
include ("pages/room_5.php");
include ("pages/right_sidebar.php");
include ("pages/footer.php"); 
break;



case 'room_6':
$title = 'ИГРА  от 100 RUB';
$description = '';
include ("pages/meta.php");
include ("pages/head.php");
include ("pages/left_sidebar.php");
include ("pages/room_6.php");
include ("pages/right_sidebar.php");
include ("pages/footer.php"); 
break;






case 'success':
$title = 'Ваш баланс пополнен';
$description = 'Оплата прошла успешно';
include ("pages/meta.php");
include ("pages/head.php");
include ("pages/left_sidebar.php");
include ("pages/success.php");
include ("pages/right_sidebar.php");
include ("pages/footer.php"); 
break;

case 'fail':
$title = 'Ошибка оплаты';
$description = 'Оплата не прошла';
include ("pages/meta.php");
include ("pages/head.php");
include ("pages/left_sidebar.php");
include ("pages/fail.php");
include ("pages/right_sidebar.php");
include ("pages/footer.php"); 
break;

case 'bonus':
$title = 'Бонус от проекта';
$description = 'Бонус раз в 24 часа';
include ("pages/meta.php");
include ("pages/head.php");
include ("pages/left_sidebar.php");
include ("pages/bonus.php");
include ("pages/right_sidebar.php");
include ("pages/footer.php"); 
break;


}

?>