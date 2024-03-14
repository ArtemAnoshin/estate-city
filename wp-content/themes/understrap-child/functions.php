<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'estate_x__add_media_gallery_to_estate' );
function estate_x__add_media_gallery_to_estate() {
    Container::make( 'post_meta', 'Информация об объекте' )
    	->where( 'post_type', '=', 'estate' )
    	->add_fields( array(
			Field::make( 'media_gallery', 'estate_x__media_gallery', __( 'Галлерея картинок' ) )
    			->set_type( array( 'image' ) ),
			Field::make( 'text', 'estate_x__square', __( 'Площадь, м2' ) )
				->set_attribute( 'type', 'number' ),
			Field::make( 'text', 'estate_x__cost', __( 'Стоимость, руб' ) )
				->set_attribute( 'type', 'number' )
				->set_attribute( 'min', 0 ),
			Field::make( 'text', 'estate_x__address', __( 'Адрес' ) ),
			Field::make( 'text', 'estate_x__living_area', __( 'Жилая площадь, м2' ) )
				->set_attribute( 'type', 'number' )
				->set_attribute( 'min', 0 ),
			Field::make( 'text', 'estate_x__floor', __( 'Этаж' ) )
				->set_attribute( 'type', 'number' ),
    	));
}

/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts() {
	wp_dequeue_style( 'understrap-styles' );
	wp_deregister_style( 'understrap-styles' );

	wp_dequeue_script( 'understrap-scripts' );
	wp_deregister_script( 'understrap-scripts' );
}
//add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );



/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles() {

	// Get the theme data.
	$the_theme = wp_get_theme();

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Grab asset urls.
	$theme_styles  = "/css/child-theme{$suffix}.css";
	$theme_scripts = "/js/child-theme{$suffix}.js";

	wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $the_theme->get( 'Version' ) );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $the_theme->get( 'Version' ), true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
//add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );



/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );



/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @return string
 */
function understrap_default_bootstrap_version() {
	return 'bootstrap5';
}
add_filter( 'theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20 );



/**
 * Loads javascript for showing customizer warning dialog.
 */
function understrap_child_customize_controls_js() {
	wp_enqueue_script(
		'understrap_child_customizer',
		get_stylesheet_directory_uri() . '/js/customizer-controls.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'understrap_child_customize_controls_js' );

// Обработка формы добавления новой недвижимости на фронтенде
add_action( 'wp_enqueue_scripts', 'estate_x__new_estate_ajax_form' );

function estate_x__new_estate_ajax_form() {
	wp_enqueue_script( 'jquery-form' );

	wp_enqueue_script( 'new-estate-ajax-form', get_theme_file_uri( '/js/ajax-form.js' ), array('jquery'), 1.0, true );
	wp_localize_script( 'new-estate-ajax-form', 'new_estate_ajax_form', array(
		'url'   => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'new-estate-ajax-form-nonce' ),
	) );
}

add_action( 'wp_ajax_new_estate_ajax_form_action', 'estate_x__new_estate_ajax_action_callback' );
add_action( 'wp_ajax_nopriv_new_estate_ajax_form_action', 'estate_x__new_estate_ajax_action_callback' );

function estate_x__new_estate_ajax_action_callback() {

	// Массив ошибок
	$errors = [];

	// Если не прошла проверка nonce, то блокируем отправку
	if ( !wp_verify_nonce( $_POST['nonce'], 'new-estate-ajax-form-nonce' ) ) {
		wp_die( 'Данные отправлены с некорректного адреса' );
	}

	// Проверяем на спам. Если скрытое поле заполнено или снят чек, то блокируем отправку
	if ( $_POST['form_anticheck'] === false || !empty( $_POST['form_submitted'] ) ) {
		wp_die( 'Ты кто такой, давай, до свидания!' );
	}

	// Наименование
	if ( empty( $_POST['estate_name'] ) || !isset( $_POST['estate_name'] ) ) {
		$errors['estate_name'] = 'Обязательное поле.';
	} else {
		$estate_name = sanitize_text_field( $_POST['estate_name'] );
	}

	// Описание
	$estate_description = '';
	if ( ! empty( $_POST['estate_description'] ) ) {
		$estate_description = sanitize_text_field( $_POST['estate_description'] );
	}

	// Площадь
	if ( empty( $_POST['estate_square'] ) || !isset( $_POST['estate_square'] ) ) {
		$errors['estate_square'] = 'Обязательное поле.';
	} else {
		$estate_square = sanitize_text_field( $_POST['estate_square'] );
	}

	// Стоимость
	if ( empty( $_POST['estate_cost'] ) || !isset( $_POST['estate_cost'] ) ) {
		$errors['estate_cost'] = 'Обязательное поле.';
	} else {
		$estate_cost = sanitize_text_field( $_POST['estate_cost'] );
	}

	// Адрес
	if ( empty( $_POST['estate_address'] ) || !isset( $_POST['estate_address'] ) ) {
		$errors['estate_address'] = 'Обязательное поле.';
	} else {
		$estate_address = sanitize_text_field( $_POST['estate_address'] );
	}

	// Жилая площадь
	if ( empty( $_POST['estate_living_area'] ) || !isset( $_POST['estate_living_area'] ) ) {
		$errors['estate_living_area'] = 'Обязательное поле.';
	} else {
		$estate_living_area = sanitize_text_field( $_POST['estate_living_area'] );
	}

	// Этаж
	if ( empty( $_POST['estate_floor'] ) || !isset( $_POST['estate_floor'] ) ) {
		$errors['estate_floor'] = 'Обязательное поле.';
	} else {
		$estate_floor = sanitize_text_field( $_POST['estate_floor'] );
	}

	// Тип
	if ( empty( $_POST['estate_type'] ) || !isset( $_POST['estate_type'] ) ) {
		$errors['estate_type'] = 'Обязательное поле.';
	} else {
		$estate_type = sanitize_text_field( $_POST['estate_type'] );
	}

	// Город
	if ( empty( $_POST['estate_city'] ) || !isset( $_POST['estate_city'] ) ) {
		$errors['estate_city'] = 'Обязательное поле.';
	} else {
		$estate_city = sanitize_text_field( $_POST['estate_city'] );
	}

	// Проверяем массив ошибок, если не пустой, то передаем сообщение. Иначе отправляем письмо
	if ( $errors ) {
		wp_send_json_error( $errors );
	} else {
		// Создаем массив
		$post_data = array(
			'post_title'    => $estate_name,
			'post_content'  => $estate_description,
			'post_status'   => 'publish',
			'post_author'   => 1,
			'post_type'     => 'estate',
			'post_parent'   => $estate_city,
			'meta_input'    => [
				'_estate_x__square' => $estate_square,
				'_estate_x__cost' => $estate_cost,
				'_estate_x__address' => $estate_address,
				'_estate_x__living_area' => $estate_living_area,
				'_estate_x__floor' => $estate_floor,
			],
			'tax_input'     => [
				'estate_type' => [$estate_type]
			], 
		);

		// Вставляем данные в БД
		wp_insert_post( wp_slash($post_data) );

		// Отправляем сообщение об успешной отправке
		$message_success = 'Добавлена новая недвижимость.';
		wp_send_json_success( $message_success );
	}

	wp_die();
}