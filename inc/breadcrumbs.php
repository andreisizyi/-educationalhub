<div class="breadcrumbs" id="breadcrumbs">
	<?php
		if( is_single() ) {
			$id = get_the_ID();
            $post_type = get_post_type($id);
            $taxonomie_name = get_object_taxonomies($post_type)[0];
            $term_id = get_the_terms($id, $taxonomie_name)[0]->term_id;
			echo '<a href="'.get_term_link($term_id).'" class="breadcrumb-item"><span>Назад</span></a>';
		}
		elseif ( is_tax() || is_category() ) {
			echo '<a href="'.get_home_url().'" class="breadcrumb-item"><span>Назад</span></a>';
		}
	?>
</div>
