<?php
  function render_select_filter($field , &$output) {
    if (is_array($field)) {
        $output .= '<div class="methodix-select">';
        $output .= '<select id="methodix-filter-'.$field["name"].'" name-filter="group-filters_'.$field["name"].'" name="methodix-filter-'.$field["name"].'">';
        $output .= '<option disabled selected hidden>'.$field["label"].'</option>';
        $output .= '<option value="" >Все '.$field["label"].'</option>';
        foreach ($field['choices'] as $key => $value) {
            $output .= '<option value="'.$key.'">'.$value.'</option>';
        }
        $output .= '</select>';
        $output .= '</div>';
    }





  // if (is_array($field)) {
  //     $output .= '<div class="methodix-select">';
  //     $output .= '<md-outlined-select id="methodix-filter-'.$field["name"].'" name-filter="group-filters_'.$field["name"].'" name="methodix-filter-'.$field["name"].'">';
  //     $output .= '<md-select-option disabled selected hidden>'.$field["label"].'</md-select-option>';
  //     $output .= '<md-select-option value="" >Все '.$field["label"].'</md-select-option>';
  //     foreach ($field['choices'] as $key => $value) {
  //         $output .= '<md-select-option value="'.$key.'">'.$value.'</md-select-option>';
  //     }
  //     $output .= '</md-outlined-select>';
  //     $output .= '</div>';
  // }
}
?>