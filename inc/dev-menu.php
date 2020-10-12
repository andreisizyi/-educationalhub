<style>
	.btn-dev{
		min-width: auto;
		padding: 1rem;
		font-size: 1.2rem;
		line-height: 1.2rem;
		position: fixed;
		z-index: 500;
		bottom: 1rem;
		right: 1rem;
	}
	.dev-menu{
		position: fixed;
		bottom: 6rem;
		right: 1rem;
		background-color: #439FB5;
		list-style-type: none;
		margin: 0;
		padding: 0;
		width: 200px;
		z-index: 9999999;
		max-height: 80vh;
		overflow-y: auto;
	}

	.dev-menu li a{
		padding: 10px 20px;
		text-decoration: none;
		font-size: 16px;
		font-weight: 600;
		color: #fff;
		display: block;
	}
</style>

<button class="btn btn-dev" type="button" id="btn-dev">
	dev-menu
</button>

<ul class="dev-menu d-none" id="dev-menu">
	<li>
		<a href="/uikit.php">
			UIKit
		</a>
	</li>
	<li>
		<a href="/single-page.php">
			Single Page
		</a>
	</li>
	<li>
		<a href="/courses.php">
			Courses
		</a>
	</li>
	<li>
		<a href="/single-course.php">
			Single course
		</a>
	</li>
	<li>
		<a href="/single-module.php">
			Single module
		</a>
	</li>
	<li>
		<a href="/video-page.php">
			Video Page
		</a>
	</li>
	<li>
		<a href="/lecturer-page.php">
			Lecturer Page
		</a>
	</li>
	<li>
		<a href="/test.php">
			Test
		</a>
	</li>
	<li>
		<a href="/news.php">
			News
		</a>
	</li>
	<li>
		<a href="/single-news.php">
			Single News
		</a>
	</li>
	<li>
		<a href="/404.php">
			404
		</a>
	</li>
	<li>
		<a href="/log-in.php">
			Log In
		</a>
	</li>
	<li>
		<a href="/sign-up.php">
			Sign Up
		</a>
	</li>
	<li>
		<a href="/cv.php">
			CV
		</a>
	</li>
	<li>
		<a href="/user-list.php">
			User list
		</a>
	</li>
	<li>
		<a href="/index.php">
			Index
		</a>
	</li>
</ul>

<script>
	var btnDev = document.getElementById('btn-dev');
	var devMenu = document.getElementById('dev-menu');
	document.addEventListener('keypress', function(e){
		if(e.keyCode == 113){
			devMenu.classList.toggle('d-none');
		}
	});

	btnDev.addEventListener('click', function(){
		devMenu.classList.toggle('d-none');
	});

</script>