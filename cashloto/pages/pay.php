<?
if ($prava>0 && $mode=="pay" && isset($_GET['pay_id']))
{ 
//только цифры!
if (preg_match('/^[1-9]\d*$/', $_GET['pay_id'])) {
//ищем есть ли в базе
$query = mysql_query("SELECT * FROM `p_update_balance` WHERE `id`='{$_GET['pay_id']}'",$db) or die(mysql_error());
$num = mysql_num_rows($query);
if($num > 0) 
{
	

$p_update_balance = mysql_query("SELECT * FROM `p_update_balance` WHERE `id`='{$_GET['pay_id']}'",$db) or die(mysql_error());
$row_p_update_balance = mysql_fetch_array($p_update_balance);

if ($row_p_update_balance['pay_system'] =='Payeer') {
include('inc/cpayeer.php');
include('inc/inc_payeer.php');
$order = $row_p_update_balance['order_id'];
$summa = $row_p_update_balance['summa'];

$m_shop = $payeerShopId;
$m_orderid = $order;
$m_amount = number_format($summa, 2, '.', '');
$m_curr = 'RUB';
$m_desc = base64_encode('Пополнение баланса на сайте '.$_SERVER['SERVER_NAME'].'');
$m_key = $payeerShopKey;
$arHash = array(
$m_shop,
$m_orderid,
$m_amount,
$m_curr,
$m_desc,
$m_key
);
$sign = strtoupper(hash('sha256', implode(':', $arHash)));

}

elseif($row_p_update_balance['pay_system'] =='Free-kassa') {
include('inc/inc_free-kassa.php');
$order = $row_p_update_balance['order_id'];
$summa = $row_p_update_balance['summa'];

$merchant_id   = $free_merchant_id;
$secret_word   = $free_merchant_secret;
$order_id      = $order;
$order_amount  = number_format($summa, 2, '.', '');;
$sign          = md5($merchant_id.':'.$order_amount.':'.$secret_word.':'.$order_id);


}
	
?>
	
<div class="content">


<div class="zag2" style="color: #fff; padding: 15px;">Пожалуйста подождите...</div>
<br/>
<img style="padding-top: 15px; width: 200px;" src="/img/loader.gif">

<?
if ($row_p_update_balance['pay_system'] =='Payeer') {
?>

<form id="pay-form" method="POST" action="https://payeer.com/merchant/">
<input type="hidden" name="m_shop" value="<?=$m_shop;?>">
<input type="hidden" name="m_orderid" value="<?=$m_orderid;?>">
<input type="hidden" name="m_amount" value="<?=$m_amount;?>">
<input type="hidden" name="m_curr" value="<?=$m_curr;?>">
<input type="hidden" name="m_desc" value="<?=$m_desc;?>">
<input type="hidden" name="m_sign" value="<?=$sign;?>">
<input type="hidden" name="m_process" value="send">
</form>
<?} elseif($row_p_update_balance['pay_system'] =='Free-kassa') {?> 
  
<form id="pay-form" method="GET" action="http://www.free-kassa.ru/merchant/cash.php">
<input type="hidden" name="m" value="<?=$merchant_id;?>">
<input type="hidden" name="oa" value="<?=$order_amount;?>">
<input type="hidden" name="o" value="<?=$order_id;?>">
<input type="hidden" name="s" value="<?=$sign;?>">
<input type="hidden" name="us_order" value="<?=$order;?>">
</form>
<?}?>  

<script>
$(function() {
$('#pay-form').submit();
});
</script>

</div>
	

<?} else {?>
	
	
<div class="content">

<div class="zag2" style="color: red; padding: 15px;">Ошибка! Платеж не найден!</div>

</div>	
	
	
<?} } else {?>
	
<div class="content">

<div class="zag2" style="color: red; padding: 15px;">Ошибка!</div>

</div>	
	
<?} } ?>