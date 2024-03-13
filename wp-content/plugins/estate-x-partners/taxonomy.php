<?php

function estate_x__create_taxonomy()
{
	register_taxonomy( 'estate_type', [ 'estate' ], [
		'label'                 => '',
		'labels'                => [
			'name'              => 'Типы',
			'singular_name'     => 'Тип',
			'search_items'      => 'Искать типы',
			'all_items'         => 'Все типы',
			'view_item '        => 'Смотреть тип',
			'parent_item'       => 'Родительский тип',
			'parent_item_colon' => 'Родительский тип:',
			'edit_item'         => 'Редактировать тип',
			'update_item'       => 'Обновить тип',
			'add_new_item'      => 'Добавить новый тип',
			'new_item_name'     => 'Имя нового типа',
			'menu_name'         => 'Тип',
			'back_to_items'     => '← Назад',
		],
		'public'                => true,
		'hierarchical'          => false,
		'rewrite'               => true,
        'meta_box_cb'           => 'post_categories_meta_box',
	] );
}