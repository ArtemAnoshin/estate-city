<?php

function estate_x__register_post_types()
{
	register_post_type( 'estate', [
		'label'  => null,
		'labels' => [
			'name'               => 'Недвижимость',
			'singular_name'      => 'Недвижимость',
			'add_new'            => 'Добавить недвижимость',
			'add_new_item'       => 'Добавление недвижимости',
			'edit_item'          => 'Редактирование недвижимости',
			'new_item'           => 'Новая недвижимость',
			'view_item'          => 'Смотреть недвижимость',
			'search_items'       => 'Искать недвижимость',
			'not_found'          => 'Не найдено',
			'not_found_in_trash' => 'Не найдено в корзине',
			'parent_item_colon'  => '',
			'menu_name'          => 'Недвижимость',
		],
		'description'            => '',
		'public'                 => true,
		'show_in_menu'           => true,
		'hierarchical'           => false,
		'supports'               => [ 'title', 'editor', 'thumbnail' ],
		'taxonomies'             => ['estate_type'],
		'has_archive'            => false,
		'rewrite'                => true,
		'query_var'              => true,
	] );
}