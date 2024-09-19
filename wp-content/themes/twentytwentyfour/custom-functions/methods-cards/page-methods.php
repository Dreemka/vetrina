<?php
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
      $output .= '<input type="submit" name="save_selection" value="Сохранить выбор">';
      $output .= '</form>';
      $output .= '</div>';

      return $output;
  }
  return ''; // Вернуть пустую строку, если пользователь не залогинен
}
add_shortcode('user_page_selection', 'custom_user_page_selection');
?>