<div class="left_sidebar">

<?
if ($prava ==0) {

?>
<div class="sidebar-header">
<div class="user user-sidebar">

<div class="reg_sidebar"><a class="reg_btn" href="/login/">Вход/Регистрация</a></div>
	
</div>
</div>

<div class="widget">

  <ul>
    <li><i class="fa fa-navicon" style="margin-right: 5px;"></i> <a href="/room_4"><b>Начать игру</b></a></li>

<li><i class="fa fa-exclamation-triangle" style="margin-right: 5px;"></i> <a href="/game/">Как играть</a></li>

    <li><i class="fa fa-info-circle" style="margin-right: 5px;"></i> <a href="/rules/">Правила проекта</a></li>
	

    <li style="padding-bottom: 10px;"><i class="fa fa-question-circle" style="margin-right: 5px;"></i> <a href="/faq/">Вопрос - ответ</a></li>

<li><i class="fa fa-envelope" style="margin-right: 5px;"></i> <a href="/contacts/">Наши контакты</a></li>


  </ul>
<br><br>
<center>
Здесь код баннера 200х300
</center>

</div>

<?}


//права больше 0!
else {?>
 
 
<div class="sidebar-header">
<div class="user user-sidebar">
<div class="user-avatar">
<img width="70" height="70" src="<? echo $vk_avatar_100?>" class="sidebar_avatar"> 





</div> 
<div class="user-info">
<div class="user-name"><b>ID: <? echo $_SESSION['ses_user'];?></b> <? echo $name?></div>
<div class="user_balance"> <span class="user_balance_osn"><b><? echo round($user_balance_global,2)?>  RUB</b></span></div>





<div class="user-desc"><a href="/exit">Выход</a></div>

</div>
</div>

<div class="widget">

  <ul>
    <?if ($prava == 5) {?>
	<li><i class="fa fa-gear" style="margin-right: 5px;"></i> <a href="/admin/index.php" target="_blank">Админка</a></li>
	<?}?> 

<hr align="center" width="500" size="2" color="#ff0000" />

    <li> <a href="/room_4">&#10102;<b> комната</b> (от 1 RUB)</a></li>

<li> <a href="/room_5">&#10103;<b> комната</b> (от 10 RUB)</a></li>

<li> <a href="/room_6">&#10104;<b> комната</b> (от 100 RUB)</a></li>




<br><hr align="center" width="500" size="2" color="#ff0000" />


    <li>&#10010; <a href="/deposit/">Пополнить баланс</a></li>

<li><i class="fa fa-external-link-square" style="margin-right: 5px;"></i> <a href="/payout/">Вывод средств</a></li>

    <li><i class="fa fa-user" style="margin-right: 5px;"></i> <a href="/refs/">Ваши рефералы</a></li>
    
	<li><i class="fa fa-gift" style="margin-right: 5px;"></i> <a href="/bonus/">Ежечасный бонус</a></li>
    
	<li><i class="fa fa-envelope" style="margin-right: 5px;"></i> <a href="/contacts/">Тех.поддержка</a></li>
	
    
  </ul>
</div>

</div>
 
 
<? }?>

</div>