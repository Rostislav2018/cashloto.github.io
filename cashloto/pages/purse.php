<?
if ($mode == 'purse' and $prava >0) {
?>

<div class="content">

<div class="h1_content">ПРИВЯЗАТЬ КОШЕЛЕК</div>
<div class="decs_text_center">Внимательно вводите свой кошелек! Изменить будет не возможно!</div>

<br/>
<span id='message'>&nbsp;</span>
<br/>

<? if(empty($payeer_purse)) {?>
<form method="post" id="purseForm">
<table align="center" width="100%">

	 <tr>

     <td align="center" style="text-align: center;">
		

      </td>
	  </tr>
	  
 <tr> 
		
		 <td align="center" style="text-align: center;">
        <input class="bginp2" size="18" type="text" name="purse" maxlength="10" style="width:190px;" placeholder="Ваш кошелек" value="" />
		</td>
      </tr>  
	 
<tr>

<td align="center" style="text-align: center;">    

<input class="knop" style="width:207px;" type="submit" value="Привязать кошелек" />

        </td>
        </tr> 
		
</table>
</form> 
<div id="purse">
<?} else {?>


<div class="user_purse"><? echo $payeer_purse ?></div>



<?}?>
</div>


    

</div>

<?

} else {

header('Location: /login');

}

?>