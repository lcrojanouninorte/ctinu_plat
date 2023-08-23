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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'inndico_wp' );
define('CONCATENATE_SCRIPTS', false); 

/** Database username */
/** MySQL database username */
define( 'DB_USER', 'lcrojano' );

/** MySQL database password */
define( 'DB_PASSWORD', '23VeCeS***' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
define('FS_METHOD', 'direct');
define('JWT_AUTH_SECRET_KEY', '23VeCeS***');
define('JWT_AUTH_CORS_ENABLE', true);
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
	define('AUTH_KEY',         'gTM{A6mz-_unvEi,f|beO*rZ,If1mf#*87>~_NtLH&>3p7xL0aNW,-FY#+$/z$*Z');
	define('SECURE_AUTH_KEY',  'XlAp0?^Ks@}C`H- )t2fVR{7|zy@qC4jBOD&@/Ga^l?}{]Wc%X<dKwl`&g,9i_i5');
	define('LOGGED_IN_KEY',    'Stt2I/p7Rzj3WLFDqNsH6:u/cYV``i|-dg|t0=.ck:*UPQlF|^J3 VWG#P T-5;1');
	define('NONCE_KEY',        ':@1Y*`u`{jZN|i|.D%1D39lux^Fh6cW8I/:GC7s~lFwXO4Pf3{yBE_RFI@&P*K=^');
	define('AUTH_SALT',        '[+plx&6+PG[nQ33c.TXA[T]dQ^;|P3k#B8F*|++W+]`TIHDC4hvG<C=Sa+w^D0C|');
	define('SECURE_AUTH_SALT', 'WU9i3eS>+{U}%SICY`BU|Ca-)(ePrS^vm|s_XmvjE~=1?:D8-[W>Wyih--)g:2#s');
	define('LOGGED_IN_SALT',   'J-kn!{-k4f00S;;)oQ!t6[@T-!gQ-Dn$$x4[.eEDD(PAP&^sDU9`P)=Jzx.|y9&|');
	define('NONCE_SALT',       '.@A?|F^Bxi[+wHve>gFQ8;EuQB=T@3}bUpY*y**QhO[5bf-60#FW]M2)K,5v^IAJ');

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



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
