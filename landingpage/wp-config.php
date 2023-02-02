<?php
define( 'WP_CACHE', true );
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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u610515881_XoxEn' );

/** Database username */
define( 'DB_USER', 'u610515881_pe1Sa' );

/** Database password */
define( 'DB_PASSWORD', 'i9bnE6vnT9' );

/** Database hostname */
define( 'DB_HOST', 'mysql' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'CAUu;GrlQbk^73e4fNQNbn}xP )3zflU`lW$F6H0 EnNWD_Y5#G*w|qos+(io7Q-' );
define( 'SECURE_AUTH_KEY',   'z=fghYe!<H{kFa`p~jW7!EeA5`wX*.$Q2oUb-wXZL`1XR?Bb.<V4}ko5VXY{ee(G' );
define( 'LOGGED_IN_KEY',     '%e+>04Pa3#0Wyf_pq2F(I7N$+x,/(<5I.*-K<7C#b~9d4UC)$YM#pA,=5*gjw28w' );
define( 'NONCE_KEY',         'y@[fq{W0R|qKRt:nP>) 7nGFFWXv*R4FT6|4316[C2T+M}Wt_NS*RS#~7qW)`q@A' );
define( 'AUTH_SALT',         'm]YlOpyNC},ibV-<gYsuo*/t>#O(Wn26)gz@.PZdXp2eV1`yFQ1a9xL}2+_6`Z7&' );
define( 'SECURE_AUTH_SALT',  'R6I>[l>x|_li{waWPYwE`?91?hB:$`ew?1 9ygqdOJj(abyM6JC>6=*8y/(c$??2' );
define( 'LOGGED_IN_SALT',    '2%28aS[ZlPrd;-i3~6Im[t1Fu}7TxVc]8lswa?0GN!L&KThya@FMCuhe0TP&V<t[' );
define( 'NONCE_SALT',        'W:.T4luH9(iE``Z-F7a;oDQzWcio009hL$S3CDRs<by3)^Kzyu2A-L]/A.z[!i6W' );
define( 'WP_CACHE_KEY_SALT', 'n5<!FfUBR<JN[u>J_*@GmxONC.CZ5F9k!tLv4 u7tr{!tVHQaB#!$UT*ie65_b[w' );


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


/* Add any custom values between this line and the "stop editing" line. */



define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
