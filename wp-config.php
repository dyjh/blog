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
define('DB_NAME', 'blog');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'qweqweqwe');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '|Lq+yNOK4nyC{`=4:fzM@wt/nl&RaHYR00#3iQ>o,kf^w5CJWu3yDdzk(&9D`A-?');
define('SECURE_AUTH_KEY',  '8( 2PP(_f4&8(Sr]CkqrquN:~8 nIIMKR=+p`493*ak~3R!{MD+qn/Cp+CEql]ss');
define('LOGGED_IN_KEY',    '<+Df|G7X3En6AJ#R]ayJ<@O4G`-uF+6L1Dp-#10c1t?i+Hp+Hb!#/wvKbybwScy2');
define('NONCE_KEY',        'ZQ<|*vMeIDYX09rYvclb]a+J^O/Cku<m,VSk-|(,8u(Vw?.V7af$@:2b5IInU^h^');
define('AUTH_SALT',        'z-12<w-{FzUR):u+J`xm]@tKZ>U%/2rH~|<txK=$%^uUs<w}&tFXNSu9,l*r}D#|');
define('SECURE_AUTH_SALT', '9qXPmzO3(cV;`x#FV`dEJ5V=}T H-=-EMo #6Fwf-xP72%Xe_{|c[,SnSCJ(!yr^');
define('LOGGED_IN_SALT',   'L~o#s<9{^_-|CsYF?6OFc2Xig2Pu^O7gz@81FQn8_|A.t@Vj aov:m`g aO#nTCG');
define('NONCE_SALT',       'KVY0 v[+Mw1j3%FJx1lZoo/-N6Z>c/;[}w[Ps>2=CJH+|=Z/LpaS%y#_|uNo[0xB');

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
define('FTP_BASE', 'www/blog/');
define('FTP_CONTENT_DIR', 'www/blog/wp-content');
define('FTP_PLUGIN_DIR', 'www/blog/wp-content/plugins/');
define('FTP_THEMES_DIR', 'www/blog/wp-content/themes/');
define('FS_METHOD', 'direct');
