<?php
function render_chips_filter($field , &$output) {
  if (is_array($field)) {
    $output .= '<div class="methodix-block-filter">';
    $output .= '<div id="methodix-filter-chip-'.$field["name"].'" class="methodix-filter-chip">';
    $output .= '<h5>'.$field["label"].'</h5>';
    $output .= '<div class="methodix-block-chips">';
    foreach ($field['choices'] as $key => $value) {
        $output .= '<md-filter-chip class="methodix-filter-chip" label="'.$value.'" name-filter="group-filters_'.$field["name"].'"><input type="checkbox" name="group-filters_'.$field["name"].'" value="'.$key.'"></md-filter-chip>';
    }
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
  }
}
?>