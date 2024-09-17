<?php
/**
 * Twenty Twenty-Four functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Twenty Twenty-Four
 * @since Twenty Twenty-Four 1.0
 */

/**
 * Register block styles.
 */

if ( ! function_exists( 'twentytwentyfour_block_styles' ) ) :
	/**
	 * Register custom block styles
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_block_styles() {

		register_block_style(
			'core/details',
			array(
				'name'         => 'arrow-icon-details',
				'label'        => __( 'Arrow icon', 'twentytwentyfour' ),
				/*
				 * Styles for the custom Arrow icon style of the Details block
				 */
				'inline_style' => '
				.is-style-arrow-icon-details {
					padding-top: var(--wp--preset--spacing--10);
					padding-bottom: var(--wp--preset--spacing--10);
				}

				.is-style-arrow-icon-details summary {
					list-style-type: "\2193\00a0\00a0\00a0";
				}

				.is-style-arrow-icon-details[open]>summary {
					list-style-type: "\2192\00a0\00a0\00a0";
				}',
			)
		);
		register_block_style(
			'core/post-terms',
			array(
				'name'         => 'pill',
				'label'        => __( 'Pill', 'twentytwentyfour' ),
				/*
				 * Styles variation for post terms
				 * https://github.com/WordPress/gutenberg/issues/24956
				 */
				'inline_style' => '
				.is-style-pill a,
				.is-style-pill span:not([class], [data-rich-text-placeholder]) {
					display: inline-block;
					background-color: var(--wp--preset--color--base-2);
					padding: 0.375rem 0.875rem;
					border-radius: var(--wp--preset--spacing--20);
				}

				.is-style-pill a:hover {
					background-color: var(--wp--preset--color--contrast-3);
				}',
			)
		);
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'twentytwentyfour' ),
				/*
				 * Styles for the custom checkmark list block style
				 * https://github.com/WordPress/gutenberg/issues/51480
				 */
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
		register_block_style(
			'core/navigation-link',
			array(
				'name'         => 'arrow-link',
				'label'        => __( 'With arrow', 'twentytwentyfour' ),
				/*
				 * Styles for the custom arrow nav link block style
				 */
				'inline_style' => '
				.is-style-arrow-link .wp-block-navigation-item__label:after {
					content: "\2197";
					padding-inline-start: 0.25rem;
					vertical-align: middle;
					text-decoration: none;
					display: inline-block;
				}',
			)
		);
		register_block_style(
			'core/heading',
			array(
				'name'         => 'asterisk',
				'label'        => __( 'With asterisk', 'twentytwentyfour' ),
				'inline_style' => "
				.is-style-asterisk:before {
					content: '';
					width: 1.5rem;
					height: 3rem;
					background: var(--wp--preset--color--contrast-2, currentColor);
					clip-path: path('M11.93.684v8.039l5.633-5.633 1.216 1.23-5.66 5.66h8.04v1.737H13.2l5.701 5.701-1.23 1.23-5.742-5.742V21h-1.737v-8.094l-5.77 5.77-1.23-1.217 5.743-5.742H.842V9.98h8.162l-5.701-5.7 1.23-1.231 5.66 5.66V.684h1.737Z');
					display: block;
				}

				/* Hide the asterisk if the heading has no content, to avoid using empty headings to display the asterisk only, which is an A11Y issue */
				.is-style-asterisk:empty:before {
					content: none;
				}

				.is-style-asterisk:-moz-only-whitespace:before {
					content: none;
				}

				.is-style-asterisk.has-text-align-center:before {
					margin: 0 auto;
				}

				.is-style-asterisk.has-text-align-right:before {
					margin-left: auto;
				}

				.rtl .is-style-asterisk.has-text-align-left:before {
					margin-right: auto;
				}",
			)
		);
	}
endif;

add_action( 'init', 'twentytwentyfour_block_styles' );

/**
 * Enqueue block stylesheets.
 */

if ( ! function_exists( 'twentytwentyfour_block_stylesheets' ) ) :
	/**
	 * Enqueue custom block stylesheets
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_block_stylesheets() {
		/**
		 * The wp_enqueue_block_style() function allows us to enqueue a stylesheet
		 * for a specific block. These will only get loaded when the block is rendered
		 * (both in the editor and on the front end), improving performance
		 * and reducing the amount of data requested by visitors.
		 *
		 * See https://make.wordpress.org/core/2021/12/15/using-multiple-stylesheets-per-block/ for more info.
		 */
		wp_enqueue_block_style(
			'core/button',
			array(
				'handle' => 'twentytwentyfour-button-style-outline',
				'src'    => get_parent_theme_file_uri( 'assets/css/button-outline.css' ),
				'ver'    => wp_get_theme( get_template() )->get( 'Version' ),
				'path'   => get_parent_theme_file_path( 'assets/css/button-outline.css' ),
			)
		);
	}
endif;

add_action( 'init', 'twentytwentyfour_block_stylesheets' );

/**
 * Register pattern categories.
 */

if ( ! function_exists( 'twentytwentyfour_pattern_categories' ) ) :
	/**
	 * Register pattern categories
	 *
	 * @since Twenty Twenty-Four 1.0
	 * @return void
	 */
	function twentytwentyfour_pattern_categories() {

		register_block_pattern_category(
			'twentytwentyfour_page',
			array(
				'label'       => _x( 'Pages', 'Block pattern category', 'twentytwentyfour' ),
				'description' => __( 'A collection of full page layouts.', 'twentytwentyfour' ),
			)
		);
	}
endif;

// Кастомное Меню
function wpb_custom_new_menu() {
  register_nav_menus(
    array(
      'left-menu-tools' => __( 'Tools' ),
      'left-menu-library' => __( 'Library' ),
      'left-menu-settings' => __( 'Settings' ),
    )
  );
}
add_action( 'init', 'wpb_custom_new_menu' );


function add_material_design() {
	?>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
	<script type="importmap">
			{
					"imports": {
							"@material/web/": "https://esm.run/@material/web/"
					}
			}
	</script>
	<script type="module">
			import '@material/web/all.js';
			import {styles as typescaleStyles} from '@material/web/typography/md-typescale-styles.js';

			document.adoptedStyleSheets.push(typescaleStyles.styleSheet);
	</script>
	<?php
}
add_action('wp_head', 'add_material_design');



// Подключаем стиль для левого блока меню

function my_theme_enqueue_styles() {
	// Подключаем файл стилей для блока left-menu
	wp_enqueue_style(
			'left-menu-style', // Уникальный идентификатор для стиля
			get_theme_file_uri( 'assets/css/left-menu.css' ), // URL к файлу стилей
			array(), // Зависимости (если есть)
			wp_get_theme()->get( 'Version' ) // Версия темы
	);
	// Подключаем файл стилей для карточек методов
	wp_enqueue_style(
		'method-card-style', // Уникальный идентификатор для нового стиля
		get_theme_file_uri( 'assets/css/method-card.css' ), // URL к файлу стилей
		array(), // Зависимости (если есть)
		wp_get_theme()->get( 'Version' ) // Версия темы
);
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

//Кастомные переменные
function my_custom_styles() {
	?>
	<style>
			:root {
					--methodix-border-radius: <?php echo get_option('my_methodix_border_radius', '0.75rem'); ?>;
					--methodix-main-color: <?php echo get_option('my_methodix-main-color', '0, 45, 116'); ?>;
					--methodix-padding: <?php echo get_option('my_methodix_padding', '0.75rem'); ?>;
					--secondary-color: <?php echo get_option('my_secondary_color', '#2ecc71'); ?>;
			}
	</style>
	<?php
}
add_action('wp_head', 'my_custom_styles');


function custom_user_page_selection() {
	if (is_user_logged_in()) {
			$current_user = wp_get_current_user();
			$selected_pages = get_user_meta($current_user->ID, 'selected_pages', true);

			// Получаем начальное значение поискового запроса из URL
			$search_query = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';

			$output = '<form id="search-form" method="get" action="">';
			$output .= '<input type="text" id="search-input" name="search" value="' . esc_attr($search_query) . '" placeholder="Search pages...">';
			$output .= '<input type="submit" value="Search">';
			$output .= '</form>';

			$output .= '<div id="search-results">';
			$output .= '<form method="post" action="' . esc_url(admin_url('admin-post.php')) . '">';
			$output .= '<input type="hidden" name="action" value="save_user_page_selection">';
			$output .= '<div class="methodix-method-cards-wrapper">';

			// Здесь будет выводиться результат поиска через AJAX
			$output .= '</div>';
			$output .= '<input type="submit" name="save_selection" value="Сохранить выбор">';
			$output .= '</form>';
			$output .= '</div>';

			return $output;
	}
	return ''; // Вернуть пустую строку, если пользователь не залогинен
}
add_shortcode('user_page_selection', 'custom_user_page_selection');

function save_user_page_selection() {
	// Проверяем, была ли отправлена форма
	if (isset($_POST['save_selection'])) {
			$current_user = wp_get_current_user();
			
			// Проверяем, что пользователь залогинен
			if ($current_user->ID) {
					$selected_pages = isset($_POST['selected_pages']) ? $_POST['selected_pages'] : [];
					
					// Сохраняем выбранные страницы в метаданные пользователя
					update_user_meta($current_user->ID, 'selected_pages', $selected_pages);
			}
	}
	
	// Перенаправляем пользователя обратно на ту же страницу после сохранения
	wp_redirect($_SERVER['HTTP_REFERER']);
	exit;
}
add_action('admin_post_nopriv_save_user_page_selection', 'save_user_page_selection');
add_action('admin_post_save_user_page_selection', 'save_user_page_selection');

function custom_user_page_selection_scripts() {
	if (is_user_logged_in()) {
			wp_enqueue_script('custom-user-page-selection', get_template_directory_uri() . '/js/custom-user-page-selection.js', array('jquery'), null, true);
			wp_localize_script('custom-user-page-selection', 'ajax_object', array(
					'ajax_url' => admin_url('admin-ajax.php'),
					'nonce' => wp_create_nonce('custom_user_page_selection_nonce')
			));
	}
}
add_action('wp_enqueue_scripts', 'custom_user_page_selection_scripts');

function custom_user_page_search() {
	check_ajax_referer('custom_user_page_selection_nonce', 'nonce');

	$search_query = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';

	$args = array(
			'post_type' => 'methodix',
			'posts_per_page' => -1,
			's' => $search_query,
	);

	$pages = get_posts($args);

	if (!empty($pages)) {
			foreach ($pages as $page) {
					$checked = in_array($page->ID, (array)get_user_meta(get_current_user_id(), 'selected_pages', true)) ? 'checked' : '';
					$plus_value = get_field('plus', $page->ID);
					$plus_field = get_field_object('plus', $page->ID);
					$minus_value = get_field('minus', $page->ID);
					$minus_field = get_field_object('minus', $page->ID);
					$expenses_value = get_field('expenses', $page->ID);
					$expenses_field = get_field_object('expenses', $page->ID);
					$description_value = get_field('description', $page->ID);
					$icon_method_value = get_field('method-icon', $page->ID);
					$type_model_value = get_field('type_model', $page->ID);

					echo '<div class="methodix-method-card">';
					echo '<div class="methodix-method-card-header methodix-display-flex-row align-items-center">';
					echo '<input type="checkbox" class="display-none" name="selected_pages[]" value="' . $page->ID . '" ' . $checked . '> <img src="'. $icon_method_value .'">';
					echo '<div class="methodix-method-card-title-type">';
					echo '<div class="methodix-method-card-title">';
					echo esc_html($page->post_title);
					echo '</div>';
					echo '<div class="methodix-method-card-type">';
					echo esc_html($type_model_value);
					echo '</div>';
					echo '</div>';
					echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="methodix-menu-card-icon" viewBox="0 0 24 24" fill="none">
					<path d="M12 20C11.45 20 10.9792 19.8042 10.5875 19.4125C10.1958 19.0208 10 18.55 10 18C10 17.45 10.1958 16.9792 10.5875 16.5875C10.9792 16.1958 11.45 16 12 16C12.55 16 13.0208 16.1958 13.4125 16.5875C13.8042 16.9792 14 17.45 14 18C14 18.55 13.8042 19.0208 13.4125 19.4125C13.0208 19.8042 12.55 20 12 20ZM12 14C11.45 14 10.9792 13.8042 10.5875 13.4125C10.1958 13.0208 10 12.55 10 12C10 11.45 10.1958 10.9792 10.5875 10.5875C10.9792 10.1958 11.45 10 12 10C12.55 10 13.0208 10.1958 13.4125 10.5875C13.8042 10.9792 14 11.45 14 12C14 12.55 13.8042 13.0208 13.4125 13.4125C13.0208 13.8042 12.55 14 12 14ZM12 8C11.45 8 10.9792 7.80417 10.5875 7.4125C10.1958 7.02083 10 6.55 10 6C10 5.45 10.1958 4.97917 10.5875 4.5875C10.9792 4.19583 11.45 4 12 4C12.55 4 13.0208 4.19583 13.4125 4.5875C13.8042 4.97917 14 5.45 14 6C14 6.55 13.8042 7.02083 13.4125 7.4125C13.0208 7.80417 12.55 8 12 8Z" fill="#1F1F1F"/>
					</svg>';
					echo '</div>';

					echo '<div class="methodix-method-card-description">'.$description_value.'</div>';

					echo '<div class="methodix-display-flex-column methodix-mb-1">';

					echo '<div class="methodix-display-flex-row">';

					echo '<div class="methodix-method-card-chips-name">';
					if ($plus_field) {
							$plus_label = $plus_field['label']; // Название поля
							echo esc_html($plus_label);
					}
					echo '</div>';

					if (is_array($plus_value) && !empty($plus_value)) {
							echo '<div class="methodix-chips-group methodix-plus-value">';
							foreach ($plus_value as $value) {
									echo '<div class="methodix-chip">' . esc_html($value) . '</div>'; // Выводим каждое значение
							}
							echo '</div>';
					}
					echo '</div>';


					echo '<div class="methodix-display-flex-row">';

					echo '<div class="methodix-method-card-chips-name">';
					if ($minus_field) {
							$minus_label = $minus_field['label']; // Название поля
							echo esc_html($minus_label);
					}
					echo '</div>';
					if (is_array($minus_value) && !empty($minus_value)) {
							echo '<div class="methodix-chips-group methodix-minus-value">';
							foreach ($minus_value as $value) {
									echo '<div class="methodix-chip">' . esc_html($value) . '</div>'; // Выводим каждое значение
							}
							echo '</div>';
					}
					echo '</div>';

					echo '<div class="methodix-display-flex-row">';
					echo '<div class="methodix-method-card-chips-name">';
					if ($expenses_field) {
							$expenses_label = $expenses_field['label']; // Название поля
							echo esc_html($expenses_label);
					}
					echo '</div>';
					if (!empty($expenses_value)) {
							echo '<div class="methodix-chips-group"><div class="methodix-chip methodix-expenses-value">' . esc_html($expenses_value) . '</div></div>';
					}
					echo '</div>';
					echo '</div>';
					echo '<hr>';
					echo '<div class="methodix-method-card-footer methodix-display-flex-row-end">';
					echo '<div class="methodix-suggestion-chip">
							<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
									<g clip-path="url(#clip0_566_2771)">
									<path d="M15.75 1.5H2.25C1.0095 1.5 0 2.5095 0 3.75V16.5H18V3.75C18 2.5095 16.9905 1.5 15.75 1.5ZM16.5 3.75V8.25H5.25V3H15.75C16.164 3 16.5 3.336 16.5 3.75ZM1.5 3.75C1.5 3.336 1.836 3 2.25 3H3.75V15H1.5V3.75ZM5.25 15V9.75H16.5V15H5.25Z" fill="#002D74"/>
									</g>
									<defs>
									<clipPath id="clip0_566_2771">
									<rect width="18" height="18" fill="white"/>
									</clipPath>
									</defs>
							</svg>
							Сравнить
					</div>';
					echo '<div class="wp-block-button">
							<a class="wp-block-button__link wp-element-button" href="' . get_page_link( $page->ID ) . '">
							<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
									<g clip-path="url(#clip0_566_2776)">
									<path d="M18 1.5V7.5H16.5V2.5605L6.90525 12.1553L5.84475 11.0948L15.4395 1.5H10.5V0H16.5C17.3272 0 18 0.67275 18 1.5ZM13.5 16.5H1.5V5.25C1.5 4.83675 1.83675 4.5 2.25 4.5H10.3177L11.8177 3H2.25C1.0095 3 0 4.0095 0 5.25V18H15V6.18225L13.5 7.68225V16.5Z" fill="white"/>
									</g>
									<defs>
									<clipPath id="clip0_566_2776">
									<rect width="18" height="18" fill="white"/>
									</clipPath>
									</defs>
							</svg>
							Открыть
							</a>
					</div>';
					echo '</div>';
					echo '</div>';
			}
	} else {
			echo 'No pages found.';
	}

	wp_die();
}
add_action('wp_ajax_custom_user_page_search', 'custom_user_page_search');
add_action('wp_ajax_nopriv_custom_user_page_search', 'custom_user_page_search');

function display_user_selected_pages() {
	if (is_user_logged_in()) {
			$current_user = wp_get_current_user();
			$selected_pages = get_user_meta($current_user->ID, 'selected_pages', true);
			
			$output = '';
			if ($selected_pages) {
					$output .= '<div class="methodix-method-cards-wrapper">';
					foreach ($selected_pages as $page_id) {
							$description_value = get_field('description', $page_id);

							$output .= '<div class="methodix-method-card">';
							$output .= '<div class="methodix-method-card-header methodix-display-flex-row align-items-center">';
							$output .= '<a href="' . get_permalink($page_id) . '">' . esc_html(get_the_title($page_id)) . '</a>';
							$output .= '</div>';
							$output .='<div class="methodix-method-card-description">'.$description_value.'</div>';

							$output .= '<div class="methodix-method-card-footer methodix-display-flex-row-end">';
							$output .= '<div class="wp-block-button">
								<a class="wp-block-button__link wp-element-button" href="' . get_permalink($page_id) . '">
								<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
									<g clip-path="url(#clip0_566_2776)">
									<path d="M18 1.5V7.5H16.5V2.5605L6.90525 12.1553L5.84475 11.0948L15.4395 1.5H10.5V0H16.5C17.3272 0 18 0.67275 18 1.5ZM13.5 16.5H1.5V5.25C1.5 4.83675 1.83675 4.5 2.25 4.5H10.3177L11.8177 3H2.25C1.0095 3 0 4.0095 0 5.25V18H15V6.18225L13.5 7.68225V16.5Z" fill="white"/>
									</g>
									<defs>
									<clipPath id="clip0_566_2776">
									<rect width="18" height="18" fill="white"/>
									</clipPath>
									</defs>
								</svg>
								Открыть
								</a>
							</div>';
							$output .= '</div>';
							$output .= '</div>';
					}
					$output .= '</div>';
			}
			return $output;
	}
	return ''; // Вернуть пустую строку, если пользователь не залогинен
}
add_shortcode('user_selected_pages', 'display_user_selected_pages');




//Подключение выбора иконок для меню
add_action( 'wp_nav_menu_item_custom_fields', 'true_menu_field', 10, 5 );

function true_menu_field( $item_id, $item, $depth, $args, $id ) {
    // Получаем URL иконки для данного элемента меню
    $icon_url = get_post_meta( $item_id, '_menu_icon', true );

    echo '<p class="description">';
    echo '<label for="menu-item-icon-' . $item_id . '">Выберите SVG иконку:</label>';
    echo '<input type="text" name="menu-item-icon[' . $item_id . ']" id="menu-item-icon-' . $item_id . '" value="' . esc_attr( $icon_url ) . '" style="width: 70%;" />';
    echo '<button class="button select-icon-button" data-item-id="' . $item_id . '">Выбрать иконку</button>';
    echo '</p>';
}

// Сохранение выбранной иконки
add_action( 'wp_update_nav_menu_item', 'save_menu_item_icon', 10, 2 );

function save_menu_item_icon( $menu_id, $menu_item_db_id ) {
    if ( isset( $_POST['menu-item-icon'][$menu_item_db_id] ) ) {
        $icon = esc_url_raw( $_POST['menu-item-icon'][$menu_item_db_id] );
        update_post_meta( $menu_item_db_id, '_menu_icon', $icon );
    } else {
        delete_post_meta( $menu_item_db_id, '_menu_icon' );
    }
}

// Функция для отображения иконок в меню
add_filter( 'walker_nav_menu_start_el', 'add_icon_to_menu_item', 10, 4 );

function add_icon_to_menu_item( $item_output, $item, $depth, $args ) {
    $icon_url = get_post_meta( $item->ID, '_menu_icon', true );
		$item_output = $args->before;
		$item_output .= '<a href="' . $item->url .'">';
		$item_output .= '<button class="vetrina-button vetrina-menu-button w-100">';
		if ( $icon_url && strpos( $icon_url, 'http' ) === 0 ) {
			$item_output .= '<img src="' . esc_url( $icon_url ) . '" class="vetrina-menu-icon">';
		};
		$item_output .= $args->link_before . $item->title . $args->link_after;
		$item_output .= '</button>';
		$item_output .= '</a>';
		$item_output .= $args->after;
    return $item_output;
}

// Подключаем скрипт для работы с медиабиблиотекой
add_action('admin_footer', 'enqueue_media_uploader_script');

function enqueue_media_uploader_script() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('.select-icon-button').on('click', function(e) {
                e.preventDefault();
                
                var button = $(this);
                var itemId = button.data('item-id');
                var file_frame;

                // Если медиа-рамка уже была создана, открыть её
                if (file_frame) {
                    file_frame.open();
                    return;
                }

                // Создаем новую медиа-рамку
                file_frame = wp.media({
                    title: 'Выберите иконку',
                    button: {
                        text: 'Выбрать иконку'
                    },
                    multiple: false // Можно выбирать только одно изображение
                });

                // Когда изображение выбрано, обновляем поле
                file_frame.on('select', function() {
                    var attachment = file_frame.state().get('selection').first().toJSON();
                    $('#menu-item-icon-' + itemId).val(attachment.url);
                });

                // Открываем медиа-рамку
                file_frame.open();
            });
        });
    </script>
    <?php
}