<?php 
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
?>