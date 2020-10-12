<?php get_header(); ?>

<main class="main" id="main">
    <?php
    while ( have_posts() ) : the_post();
        include('inc/breadcrumbs.php');
        $title = get_the_title();
        $titleClasses = 'page-title-sm page-title-bottom-md';
        include('inc/title.php');
        ?>
        <section class="section blog-section margin-top-negative-md">
            <div class="wrap">
                <div class="main-image news-main-image">
                    <?php the_post_thumbnail('single', array('style'=>'width: 100%')); ?>
                </div>
                <div class="row-w content blog-content">
                    <div class="col-10-w col-md-w">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </section>
    
    <?php endwhile; ?>

	<section class="section blog-latest">
		<div class="wrap">
            <?php
                //Получаю ID первой категории поста или произвольной записи чтобы сделать шаблон синг универсальным
                $id = get_the_ID();
                $post_type = get_post_type($id);
                $taxonomie_name = get_object_taxonomies($post_type)[0];
                $term_id = get_the_terms($id, $taxonomie_name)[0]->term_id;
            ?>
			<h2 class="t-center">
                <?php if ($post_type == 'post') :
                    echo 'ОСТАННІ НОВИНИ';
                else : 
                    echo 'ТАКОЖ ЦІКАВО';
                endif;?>
				
			</h2>
			<div class="row news-amount">
            <?php
                $posts = get_posts( array(
                    'numberposts' => 2,
                    //Указываю категорию текущего поста
                    'taxonomy'    => $term_id,
                    'orderby'     => 'rand',
                    'order'       => 'DESC',
                    'include'     => array(),
                    //Исключаю текущий пост
                    'exclude'     => $id,
                    'post_type'   => $post_type,
                    'suppress_filters' => true,
                ) );

                foreach( $posts as $post ){
                    setup_postdata($post);
                   get_template_part('parts/post-loop');
                }

                wp_reset_postdata();
            ?>
        




			</div>
		</div>
	</section>
</main>


<?php get_footer(); ?>