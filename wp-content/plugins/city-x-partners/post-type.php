<?php

function city_x__register_post_types()
{
	register_post_type( 'city', [
		'label'  => null,
		'labels' => [
			'name'               => 'Город',
			'singular_name'      => 'Город',
			'add_new'            => 'Добавить город',
			'add_new_item'       => 'Добавление города',
			'edit_item'          => 'Редактирование города',
			'new_item'           => 'Новый город',
			'view_item'          => 'Смотреть город',
			'search_items'       => 'Искать город',
			'not_found'          => 'Не найдено',
			'not_found_in_trash' => 'Не найдено в корзине',
			'parent_item_colon'  => '',
			'menu_name'          => 'Город',
		],
		'description'            => '',
		'public'                 => true,
		'show_in_menu'           => true,
		'hierarchical'           => false,
		'supports'               => [ 'title', 'editor', 'thumbnail' ],
		'has_archive'            => false,
		'rewrite'                => true,
		'query_var'              => true,
	] );
}