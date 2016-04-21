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
define('DB_NAME', 'insurance_house_dev');

/** MySQL database username */
define('DB_USER', 'php');

/** MySQL database password */
define('DB_PASSWORD', 'php!2012');

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
define('AUTH_KEY',         'TkT4 6^A~o<&KS~(G]-DKO5!V?[yU6u~{AN3G6toUEPl@6:]Tm`+.yWZ_;oT2n-N');
define('SECURE_AUTH_KEY',  ')K3`KR^kp }aEE9nh+no`~tE|HwgVfJB{/LnsPf*e+isqdN)o<-6=Z9t{aqFu] W');
define('LOGGED_IN_KEY',    'sy*WUMKe^<#Ssw.UuwTipiV9/cG$AgSuU@=BM4G1_K@_lmoUr}-olp+Lj=V.$DT ');
define('NONCE_KEY',        '|Ky&X*i61yWnJ@@ZpJg29>A`@|psLo{trl(khM}|`4B&;;A7]yqZ;#}(,]8WZGHC');
define('AUTH_SALT',        'TcX +RsuA_1|[=)08&;M6D#}wcqC[P/H~6wLKWoP]{A&M<{1u[w#{%30DA-SD8oq');
define('SECURE_AUTH_SALT', '6)ta+6MS6~~0w,i?zd>{13Rb!8$OAN+?f8SUXf:]+:z:8%{a))^?7tE#Bvofq MI');
define('LOGGED_IN_SALT',   '1?+i%R|;+f-q6VF!-D-V-+C}9=-qW+/eMmeS+2V[bM_kR)_hXw;0|R-O9 rM%0Jt');
define('NONCE_SALT',       ' vUsH10hBM:5,Q,ADlu|[jq1|R/UfflULD6/|WmYt)Q3@C-AF@yi,Bpt8M#}&nF*');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'fhg_fh_';

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
define('FS_METHOD','direct');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');//Disable File Edits
define('DISALLOW_FILE_EDIT', true);


define ('EMPTY_TRASH_DAYS', 7);
define( 'WP_POST_REVISIONS', 3 );