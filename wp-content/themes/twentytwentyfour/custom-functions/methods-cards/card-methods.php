<?php
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


//Шорткод вывода карточек методов и поиска
if (file_exists(get_template_directory() . '/custom-functions/methods-cards/page-methods.php')) {
	require_once get_template_directory() . '/custom-functions/methods-cards/page-methods.php';
}

//Функция выводит фильтра
if (file_exists(get_template_directory() . '/custom-functions/methods-cards/render-filters.php')) {
	require_once get_template_directory() . '/custom-functions/methods-cards/render-filters.php';
}

//Функция сохранения выделенных карточек методов
if (file_exists(get_template_directory() . '/custom-functions/methods-cards/selection-cards.php')) {
	require_once get_template_directory() . '/custom-functions/methods-cards/selection-cards.php';
}

//функция которая строит карточку метода
if (file_exists(get_template_directory() . '/custom-functions/methods-cards/constructor-card.php')) {
	require_once get_template_directory() . '/custom-functions/methods-cards/constructor-card.php';
}

//функция которая строит карточку метода
if (file_exists(get_template_directory() . '/custom-functions/methods-cards/comparison-methods.php')) {
	require_once get_template_directory() . '/custom-functions/methods-cards/comparison-methods.php';
}

//функция которая выводит контент метода в окно
if (file_exists(get_template_directory() . '/custom-functions/methods-cards/page-method-in-window.php')) {
	require_once get_template_directory() . '/custom-functions/methods-cards/page-method-in-window.php';
}

//функция которая выводит контент метода в окно
if (file_exists(get_template_directory() . '/custom-functions/methods-cards/methods-list-right-panel.php')) {
	require_once get_template_directory() . '/custom-functions/methods-cards/methods-list-right-panel.php';
}


//Шорткод который выводит сохраненные карточки методов пользователя
if (file_exists(get_template_directory() . '/custom-functions/methods-cards/selected-cards.php')) {
	require_once get_template_directory() . '/custom-functions/methods-cards/selected-cards.php';
}


if (file_exists(get_template_directory() . '/custom-functions/methods-cards/render-chips-filter.php')) {
	require_once get_template_directory() . '/custom-functions/methods-cards/render-chips-filter.php';
}

?>