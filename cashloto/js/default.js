$(function() {

var mess_interval;

		function displayMessage(text, color) {
		clearTimeout(mess_interval);
		$('#message').css('color', color);
		$('#message').html(text);
		mess_interval = setTimeout(function() { $('#message').html(''); }, 5000);
	}		
			
				
				
      $( "#betForm" ).submit(function( event ) {
	  event.preventDefault();

		displayMessage('Подождите....', '#fff');
		$('#betForm').css('opacity', 0.3);
		
		$.ajax({
			url: '/ajax/check_of_bet.php',
			type: "POST",
			data: $('#betForm').serialize(),
			dataType: 'json',
			cache: false,
			success: function(res) {
                    if (res['error']=='7') {
					window.location = "/login";
					return;
					}
				if (res['error']!=undefined) {
					displayMessage('ОШИБКА: '+res['error'], '#ff6b80');
				}

					if (res['res'] =='ok') {
					displayMessage('Ставка принята!', '#5cb85c');
					$('.user_balance_osn').each(function () { $(this).html(res['new_balance']) } );
					$('#ps').hide();
					$('#sub').hide();
				};
				
				
				
				$('#betForm').css('opacity', 1);
			}, error: function(res) {
				$('#message').html( 'Запрос не удался. Попробуйте еще раз.' );
					$('#message').css('color', '#ff6b80');
			}
		});
			
	});
	
	
	
	
	
	//депозит
	  $( "#depositForm" ).submit(function( event ) {
	  event.preventDefault();

		displayMessage('Подождите....', '#fff');
		$('#depositForm').css('opacity', 0.3);
		
		$.ajax({
			url: '/ajax/pay_deposit.php',
			type: "POST",
			data: $('#depositForm').serialize(),
			dataType: 'json',
			cache: false,
			success: function(res) {
                    if (res['error']=='7') {
					window.location = "/login";
					return;
					}
				if (res['error']!=undefined) {
					displayMessage('ОШИБКА: '+res['error'], '#ff6b80');
				}
				if (res['res'] =='ok') {
					displayMessage('Перенаправление на платежную систему...', '#009678');
					window.location = res['go_pay'];
				};
				
				
				$('#depositForm').css('opacity', 1);
			}, error: function(res) {
				$('#message').html( 'Запрос не удался. Попробуйте еще раз.' );
					$('#message').css('color', '#ff6b80');
			}
		});
			
	});
	
	
	
	
	
	//депозит
	  $( "#payoutForm" ).submit(function( event ) {
	  event.preventDefault();

		displayMessage('Подождите....', '#fff');
		$('#payoutForm').css('opacity', 0.3);
		
		$.ajax({
			url: '/ajax/payout.php',
			type: "POST",
			data: $('#payoutForm').serialize(),
			dataType: 'json',
			cache: false,
			success: function(res) {
                    if (res['error']=='7') {
					window.location = "/login";
					return;
					}
				if (res['error']!=undefined) {
					displayMessage('ОШИБКА: '+res['error'], '#ff6b80');
				}
				if (res['res'] =='ok') {
					displayMessage('Выплата произведена успешно!', '#009678');
					
				};
				
				
				$('#payoutForm').css('opacity', 1);
			}, error: function(res) {
				$('#message').html( 'Запрос не удался. Попробуйте еще раз.' );
					$('#message').css('color', '#ff6b80');
			}
		});
			
	});
	
	
	
	
	
	
	  //депозит
	  $( "#purseForm" ).submit(function( event ) {
	  event.preventDefault();

		displayMessage('Подождите....', '#fff');
		$('#purseForm').css('opacity', 0.3);
		
		$.ajax({
			url: '/ajax/add_purse.php',
			type: "POST",
			data: $('#purseForm').serialize(),
			dataType: 'json',
			cache: false,
			success: function(res) {
                    if (res['error']=='7') {
					window.location = "/login";
					return;
					}
				if (res['error']!=undefined) {
					displayMessage('ОШИБКА: '+res['error'], '#ff6b80');
				}
				if (res['res'] =='ok') {
					displayMessage('Кошелек сохранен!', '#009678');
					$('#purseForm').hide();
					$('#purse').html(res['purse']);
				};
				
				
				$('#purseForm').css('opacity', 1);
			}, error: function(res) {
				$('#message').html( 'Запрос не удался. Попробуйте еще раз.' );
					$('#message').css('color', '#ff6b80');
			}
		});
			
	});
	
	
	
	
	
	
	});
	
	
	
function update_page(){
$.ajax({
type: "POST",
url: "/ajax/up_info.php",
cache: false,

success: function(html) {
			data = JSON.parse(html);
			$("#all_users_ruletka").html(data.total_users);
			$("#vusers").html(data.vusers);
			$("#last_game").html(data.last_game);
			$("#timer").html(data.time_to_show);
			
			$("#luser_block").html(data.luser);
			
			$(".user_balance_osn").html(data.new_balance);
            var kk = data.user;
	        var ww = data.total_users;
			var we = data.time_to_show;
			var fi = data.time_to_finish;
			var luser = data.luser;
			var luser_time = data.luser_time;
			hide_pay(kk);
			hide_wait(fi,ww);
			hide_luser(luser);
		}
	
	});
	
}
setInterval("update_page();",3000);	
	

function hide_pay(kk) {

if( kk == 1) {
$('#tab_bet').hide();

} else {
$('#tab_bet').show();
$('#sub').show();
}

}



function hide_wait(fi,ww) {

if(fi == 0 || ww >1) {
$('#wait').hide();

}


else {
$('#wait').show();
}

}


function hide_luser(luser) {

if( luser == 0) {
$('#luser_block').hide();

$('#num_users').show();

$('#game_users').show();
/*$('#wait').show();*/
$('#last_game_users').show();
} else {
$('#luser_block').show();
$('#wait').hide();
$('#tab_bet').hide();
$('#num_users').hide();


$('#last_game_users').hide();

$('#game_users').hide();


/*
setTimeout(function(){
$('#luser_block').hide();
}, 8000);
*/


}

}
