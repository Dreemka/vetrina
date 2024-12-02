<?php
  function render_right_panel_filters($fields , &$output) {
    $output .= '<div class="methodix-background-right-panel"></div>';
    $output .= '<div class="methodix-right-panel methodix-right-panel-filters">';
    $output .= '<div class="methodix-right-header-panel-filters">';
    $output .= '<h4>';
    $output .= 'Фильтры';
    $output .= '</h4>';
    $output .= '<div class="methodix-close-button methodix-close-button-filters" onClick="handleOpenRightPanelFiltersClose()">';
    $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
    <path d="M6.4 19.5L5 18.1L10.6 12.5L5 6.9L6.4 5.5L12 11.1L17.6 5.5L19 6.9L13.4 12.5L19 18.1L17.6 19.5L12 13.9L6.4 19.5Z" fill="#1F1F1F"/>
    </svg>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '<div class="methodix-block-filter-right-panel">';
    foreach ($fields as $field) {
      $output .= render_chips_filter($field , $output);
    }
    $output .= '</div>';
    $output .= '</div>';
  }
?>