<?php
function page_method_in_window() {
  $post_id = intval($_POST['post_id']);
  $post = get_post($post_id);
  // echo '<div class="methodix-comparison-card-block">';
  echo '<div class="methodix-method-page-wrapper">';
  echo '<main class="wp-block-group methodix-main-content-block is-layout-flow wp-block-group-is-layout-flow" style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--40)" id="wp--skip-link--target">';
  echo '<div class="methodix-method-page-main">';
  echo '<div class="methodix-method-page-header">';
  echo '<div class="methodix-method-page-header-wrapper">';
  echo '<div class="wp-block-column methodix-method-page-header-back is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:3%" onclick="handleCardCloseClick()">';
  echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">';
  echo '<path d="M7.825 13L13.425 18.6L12 20L4 12L12 4L13.425 5.4L7.825 11H20V13H7.825Z" fill="#1F1F1F"></path>';
  echo '</svg>';
  echo '</div>';



  echo '<div class="wp-block-column methodix-method-page-header-title is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:87%"><h4 class="has-text-align-left wp-block-post-title">'. $post->post_title .'</h4></div>';



  echo '<div class="wp-block-column methodix-method-page-header-menu is-layout-flow wp-block-column-is-layout-flow" style="flex-basis:10%">';
  echo '<div class="methodix-menu-block-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="18" viewBox="0 0 24 18" fill="none">';
  echo '<path d="M24 1H7V3H24V1Z" fill="#1F1F1F"></path>';
  echo '<path d="M24 8H7V10H24V8Z" fill="#1F1F1F"></path>';
  echo '<path d="M24 15H7V17H24V15Z" fill="#1F1F1F"></path>';
  echo '<path d="M2 4C3.10457 4 4 3.10457 4 2C4 0.89543 3.10457 0 2 0C0.89543 0 0 0.89543 0 2C0 3.10457 0.89543 4 2 4Z" fill="#1F1F1F"></path>';
  echo '<path d="M2 11C3.10457 11 4 10.1046 4 9C4 7.89543 3.10457 7 2 7C0.89543 7 0 7.89543 0 9C0 10.1046 0.89543 11 2 11Z" fill="#1F1F1F"></path>';
  echo '<path d="M2 18C3.10457 18 4 17.1046 4 16C4 14.8954 3.10457 14 2 14C0.89543 14 0 14.8954 0 16C0 17.1046 0.89543 18 2 18Z" fill="#1F1F1F"></path>';
  echo '</svg></div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '<div>' . apply_filters('the_content', $post->post_content) . '</div>';
  echo '</div>';
  echo '</main>';
  echo '</div>';
  // echo '</div>';
  // $choiseCards = isset($_POST['choiseCards']) ? stripslashes($_POST['choiseCards']) : [];
  // $choiseCards_arr = json_decode($choiseCards, true);
  // $lengthChoiseCards = count($choiseCards_arr) + 1;

  // // Создаем строку стилей с нужным количеством 1fr
  // $gridTemplateColumns = '250px ' . str_repeat('1fr ', $lengthChoiseCards - 1);

  // echo '<div class="methodix-comparison-card-block">';
  // echo '<div class="methodix-comparison-card-header">';
  // echo '<div class="methodix-comparison-card-header-back" onclick="handleCardCloseClick()">';
  // echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
  // <path d="M7.825 13L13.425 18.6L12 20L4 12L12 4L13.425 5.4L7.825 11H20V13H7.825Z" fill="#1F1F1F"/>
  // </svg>';
  // echo '</div>';
  // echo '<h4>';
  // echo 'Сравнение';
  // echo '</h4>';
  // echo '</div>';
  // echo '<div class="methodix-comparison-content" style="grid-template-columns: ' . trim($gridTemplateColumns) . ';">';
  // $indexCore = 0;
  // foreach ($choiseCards_arr as $choiseCard) {
  //   $fields = get_field_object('group-filters' , $choiseCard['id']);
  //   $post = get_post($choiseCard['id']);
  //   // echo '<pre>';
  //   // print_r($post->post_title);
  //   // echo '</pre>';
  //   $value_fields = $fields['value'];
  //   $sub_fields = $fields['sub_fields'];
  //   $inner_array = [
  //       'label' => 'Методика',
  //   ];
  //   $inner_name_array = [
  //       'label' => $post->post_title,
  //   ];
  //   $length_value_fields = count($value_fields) + 1;
  //   array_unshift($sub_fields, $inner_array);
  //   array_unshift($value_fields, $inner_name_array);
  
  //   // array_push($value_fields, '$objectName');
  //   // echo '<pre>';
  //   // print_r($sub_fields);
  //   // echo '</pre>';
  //   $index = 0;
  //   if ($indexCore < 1) {
  //     echo '<div class="methodix-method-card-wrapper" style="grid-row: span '.$length_value_fields.';">';
  //     foreach ($sub_fields as $field=>$value) {
  //         render_comparison_cards($value['label'], $index);
  //         $index++;
  //     }
  //     echo '</div>';
  //   }
    
  //   echo '<div class="methodix-method-card-wrapper" style="grid-row: span '.$length_value_fields.';">';
  //   foreach ($value_fields as $field=>$value) {
  //       // render_comparison_cards($value , $index);
  //       $index++;
  //   }
  //   echo '</div>';
    
    
  //   $indexCore++;
  // }

  // echo '</div>';

  // echo '</div>';

  wp_die();
}
add_action('wp_ajax_page_method_in_window', 'page_method_in_window');
add_action('wp_ajax_nopriv_page_method_in_window', 'page_method_in_window');
?>

<?php
  // function render_comparison_cards($cards , $index) {
  //   echo '<div class="metgodix-comparison-data-wrapper">';
  //   // echo '<div class="metgodix-comparison-label">';
  //   // echo $name;
  //   // echo '</div>';


  //   echo '<div class="metgodix-comparison-value">';
  //   if (is_array($cards)) {
  //     foreach ($cards as $card) {
  //       echo '<div>';
  //       print_r($card);
  //       echo '</div>';
  //     }
  //   } else {
  //     echo '<div>';
  //     echo $cards;
  //     echo '</div>';
  //   }
  //   echo '</div>';
  //   echo '</div>';

  // }
?>