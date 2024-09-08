<?php
/**
 * Title: User block menu
 * Slug: twentytwentyfour/user-block-menu
 * Block Types: core/template-part/user-block-menu
 * Description: User block menu.
 */
?>

<?php
// Получаем ID текущего пользователя
$current_user_id = get_current_user_id();

// Проверяем, есть ли текущий пользователь
if ($current_user_id) {
    // Получаем данные пользователя
    $user_info = get_userdata($current_user_id);
    
    // Выводим аватар, имя и фамилию
    echo '<div class="vetrina-user-block-menu">';
    echo get_avatar($current_user_id, 96); // 96 - размер аватара в пикселях
    echo '<p>' . esc_html($user_info->first_name) . ' ' . esc_html($user_info->last_name) . '</p>'; // Имя и фамилия
    echo '</div>';
} else {
    echo 'Пользователь не найден.';
}
?>
