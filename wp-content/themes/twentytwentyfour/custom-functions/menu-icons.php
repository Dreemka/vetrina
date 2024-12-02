<?php
//Подключение выбора иконок для меню
add_action( 'wp_nav_menu_item_custom_fields', 'true_menu_field', 10, 5 );

function true_menu_field( $item_id, $item, $depth, $args, $id ) {
    // Получаем URL иконки для данного элемента меню
    $icon_url = get_post_meta( $item_id, '_menu_icon', true );

    echo '<p class="description">';
    echo '<label for="menu-item-icon-' . $item_id . '">Выберите SVG иконку:</label>';
    echo '<input type="text" name="menu-item-icon[' . $item_id . ']" id="menu-item-icon-' . $item_id . '" value="' . esc_attr( $icon_url ) . '" style="width: 70%;" />';
    echo '<button class="button select-icon-button" data-item-id="' . $item_id . '">Выбрать иконку</button>';
    echo '</p>';
}

// Сохранение выбранной иконки
add_action( 'wp_update_nav_menu_item', 'save_menu_item_icon', 10, 2 );

function save_menu_item_icon( $menu_id, $menu_item_db_id ) {
    if ( isset( $_POST['menu-item-icon'][$menu_item_db_id] ) ) {
        $icon = esc_url_raw( $_POST['menu-item-icon'][$menu_item_db_id] );
        update_post_meta( $menu_item_db_id, '_menu_icon', $icon );
    } else {
        delete_post_meta( $menu_item_db_id, '_menu_icon' );
    }
}

// Функция для отображения иконок в меню
add_filter( 'walker_nav_menu_start_el', 'add_icon_to_menu_item', 10, 4 );

function add_icon_to_menu_item( $item_output, $item, $depth, $args ) {
    $icon_url = get_post_meta( $item->ID, '_menu_icon', true );
		$item_output = $args->before;
		$item_output .= '<a href="' . $item->url .'">';
		$item_output .= '<button class="methodix-button methodix-menu-button w-100">';
		if ( $icon_url && strpos( $icon_url, 'http' ) === 0 ) {
			$item_output .= '<img src="' . esc_url( $icon_url ) . '" class="methodix-menu-icon">';
		};
		$item_output .= $args->link_before . $item->title . $args->link_after;
		$item_output .= '</button>';
		$item_output .= '</a>';
		$item_output .= $args->after;
    return $item_output;
}

// Подключаем скрипт для работы с медиабиблиотекой
add_action('admin_footer', 'enqueue_media_uploader_script');

function enqueue_media_uploader_script() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('.select-icon-button').on('click', function(e) {
                e.preventDefault();
                
                var button = $(this);
                var itemId = button.data('item-id');
                var file_frame;

                // Если медиа-рамка уже была создана, открыть её
                if (file_frame) {
                    file_frame.open();
                    return;
                }

                // Создаем новую медиа-рамку
                file_frame = wp.media({
                    title: 'Выберите иконку',
                    button: {
                        text: 'Выбрать иконку'
                    },
                    multiple: false // Можно выбирать только одно изображение
                });

                // Когда изображение выбрано, обновляем поле
                file_frame.on('select', function() {
                    var attachment = file_frame.state().get('selection').first().toJSON();
                    $('#menu-item-icon-' + itemId).val(attachment.url);
                });

                // Открываем медиа-рамку
                file_frame.open();
            });
        });
    </script>
    <?php
}
?>