<?php
/**
 * Шаблон обычной страницы (page.php)
 * @package WordPress
 * @subpackage your-clean-template-3
 */
get_header(); // подключаем header.php ?>
<section>
	<div class="container">
		<div class="row">
			<div>
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); // старт цикла ?>
					<article id="post-<?php the_ID(); ?>">
						<h1><?php the_title(); // заголовок поста ?></h1>
						<?php the_content(); // контент ?>
					</article>
				<?php endwhile; // конец цикла ?>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); // подключаем footer.php ?>
