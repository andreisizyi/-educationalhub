
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">

	<?php wp_head(); ?>
</head>

<body>


	<?php include('inc/dev-menu.php'); ?>


	<div class="d-none">
		<?php include('inc/svgmap.php'); ?>
	</div>

	<header class="header" id="header">
		<a href="/" class="logo">
			<img src="<?php echo get_template_directory_uri() ?>/img/logo.png" alt="">
		</a>
		<button class="btn-light-tr btn-menu" id="btn-menu">
			<span class="menu-icon">
				<span class="dot"></span>
				<span class="dot"></span>
				<span class="dot"></span>
				<span class="dot"></span>
				<span class="dot"></span>
				<span class="dot"></span>
				<span class="dot"></span>
				<span class="dot"></span>
				<span class="dot"></span>
			</span>
			<span class="menu-name">Меню</span>
		</button>
		<div class="menu">
			<div class="menu-inner">
				
				<div id="insert_menu">
					<?php menu(); ?>
				</div>

				<div class="menu-buttons">
					<a href="#" class="btn-light-tr btn-with-icon">
						<svg class="icon tr-reflect">
							<use xlink:href="#arrow-long">
						</svg>
						<span>Роботодавцю</span>
					</a>
					<a href="#" class="btn-light">Особистий кабінет</a>
				</div>
			</div>
		</div>
	</header>