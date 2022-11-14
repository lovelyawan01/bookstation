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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bookstationwpdb' );

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
define( 'AUTH_KEY',         '_;;AOHOY0)ZQA/o)+Z1$?2uDI-Z8?!A6 BvEeo_@2Tl|kcA^Hf`Le{1R3B!iu*!N' );
define( 'SECURE_AUTH_KEY',  'mkQWn$hTNYp.IYRiL2V$-[UCY]k@-Z<)rdr|it|51^?!hUOuEgWF$?!ISO_JCzQu' );
define( 'LOGGED_IN_KEY',    '#;1EKK:qA|8%IRtfrvxi[``Z1#5I6la|nyFQ];4G,E$$t=#Q+gMI=T3` +UlyBp~' );
define( 'NONCE_KEY',        'qyV8w0,K@%xi)8l4<;X`Zz *@k_]1FT|6.]G*w,~26fr+w&7O1*:EG]%3=[#xL}<' );
define( 'AUTH_SALT',        'G@?$.}t=wD(j Gf(iT?]*oUA#lGs=38S**db>C M,G/1I5Oz8>cQ?7wmKnd|qDq#' );
define( 'SECURE_AUTH_SALT', 'KHUro=F[LFDz018+AY8#cF$)mm2~HwCB>|l+KH$ZmD-sOUMImN|n/0lmpF|6RK==' );
define( 'LOGGED_IN_SALT',   'ul<obDob=uKaI<b}E7/SGoB%AW*hi4AZyMN$P4t#%5sO-=m%l0#d;[v_.=[G=&E1' );
define( 'NONCE_SALT',       '$)wSSq1ZH=a;1!IS03%3h`;]9#Un]X7e*Y@8tN%>x4Ud.<m(~CfzRq gx{{Sh*oG' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'bookstation143_';

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
