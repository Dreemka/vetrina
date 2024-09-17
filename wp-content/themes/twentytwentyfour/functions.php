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

			$args = array(
					'post_type' => 'methodix', // Название вашего кастомного типа записи
					'posts_per_page' => -1, // Получить все записи
			);

			$pages = get_posts($args);
			$output = '<form method="post" action="' . esc_url(admin_url('admin-post.php')) . '">';
			$output .= '<input type="hidden" name="action" value="save_user_page_selection">';

			$output .= '<div class="methodix-method-cards-wrapper">';
			
			foreach ($pages as $page) {
					$checked = in_array($page->ID, (array)$selected_pages) ? 'checked' : '';
					$plus_value = get_field('plus', $page->ID);
					$plus_field = get_field_object('plus', $page->ID);
					$minus_value = get_field('minus', $page->ID);
					$minus_field = get_field_object('minus', $page->ID);
					$expenses_value = get_field('expenses', $page->ID);
					$expenses_field = get_field_object('expenses', $page->ID);
					$description_value = get_field('description', $page->ID);
					$icon_method_value = get_field('method-icon', $page->ID);
					$type_model_value = get_field('type_model', $page->ID);

					$output .= '<div class="methodix-method-card">';
					$output .= '<div class="methodix-method-card-header methodix-display-flex-row align-items-center">';
					$output .= '<input type="checkbox" class="display-none" name="selected_pages[]" value="' . $page->ID . '" ' . $checked . '> <img src="'. $icon_method_value .'">';
					$output .= '<div class="methodix-method-card-title-type">';
					$output .= '<div class="methodix-method-card-title">';
					$output .= esc_html($page->post_title);
					$output .= '</div>';
					$output .= '<div class="methodix-method-card-type">';
					$output .= esc_html($type_model_value);
					$output .= '</div>';
					$output .= '</div>';
					$output .= '</div>';

					$output .='<div class="methodix-method-card-description">'.$description_value.'</div>';

					$output .='<div class="methodix-display-flex-column">';

					$output .='<div class="methodix-display-flex-row">';

					$output .='<div class="methodix-method-card-chips-name">';
					if ($plus_field) {
							$plus_label = $plus_field['label']; // Название поля
							$output .= esc_html($plus_label);
					}
					$output .='</div>';

					if (is_array($plus_value) && !empty($plus_value)) {
						$output .= '<div class="methodix-chips-group methodix-plus-value">';
						foreach ($plus_value as $value) {
								$output .= '<div class="methodix-chip">' . esc_html($value) . '</div>'; // Выводим каждое значение
						}
						$output .= '</div>';
					}
					$output .='</div>';


					$output .='<div class="methodix-display-flex-row">';

					$output .='<div class="methodix-method-card-chips-name">';
					if ($minus_field) {
							$minus_label = $minus_field['label']; // Название поля
							$output .= esc_html($minus_label);
					}
					$output .='</div>';
					if (is_array($minus_value) && !empty($minus_value)) {
						$output .= '<div class="methodix-chips-group methodix-minus-value">';
						foreach ($minus_value as $value) {
								$output .= '<div class="methodix-chip">' . esc_html($value) . '</div>'; // Выводим каждое значение
						}
						$output .= '</div>';
					}
					$output .='</div>';

					$output .='<div class="methodix-display-flex-row">';
					$output .='<div class="methodix-method-card-chips-name">';
					if ($expenses_field) {
							$expenses_label = $expenses_field['label']; // Название поля
							$output .= esc_html($expenses_label);
					}
					$output .='</div>';
					if (!empty($expenses_value)) {
						$output .= '<div class="methodix-chips-group"><div class="methodix-chip methodix-expenses-value">' . esc_html($expenses_value) . '</div></div>';
					}
					$output .='</div>';
					$output .= '</div>';
					$output .= '<hr>';
					$output .= '<div class="methodix-method-card-footer methodix-display-flex-row">';
					$output .= '<md-suggestion-chip class="methodix-suggestion-chip">Сравнить</md-suggestion-chip>';
					$output .= '<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Открыть</a></div>';
					$output .= '</div>';
					$output .= '</div>';
			}
			$output .= '</div>';
			$output .= '<input type="submit" name="save_selection" value="Сохранить выбор">';
			$output .= '</form>';

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

function display_user_selected_pages() {
	if (is_user_logged_in()) {
			$current_user = wp_get_current_user();
			$selected_pages = get_user_meta($current_user->ID, 'selected_pages', true);
			
			$output = '';
			if ($selected_pages) {
					foreach ($selected_pages as $page_id) {
							$output .= '<a href="' . get_permalink($page_id) . '">' . esc_html(get_the_title($page_id)) . '</a><br>';

							$plus_value = get_field('plus', $page_id);
							$minus_value = get_field('minus', $page_id);
							$expenses_value = get_field('expenses', $page_id);
							$description_value = get_field('description', $page_id);
							
							$output .='<p>'.$description_value.'</p>';
							
							if (is_array($plus_value) && !empty($plus_value)) {
								$output .= '<div class="metodix-plus-value">';
								foreach ($plus_value as $value) {
										$output .= '<div>' . esc_html($value) . '</div>'; // Выводим каждое значение
								}
								$output .= '</div>';
							}

							if (is_array($minus_value) && !empty($minus_value)) {
								$output .= '<div class="metodix-minus-value">';
								foreach ($minus_value as $value) {
										$output .= '<div>' . esc_html($value) . '</div>'; // Выводим каждое значение
								}
								$output .= '</div>';
							}

							if (is_array($expenses_value) && !empty($expenses_value)) {
								$output .= '<div class="metodix-expenses-value">';
								foreach ($expenses_value as $value) {
										$output .= '<div>' . esc_html($value) . '</div>'; // Выводим каждое значение
								}
								$output .= '</div>';
							}


					}
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