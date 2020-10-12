let form = $( "#contact_form" );
				form.submit(function(e) {
					e.preventDefault();
					//Блокирую кнопку до получения ответа от сервера, дляизбежания дублей
					$('#contact_form button').attr('disabled', true);
					$('#contact_form #response').empty();
					let data = form.serializeArray();
					let allow = true;
					$.each(data, function(){
						let val = this.value;
						let name = this.name;
						//console.log(name+'='+val);
						//Проверка обязательных полей
						switch (name) {
							case 'first_name':
							case 'second_name':
							case 'comment':
								if (val.length == 0 ) {
									allow = false;
									console.log($('[name="first_name"]').next().text());
									$('#contact_form #response').append("Обовя'зкове поле <strong style='font-weight: bold'>"+ $('[name="'+name+'"]').next().text() +"</strong> не заповнено.</br>");
								};
						}
						//Проверка всех полей - если меньше двух и не ноль то нельзя
						if (val.length < 2 && val.length != 0 ) {
							allow = false;
							$('#contact_form #response').append("Поле <strong style='font-weight: bold'>" + $('[name="'+name+'"]').next().text() + "</strong> не може містити меньше 2-х символів.</br>");
						};
					});
					if (allow) {
						$.ajax({
							url: '/wp-admin/admin-ajax.php?action=post_form',
							type: "POST",
							data: form.serialize(),
							dataType: 'text',
							beforeSend: function() {},
							error: function() {
								$('#contact_form #response').append("Щось пішло не так, спробуйте ще.</br>");
								$('#contact_form button').attr('disabled', false);
							},
							success: function(response) {
								//console.log(response);
								$('#contact_form #response').append("Данні відправлено успішно.");
								$('#contact_form button').attr('disabled', false);
								$("#contact_form").trigger('reset')
							}
						});
					} else {
						$('#contact_form button').attr('disabled', false);
					}
				});