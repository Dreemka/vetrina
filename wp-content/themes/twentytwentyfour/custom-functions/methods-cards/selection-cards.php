<?php
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
?>