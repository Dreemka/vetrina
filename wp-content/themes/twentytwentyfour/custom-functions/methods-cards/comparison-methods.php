<?php
function comparison_methods_window() {
  $choiseCards = isset($_POST['choiseCards']) ? stripslashes($_POST['choiseCards']) : [];
  $choiseCards_arr = json_decode($choiseCards, true);
  $lengthChoiseCards = count($choiseCards_arr) + 1;

  // Создаем строку стилей с нужным количеством 1fr
  $gridTemplateColumns = '250px ' . str_repeat('1fr ', $lengthChoiseCards - 1);

  echo '<div class="methodix-comparison-card-block">';
  echo '<div class="methodix-comparison-card-header">';
  echo '<div class="methodix-comparison-card-header-back" onclick="handleCardCloseClick()">';
  echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
  <path d="M7.825 13L13.425 18.6L12 20L4 12L12 4L13.425 5.4L7.825 11H20V13H7.825Z" fill="#1F1F1F"/>
  </svg>';
  echo '</div>';
  echo '<h4>';
  echo 'Сравнение';
  echo '</h4>';
  echo '</div>';
  echo '<div class="methodix-comparison-content" style="grid-template-columns: ' . trim($gridTemplateColumns) . ';">';
  $indexCore = 0;
  foreach ($choiseCards_arr as $choiseCard) {
    $fields = get_field_object('group-filters' , $choiseCard['id']);
    $post = get_post($choiseCard['id']);
    // echo '<pre>';
    // print_r($post->post_title);
    // echo '</pre>';
    $value_fields = $fields['value'];
    $sub_fields = $fields['sub_fields'];
    $inner_array = [
        'label' => 'Методика',
    ];
    $inner_name_array = [
        'label' => $post->post_title,
    ];
    $length_value_fields = count($value_fields) + 1;
    array_unshift($sub_fields, $inner_array);
    array_unshift($value_fields, $inner_name_array);
  
    // array_push($value_fields, '$objectName');
    // echo '<pre>';
    // print_r($sub_fields);
    // echo '</pre>';
    $index = 0;
    if ($indexCore < 1) {
      echo '<div class="methodix-method-card-wrapper" style="grid-row: span '.$length_value_fields.';">';
      foreach ($sub_fields as $field=>$value) {
          render_comparison_cards($value['label'], $index);
          $index++;
      }
      echo '</div>';
    }
    
    echo '<div class="methodix-method-card-wrapper" style="grid-row: span '.$length_value_fields.';">';
    foreach ($value_fields as $field=>$value) {
        render_comparison_cards($value , $index);
        $index++;
    }
    echo '</div>';
    
    
    $indexCore++;
  }

  echo '</div>';

  echo '</div>';

  wp_die();
}
add_action('wp_ajax_comparison_methods_window', 'comparison_methods_window');
add_action('wp_ajax_nopriv_comparison_methods_window', 'comparison_methods_window');
?>

<?php
  function render_comparison_cards($cards , $index) {
    echo '<div class="metgodix-comparison-data-wrapper">';
    // echo '<div class="metgodix-comparison-label">';
    // echo $name;
    // echo '</div>';


    echo '<div class="metgodix-comparison-value">';
    if (is_array($cards)) {
      foreach ($cards as $card) {
        echo '<div>';
        print_r($card);
        echo '</div>';
      }
    } else {
      echo '<div>';
      echo $cards;
      echo '</div>';
    }
    echo '</div>';
    echo '</div>';

  }
?>