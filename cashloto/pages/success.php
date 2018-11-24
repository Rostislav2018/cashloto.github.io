<?
if ($mode == 'success') {
?>

<div class="content">
<script language = 'javascript'>
setTimeout( 'location="http://<? echo $_SERVER['SERVER_NAME']?>";', 4000 );
</script>
<div class="h1_content">ОПЛАТА ПРОШЛА УСПЕШНО!</div>
<div style="margin-bottom: 30px;">


<i style="font-size: 100px;" class="fa fa-thumbs-up"></i>

<div style="font-size: 11px; margin-top: 30px;">Через несколько секунд Вы будете перенаправлены в игру...</div>

</div>
</div>

<?}?>