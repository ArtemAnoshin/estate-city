<?php

/*
 * Plugin Name: Создание и управление типом поста Недвижимость (estate)
 */

require_once __DIR__ . '/post-type.php';
require_once __DIR__ . '/taxonomy.php'; 

/**
 * Регистрируем таксономию для недвижимости - тип недвижимости
 */
add_action( 'init', 'estate_x__create_taxonomy' );

/**
 * Регистрируем тип поста Недвижимость / estate 
 */ 
add_action( 'init', 'estate_x__register_post_types' );