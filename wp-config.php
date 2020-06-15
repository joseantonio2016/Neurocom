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
define( 'DB_NAME', 'segunda' );

/** MySQL database username */
define( 'DB_USER', 'jose' );

/** MySQL database password */
define( 'DB_PASSWORD', '32_gigilo' );

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
define( 'AUTH_KEY',         '0zCf|BVD5J!FiOpP$Bu}~p|Pe3@[|=B!3kuu:-O&{WjoHHd,-fAZ~6z^.xZ]#xW9' );
define( 'SECURE_AUTH_KEY',  'rR?Kfny=YjP#[Jd@cW%A|BY/WedCT7&};C4If;q|%7iuoj=aBeHe^y|XN2|7A_Zj' );
define( 'LOGGED_IN_KEY',    '2Se:R6S/!(`c*@~C5VO(*aL0Tqal^R6N(!68PIU6?}%?N:HDL/[ef2A.W0p[:iDS' );
define( 'NONCE_KEY',        'AEAbwHw/>^GZH{x_tp%t0KE(w/swACzcPC^LF%C#T#6HCMtp>+/*>[v6q%5YG+0J' );
define( 'AUTH_SALT',        'b->ueSrN(#Z=]YGr2FJ~+(#*0SF9_iOC2Up+<*&8e!}JPJ)P{eus$fT+.EaL*1[:' );
define( 'SECURE_AUTH_SALT', 'qBu3%QN1gL=t{g7(7+kXc-IsG_g(Xnj[?e+5wZRQfRORWQv`zN#7aF&`29OgAa_}' );
define( 'LOGGED_IN_SALT',   ',49s%oXLUqwV1*lbe&g{nSy_ P89cw[0{+LG?E{!966@Q#y}>91;%dfGz}[{6({x' );
define( 'NONCE_SALT',       'M_W}Yg3i4QZ^g9f*5@KR 0uzA_X)TtT >BOf~Y,ISB*3F(ty-5}a|khBF_[ny[f~' );

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
define('FS_METHOD','direct');

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
