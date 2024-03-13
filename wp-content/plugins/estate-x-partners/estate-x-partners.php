<?php

/*
 * Plugin Name: Создание и управление типом поста Недвижимость (estate)
 */

require_once __DIR__ . '/post-type.php';
require_once __DIR__ . '/taxonomy.php'; 

/**
 * Регистрируем таксономию для недвижимости - тип недвижимости
 */
if (function_exists('estate_x__create_taxonomy')) {
    add_action( 'init', 'estate_x__create_taxonomy' );
}


/**
 * Регистрируем тип поста Недвижимость / estate 
 */ 
if (function_exists('estate_x__register_post_types')) {
    add_action( 'init', 'estate_x__register_post_types' );
}

