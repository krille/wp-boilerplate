<?php
/**
 * Default config settings
 *
 * Enter any WordPress config settings that are default to all environments
 * in this file.
 *
 * Please note if you add constants in this file (i.e. define statements)
 * these cannot be overridden in environment config files so make sure these are only set once.
 *
 */


/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'sZc/J4Wk1PB8kuM2hghkcncj8efXs6L1pxUlwk2nkp83r56iV6/WS9byGOXK/PbTBZXm5KrIXxCnaLF3L6SFyQ==');
define('SECURE_AUTH_KEY',  'MC9vRNgMFtlNkTGsC7Tn/CF6L9aat9hliP4kMTwLWhRktrTjYbunrPDpAdwFMA9fhZ0U4tgwbncITHQwIA6pnQ==');
define('LOGGED_IN_KEY',    'CXiqppoXDRAZMhhbb7Gqe79Y7ouNyW0vo/qPM2zBm+wGuRm1b8wZEyf71HVJfLWb5OvNEB/i+AA1Jcz/+r1ADg==');
define('NONCE_KEY',        'b6SSNw1CoKIqXuvhDCxc0WtwCYilhGwwsH3mVczZSrxf8vIraFAM3vXKeaXSfOBEtsNG8nISS6es3f71FOL38Q==');
define('AUTH_SALT',        'TkF1LBY8DEzOYhEVAOHz4NTMI0/rqegpgvAMDOuqhi90yyMsUARYSLieBLoRUuS4cMBc4hUzjJ8eA1Kr3BmnjQ==');
define('SECURE_AUTH_SALT', 'QpkzyYt4eVQJ2T/JuUyC6VAJAoireADo4ba9Jd52yvrie7m+Yw20XVts37ilsPTANWobSVeM6WXPL/Xw2iw7vQ==');
define('LOGGED_IN_SALT',   'LQB2KLxXMoVN+PbYRirriRq+Ze+YnKi6PAYHbYVLzO7zqh3QhgzfBbowXzgvVVCNEmUPlovRsPtG2J5k36AtKA==');
define('NONCE_SALT',       'nTX9G1PIGv0h4wLy3bh5gMJvNx/d0foa854GFZR1730MPmje7cDg92XhMn4h1TA3BS6jiiicH7ZFmVxaaY9iqw==');

/**#@-*/


/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * Increase memory limit.
 */
define('WP_MEMORY_LIMIT', '64M');
