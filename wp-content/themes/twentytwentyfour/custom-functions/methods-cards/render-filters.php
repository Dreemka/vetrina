<?php
function render_filters() {
  $minus_values = get_field_object('minus' , 218);
  $plus_values = get_field_object('plus' , 218);
  $expenses_values = get_field_object('expenses' , 218);
  $fields = array($minus_values, $plus_values, $expenses_values);

  $output = '<div class="methodix-filters mr-b-20 methodix-display-flex-row">';
  function render_select_filter($field , &$output) {
    if (is_array($field)) {
        $output .= '<div class="methodix-select">';
        $output .= '<select id="methodix-filter-'.$field["name"].'" name="methodix-filter-'.$field["name"].'">';
        $output .= '<option disabled selected hidden>'.$field["label"].'</option>';
        $output .= '<option value="" >Все '.$field["label"].'</option>';
        foreach ($field['choices'] as $key => $value) {
            $output .= '<option value="'.$key.'">'.$value.'</option>';
        }
        $output .= '</select>';
        $output .= '</div>';
    } else {
        echo 'Полученные данные не являются массивом.';
    }
  }
  foreach ($fields as $field) {
    if (is_array($field)) {
      render_select_filter($field , $output);
    }
  }
  $output .= '</div>';
  return $output;
}
?>