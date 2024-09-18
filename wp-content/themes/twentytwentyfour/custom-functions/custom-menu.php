<?php 
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
?>