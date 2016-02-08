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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'jh_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         ':.o3fpc;w+k*MfXMB~Rp+sn4>A#ZhsA^vzUL?-zFo ,tTP5:#+nAeGh7t4Y|%pk5');
define('SECURE_AUTH_KEY',  '+B#A?|,ng17`tJBqJJ7*b@9HYaQ+b=I#D@b^Ug-xIwSv8:&_GM,E%4-L8yx,I-ie');
define('LOGGED_IN_KEY',    'p{F:*NxE>iq4-%L3cJ7WUchk|tAXq<6&:V_^.GnYs}+3]3~=j+e{CCqd/n*w:,;=');
define('NONCE_KEY',        ']{-+n^GF#T3R^s9Mip-|9[AV,)9<n&bj!&pFRJpPAFkwT&LK2m,0qwZVTW-Pe`is');
define('AUTH_SALT',        '$P<oR;:.E1oB(P;|QX^Gk>R<`-)De|Y`ccE#1lk^Pxug4|34$0mmJD#~^0PN$g#]');
define('SECURE_AUTH_SALT', '$TzR0~dwgi !x*1@xQgM%+ (SG23tHhEJc!E<q!YaO:4he7 }d%v`0r`m^M(<k47');
define('LOGGED_IN_SALT',   'Ha@D!`<P:gA`^=HGSgKV}S--+F)`;~6+!Dy4F*RW8bl2V4ov(Y.3=it-|]<_&>!B');
define('NONCE_SALT',       '*Q1U9F+kH3f05y^?WN@T-+4)9}h:]/M.U3jK6,B[/~mnX`m8L^+GwaLlh-n)2+<n');

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
