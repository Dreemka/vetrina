<?php
/**
 * Title: Left Menu
 * Slug: twentytwentyfour/left-menu
 * Categories: menu
 * Block Types: core/template-part/menu
 * Description: Left menu.
 */
?>
<?php

// Используем наш кастомный класс в wp_nav_menu
wp_nav_menu( array( 
	'theme_location' => 'left-menu', 
	'container_class' => 'vetrina-left-menu',
	'before' => '<md-outlined-button>', // текст (или HTML) перед <a
	'after' => '</md-outlined-button>', // текст после </a>
) );

?>
