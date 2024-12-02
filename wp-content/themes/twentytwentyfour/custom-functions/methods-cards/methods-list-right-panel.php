<?php
function methods_list_right_panel() {
  $args = array(
      'post_type' => 'methodix',
      'posts_per_page' => -1,
  );
  $pages = get_posts($args);

  $output = '<div class="methodix-background-right-panel"></div>';
  $output .= '<div class="methodix-right-panel-methods-list methodix-right-panel">';
  $output .= '<div class="methodix-right-header-panel-filters">';
  $output .= '<h4>';
  $output .= 'Методологии';
  $output .= '</h4>';
  $output .= '<div class="methodix-close-button methodix-close-button-methods-list" onClick="handleOpenMethodsListRightPanelClickClose()">';
  $output .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
  <path d="M6.4 19.5L5 18.1L10.6 12.5L5 6.9L6.4 5.5L12 11.1L17.6 5.5L19 6.9L13.4 12.5L19 18.1L17.6 19.5L12 13.9L6.4 19.5Z" fill="#1F1F1F"/>
  </svg>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '<div class="methodix-block-filter-right-panel">';
  if ($pages) {
      $output .= '<div class="methodix-link-method-in-right-panel-wrapper">';
      foreach ($pages as $page) {
        $output .= '<div id="mathodix-method-link-' . $page->ID . '" class="methodix-link-method-in-right-panel methodix-display-flex-row align-items-center" onclick="handleCardOpenClick(event , '.$page->ID.')">';
        // $output .= '<a href="' . get_permalink($page->ID) . '" onclick="handleCardOpenClick(event , '.$page->ID.')">' . esc_html(get_the_title($page->ID)) . '</a>';
        $output .= '<span>' . esc_html(get_the_title($page->ID)) . '</span>';
        $output .= '</div>';
      }
      $output .= '</div>';
  }
  $output .= '</div>';
  $output .= '</div>';
  return $output;
}
?>