<?
if ($mode == 'deposit' and $prava >0) {
?>

<div class="content">

<div class="h1_content">ПОПОЛНИТЬ БАЛАНС</div>
<div class="decs_text">Пополнение баланса возможно через две платежные системы Payeer и Free-kassa. <br> Средства зачисляются на Ваш баланс автоматически и мгновенно. <br> Минимальная сумма пополнения - <? echo $min_summa_in?> руб.</div>
<br/>
<span id='message'>&nbsp;</span>
<br/>

<form method="post" id="depositForm">
<table align="center" width="100%">

	 <tr>

     <td align="center" style="text-align: center;">
		
      <select name="pay_system" style="padding: 5px; border-radius: 4px; border: 1px solid #CCCCCC; width:206px;">
      <option value="1">Payeer</option>
	  <option value="2">Free-kassa</option>
      </select>
      </td>
	  </tr>
	  
 <tr> 
		
		 <td align="center" style="text-align: center;">
        <input class="bginp2" size="18" type="text" name="pay_summ" maxlength="5" style="width:190px;" placeholder="Сумма, минимум <? echo $min_summa_in?> руб" value="" />
		</td>
      </tr>  
	 
<tr>

<td align="center" style="text-align: center;">    
<input type="hidden" name="act" value="pay_in">
<input type="hidden" name="acton" value="pay_in">
<input class="knop" style="width:207px;" type="submit" value="Пополнить" />

        </td>
        </tr> 
		
</table>
</form> 
<br />
    
		
	
			
<?		
		echo'<tr></br><td align="center"><center><div class="zag2" style="margin-top: 50px;">История пополнения баланса</div></center>';
	
	$viplati = mysql_query("SELECT * FROM `p_update` WHERE `user_id`='{$_SESSION['ses_user']}' ORDER BY `id` DESC",$db) or die(mysql_error());
			$rowviplati = mysql_fetch_array($viplati);
				
	 	if ($rowviplati>0) {	
echo'<table align="center" width="98%" class="tbl" cellpadding="5" cellspacing="0">

<tr>
<td bgcolor="#391649" style="color: #FF6A00; font-size: 17px; text-align: center;" align="center">Сумма</td>
<td bgcolor="#391649" style="color: #FF6A00; font-size: 17px; text-align: center;" align="center">Дата</td>
<td bgcolor="#391649" style="color: #FF6A00; font-size: 17px; text-align: center;" align="center">Платежная система</td>

</tr>';

do { 
if ($cv == 1) { $bg_color = "391649"; $td_color = "ffffff"; $cv=0; } else { $bg_color = "512E61"; $td_color = "ffffff"; $cv++; }
echo'
<tr>
<td bgcolor="'.$bg_color.'" align="center" style="text-align: center;" width="200">'.$rowviplati['summa'].'  RUB</td>
<td bgcolor="'.$bg_color.'" align="center" style="text-align: center;" width="150">'.$rowviplati['data'].'</td>
<td bgcolor="'.$bg_color.'" align="center" style="text-align: center;" width="150">'.$rowviplati['pay_system'].'</td>

</tr>
';}

while($rowviplati = mysql_fetch_array($viplati));

echo'</table>';
	
	} else {echo '<center>пополнений еще не было</center>';}
	
	
echo'</td></tr></table></td></tr>';	
		
?>	


</div>

<?

} else {

header('Location: /login');

}
?>