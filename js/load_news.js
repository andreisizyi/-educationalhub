$('#posts').on('click', '.page-number:not(.current):not(.dots)', function(e) {
	e.preventDefault();
	//Забираю номер страницы из линка пагинации
	let page = $(this).attr('href');
	let term_id = $('#posts').attr('data-termid');
	let post_type = $('#posts').attr('data-type');
	//console.log(page);
	//Проверяю есть ли совпадения
	if (page.indexOf('page/') > -1) {
		//Ищу вхождение "page/" и беру часть после него
		page = page.substring(page.indexOf('page/')+5)
		//Очищаю все после него если есть параметры, например UTM метки
		page = page.substring(0,page.indexOf("/"))
		//console.log(page);
	} else {
		page = page.substring(page.indexOf('paged=')+6)
		//console.log(page);
	}
	let element = $(this);
		$.ajax({
			url: '/wp-admin/admin-ajax.php?action=load_news',
			type: 'POST',
			data: {
				page: page,
				term_id: term_id,
				post_type: post_type
			},
			dataType: 'text',
			beforeSend: function() {
				//Позже можно добавить прелоаред для визуализации загрузки
			},
			error: function() {
				alert("Error");
			},
			success: function(response) {
				//Добавляю контент с jQuery анимацией со стандартными параметрами
				$('#posts').html(response).css('display','none').fadeIn();
				//Здесь я добавляю номера  страниц в url, чтобы пользователь при обновлении страницы остался на выбранной
				if (history.pushState) {
					let baseUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
					let newUrl;
					if (baseUrl.indexOf('page/') == -1) {
						newUrl = baseUrl + 'page/' +  page+'/';
					} else {
						endurl = baseUrl.substring(baseUrl.indexOf('page/')+5);
						newUrl = baseUrl.replace(endurl, page+'/');
					}
					history.pushState(null, null, newUrl);
				}
				//Отправялю в top страницы, в тз написано до загрузки записей, но я считаю что нужно после, так как так человек успеет еще увидит изменения в пагинации, а также будет отправлен вверх только в случае реальной загрузки новостей
				$('html').animate(
					{scrollTop:0},
					'slow');
			}
		});
});