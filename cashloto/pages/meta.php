<!DOCTYPE html>
<html>
    <head>
        <title><? echo $title?></title>
<meta property="og:image" content="/img/ovk.png" />
<link rel="shortcut icon" href="/img/ico.gif" type="image/x-icon"/>
<meta name="description" content="<? echo $description?>" />
        <meta name="keywords" content="<? echo $site_keywords?>" />
		 <meta charset="utf-8" />
         <script type="text/javascript" src="/js/jquery.main.js"></script>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	    <link href="/css/style.css" rel="stylesheet" type="text/css"> 
	    <script type='text/javascript' src='/js/jquery.min.js'></script>
		<script type='text/javascript' src='/js/jquery-ui.js'></script>
	    <?if ($mode == 'room_2'){?>
	    <script type='text/javascript' src='/js/room_2.js'></script>
        <?} elseif($mode == 'room_3'){?>
        <script type='text/javascript' src='/js/room_3.js'></script>
	    <?} elseif($mode == 'room_default' || $mode == 'deposit' || $mode == 'payout' || $mode == 'purse') {?>
	    <script type='text/javascript' src='/js/default.js'></script>
	    <?} elseif($mode == 'bonus'){?>
	    <script src="/js/jquery.flipcountdown.js"></script>
        <link rel="stylesheet" href="/css/jquery.flipcountdown.css">
	    <?}?>
    </head>
<body> 
<div class="wrapper">


<div style="position: fixed; z-index: 1000; right:0px; bottom: 0px; width: 400px; height: 527px; display: none; border: 2px solid #FF6A00;" id="chat_window">
	<div id="chat_title" style="width:100%; background: #1088ee; font-size: 20px; cursor: move;">
		ЧАТ 
		<div style="float: right"><a href="#" id="close_chat"><i class="fa fa-close"></i></a>&nbsp;&nbsp;</div>
	</div>
	
	<div id="chat" style="background: #2F343A;">
		
		
			<script type="text/javascript" src="//vk.com/js/api/openapi.js?144"></script>
			<script type="text/javascript"> VK.init({apiId: <? echo $chat_vk_id?>, onlyWidgets: true}); </script>
			<div id="vk_comments"></div>


			<script type="text/javascript">
			VK.Widgets.Comments("vk_comments", {limit: 10, attach: "*", mini: '1', height : 500, attach: false}, "ROOM");
			</script>
	</div>
</div>
	
<script>
$(function() {
	$('#chat_window').draggable({cursor: "move" ,  handle: "#chat_title" });
	$('#chat_b').click(function() { 
		$('#chat_window').slideDown(); 
		return false;
	} );
	$('#close_chat').click(function() { 
		$('#chat_window').slideUp(); 
		return false;
	} );
});
</script>




