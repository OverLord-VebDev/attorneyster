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
define( 'DB_NAME', 'attorneyster' );

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
define( 'AUTH_KEY',         'Uj3ANi]9O&U&js1 ohAMdPQh=wy=7:?7t5F]U-f4!I7jBCTu~mcrr}aaL X@Z.Ns' );
define( 'SECURE_AUTH_KEY',  '7I=moq5R0#s;u^y,4D1!75z_5ZE9,$M{Xk&p[/SpdKMN/!mb7fK$Y|5|}n<&[*?^' );
define( 'LOGGED_IN_KEY',    'D@>@>7S&.vUVuo%DLTu{$v ^ol|dczesdVJNt>Ly{#|hZm~[LjQbx>;?YOq_w~JC' );
define( 'NONCE_KEY',        'ZM_tjMQ~WtrHd_mK6QKIR[3meFAdJ@k(7N%iL#4pe3^,Nv$=or8`{4;?.LvLmH!i' );
define( 'AUTH_SALT',        'i4I,o&Yhw~by~al[IWvtiNzNJ>%6k$)*5P!wzL|XcW.AwodJb963-koH<GL9M9Jp' );
define( 'SECURE_AUTH_SALT', ' :dHE6BKc`}6FT18[B%Ad{rNo|j;$7`h[cjow<Uw#<9ts-3h(uv[eNK;#p[H_~7-' );
define( 'LOGGED_IN_SALT',   'K=9m=}`J~LPZmO0(IrnVxd[7iW*+=a,Bn7YnE(_uJgPU,4gR!y!  x:K$S]L.:OO' );
define( 'NONCE_SALT',       '`|?%at+db,0Mr.t&RF2wv=ykP=A=_6j<|/U-BV(:l#[P2.jy981qHDfj(!B?[SI4' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
