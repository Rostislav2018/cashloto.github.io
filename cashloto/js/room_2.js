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
			url: '/ajax/check_of_bet_room_2.php',
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
	
	
	});
	
	
	
function update_page(){
$.ajax({
type: "POST",
url: "/ajax/up_info_room_2.php",
cache: false,

success: function(html) {
			data = JSON.parse(html);
			$("#all_users_ruletka").html(data.total_users);
			$("#vusers").html(data.vusers);
			$("#last_game").html(data.last_game);
			$("#timer").html(data.time_to_show);
			$(".user_balance_osn").html(data.new_balance);
            var kk = data.user;
	        var ww = data.total_users;
			var we = data.time_to_show;
			var fi = data.time_to_finish;
			hide_pay(kk);
		}
	
	});
	
}
setInterval("update_page();",10000);	
	

function hide_pay(kk) {

if( kk == 1) {
$('#tab_bet').hide();

} else {
$('#tab_bet').show();
$('#sub').show();
}

}