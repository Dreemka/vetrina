<?php
/**
 * Title: Left Menu Copy
 * Slug: twentytwentyfour/left-menu-copy
 * Categories: menu
 * Block Types: core/template-part/menu
 * Description: Left Menu Copy.
 */
?>

<?php
echo '<div class="vetrina-left-menu">';
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
            echo '<li class="vetrina-menu-name">' . esc_html($menu->name) . '</li>';
            
            // Выводим само меню
            wp_nav_menu(array(
                'menu' => $menu->term_id, // ID меню
                'container' => false, // Отключаем контейнер
                'link_before' => '<md-text-button class="vetrina-menu-button w-100"><svg slot="icon" class="vetrina-icon-menu" viewBox="0 0 48 48"><path d="M9 42q-1.2 0-2.1-.9Q6 40.2 6 39V9q0-1.2.9-2.1Q7.8 6 9 6h13.95v3H9v30h30V25.05h3V39q0 1.2-.9 2.1-.9.9-2.1.9Zm10.1-10.95L17 28.9 36.9 9H25.95V6H42v16.05h-3v-10.9Z"/></svg>', // текст (или HTML) перед <a
                'link_after' => '</md-text-button>', // текст после </a>
                'items_wrap' => '<ul class="vetrina-block-menu-wrapper">%3$s</ul>', // Оборачиваем элементы в ul
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
