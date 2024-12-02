<?php
/**
 * Title: Left Menu
 * Slug: twentytwentyfour/left-menu
 * Categories: menu
 * Block Types: core/template-part/menu
 * Description: Left menu.
 */
?>

<?php
echo '<div class="methodix-left-menu">';
?>

<?php
// Массив ID меню в нужном порядке
$menu_ids = array(12, 14, 13); // Замените на нужные вам ID в нужном порядке

// Получаем все зарегистрированные меню
$menus = wp_get_nav_menus();

if (!empty($menus)) {
    echo '<ul>'; // Начинаем список для вывода меню
    
    // Создаем ассоциативный массив для быстрого доступа по ID
    $menus_by_id = [];
    foreach ($menus as $menu) {
        $menus_by_id[$menu->term_id] = $menu; // Сохраняем меню по его ID
    }

    // Перебираем массив ID и выводим меню в нужном порядке
    foreach ($menu_ids as $menu_id) {
        if (isset($menus_by_id[$menu_id])) {
            $menu = $menus_by_id[$menu_id];
            // Выводим название меню
            
            if ($menu->name !== 'Настройки') {
                echo '<li class="methodix-menu-name">' . esc_html($menu->name) . '</li>';
            }
            // Выводим само меню
            wp_nav_menu(array(
                'menu' => $menu->term_id, // ID меню
                'container' => false, // Отключаем контейнер
                'items_wrap' => '<ul class="methodix-block-menu-wrapper">%3$s</ul>', // Оборачиваем элементы в ul
            ));
        }
    }

    echo '</ul>'; // Закрываем список
} else {
    echo 'Меню не найдено'; // Если меню не найдено
}
?>

<?php
echo '</div>';
?>
