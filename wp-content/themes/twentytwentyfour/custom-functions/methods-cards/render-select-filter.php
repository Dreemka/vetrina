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
}
?>