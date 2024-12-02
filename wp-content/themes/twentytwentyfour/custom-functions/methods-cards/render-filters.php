<?php
function render_filters() {
  $fields = get_field_object('group-filters' , 252);
  $fields = $fields['sub_fields'];
  $output = '<div class="methodix-filters methodix-curent-filters mr-b-20 methodix-display-flex-row">';
  $podhody_fields = [];
  $harakteristiki_fields = [];
  foreach ($fields as $field) {
      if (strpos($field['name'], 'podhody') !== false) {
          $podhody_fields[] = $field;
      } elseif (strpos($field['name'], 'harakteristiki') !== false) {
          $harakteristiki_fields[] = $field;
      }
  }
  foreach ($podhody_fields as $field) {
      render_chips_filter($field, $output);
  }
  $output .= '<div class="methodix-filter-chip">';
  $output .= '<h5>Ресурсы</h5>';
  $output .= '<div class="methodix-block-chips">';
  foreach ($fields as $field) {
    if (is_array($field) && (strpos($field['name'], 'sroki') !== false || strpos($field['name'], 'bjudzhet') !== false)) {
      render_select_filter($field , $output);
    }
  }
  $output .= '</div>';
  $output .= '</div>';
  foreach ($harakteristiki_fields as $field) {
      render_chips_filter($field, $output);
  }

  $output .= '<div class="methodix-suggestion-chip methodix-open-right-panel-button" onClick="handleOpenRightPanelFilters()">';
  $output .= 'Все';
  $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" viewBox="0 0 18 12" fill="none">
  <path d="M17.343 4.40923L13.9035 0.969727L12.843 2.03023L16.0395 5.22748L0 5.24998V6.74998L16.0845 6.72748L12.8422 9.96973L13.9028 11.0302L17.343 7.59073C17.7635 7.16811 17.9996 6.59617 17.9996 5.99998C17.9996 5.40378 17.7635 4.83184 17.343 4.40923Z" fill="#002D74"/>
  </svg>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= render_right_panel_filters($fields , $output);
  return $output;
}
?>

<?php
  if (file_exists(get_template_directory() . '/custom-functions/methods-cards/right-panel-filters.php')) {
    require_once get_template_directory() . '/custom-functions/methods-cards/right-panel-filters.php';
  }

  if (file_exists(get_template_directory() . '/custom-functions/methods-cards/render-chips-filter.php')) {
    require_once get_template_directory() . '/custom-functions/methods-cards/render-chips-filter.php';
  }

  if (file_exists(get_template_directory() . '/custom-functions/methods-cards/render-select-filter.php')) {
    require_once get_template_directory() . '/custom-functions/methods-cards/render-select-filter.php';
  }
?>