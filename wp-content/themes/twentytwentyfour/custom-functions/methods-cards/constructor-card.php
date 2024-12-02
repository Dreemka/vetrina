<?php
function custom_user_page_search() {
  check_ajax_referer('custom_user_page_selection_nonce', 'nonce');

  $search_query = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
  $filters = isset($_POST['filters']) ? stripslashes($_POST['filters']) : [];
  $filters_arr = json_decode($filters, true);
  
  $args = array(
      'post_type' => 'methodix',
      'posts_per_page' => -1,
  );

  if (!empty($search_query)) {
      $args['s'] = $search_query;
  }

  // Применяем фильтры
  $meta_query = array('relation' => 'OR');

  // Применяем фильтры
  foreach ($filters_arr as $filter => $value) {
    if (!empty($filters_arr[$filter])) {
        if (is_array($value)) {
            // Если значение является массивом, создаем подмассив для каждого элемента
            foreach ($value as $val) {
                $meta_query[] = array(
                    'key' => $filter,
                    'value' => $val,
                    'compare' => 'LIKE'
                );
            }
        } else {
            // Если значение не является массивом, добавляем его как обычно
            $meta_query[] = array(
                'key' => $filter,
                'value' => $value,
                'compare' => 'LIKE'
            );
        }
    }
}

  if (!empty($meta_query)) {
      $args['meta_query'] = $meta_query;
  }
  $pages = get_posts($args);
  if (!empty($pages)) {
      foreach ($pages as $page) {
          $checked = in_array($page->ID, (array)get_user_meta(get_current_user_id(), 'selected_pages', true)) ? 'checked' : '';
          $plus_value = get_field('group-filters_plus', $page->ID);
          $plus_field = get_field_object('group-filters_plus', $page->ID);
          $minus_value = get_field('group-filters_minus', $page->ID);
          $minus_field = get_field_object('group-filters_minus', $page->ID);
          $expenses_value = get_field('group-filters_expenses', $page->ID);
          $expenses_field = get_field_object('group-filters_expenses', $page->ID);
          $description_value = get_field('description', $page->ID);
          $icon_method_value = get_field('method-icon', $page->ID);
          $type_model_value = get_field('group-filters_type_model', $page->ID);

          echo '<div class="methodix-method-card">';
          echo '<div class="methodix-method-card-header methodix-display-flex-row align-items-center">';
          echo '<img src="'. $icon_method_value .'">';
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
          echo '<input type="checkbox" class="display-none  methodix-hidden-checkbox" name="selected_pages[]" id="'.$page->ID.'" value="' . $page->ID . '" ' . $checked . '>';
          echo '<label for="'.$page->ID.'" id="MethodixclickableLabel" class="methodix-label methodix-suggestion-chip methodix-chip-icon">';
          echo '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
            <path d="M13.125 0.687988C12.2805 0.701124 11.4544 0.936878 10.7301 1.37144C10.0058 1.80601 9.40905 2.42399 9.00003 3.16299C8.59101 2.42399 7.99423 1.80601 7.26996 1.37144C6.54569 0.936878 5.71957 0.701124 4.87503 0.687988C3.52874 0.746481 2.26031 1.33543 1.34687 2.32616C0.433424 3.3169 -0.0507831 4.62888 2.97532e-05 5.97549C2.97532e-05 11.0567 8.21703 16.9255 8.56653 17.1745L9.00003 17.4812L9.43353 17.1745C9.78303 16.927 18 11.0567 18 5.97549C18.0508 4.62888 17.5666 3.3169 16.6532 2.32616C15.7398 1.33543 14.4713 0.746481 13.125 0.687988ZM9.00003 15.6347C6.56028 13.8122 1.50003 9.33474 1.50003 5.97549C1.44876 5.02653 1.7748 4.09579 2.40705 3.38626C3.0393 2.67674 3.92646 2.246 4.87503 2.18799C5.8236 2.246 6.71076 2.67674 7.34301 3.38626C7.97526 4.09579 8.3013 5.02653 8.25003 5.97549H9.75003C9.69876 5.02653 10.0248 4.09579 10.6571 3.38626C11.2893 2.67674 12.1765 2.246 13.125 2.18799C14.0736 2.246 14.9608 2.67674 15.593 3.38626C16.2253 4.09579 16.5513 5.02653 16.5 5.97549C16.5 9.33624 11.4398 13.8122 9.00003 15.6347Z" />
            </svg>';
          echo '</label>';
          echo '<div class="methodix-suggestion-chip methodix-comparison-chip" onclick="handleCardComparisonChoiseClick(event , '.$page->ID.')">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                  <g clip-path="url(#clip0_566_2771)">
                  <path d="M15.75 1.5H2.25C1.0095 1.5 0 2.5095 0 3.75V16.5H18V3.75C18 2.5095 16.9905 1.5 15.75 1.5ZM16.5 3.75V8.25H5.25V3H15.75C16.164 3 16.5 3.336 16.5 3.75ZM1.5 3.75C1.5 3.336 1.836 3 2.25 3H3.75V15H1.5V3.75ZM5.25 15V9.75H16.5V15H5.25Z"/>
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
              <a class="wp-block-button__link wp-element-button" onclick="handleCardOpenClick(event , '.$page->ID.')">
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
?>