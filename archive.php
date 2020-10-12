<?php get_header(); ?>
<main class="main" id="main">
	<?php
	include('inc/breadcrumbs.php');
	$titleClasses = 'page-title-bottom-md';
	$title = single_term_title('',false);
	include('inc/title.php');

	$id = get_the_ID();
    $post_type = get_post_type($id);
    $taxonomie_name = get_object_taxonomies($post_type)[0];
	$term_id = get_the_terms($id, $taxonomie_name)[0]->term_id;
	//В архиве все записи и новости и ивенты сортируються по дате публикации, так что нужно еще учесть правило для архива ивентов
	?>
	<section class="section margin-top-negative">
		<div id="posts" class="wrap" data-termid="<?php echo $term_id; ?>" data-type="<?php echo $post_type; ?>">
			<div class="row news-amount">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php get_template_part('parts/post-loop'); ?>
				<?php endwhile; // конец цикла
				else: echo '<p>Новин немає.</p>'; endif; ?>	 
			</div>
			<?php 
			pagination(); ?>
		</div>
	</section>
</main>

<?php get_footer(); ?>