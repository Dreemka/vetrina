<?php 
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

	wp_enqueue_style(
			'method-page-style', // Уникальный идентификатор для нового стиля
			get_theme_file_uri( 'assets/css/method-page.css' ), // URL к файлу стилей
			array(), // Зависимости (если есть)
			wp_get_theme()->get( 'Version' ) // Версия темы
	);

	wp_enqueue_style(
		'core-style', // Уникальный идентификатор для нового стиля
		get_theme_file_uri( 'assets/css/core-style.css' ), // URL к файлу стилей
		array(), // Зависимости (если есть)
		wp_get_theme()->get( 'Version' ) // Версия темы
);
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
?>