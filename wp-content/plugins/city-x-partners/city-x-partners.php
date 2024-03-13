<?php

/*
 * Plugin Name: Создание и управление типом поста Города (city)
 */

require_once __DIR__ . '/post-type.php';
require_once __DIR__ . '/estate-city-metabox.php';

/**
 * Регистрируем тип поста Город / city 
 */ 
if (function_exists('city_x__register_post_types')) {
    add_action( 'init', 'city_x__register_post_types' );
}

/** Добавим метабокс в недвижимость */
if (function_exists('city_x__estate_city_metabox')) {
    add_action('add_meta_boxes', function () {
        add_meta_box( 'estate_city', 'Город', 'city_x__estate_city_metabox', 'estate', 'side', 'low'  );
    }, 1);
}