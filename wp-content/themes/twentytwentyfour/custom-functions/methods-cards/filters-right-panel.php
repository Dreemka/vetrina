<?php
function filters_right_panel() {
  $fields = get_field_object('group-filters' , 252);
  $fields = $fields['sub_fields'];
  $output .= '<div>';
  foreach ($fields as $field) {
    $output .= render_chips_filter($field);
  }
  $output .= '</div>';
}
add_action('wp_ajax_filters_right_panel', 'filters_right_panel');
add_action('wp_ajax_nopriv_filters_right_panel', 'filters_right_panel');
?>