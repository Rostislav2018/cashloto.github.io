<?
if ($mode == 'fail') {
?>

<div class="content">
<script language = 'javascript'>
setTimeout( 'location="http://<? echo $_SERVER['SERVER_NAME']?>/deposit/";', 4000 );
</script>
<div class="h1_content">ОПЛАТА НЕ ПРОШЛА!</div>
<div style="margin-bottom: 30px;">


<i style="font-size: 100px;" class="fa fa-times-circle"></i>

<div style="font-size: 11px; margin-top: 30px;">Через несколько секунд Вы будете перенаправлены на страницу пополнения баланса...</div>

</div>
</div>

<?}?>