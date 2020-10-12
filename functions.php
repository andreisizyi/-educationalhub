<?php
//Настройки темы
add_action('after_setup_theme', 'setup');
function setup() {
    //Миниатюры
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(516, 310);
    //Создаю миниматюру для сингла с масшбаированием по подходящей стороне
    add_image_size('single', 1122, 999, false);
    // Тайт с настроек ВП
    add_theme_support('title-tag');
    // Меню
    register_nav_menus(array(
        'main' => 'Головне',
    ));
    //Логотип оставлю в верстке
}
// Вешаю фанкшин на хук
add_action('wp_enqueue_scripts', 'style');
function style() {
    // Использую функци ВП для прикреапления стилей в раздел <head>
    wp_enqueue_style('main', get_template_directory_uri() . '/dist/main.css');
}
//Отключаю стили гутенберга
function dm_remove_wp_block_library_css() {
    if (is_admin()) return false;
    wp_dequeue_style('wp-block-library');
}
add_action('wp_enqueue_scripts', 'dm_remove_wp_block_library_css');
// Вешаю фанкшин на хук
add_action('wp_footer', 'scripts');
function scripts() {
    // Использую функци ВП для прикреапленияскриптов в <footer>
    // Тишина в админке
    if (is_admin()) return false;
    // Убираю стандартный jquery
    wp_deregister_script('jquery');
    wp_deregister_script('wp-embed');
    // Подключаю запакованый JS
    wp_enqueue_script('bundle', get_template_directory_uri() . '/dist/bundle.js');
}
//На случай если скрипты в хедерд можно добавить defer
/*add_filter( 'clean_url', function( $url )
{
    if ( FALSE === strpos( $url, '.js' ) )
    {
        return $url;
    }
    return "$url' defer='defer";
}, 11, 1 );*/
//Убираю Эмоджи
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
//Создаю кастомное меню
function menu() {
    $cookie_country = base64_decode($_COOKIE["country"]);
    $str = strpos($cookie_country, ":");
    $country = substr($cookie_country, 0, $str);
    switch ($country) {
        case 'by':
            $menu_name = 'menu_by';
        break;
        default:
            $menu_name = 'menu_ua';
        break;
    }
    menu_construct($menu_name);
}
function menu_construct($menu_name) {
    echo '<nav class="menu-nav">
		<ul class="main-menu">';
    //Стандартные параметры массива меню на случай если нужно подправить
    $args = array(
        'nopaging' => true,
        'post_type' => 'nav_menu_item',
        'post_status' => 'publish',
        'order' => 'ASC',
        'orderby' => 'menu_order',
        'output' => ARRAY_A,
        'output_key' => 'menu_order',
        'update_post_term_cache' => false
    );
    //print_r(wp_get_nav_menu_items( 2, $args = array() ));
    //Начинаю перебирать массив с нужной версткой и вывожу тайт + линк
    foreach (wp_get_nav_menu_items($menu_name, $args = array()) as $value) {
        echo '<li><a href="' . $value->url . '">' . $value->title . '</a></li>';
    };
    echo '</ul>
	</nav>';
}
//Кастомный тип
add_action('init', 'register_post_types');
function register_post_types() {
    register_taxonomy('events', array(
        'object'
    ) , array(
        'label' => 'Типи подій',
        'labels' => array(
            'name' => 'Типи подій',
            'singular_name' => 'Типи подій',
            'search_items' => 'Шукати події',
            'all_items' => 'Усі події',
            'parent_item' => 'Батьківська рубрика події',
            'parent_item_colon' => 'Батьківська рубрика події:',
            'edit_item' => 'Редагувати рубрику події',
            'update_item' => 'Оновити рубрику події',
            'add_new_item' => 'Добобти рубрику події',
            'new_item_name' => 'Заголовок',
            'menu_name' => 'Типи подій',
        ) ,
        'description' => 'Рубрики для подій',
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => false,
        'hierarchical' => true,
        'rewrite' => array(
            'hierarchical' => true
        ) ,
        'show_admin_column' => true
    ));
    register_post_type('event', ['label' => null, 'labels' => ['name' => 'Події', 'singular_name' => 'Подія', 'add_new' => 'Додати подію', 'add_new_item' => 'Додавання події', 'edit_item' => 'Редагування події', 'new_item' => 'Новая подія', 'view_item' => 'Дивитися подію', 'search_items' => 'Шукати подію', 'not_found' => 'Не знайдено', 'not_found_in_trash' => 'Не знайдено у кошику', 'parent_item_colon' => '', 'menu_name' => 'Події', ], 'description' => '', 'public' => true,
    'show_in_menu' => null,
    'show_in_rest' => null, // добавить в REST API
    'rest_base' => null, 'menu_position' => null, 'menu_icon' => null,
    'hierarchical' => false, 'supports' => ['title', 'editor', 'thumbnail'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    'taxonomies' => array(
        'events'
    ) , 'has_archive' => false, 'rewrite' => true, 'query_var' => true, ]);
}
//Добавляю рубрику по умолчанию для кастомного типа записей
function default_terms_event($post_id, $post, $update) {
    if ('event' == $post->post_type) {
        $default_term = '6'; //ID рубрики
        $taxonomy = "events"; //Название таксономии, которую создал тут чуть выше
        wp_set_post_terms($post_id, $default_term, $taxonomy);
    }
}
add_action('save_post', 'default_terms_event', 30, 3);
//Обработчик для Ивентов
add_action('wp_ajax_load_events', 'load_events');
add_action('wp_ajax_nopriv_load_events', 'load_events');
function load_events() {
    // Создаю новый обьект WP_Query с нужными параметрами
    $posts = new WP_Query(array(
        'post_type' => 'event',
        'taxonomy' => 'events',
        'meta_key' => 'event_date',
        'post_status' => 'publish',
        'posts_per_page' => 2,
        'orderby' => 'meta_value',
        'order' => 'DESC',
        'post__not_in' => explode(',', $_POST['notin']) ,
        'paged' => get_query_var('paged') ? : $_POST['page'] // страница пагинации
        
    ));
    while ($posts->have_posts()):
        $posts->the_post(); ?>
		<div class="col-6 col-md anim" style="display: none">
			<div class="card-square">
				<div class="card-square-inner">
					<div class="card-square-date">
						<?php $date = strtotime(get_field("event_date")); ?>
						<span class="day">
							<?php echo date('d', $date); ?>
						</span>
						<span class="month">
							<?php
        //Склоняю дату встроеной функцией ВП, и убираю лишнии символы, необходимые для работы функции
        $predate = date_i18n('d F Y', $date);
        //Обрезаю все до первого пробела
        echo substr($predate, strpos($predate, ' '));
?>								
						</span>
					</div>
									<div class="card-square-title">
										<?php
        $categories = get_terms(array(
            'taxonomy' => 'events',
        ));
        //print_r($categories);
        foreach ($categories as $category) {
            echo '<span># ' . $category->name . '</span>';
        }
?>
										<h2>
											<a href="<?php echo get_post_permalink(); ?>" class="like-h3">
												<?php the_title(); ?>
											</a>
										</h2>
										<span><?php echo get_field("speaker"); ?></span>
									</div>
									
								</div>
							</div>
						</div>
				<?php
    endwhile;
    //Останавливаем чтобы не получать 0 в конце
    die();
}
//Склоняю даты встроенным способом, раньше писал массив для замены — теперь есть готовое, но с некоторыми особенностями, работает только с числом, от которого позже избавлюсь
add_filter('date_i18n', 'wp_maybe_decline_date');
//Основа для пагинации, разделил чтобы дважды ее не записывать для обработчика загрузки постов без перегазгрузки страницы
function pagination_build($currentpage, $wp_query) {
    $big = 999999999; // число для замены
    $links = paginate_links(array( // вывод пагинации с опциями ниже
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))) , // что заменяем в формате ниже
        'format' => '?paged=%#%', // формат, %#% будет заменено
        'current' => max($currentpage, get_query_var('paged')) , // текущая страница
        'type' => 'array', // нам надо получить массив
        'prev_text' => 'Назад', // текст
        'next_text' => 'Далі', // текст
        'total' => $wp_query->max_num_pages, // общие кол-во страниц в пагинации
        'show_all' => false, // не показывать ссылки на все страницы, иначе end_size и mid_size будут проигнорированны
        'end_size' => 2, //  сколько страниц показать в начале и конце списка
        'mid_size' => 1, // сколько страниц показать вокруг текущей страницы
        'add_args' => false, // массив GET параметров для добавления в ссылку страницы
        'add_fragment' => '', // строка для добавления в конец ссылки на страницу
        'before_page_number' => '', // строка перед цифрой
        'after_page_number' => ''
        // строка после цифры
        
    ));
    // если пагинация есть
    if (is_array($links)) {
        echo '<div class="pagination">';
        foreach ($links as $link) {
            echo str_replace("page-numbers", 'page-number', $link);
        }
        echo '</div>';
    }
}
//Пагинация для глобальной wp_query
function pagination() { // функция вывода пагинации
    global $wp_query; // текущая выборка должна быть глобальной
    pagination_build(1, $wp_query);
}
//Обработчик для Новостей
add_action('wp_ajax_load_news', 'load_news');
add_action('wp_ajax_nopriv_load_news', 'load_news');
function load_news() {
    //Получаю значение количества постов на странице в глобальном запросе, чтобы все продолжило корректно рабоать даже если в админке изменят количество выводимых записей
    global $wp_query;
    $posts_per_page = $wp_query->query_vars['posts_per_page'];
    // Создаю новый обьект WP_Query с нужными параметрами
    $posts = new WP_Query(array(
        'taxonomy' => $_POST['term_id'],
        'post_type' => $_POST['post_type'],
        'post_status' => 'publish',
        'posts_per_page' => $posts_per_page,
        'orderby' => 'date',
        'order' => 'DESC',
        'paged' => get_query_var('paged') ? : $_POST['page']
    ));
?> <div class="row news-amount"> 
		<?php while ($posts->have_posts()):
        $posts->the_post(); ?>
			<?php get_template_part('parts/post-loop'); ?>
		<?php
    endwhile;
?> </div> <?php
    pagination_build($_POST['page'], $posts);
    //Останавливаем чтобы не получать 0 в конце
    die();
}
//Так как в .htaccess установил RedirectMatch на category вношу исправления в разбивку на страницы #RedirectMatch 301 /category/(.*) /$1
function fix_category_pagination($query_string = array()) {
    if (isset($query_string['category_name']) && isset($query_string['name']) && $query_string['name'] === 'page' && isset($query_string['page'])) {
        $paged = trim($query_string['page'], '/');
        if (is_numeric($paged)) {
            unset($query_string['name']);
            unset($query_string['page']);
            $query_string['paged'] = ( int )$paged;
        }
    }
    return $query_string;
}
add_filter('request', 'fix_category_pagination');
function beforeload() {
    $cookie_country = base64_decode($_COOKIE["country"]);
    $str = strpos($cookie_country, ":");
    $country = substr($cookie_country, 0, $str);
    $date_expire = strtotime(substr($cookie_country, $str + 1));
    $date_current = strtotime(date("d-m-y"));
    if (isset($_COOKIE['country'])) {
        if (($date_expire > $date_current) && ($country == 'ru')) {
            global $wp_query;
            $wp_query->set_404();
            status_header(403);
            get_template_part('blocked');
            exit();
        }
    }
}
add_action('init', 'beforeload');
//Обработчик для Формы
add_action('wp_ajax_post_form', 'post_form');
add_action('wp_ajax_nopriv_post_form', 'post_form');
function post_form() {
    //Получаю нужный email
    $cookie_country = base64_decode($_COOKIE["country"]);
    $str = strpos($cookie_country, ":");
    $email_rule = substr($cookie_country, 0, $str);
    switch ($email_rule) {
        case by:
            $email = get_field('email_by', 'option');
        break;
        default:
            $email = get_field('email_ua', 'option');
        break;
    }
    //Мейлер буду использовать стандартный
    $to = $email;
    $subject = "Test header";
    $headers = 'Content-type: text/html; charset="utf-8"'."\r\n";
    $headers .= "From: TEST <test@test.com>\r\n";
    $message = $_POST['first_name'] . '<br />' . $_POST['second_name'] . '<br />' . $_POST['position'] . '<br />' . $_POST['web'] . '<br />' . $_POST['comment'];
    mail($to, $subject, $message, $headers);
    $my_postarr = array(
        'post_type' => 'contact_form',
        'post_title' => $_POST['first_name'] . ' ' . $_POST['second_name'],
        'post_status' => 'publish'
        // опубликованный пост
    );
    // добавляем пост и получаем его ID
    $my_post_id = wp_insert_post($my_postarr);
    add_post_meta($my_post_id, 'first_name', $_POST['first_name'], false);
    add_post_meta($my_post_id, 'second_name', $_POST['second_name'], false);
    add_post_meta($my_post_id, 'position', $_POST['position'], false);
    add_post_meta($my_post_id, 'web', $_POST['web'], false);
    add_post_meta($my_post_id, 'comment', $_POST['comment'], false);
    echo 'Відправлено успішно';
    die();
}
//Записи с контактами
add_action('init', 'register_contact_form');
function register_contact_form() {
    register_post_type('contact_form', ['label' => null, 'labels' => ['name' => 'Контактна форма', 'singular_name' => 'Контактна форма', 'add_new' => 'Додати контактні данні', 'add_new_item' => 'Додавання данних', 'edit_item' => 'Редагування данних', 'new_item' => 'Нові данні', 'view_item' => 'Дивитися данні', 'search_items' => 'Шукати данні', 'not_found' => 'Не знайдено', 'not_found_in_trash' => 'Не знайдено у кошику', 'parent_item_colon' => '', 'menu_name' => 'Заявки', ], 'description' => '', 'public' => true,
    // 'publicly_queryable'  => null,
    // 'exclude_from_search' => null,
    // 'show_ui'             => null,
    // 'show_in_nav_menus'   => null,
    'show_in_menu' => null,
    // 'show_in_admin_bar'   => null,
    'show_in_rest' => null, // добавить в REST API
    'rest_base' => null, 'menu_position' => null, 'menu_icon' => null,
    //'capability_type'   => 'post',
    //'capabilities'      => 'post',
    //'map_meta_cap'      => null,
    'hierarchical' => false, 'supports' => ['title', 'custom-fields'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    //Функционал категорий и меток
    //'taxonomies'          => array('events'),
    'has_archive' => false, 'rewrite' => true, 'query_var' => true, ]);
}
//Страница настроек
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(__('Email options'));
}
//Загрузка меню ajax
add_action('wp_ajax_load_menu', 'load_menu');
add_action('wp_ajax_nopriv_load_menu', 'load_menu');
function load_menu() {
    //Получаю значение количества постов на странице в глобальном запросе, чтобы все продолжило корректно рабоать даже если в админке изменят количество выводимых записей
    menu_construct('menu_by');
    die();
}