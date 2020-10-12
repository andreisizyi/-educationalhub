<section class="page-title <?php echo $titleClasses; ?>" id="page-title">
	<div class="wrap">
		<h1>
			<?php echo $title; ?>
		</h1>

		<?php if($infoValues) { ?>
			<div class="info-values">
				<span class="info-item caption">
					20 відеоматеріалів
				</span>
				<span class="info-item caption">
					12 тестів
				</span>
			</div>
		<?php } ?>

		<?php if($titleButton) { ?>
			<a href="#" class="btn-light title-btn">Розпочати</a>
		<?php } ?>

		<?php if($expandDescription) { ?>
			<button type="button" class="btn-light-tr btn-expand">
				<span>
					<span class="opened">
						Розгорнути
					</span>
					<span class="closed">
						Згорнути
					</span>
				</span>
				<svg class="icon">
					<use xlink:href="#arrow-down" >
				</svg>
			</button>

			<span class="expanded-desc">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente veritatis doloremque aperiam odio aliquam, et eum nobis possimus reiciendis inventore enim odit maxime atque reprehenderit laborum quidem assumenda impedit, explicabo a eos maiores. Id dolore, excepturi cum quidem facere, modi similique sequi adipisci, maiores vero qui eos quae animi expedita esse tempora minima a fugiat assumenda suscipit! Officiis voluptatem, magni illo excepturi architecto nostrum odit. Hic dolore, libero, asperiores eveniet rerum, repellendus fugit natus odit recusandae adipisci quidem dolorem sapiente alias officia minus! Obcaecati, quibusdam, natus! Ratione quia pariatur alias saepe culpa commodi facilis, expedita libero eos blanditiis, sunt et.
			</span>
		<?php } ?>


		<?php if($filterAndSearch){ ?>
			<div class="search-row">
				<div class="row-w">
					<div class="col-10-w">
						<form class="label-search">
							<input type="text" class="input-text" placeholder="Ключові слова">
							<select name="city">
								<option hidden>Уся країна</option>
								<option value="kyiv">Київ</option>
								<option value="khakiv">Харків</option>
								<option value="odesa">Одеса</option>
							</select>
							<button class="btn-light-tr" type="submit">
								Знайти
							</button>
						</form>
					</div>
					<div class="col-2-w">
						<button class="btn-tr btn-filter" type="button">
							<svg class="icon">
								<use xlink:href="#settings">
							</svg>
						</button>
					</div>
				</div>
			</div>
		<?php } ?>

		<?php if($titleDescription){ ?>
			<span class="page-title-desc">
				ТЕРИТОРІЯ НОВИХ МОЖЛИВОСТЕЙ <span>ДЛЯ КОЖНОГО</span>
			</span>
		<?php } ?> 

		<?php if($titleBtns) { ?>
			<div class="page-title-btns">
				<a href="#" class="btn-light">ПОЧАТИ НАВЧАННЯ</a>
				<a href="#" class="btn-light-tr">ДІЗНАТИСЯ БІЛЬШЕ</a>
			</div>
		<?php } ?>
	</div>

	<?php if($titleBgImg) {?>
		<img src="../img/course.jpg" alt="" class="title-bg-img cover-img">
	<?php } ?>
</section>