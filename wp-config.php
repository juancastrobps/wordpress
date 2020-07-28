<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'nuevadb' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'ca,!fUxfvR4ey?%C`]-AvjP3#v-Ml] qT#ku;c8PK;$U&9BG~&,dG8g>]-^_}3W#' );
define( 'SECURE_AUTH_KEY',  '<=SC2(,,aYB}39_>sE|,mk.$[T{w1n#j3!Max^3f`=37 ~6U~4VFAN(r=5>>*1,y' );
define( 'LOGGED_IN_KEY',    '2 A#TB|?,VNCi3gG8hXH1Qnic5?qF7<h<B8wJ%W,E=}U-ym&yj/uhY%OX-|xS:E=' );
define( 'NONCE_KEY',        'N6=Yl;kZLnrBTb0wIh;z$#):xX4&NT@NxGDwn!w51_gNNhK|L<|5*?sq=@1RTb%W' );
define( 'AUTH_SALT',        '5p,nwV6:#ixnJ O{T t<eHd5`<}sT&bPlq+;RtNC4vG1HjWQqK?0vV8N7RHRtt(c' );
define( 'SECURE_AUTH_SALT', ']LYr5sgYxV1e?TN@g!&r)CF$`tg^Fo+03u>K.gaY9sDv<G.w?.qfjT~rX.lc==!#' );
define( 'LOGGED_IN_SALT',   '+^Qc}&/E|fQ@:j`6z{[Nmb88p`8.q)m-sP<7phL1A.(ahY){A;@(%19mH6jiyAVx' );
define( 'NONCE_SALT',       'O&fCWs~7_47uPHRhmLpX0r]xOwr=87Z^HXcRYv,1+.Be]AML#.JXwe.8dpr5(>u~' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
