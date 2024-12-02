<?php


/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'srv157755_meth' );

/** Database username */
define( 'DB_USER', 'srv157755_meth' );

/** Database password */
define( 'DB_PASSWORD', 'drema22722' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         '/FW-xo}*rL?#ny=T4h#Do]AT|4WLWZK`)3PC[W:Q!lFl,N!TC3tv:*IgwNLa?6Ky' );
define( 'SECURE_AUTH_KEY',  'taaIb[Gm$x7rM3GF6KxSS=mV.V0no|HO*[c:8A*tt0WcD$A; Q9&x=p]iQTz!QbN' );
define( 'LOGGED_IN_KEY',    'IEl&;B9!YZ*s7O/cfm2tbadq,~L{?OC-G49DtR:xN.Fy/$MEu?#Y=:U9?GHP% YQ' );
define( 'NONCE_KEY',        '@97S`[BE @Kq=_jR^:=C]v#K1`s|P:qW0`l-B3zC&J!Yb</ #7d`m,bgu=^AZ^@V' );
define( 'AUTH_SALT',        '3>WW;66~7s4-BZnwz^U)zCor|FcikL<cL(/~m-xIPwdw!%v?[7USoKg&bhO_{vz-' );
define( 'SECURE_AUTH_SALT', '5LJjl0[:L+I1-%48yh@D|c[/0ls:[mZFzD2e;;+R[AY&>u8$J 1/>lk1S*<v&q9b' );
define( 'LOGGED_IN_SALT',   ' OxWk)~xDF-?M0%ao1%*m:bE%9U=8Geu6&bbli1JY[MT+|{oN1znjC=l`)aLXQ?B' );
define( 'NONCE_SALT',       '$lRqsWx|$(,NOtIk[K&blV1`cPE<8tq& 0n5ZrzNVG>XI%eeq4A}xpLf@r75$i[b' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', '/tmp/wp-errors.log' );
define( 'AUTOMATIC_UPDATER_DISABLED', true );


/* Add any custom values between this line and the "stop editing" line. */


// define('ALLOW_UNFILTERED_UPLOADS', true);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
