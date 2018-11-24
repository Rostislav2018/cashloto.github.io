<?
if ($mode == 'refs' and $prava >0) {
?>

<div class="content">

<div class="h1_content" style="margin-bottom: 5px; !important;">РЕФЕРАЛЫ</div>




<?if ($prava>0){
echo '<div class="decs_text" style="margin-bottom: 10px !important;"> Приглашайте Ваших друзей и знакомых и получайте дополнительный доход в размере: <br> - '.$ref_percent.'% от пополнений Ваших рефералов <br> - 5% от каждой ставки Вашего реферала</div>';
echo '<p style ="background: #2F343A; padding: 5px; font-size: 14px; margin-top: 0px; margin-bottom: 10px; text-align: center;">Ваша реферальная ссылка: <span style="color: #FF6A00;">http://'.$_SERVER['SERVER_NAME'].'/?ref='.$_SESSION['ses_user'].'</span></p>';		   
?>
<script>
function list_banners() {
var el = document.getElementById('list_banners');
var elm = document.getElementById('list_banners_hide');
if (el.style.display == 'none') {
el.style.display = 'block';
elm.innerHTML = 'Закрыть список баннеров для приглашения реферлов';
} else {
el.style.display = 'none';
elm.innerHTML = 'Открыть список баннеров для приглашения реферлов';
}
}
</script>


<?

$returnValue = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);

//echo '<br/>'. $returnValue;
parse_str($returnValue, $output);

//echo '<br/>'. $output['p'];

$page = $output['p'];

echo'<a href="#open" onclick="list_banners();" style="font-size: 16px;">';
echo'<div id="list_banners_hide" style="font-size: 14px; padding-top: 5px;">Открыть список баннеров для приглашения реферлов</div></a>';
//echo'</div>';
echo'</br>';
echo'<div id="list_banners" style="display: none;">';
echo'<center>'.$site_ref_promo_banner_1.'</center></br>';

echo'</div>';

$rezult = postr2(10,'/refs/',$page,"`p_users` WHERE `user_ref`='{$_SESSION['ses_user']}' ORDER BY `user_id` DESC",$db,4);


$zapros1 = mysql_query("SELECT * FROM `p_users` WHERE `user_ref`='{$_SESSION['ses_user']}' ORDER BY `user_id` DESC limit $rezult[15], $rezult[16]",$db) or die(mysql_error());
			$rowzapros1 = mysql_fetch_array($zapros1);
				
	 	if ($rowzapros1>0) {

//Общая сумма заработка на ерфералах
function total_ref_money_prifit($db)
{
	$query = mysql_query("select SUM(`total_ref_money`) from `p_users` WHERE `user_ref`='{$_SESSION['ses_user']}'",$db) or die(mysql_error());
	$result = mysql_fetch_array($query);
	return $result[0] + 0;
}

//количество рефералов юзера
function total_ref_num($db)
{
	$query = mysql_query("SELECT `user_id` FROM `p_users` WHERE `user_ref`='{$_SESSION['ses_user']}'",$db) or die(mysql_error());
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



echo'<table align="center" style="border-top: 1px solid #2F343A; border-left: 1px solid #2F343A; border-right: 1px solid #2F343A; margin-top: 10px;" width="100%" id="myTable" class="tablesorter" cellpadding="5" cellspacing="0">
<thead>
<tr>
<td style="border-bottom: 1px solid #2F343A; text-align: center;" bgcolor="#2F343A" class="sm2" align="center">Всего рефералов</td>
<td style="border-bottom: 1px solid #2F343A; border-left: 1px solid #2F343A; text-align: center;" bgcolor="#2F343A" class="sm2" align="center">Заработано на рефералах</td>
</tr>
</thead>
<tbody>
<tr>
<td style="border-bottom: 1px solid #2F343A; text-align: center;" align="center" width="50%">'.total_ref_num($db).'</td>
<td style="border-bottom: 1px solid #2F343A; border-left: 1px solid #2F343A; text-align: center;" align="center" width="50%">'.round(total_ref_money_prifit($db),2).'  RUB</td>
</tr>
</tbody>
</table>';

echo'<div style="margin-top: 15px; margin-bottom: 15px; color: #FF6A00;">В таблице ниже находится список ваших рефералов</div>';
		
echo'<table align="center" style="margin-top: 10px; border-right: 1px solid #2F343A;" width="100%" id="myTable" class="tablesorter" cellpadding="5" cellspacing="0">
<thead>
<tr>
<td style="border-bottom: 1px solid #2F343A; border-left: 1px solid #2F343A; text-align: center;" bgcolor="#2F343A" class="sm2" align="center">Пользователь</td>
<td style="border-bottom: 1px solid #2F343A; border-left: 1px solid #2F343A; text-align: center;" bgcolor="#2F343A" class="sm2" align="center">Ваш доход</td>

<td style="border-bottom: 1px solid #2F343A; border-left: 1px solid #2F343A; text-align: center;" bgcolor="#2F343A" class="sm2" align="center">Зарегистрирован</td>
<td style="border-bottom: 1px solid #2F343A; border-left: 1px solid #2F343A; text-align: center;" bgcolor="#2F343A" class="sm2" align="center">От куда пришел</td>
</tr>
</thead>
';

do { 
$user_ref = $rowzapros1['user_login'];

echo'
<tbody>
<tr>
<td style="border-bottom: 1px solid #2F343A; border-left: 1px solid #2F343A; text-align: center;" align="center" width="150">'.$user_ref.'</td>
<td style="border-bottom: 1px solid #2F343A; border-left: 1px solid #2F343A; text-align: center;" align="center" width="50">'.$rowzapros1['total_ref_money'].'  RUB</td>

<td style="border-bottom: 1px solid #2F343A; border-left: 1px solid #2F343A; text-align: center;" align="center" width="100">'.date("d-m-Y  H:i:s", $rowzapros1['user_regtime']).'</td>
<td style="border-bottom: 1px solid #2F343A; border-left: 1px solid #2F343A; text-align: center;" align="center" width="100">'.$rowzapros1['ot_kuda_prishel'].'</td>
</tr>';}

while($rowzapros1 = mysql_fetch_array($zapros1));

echo'</tbody></table>';

?>



<?
if ($rezult[17] > 1) { vpostr2($rezult,$page); }
} else {echo '<center>Рефералов пока нет</center>';}
} else {echo '<center>Вы не авторизованы</center>';}



} else {

header('Location: /login');

}

?>



</div>