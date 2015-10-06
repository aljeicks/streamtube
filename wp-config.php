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
define('DB_NAME', 'streamtube_tvshows');

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
define('AUTH_KEY',         'Eq>Zh#$EzB8aONwRpu-zg.OI(!9H].}pUanwnH:A)jWtzH+z~;})lyB)x`%Ep6fU');
define('SECURE_AUTH_KEY',  'Or3meDmE{^) +4BQf`T{-PgE{0vp?xmSfnBYIpT$g|FFi?7GOm|#~.t 1w:G&g(@');
define('LOGGED_IN_KEY',    'KbzyzGrV$7u[RwB$o6 h9EE&7{5DRM7|d+Q.51?M&|}5<t2_oH*Q(/W[I_W+;2Rh');
define('NONCE_KEY',        '])l~v#FLlfu O|7/jE=y+pOIqy2:76yWp[<s1MD^oZ|ERX [N|:i?Z_{X,|L?.1q');
define('AUTH_SALT',        'J|%SnZO;Cht=|[^PlVe4)):y#%uoOs+#)UQw@B|;3DK|v?|erDz~UNlAOLP1(w,x');
define('SECURE_AUTH_SALT', 'n.W-M,j-!gY+<Ac<Hv-xm(p|C$b.gy)zM7piD>B$4,ZuN=)$X]~WxFrgXNhP0a+y');
define('LOGGED_IN_SALT',   'eP[8=k9/f^UBufD=O.@vEW1j2lvXKR^ehW8^oh0GGF$J+tp[(.IU1MivAB/sr;>4');
define('NONCE_SALT',       'gndZHl:!7*{T22yK6|1x]>+ t4(d6 E,E|/RO[ilcPqvz:LQtUT]L#!0xQW`}-+J');

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
