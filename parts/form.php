<section class="section section-pd bg-light-grey t-center">
		<div class="wrap">
			<h2>Напишіть нам</h2>
			<form id="contact_form" action="/" method="post" style="max-width: 600px; margin: 0 auto;">
				<label class="label-text">
					<input type="text" name="first_name" class="input-text"  placeholder="input text">
					<span class="label-placeholder">Ім’я *</span>
					<span class="label-line"></span>
					<span class="help-text">Обов'язкове поле</span>
					<span class="sign-text"></span>
				</label>

				<label class="label-text">
					<input type="text" name="second_name" class="input-text"  placeholder="input text">
					<span class="label-placeholder">Прізвище *</span>
					<span class="label-line"></span>
					<span class="help-text">Обов'язкове поле</span>
					<span class="sign-text"></span>
				</label>

				<label class="label-text">
					<input type="text" name="position" class="input-text"  placeholder="input text">
					<span class="label-placeholder">Посада</span>
					<span class="label-line"></span>
					<span class="sign-text"></span>
				</label>

				<label class="label-text">
					<input type="text" name="web" class="input-text"  placeholder="input text">
					<span class="label-placeholder">Веб сайт</span>
					<span class="label-line"></span>
					<span class="sign-text"></span>
				</label>

				<label class="label-text">
					<textarea name="comment" class="input-text input-textarea" rows="3"></textarea>
					<span class="label-placeholder">Коментар *</span>
					<span class="label-line"></span>
					<span class="help-text">Обов'язкове поле</span>
					<span class="sign-text">
						<svg class="icon">
							<use xlink:href="#error">
						</svg>
					</span>
				</label>
				<!-- Позже можно добавить поле google капчи или сделать фоновую проверку -->
				<button type="submit" class="btn" type="button">Відправити</button>
				<span id="response" style="display: block; margin-top: 15px;" class="help-text"></span>
			</form>
		</div>
	</section>