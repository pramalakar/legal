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
define('DB_NAME', 'legal');

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
define('AUTH_KEY',         '>~rDhY~2Fv#d#(81e9$EmH;9G@t}%:5v_x;eJGD3)YRj~6l{4/xKIQQ}*U_(kMx<');
define('SECURE_AUTH_KEY',  'Nv-8%R/0Y6hbg:LjUM}Y):4vh~l@v+dS^6Lp/daH$j+|I_y,^Ck)u*FvZuH,RsXE');
define('LOGGED_IN_KEY',    'j%hi*T%dQ*e2ymSC5=>)7{-pgqfTXJyskc?_Z?[YYXABqll|caD.RmnOd1aK$-H7');
define('NONCE_KEY',        'A^s1PLT{Qv/&l_Msoid/okVleH}=e*efy8:Hn>ypS{%h{XAa]W.[%/BPiSG )d1|');
define('AUTH_SALT',        'ujk?[}RK0u*HxCUG4v^@B6@zo-vr 9ok|R_%GXz3R-WqadcUflGKo/$cD8V`JIYV');
define('SECURE_AUTH_SALT', 'C*xNzyC+*=^ huDdY_=Or<nG0i/22`J3UKYLjj1rh2g9.PP|O-}5;BOGj^Y44>=c');
define('LOGGED_IN_SALT',   '7{q}`GFg$C8,KPg,^H_u$/s&lbB7v27wT9^]7AMKuMEH@Z=S(P*XP/`%vPx*-pYj');
define('NONCE_SALT',       '>n@|-rWps8M]q_@D$%)45`a!~X0@yZVg//mw-/xTPNR3M>[_%b2PjsCkvqH&!A8m');

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
