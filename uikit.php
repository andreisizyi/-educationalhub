<?php include('header.php'); ?>

	<?php 

			$title = "UIKit";
			include('inc/title.php');
	?>
	
<div class="wrap">
	<br>
	<h2>Typography</h2>
	<br>
	<h1>ТВОЇ МОЖЛИВОСТІ</h1>
	<h2>Сертифікати</h2>
	<h3>Оберіть варіант</h3>
	<h4>НАВИЧКИ SOFT SKILLS (М’ЯКІ НАВИЧКИ)</h4>	
	<h5>НАВИЧКИ SOFT SKILLS (М’ЯКІ НАВИЧКИ)</h5>	
	
	<span class="overline">
		Чемпіонати з інтелектуальних ігор
	</span>
	<br>
	<span class="caption">
		Василь Цитатник
	</span>
	<br>
	<br>

	<span class="text">
		розвинь у собі навички майбутнього/ХХІ століття та стань пріоритетною ціллю для українських та міжнародних компаній (роботодавців) або відкрий успішну власну справу.
	</span>
	<br>
	<br>
	<a href="#">
		міжнародних компаній
	</a>
	<br>
	<br>
	<br>
	<span class="italic">
		Інтерактивне резюме – це показник Твого руху сходинками успіху. Це - Твоє дзеркало, в яке буде приємно дивитись щодня, адже ніщо так не прикрашає людину, як її власна праця, досягнення результату та перемога над самим собою. Стань прикладом для своїх близьких та друзів.
	</span>

	<br>
	<br>
	<br>
	<hr>
	<h2>Colours</h2>
	<br>

	<div class="uikit-color bg-primary"></div>
	<div class="uikit-color bg-primaryX"></div>
	<div class="uikit-color bg-primaryM"></div>
	<div class="uikit-color bg-primaryL"></div>
	<div class="uikit-color bg-secondary"></div>
	<div class="uikit-color bg-light-grey"></div>
	<div class="uikit-color bg-grey"></div>
	<div class="uikit-color bg-dark-grey"></div>

	<br>
	<br>

	<hr>
	<h2>Buttons</h2>
	<br>
	<button class="btn" type="button">Почати навчання</button>
	<button class="btn" type="button" disabled>Почати навчання</button>
	<button class="btn-sm" type="button">Розпочати</button>
	<br>
	<br>

	<button class="btn-tr" type="button" disabled>Почати навчання</button>
	<button class="btn-tr" type="button">Почати навчання</button>
	<br>
	<br>
	<br>


	<div class="bg-primary">
		<br>
		<button class="btn-light" type="button">Почати навчання</button>
		<button class="btn-light" type="button" disabled>Почати навчання</button>
		<button class="btn-light btn-sm" type="button">Розпочати</button>
		<br>
		<br>

		<button class="btn-light-tr" type="button" disabled>Почати навчання</button>
		<button class="btn-light-tr" type="button">Почати навчання</button>
		<br>
		<br>
		<br>
	</div>

	<hr>
	<h2>Forms</h2>
	<label class="checkbox">
		<input type="checkbox" name="checkbox">
		<span class="control">
			<svg class="icon">
				<use xlink:href="#check">
			</svg>
		</span>
		<span class="text">Check</span>
	</label>
	<label class="checkbox">
		<input type="checkbox" name="checkbox" checked>  
		<span class="control">
			<svg class="icon">
				<use xlink:href="#check">
			</svg>
		</span>
		<span class="text">Check</span>
	</label>

	<label class="checkbox">
		<input type="checkbox" name="checkbox" disabled>  
		<span class="control">
			<svg class="icon">
				<use xlink:href="#check">
			</svg>
		</span>
		<span class="text">Check</span>
	</label>

	<label class="checkbox">
		<input type="checkbox" name="checkbox" checked disabled>  
		<span class="control">
			<svg class="icon">
				<use xlink:href="#check">
			</svg>
		</span>
		<span class="text">Check</span>
	</label>


	<br>
	<br>
	<br>

	<label class="radio">
		<input type="radio" name="radio" checked>  
		<span class="control"></span>
		<span class="text">Check</span>
	</label>
	<label class="radio">
		<input type="radio" name="radio">  
		<span class="control"></span>
		<span class="text">Check</span>
	</label>
	<label class="radio">
		<input type="radio" name="radio1" checked disabled>  
		<span class="control"></span>
		<span class="text">Check</span>
	</label>
	<label class="radio">
		<input type="radio" name="radio1" disabled>  
		<span class="control"></span>
		<span class="text">Check</span>
	</label>


	<br>
	<br>
	<br>

	<label class="switch">
		<input type="checkbox" name="switch" checked>  
		<span class="control"></span>
		<span class="text">Check</span>
	</label>
	<label class="switch">
		<input type="checkbox" name="switch">  
		<span class="control"></span>
		<span class="text">Check</span>
	</label>

	<label class="switch">
		<input type="checkbox" name="switch" checked disabled>  
		<span class="control"></span>
		<span class="text">Check</span>
	</label>
	<label class="switch">
		<input type="checkbox" name="switch" disabled>  
		<span class="control"></span>
		<span class="text">Check</span>
	</label>

	<br>
	<br>
	<br>
	<label class="label-text">
		<input type="text" name="text" class="input-text"  placeholder="input text">
		<span class="label-placeholder">Name</span>
		<span class="label-line"></span>
		<span class="help-text">Assistive text</span>
		<span class="sign-text"></span>
	</label>

	<br>

	<label class="label-text">
		<input type="text" name="text" class="input-text" placeholder="input text">
		<span class="label-placeholder">Name</span>
		<span class="label-line"></span>
		<span class="help-text">Assistive text heudbeubdeubd jncdcbhdhbcdjbhc dcdc Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo amet rem mollitia tempore odio quod autem cum reprehenderit, corrupti molestias.</span>
		<span class="sign-text"></span>
	</label>

	<br>

	<label class="label-text">
		<input type="text" name="text" class="input-text error" value="value" placeholder="input text">
		<span class="label-placeholder">Name</span>
		<span class="label-line"></span>
		<span class="sign-text">
			<svg class="icon error-icon">
				<use xlink:href="#error">
			</svg>
		</span>
		<span class="help-text">Assistive text heudbeubdeubd jncdcbhdhbcdjbhc dcdc Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo amet rem mollitia tempore odio quod autem cum reprehenderit, corrupti molestias.</span>
	</label>

	<br>

	<label class="label-text">
		<textarea name="text" class="input-text input-textarea" rows="3"></textarea>
		<span class="label-placeholder">Name</span>
		<span class="label-line"></span>
		<span class="sign-text">
			<svg class="icon">
				<use xlink:href="#error">
			</svg>
		</span>
		<span class="help-text">Assistive text</span>
	</label>
	<br>
	<br>
	<br>
	<br>
	<hr>

	<br>
	<br>
	<h2>Drop-down list</h2>
	<br>
	<br>

	<div class="label-select">
		<span class="label-info">Label</span>
		<select name="select">
			<option hidden>Choose</option>
			<option value="list-1">List 1</option>
			<option value="list-2">List 2</option>
		</select>
	</div>

	<br>
	<br>
	<br>
	<hr>
	<br>
	<br>

	<h2>System Icons</h2>
		<svg class="uikit-icon">
			<use xlink:href="#check"> 
		</svg>
		<svg class="uikit-icon">
			<use xlink:href="#play"> 
		</svg>

	<br>
	<br>
	<br>
	<br>
	<hr>
	<br>
	<br>
	<h2>Cards</h2>
	<br>
	<!-- <div class="card">
		<div class="card-title">
			<div class="overline"># Історії успіху</div>
		</div>
	</div> -->
	<br>
	<br>
	<br>
	<hr>

	<h2>Tables</h2>

	<div class="wrap">
		<div class="table-wrap">
			<table class="table">
				<tr>
					<th>#</th>
					<th>First</th>
					<th>Last</th>
					<th>Handle</th>
				</tr>
				<tr>
					<td>1</td>
					<td>Mark</td>
					<td>Otto</td>
					<td>@mdo</td>
				</tr>
				<tr>
					<td>2</td>
					<td>Jacob</td>
					<td>Thornton</td>
					<td>@mdo</td>
				</tr>
				<tr>
					<td>3</td>
					<td>Larry</td>
					<td>the Bird</td>
					<td>@mdo</td>
				</tr>
			</table>
		</div>
	</div>

	<br>
	<br>
	<br>

	<div class="bg-primary wrap">

		<br>
		<br>
		<br>

		<div class="table-wrap dark-table-wrap">
			<table class="table dark-table">
				<tr>
					<th>#</th>
					<th>First</th>
					<th>Last</th>
					<th>Handle</th>
				</tr>
				<tr>
					<td>1</td>
					<td>Mark</td>
					<td>Otto</td>
					<td>@mdo</td>
				</tr>
				<tr>
					<td>2</td>
					<td>Jacob</td>
					<td>Thornton</td>
					<td>@mdo</td>
				</tr>
				<tr>
					<td>3</td>
					<td>Larry</td>
					<td>the Bird</td>
					<td>@mdo</td>
				</tr>
			</table>
		</div>


		<br>
		<br>
		<br>
	</div>


	<br>
	<br>


</div>











<?php include('footer.php'); ?>