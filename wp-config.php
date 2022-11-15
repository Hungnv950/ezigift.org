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
define( 'DB_NAME', 'siquatet' );

/** MySQL database username */
define( 'DB_USER', 'siquatet' );

/** MySQL database password */
define( 'DB_PASSWORD', 'siquatet@123!' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'a56@NCZm@98x}K}~P3:7gtw;t9L`|;X1N<qQ@zT}~S$_hlt_{Wl=]QwE.D3R%`x*' );
define( 'SECURE_AUTH_KEY',  '.B|N/!$+6p}i4%?H{L|/-1%9T:!hy{1VxHZR@+yfh1~WrRNdJDG,23oAzaR;l4w{' );
define( 'LOGGED_IN_KEY',    'A1zIj*jhwYEz+eh*G-Sm{^q{r|xpq$)*3nzMt=-x1wsn@Vj#eK&trS{| {5p!}.G' );
define( 'NONCE_KEY',        '9!o~KU4ngrMjtbKQ!]2x` E#[b,?2{Y%^hbF n#UHNfqEuBZ)WsICaWz(~A*)3g:' );
define( 'AUTH_SALT',        'L!6#{TH`.U`R6t>!Uj4N-qC0~k*#Ep0<V4s{ %/AYP(*UnORxFU>G[.gT:_+_rQ/' );
define( 'SECURE_AUTH_SALT', '4Y6E^q-$;dxTBk@J)lX$?{9^cB(vwK!@dN$oxhL@L$xW!FN.1hnQ!/GE]wqf>Hc@' );
define( 'LOGGED_IN_SALT',   'G4&C$5||D>mq4n:w}*SjfmQ&e&nu)W-=/D_,[{-E}lKC;^PP?ueYef%OLlK+U>K4' );
define( 'NONCE_SALT',       '1phU[<0RxyWQrpgf&P]~CEGD&^MM?IqKs1b9!-vA<^q]%,]W|;`EGxTyG&m6/0sc' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
#define('FS_METHOD', 'direct');
define('FS_METHOD', 'fpt');


define( 'WP_DEBUG', true );
define( 'WP_DEBUG_DISPLAY', false );
define( 'WP_DEBUG_LOG', true );

@ini_set( 'upload_max_filesize' , '128M' );
@ini_set( 'post_max_size', '128M');
@ini_set( 'memory_limit', '256M' );
@ini_set( 'max_execution_time', '300' );
@ini_set( 'max_input_time', '300' );
