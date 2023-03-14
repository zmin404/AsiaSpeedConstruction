<?php
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
define( 'DB_NAME', 'as_construction' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'abwP@ssw0rd' );

/** Database hostname */
define( 'DB_HOST', 'localhost:3306' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         ' a*@wrGlLUT9B8Lh~$De6<m$^14_Kq=[/?.)np|&P!F:G~SM506iQgr{^&}u1Nb:' );
define( 'SECURE_AUTH_KEY',  'euE<aVaL34$fs1`/Jv[7YtKB_W<CPVt2bgg2pF=lS!7lJX;HtqJdro,0_X;6p  a' );
define( 'LOGGED_IN_KEY',    'hnZ$3Sj49Sui#BdkkiOV=kAK=ODN`2Tz)CiJax6{>a[xC@)~F<H%8` @)-kCQgzb' );
define( 'NONCE_KEY',        'tT_VWpzZi=6Sm-$2B(F2gylY8)weJ)H_CnZb!68$aOG0`Bc|7B%]C)qO_7N1vB]9' );
define( 'AUTH_SALT',        ' 6W1%++w/1mjt)Fiu.!7NE]z0~?fCq4p-d{jfag><9@&>3UZh8k!1-MkY#kw>ulf' );
define( 'SECURE_AUTH_SALT', ',19R4B*QcL[!L~ENC.>Q;tqb=d=6TNS/sHvD&<m%20i&-!P9X!oD2uOwI]7!O F%' );
define( 'LOGGED_IN_SALT',   'p|zJg>,8L!JpN)umRP.dq6 ;o;gC>.dq}ocSEsBh}?T5#7B9wAh;n{1K/MR7sb=+' );
define( 'NONCE_SALT',       '7DwcVUP~!y#eMA#air*Cg&U}`|WRyOxiw2!TotEw$m08lvr6v>L+IB@oT}$S9+~J' );

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
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_DISPLAY', false );
define( 'WP_DEBUG_LOG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
