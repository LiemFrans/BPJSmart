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
define('DB_NAME', 'bpjsmart');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'HH7a#m+}`iv$MmT,B*]v~nwT3jD!/i4`fH?(@k2evMjM5_M+,5PkP`YEs]-TuD7]');
define('SECURE_AUTH_KEY',  'ygMVpg;unlhiv1=c3Rpx.G+lHXNt)Y%c.sYqN6T*x{0m s,yBs_$#fx4%C3ubbf.');
define('LOGGED_IN_KEY',    ':m,KihyhV`M>8?x<2}l1hwMS@BQ$5|>)QD)x6es@,n0e}[WTTG#g<~$r+1;|Ju`&');
define('NONCE_KEY',        'PTA`&7a?Q*L2PL^hV7WV_DDk.wnERA@+Hj0$-GZs=95o+:EP5&kvYcDX`Qn{am;i');
define('AUTH_SALT',        'AR?9MH|ZXNrKe|-w5}D|X_K3z_q@7Z}N:sd ){D.`a/}LLhB[*|ko<.V/s+4(AHq');
define('SECURE_AUTH_SALT', '[wH/ge0A+Tr{`z8XU)q$?<nY=E`1S#A[c_dnl_Jq7iYt>!Y7xZkKz.>D}()ge~.q');
define('LOGGED_IN_SALT',   'J2S)3K,pXiFrwo&r:tHUBtI?lY&> FeSa7Ib@&Q`2_1[.C8Qr07 t Ql*9y?kOil');
define('NONCE_SALT',       '^arp@xvDyx:Vm*l[vFddvz!Xoz0jw*/E0h)i_&12og2a23T.@iqun2fg.P+Hb]om');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'bpjsmart_';

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
