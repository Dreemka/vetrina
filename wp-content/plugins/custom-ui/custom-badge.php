<?php
/*
Plugin Name: Custom Badge
Description: Adds a custom badge to WordPress admin blocks.
Version: 1.0
Author: Your Name
*/

function custom_badge_enqueue_scripts() {
    wp_enqueue_script(
        'custom-badge-script',
        plugin_dir_url(__FILE__) . 'custom-badge.js',
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-data'),
        filemtime(plugin_dir_path(__FILE__) . 'custom-badge.js')
    );
}
add_action('enqueue_block_editor_assets', 'custom_badge_enqueue_scripts');
?>