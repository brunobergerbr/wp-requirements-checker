<?php
/**
 * Plugin Name: WP Version Checker
 * Plugin URI:  https://brunoberger.com/plugins/wp-version-checker
 * Description: Checks if you're using the latest WordPress version or not.
 * Version:     1.0.0
 * Author:      Bruno Berger
 * Author URI:  https://github.com/brunobergerbr
 * License:     GPL-3.0+
 * License URI: https://www.gnu.org/licenses/gpl-3.0.txt
 *
 * Text Domain: wp-version-checker
 * Domain Path: /languages
 *
 * @package wp-version-checker
 */

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

define( 'WPVC_VERSION', '1.0.0.' );

require_once dirname( __FILE__ ) . '/includes/class-wp-version-checker.php';

$wpvc = new WP_Version_Checker();

if ( is_admin() ) {
	add_action( 'admin_init', [ $wpvc, 'init' ] );
}
