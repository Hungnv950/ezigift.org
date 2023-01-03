<?php
define('WP_CACHE', true); // Added by WP Rocket
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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ezigift_org' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'Aa@123123' );

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
define( 'AUTH_KEY',         '[jYa=b1H9TeWqt5<*gzJgWtVQ)TNr1J`.J8U]_,Mp$5&E8Qe}=v6wt]tWJA#VzI+' );
define( 'SECURE_AUTH_KEY',  'nVe:s+&Q6cTZInM5a>pe!_/% Ga2NZNzqKnE3AWot`B5,(GK2Ct)f/A>jMh`:ng:' );
define( 'LOGGED_IN_KEY',    'Wsl~nXMO4F[`{gD}AU*inpjJ$1t?&a6R_]HgIA3c<K$yI!DvV&D-v>bTG#@W7kUM' );
define( 'NONCE_KEY',        'Y+e5iCh{|l1Hwm~:*<ORR(6J).NN(%$@4>4v=s!-fKgs{,8.L)oZ3mkY[[VXhi6U' );
define( 'AUTH_SALT',        '+nXzkKi`,y0;]uByCMGmiIvI8p5pL^Wb]{w6I$M|Li/3PIsjxEqw#Mx1PRPOC5z4' );
define( 'SECURE_AUTH_SALT', '5QD{2?X4Uz`.LS&]D%*HHN1~kj^(.o)x{:nQ$56J{S0fZ~qL9I^*lm:qIunM9i(k' );
define( 'LOGGED_IN_SALT',   'bfR*DvQ0uS_oPe*l+!9OTVz)XW_?PEtqV`aw)0h]Hr$ 9xj6/iHMUn1Qf`jWeV!j' );
define( 'NONCE_SALT',       'UQNzKMiSD3qPK6_n{bt/_Fe;~@!I`VQM7~oZ*i%/;;6U|bO9G^fQ-7v3]JqX_!8Y' );

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
define('WP_MEMORY_LIMIT', '128M');


/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
define("WP_MEMORY_LIMIT", "128M");


