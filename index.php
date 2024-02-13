<?php
/**
 * Plugin Name: WooSync
 * Description: A plugin to synchronize products from a desktop application to WooCommerce.
 * Version: 1.0.0
 * Author: Teszáry Péter
 * Text Domain: woosync
 * Domain Path: /languages
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants.
define('WOOSYNC_VERSION', '1.0.0');
define('WOOSYNC_PATH', plugin_dir_path(__FILE__));
define('WOOSYNC_URL', plugin_dir_url(__FILE__));

// Include necessary files.
require_once WOOSYNC_PATH . 'includes/class-sync.php';
require_once WOOSYNC_PATH . 'includes/class-authentication.php';

// Initialize the plugin.
function woosync_init() {
    // Initialize sync functionality.
    $sync = new WooSync_Sync();
    $sync->init();

    // Initialize authentication functionality.
    $authentication = new WooSync_Authentication();
    $authentication->init();
}
add_action('plugins_loaded', 'woosync_init');