//Начинаю с первой страницы, но в фанкшине убираю три записи, которые уже выведены
//Эти параметры я передам на обработчик
let page = 1;
let notin = $("#load").attr("data-not-in");
//Этот параметр я использую в js для проверки видимости кнопки "Еще"
let maxpages = $("#load").attr("data-max-pages");
$('#load').click(function(e) {
	e.preventDefault();
	if (page <= maxpages) {
		$.ajax({
			url: '/wp-admin/admin-ajax.php?action=load_events',
			type: 'POST',
			data: {
				page: page,
				notin: notin
			},
			dataType: 'text',
			beforeSend: function() {},
			error: function() {
				alert("Error");
			},
			success: function(response) {
				//console.log(response);
				if (page == maxpages) {
					$('#load').fadeOut();
				}
				//Добавляю контент с jQuery анимацией со стандартными параметрами
				$('#postsinsert').append(response);
				$('#postsinsert .anim').fadeIn().removeClass('.anim');
				scrollToBottom('postsinsert');
				page++;
			}
		});
	}
});
//Скролл к нижней части контейнера
function scrollToBottom(id) {
	div_height = $("#" + id).height();
	div_offset = $("#" + id).offset().top;
	window_height = $(window).height();
	$('html,body').animate({
		scrollTop: div_offset - window_height + div_height
	}, 'slow');
}