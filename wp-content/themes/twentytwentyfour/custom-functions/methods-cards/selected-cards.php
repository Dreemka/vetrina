<?php
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