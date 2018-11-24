


<div class="right_sidebar" style="margin-top: -1px;">



<div class="h1">ПОСЛЕДНИЕ ВЫПЛАТЫ</div>


<div class="sidebar-header">


<br/>


<?


$viplati = mysql_query("SELECT * FROM `p_payments` ORDER BY `id` DESC LIMIT 7",$db) or die(mysql_error());
$rowviplati = mysql_fetch_array($viplati);
				
if ($rowviplati>0) {	

do { 
$zapros = mysql_query("SELECT * FROM `p_users` WHERE `user_id`='{$rowviplati['user_id']}' LIMIT 1",$db) or die(mysql_error());
$row = mysql_fetch_array($zapros);
$lucky_user = $row["user_login"];
$lucky_user_avatar = $row["vk_avatar_100"];
$lucky_user_vk_id = $row["vk_id"];


?>



<div class="user user-sidebar" style="padding-top: 10px;">
<div class="user-avatar-top">
<img width="60" height="60" src="<? echo $lucky_user_avatar?>" class="sidebar_avatar_top">
</div>
<div class="user-info-top">
<div class="user-name-top"><a style="font-size: 16px; text-decoration: none;" href="https://vk.com/id<? echo $lucky_user_vk_id?>"><? echo $lucky_user?></a></div>
<div class="user_balance-top" style="margin-top: 3px !important;">
<img src="/img/payeer.png" style="width: 17px; vertical-align: middle; padding-bottom: 2px;"> <? echo $rowviplati['summa']?>  RUB</div>

<div class="user_balance-top" style="margin-top: 3px !important;"><? echo substr_replace($rowviplati['payeer_purse'],'XXX',-3)?> </div>

</div>
</div>


<hr color="#fff" size="1">



<?
}
while($rowviplati = mysql_fetch_array($viplati));

} else {echo '<center>Выплат еще не было</center>';}



?>

</div>

</div>