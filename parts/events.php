<section class="section section-pd">
	<div class="wrap">
		<h2>ЖИВЕ СПІЛКУВАННЯ</h2>
		<div id="postsinsert" class="mb-0 row card-square-amount">
			<div class="col-6 col-md">
				<div class="card-square special-card">
					<div class="card-square-sp">
						<span class="text">
							Окрім тестування, навчання топовим навичкам та побудови успішної кар’єри Ти отримуєш можливість відвідувати наші FAN-активності:
						</span>
						<ul>
							<li>Презентації українських та міжнародних компаній</li>
							<li>Чемпіонати з інтелектуальних ігор</li>
							<li>Історії успіху</li>
							<li>Кіно Клуб</li>
							<li>Lingva SHOW</li>
							<li>Школа HR</li>
						</ul>
					</div>
				</div>
			</div>
			<?php
				// Создаю новый обьект WP_Query с нужными параметрами
				$posts  = new WP_Query(
					array(
						'post_type'   => 'event',
						'taxonomy' => 'events',
						'meta_key'    => 'event_date',
						'post_status' => 'publish',
						'posts_per_page' => 3,
						'orderby'     => 'meta_value',
						'order'       => 'DESC'
					)
				); 
				//Создаю массив, далее пригодиться
				$notin = [];
			?>
			<?php
			while ( $posts->have_posts() ) : $posts->the_post(); ?>
				<div class="col-6 col-md">
					<div class="card-square">
						<div class="card-square-inner">
							<div class="card-square-date">
								<?php $date = strtotime(get_field( "event_date" )); ?>
								<span class="day">
									<?php echo date('d', $date ); ?>
								</span>
								<span class="month">
									<?php
									//Склоняю дату встроеной функцией ВП, и убираю лишнии символы, необходимые для работы функции
									$predate = date_i18n('d F Y', $date );
									//Обрезаю все до первого пробела
									echo substr($predate, strpos($predate, ' ')); ?>								
								</span>
								</div>
								<div class="card-square-title">
									<?php 
										echo '# '.get_field( "tag" );
									?>
									<h2>
										<a href="<?php echo get_post_permalink(); ?>" class="like-h3">
											<?php the_title(); ?>
										</a>
									</h2>
									<span><?php echo get_field( "speaker" ); ?></span>
								</div>	
							</div>
						</div>
					</div>
					<?php //Записываю ID каждого выведенного ивента в массив, чтобы потом их исключить
						$notin[] = get_the_id();
					?>
			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
		</div>
		<!-- Разделил блоками кнопку от блока с динамическим контентом, для последующей загрузки в первый блок-->
		<!-- На мобильном в дальнейшем имеет смысл подключить Mobile Detect класс или воспользовать js переменной, чтобы загружать не по 2-ве, а по 1 записи, так как не на всех устройствах поместяться в экран -->
		<div class="mt-0 row card-square-amount">
			<?php 
				//Тут я проверяю нужно ли показывать кнопку по условие если есть еще страницы
				if ($posts->max_num_pages > 1) { ?>
				<?php 
					//Так как в начальном цикле у меня выводиться 3 записи, а подгружаться будет по две (в угоду дизайна и юзабилити) я создаю дополнительный объект с новывми параметрами
					//Этот объект я использую чтобы подсчитать количество страниц, без уже выведеных записей, а также с новой постраничной разбивкой по 2.
					$posts  = new WP_Query(
						array(
							'post_type'   => 'event',
							'taxonomy' => 'events',
							'meta_key'    => 'event_date',
							'post_status' => 'publish',
							'posts_per_page' => 2,
							'orderby'     => 'meta_value',
							'order'       => 'DESC',
							//Здесь убираю из вывода уже полученые ранее записи
							'post__not_in'=>$notin,
						)
					);
					//Полученый параметр max_num_pages из дополнительного объекта я записываю в атрибут кнопки, чтобы потом обратиться к нему из js
				?>
				<a data-not-in="<?php echo implode(',', $notin); ?>" data-max-pages="<?php echo $posts->max_num_pages; ?>" href="" id="load" class="btn">
					Ще заходи
				</a>
			<?php } ?>
		</div>
		<?php 
		//Анулирую данные последнего запроса чтобы глобальные переменные соответствовали текущей странице
		wp_reset_query(); ?>
	</div>
</section>