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
define('DB_NAME', 'boise');

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

define( 'ALLOW_UNFILTERED_UPLOADS', true );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '_w)=`<yR]2^$U:TR!W*;Arb()e~}*eS0+:c|RZQo.aA;-r{N19,1C;rlstS;^7E7');
define('SECURE_AUTH_KEY',  'eJ/w3Wj4&V_;VTQXEb_6hC+.bDK%k+a{;#+[Ch?u2l4yM!9A&,KpgpJTL 1CY:;h');
define('LOGGED_IN_KEY',    '|hXd7ITW&a2WZ<?iUAH~t|#d8;e[?2@X%/}FM*TOu`?A!0DB.txdrWx}un fJb3g');
define('NONCE_KEY',        'vkypBb5TzW^uc!zn<vpZ%y7 &opN(O~t5HBa86jGqq16:ffBv$5;EY3{# UF [@P');
define('AUTH_SALT',        'jd}cZ6T4^~(0A@<>SPvi7P;&Wg*LfQ,{ny7B]i?Z<AHMqNe8)H5=o4{8}l1oidH?');
define('SECURE_AUTH_SALT', 'cIQJA 9l{F9Og8fyeuF/o},Zhn<=va):|1x.i*2X<X(R(5m1/|.pRDI$$>eO2-oM');
define('LOGGED_IN_SALT',   'R@)OQu{#Bv8hGwFn0V+>PM+:>!FOCnq:OwOPU%3U*6IB07IT@$sV3EM#nx`zM>$s');
define('NONCE_SALT',       '$gp.G{GRnUnqtaGE[3J|h m**1<SBs)K3ImQnn8ApUhUv$Fx7d6vQZ&$Dqa7sTsO');

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
