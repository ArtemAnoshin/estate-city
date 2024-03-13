<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'x-partners' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '12QLgZR51vcIc^oq;`xmyymep0weZ!{DDBezA7=.+Y$aU/MLbs`MlRynPc;H*47B' );
define( 'SECURE_AUTH_KEY',  ':>dK7Zn6t5.Ai5w0+i9(<9D0i[Bj^GlWT..cJT7%Z#t``Akywy%+!RVCJ*!beszz' );
define( 'LOGGED_IN_KEY',    'x,kFP`s[n*Bp~gfnjHhi4[:LRC=CdwbgdT0}LV^1N?Y>~hT<%{*j@>*(KZw02=w]' );
define( 'NONCE_KEY',        'E0F/b^ndL[q+r&]=.?F0M5n?<N8qy7S<Ulw3@51mB$vf:u(##mT#IJjWSC+N1u$F' );
define( 'AUTH_SALT',        'M1v%EMSY0f.b-/Duz=W~@DlBMM)y9#+V(0}JN$t5Ujpi=RSN{sQxHO55*lg0dG;f' );
define( 'SECURE_AUTH_SALT', '9)I6]I1tTpZxF4&e8_ZX/2pn/3/BKrQ?r%;T9T5yeOx.-ns@}&z$8uQ8?pWg5Zs(' );
define( 'LOGGED_IN_SALT',   'P_%,,=Zkn1`V}%#/tb)d8r^XjBFuN|3^ Al-cc=R*qaB#_,#X=S$_fCLL%7}1RCT' );
define( 'NONCE_SALT',       ']QV7ql3(RWMudnwI~?K(OX.Wf7j3+i<if{*e*d`)BjoL;hIlx)R^K0H%@q4tZTnS' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
