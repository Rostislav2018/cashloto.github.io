<?
if ($mode == 'payout' and $prava >0) {
?>

<div class="content">

<div class="h1_content">ВЫВОД СРЕДСТВ</div>
<div class="decs_text">Вывод заработаных стредств осуществляется на платежную систему Payeer. <br>  Средства мгновенно поступят на Ваш кошелек. <br>Минимальная сумма для вывода - <? echo $min_summa_out?> руб. <br>Комиссия при выводе средств - <? echo $commission_pay_out?>%. Ограничений на максимальную сумму нет. <br>При первом выводе, с вас так же будут удержаны 2 рубля, которые вам зачислены для ознакомления с маркетингом проекта при регистрации.</div>
<br/>
<span id='message'>&nbsp;</span>
<br/>
<? if(!empty($payeer_purse)) {?>
<form method="post" id="payoutForm">
<table align="center" width="100%">

	 <tr>

     <td align="center" style="text-align: center;">
		
     <div class="user_purse"><? echo $payeer_purse ?></div>
      </td>
	  </tr>
	  
 <tr> 
		
		 <td align="center" style="text-align: center;">
        <input class="bginp2" size="18" type="text" name="pay_summ" maxlength="5" style="width:190px;" placeholder="Сумма, минимум <? echo $min_summa_out?> руб" value="" />
		</td>
      </tr>  
	 
<tr>

<td align="center" style="text-align: center;">    

<input class="knop" style="width:207px;" type="submit" value="Вывести" />

        </td>
        </tr> 
		
</table>
</form>
<?} else {echo '<a style="color: #FF6A00; font-size: 17px;" href="/purse/">Привязать кошелек</a>';}?>
<br />
    
		
	
			
<?		
		echo'<tr></br><td align="center"><center><div class="zag2" style="margin-top: 50px;">История вывода</div></center>';
	
	$viplati = mysql_query("SELECT * FROM `p_payments` WHERE `user_id`='{$_SESSION['ses_user']}' ORDER BY `id` DESC LIMIT 10",$db) or die(mysql_error());
			$rowviplati = mysql_fetch_array($viplati);
				
	 	if ($rowviplati>0) {	
echo'<table align="center" width="98%" class="tbl" cellpadding="5" cellspacing="0">

<tr>
<td bgcolor="#2F343A" style="color: #FF6A00; font-size: 17px; text-align: center;" align="center">Сумма вывода</td>
<td bgcolor="#2F343A" style="color: #FF6A00; font-size: 17px; text-align: center;" align="center">Сумма к получению</td>
<td bgcolor="#2F343A" style="color: #FF6A00; font-size: 17px; text-align: center;" align="center">Дата</td>
<td bgcolor="#2F343A" style="color: #FF6A00; font-size: 17px; text-align: center;" align="center">Кошелек</td>

</tr>';

do { 
if ($cv == 1) { $bg_color = "2F343A"; $td_color = "ffffff"; $cv=0; } else { $bg_color = "2F343A"; $td_color = "ffffff"; $cv++; }
echo'
<tr>
<td bgcolor="'.$bg_color.'" align="center" style="text-align: center;" width="200">'.$rowviplati['summa'].'  RUB</td>
<td bgcolor="'.$bg_color.'" align="center" style="text-align: center;" width="200">'.$rowviplati['summa_commission'].'  RUB</td>
<td bgcolor="'.$bg_color.'" align="center" style="text-align: center;" width="150">'.$rowviplati['date'].'</td>
<td bgcolor="'.$bg_color.'" align="center" style="text-align: center;" width="150">'.$rowviplati['payeer_purse'].'</td>

</tr>
';}

while($rowviplati = mysql_fetch_array($viplati));

echo'</table>';
	
	} else {echo '<center>выплат еще не было</center>';}
	
	
echo'</td></tr></table></td></tr>';	
		
?>	



</div>

<?

} else {

header('Location: /login');

}

?>