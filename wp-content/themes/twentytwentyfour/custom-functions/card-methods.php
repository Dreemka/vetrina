<?php
//Шорткод вывода карточек методов и поиска
function custom_user_page_selection() {
  if (is_user_logged_in()) {
      $current_user = wp_get_current_user();
      $selected_pages = get_user_meta($current_user->ID, 'selected_pages', true);

      // Получаем начальное значение поискового запроса из URL
      $search_query = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';

      $output = '<form id="methodix-search-form" class="mr-b-20" method="get" action="">';
      $output .= '<input type="text" id="methodix-search-input" name="search" value="' . esc_attr($search_query) . '" placeholder="Метод или методика">';
      $output .= '<input type="submit" class="display-none" value="Search">';
      $output .= '<svg xmlns="http://www.w3.org/2000/svg" class="methodix-cards-search-icon" width="24" height="24" viewBox="0 0 24 24" fill="none">
      <path d="M24 22.5858L17.738 16.3238C19.3646 14.3344 20.1644 11.7959 19.9719 9.23334C19.7793 6.67081 18.6092 4.28031 16.7036 2.5563C14.798 0.832292 12.3026 -0.0933258 9.73367 -0.029094C7.16472 0.0351378 4.71873 1.08431 2.90164 2.9014C1.08455 4.71848 0.035382 7.16447 -0.0288498 9.73342C-0.0930816 12.3024 0.832537 14.7977 2.55655 16.7034C4.28056 18.609 6.67106 19.7791 9.23359 19.9716C11.7961 20.1642 14.3346 19.3644 16.324 17.7378L22.586 23.9998L24 22.5858ZM10 17.9998C8.41778 17.9998 6.87106 17.5306 5.55546 16.6515C4.23987 15.7725 3.21449 14.5231 2.60899 13.0612C2.00349 11.5994 1.84506 9.99091 2.15374 8.43906C2.46243 6.88721 3.22435 5.46175 4.34317 4.34293C5.46199 3.22411 6.88746 2.46218 8.4393 2.1535C9.99115 1.84482 11.5997 2.00324 13.0615 2.60875C14.5233 3.21425 15.7727 4.23963 16.6518 5.55522C17.5308 6.87081 18 8.41753 18 9.99978C17.9976 12.1208 17.154 14.1542 15.6542 15.654C14.1545 17.1538 12.121 17.9974 10 17.9998Z" fill="#002D74"/>
      </svg>';
      $output .= '</form>';

      // Вставляем фильтры
      $output .= render_filters();

      // Добавляем элемент лоадера
      $output .= '<div id="loader" style="display: none;">Загрузка...</div>';

      $output .= '<div id="search-results">';
      $output .= '<form method="post" action="' . esc_url(admin_url('admin-post.php')) . '">';
      $output .= '<input type="hidden" name="action" value="save_user_page_selection">';
      $output .= '<div class="methodix-method-cards-wrapper">';

      // Здесь будет выводиться результат поиска через AJAX
      $output .= '</div>';
      // $output .= '<input type="submit" name="save_selection" value="Сохранить выбор">';
      $output .= '</form>';
      $output .= '</div>';

      return $output;
  }
  return ''; // Вернуть пустую строку, если пользователь не залогинен
}
add_shortcode('user_page_selection', 'custom_user_page_selection');

//Функция выводит фильтра
function render_filters() {
  $minus_values = get_field_object('minus' , 218);
  $plus_values = get_field_object('plus' , 218);
  $expenses_values = get_field_object('expenses' , 218);
  $fields = array($minus_values, $plus_values, $expenses_values);

  $output = '<div class="methodix-filters mr-b-20 methodix-display-flex-row">';
  function render_select_filter($field , &$output) {
    if (is_array($field)) {
        $output .= '<div class="methodix-select">';
        $output .= '<select id="methodix-filter-'.$field["name"].'" name="methodix-filter-'.$field["name"].'">';
        $output .= '<option disabled selected hidden>'.$field["label"].'</option>';
        $output .= '<option value="" >Все '.$field["label"].'</option>';
        foreach ($field['choices'] as $key => $value) {
            $output .= '<option value="'.$key.'">'.$value.'</option>';
        }
        $output .= '</select>';
        $output .= '</div>';
    } else {
        echo 'Полученные данные не являются массивом.';
    }
  }
  foreach ($fields as $field) {
    if (is_array($field)) {
      render_select_filter($field , $output);
    }
  }
  $output .= '</div>';
  return $output;
}

//Функция сохранения выделенных карточек методов
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

//Подключаем JS скрипт для управления карточками методов 
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

//функция которая строит карточку метода
function custom_user_page_search() {
  check_ajax_referer('custom_user_page_selection_nonce', 'nonce');

  $search_query = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
  $filters = isset($_POST['filters']) ? $_POST['filters'] : array();
  $args = array(
      'post_type' => 'methodix',
      'posts_per_page' => -1,
  );

  if (!empty($search_query)) {
      $args['s'] = $search_query;
  }

  // Применяем фильтры
  $meta_query = array('relation' => 'AND');

  // Применяем фильтры
  foreach ($filters as $filter => $value) {
    if (!empty($filters[$filter])) {
        $meta_query[] = array(
            array(
                'key' => $filter,
                'value' => sanitize_text_field($filters[$filter]),
                'compare' => 'LIKE'
            )
        );
    }
  }

  if (!empty($meta_query)) {
      $args['meta_query'] = $meta_query;
  }


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
                  <clipPath id="clip0_566_2771)">
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
                  <clipPath id="clip0_566_2776)">
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

//Шорткод который выводит сохраненные карточки методов пользователя
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
?>