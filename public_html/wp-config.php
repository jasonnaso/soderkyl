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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */


if ( $_SERVER[ 'SERVER_NAME' ] == 'soderkyl.se.nitea.net' )
{
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'soderkyl.se');

/** MySQL database username */
define('DB_USER', 'nitea');

/** MySQL database password */
define('DB_PASSWORD', '0aetin!5');

/** MySQL hostname */
define('DB_HOST', 'nitea.net');

}
else
{
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'soderkyl_se');

/** MySQL database username */
define('DB_USER', 'soderkyl@s255830');

/** MySQL database password */
define('DB_PASSWORD', ')!nJu450PaqMl)/6&');

/** MySQL hostname */
define('DB_HOST', 'mysql681.loopia.se');


}

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'SlCS6nBR!*1r5,pN|hQ0`lPq;-@2_a9alp7dy0tT&F7!,BHC6A?9!JL.7x@PGwUZ');
define('SECURE_AUTH_KEY',  'x[^Kihi#WmukBh{g`FobgO^ S(9fwpR#fshR|s@ZCl9`O}<45{p=Ue>f]Q G)FrI');
define('LOGGED_IN_KEY',    'c0m&I*t/<]~JtzDS;b+V3k!YA_qRDg17`DNUm#<7yVCg=Ep6Lk2+SM&wm;Eh[+vE');
define('NONCE_KEY',        'vQ;)Xbj*;3V-jThS.+u|J1~.Ugjm#?QyHo|Dm [8dmxLPOi@JZ=)$-E_;oI)BeA4');
define('AUTH_SALT',        'qwPfY;VIWY_j0Po$)e-*>4kJ0~8c$tR}J`HIp*P)F-`g*B;W~~_69mT7{f3`p2Y)');
define('SECURE_AUTH_SALT', 'n9UYHvee6M7T3|V]=+Wy*2Yu)H@1tlfNUjg2l8G3IV4Qa_/84J]0:hPZRB#UWp<,');
define('LOGGED_IN_SALT',   'xbp{{D_sOS4}}s)}-[N8`dL.LC?D==ghY7m)B_l+R&.{6T_KF1P871Z!.S.?cl(F');
define('NONCE_SALT',       '$ALAi:UC+giGp@:4^*U_eAg4TEg~aw#A]gQy7bo_,LbBV)%!S1c|VFAtof(JCEik');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
