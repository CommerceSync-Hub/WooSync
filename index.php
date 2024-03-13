<?php
/**
 * Plugin Name: WooSync
 * Description: A plugin to synchronize products from a desktop application to WooCommerce.
 * Version: 1.0.1
 * Author: Teszáry Péter
 * Text Domain: woosync
 * Domain Path: /languages
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// Kilépés közvetlen hozzáférés esetén.
if (!defined('ABSPATH')) exit;

class WooSync {
  function __construct() {
    add_action('admin_menu', array($this, 'ourMenu'));
    register_activation_hook(__FILE__, array($this, 'plugin_activation'));
    add_action('admin_init', array($this, 'register_settings'));
    add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
    add_action('wp_ajax_generate_api_key', array($this, 'generate_api_key_callback'));
    add_action('wp_ajax_reset_api_key', array($this, 'reset_api_key_callback'));

    // AJAX hívás a szinkronizációhoz és változások ellenőrzéséhez
    add_action('wp_ajax_sync_and_check_changes', array($this, 'sync_and_check_changes_callback'));
  }

  function ourMenu() {
    add_menu_page('WooSync', 'WooSync', 'manage_options', 'ourwoosyncplugin', array($this, 'woosyncSettingsPage'), 'dashicons-smiley', 111);
    add_submenu_page('ourwoosyncplugin', 'WooSync Authentication', 'Authentication', 'manage_options', 'woosync-authentication', array($this, 'woosyncAuthPage'));
    add_submenu_page('ourwoosyncplugin', 'WooSync Settings', 'Options', 'manage_options', 'woosync-settings', array($this, 'settingsSubPage'));
  }

  function plugin_activation() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'woosync_api_keys';
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      api_key varchar(255) NOT NULL,
      PRIMARY KEY  (id)
    ) $charset_collate;";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
  }

  function register_settings() {
    register_setting('woosync_settings', 'woosync_api_key');
    register_setting('woosync_settings', 'woosync_sync_interval');
    // Új beállítás a perces szinkronizációs időtartamhoz
    register_setting('woosync_settings', 'woosync_sync_interval_minutes');
  }

  function enqueue_scripts() {
    //Saját stíluslap hozzáadása
    wp_enqueue_style('woosync-css', plugin_dir_url(__FILE__) . 'css/woosync.css', array(), '1.0');

    // BootStrap CSS hozzáadása
    wp_enqueue_style('bootstrap-css', plugin_dir_url(__FILE__) . 'css/bootstrap.min.css', array(), '5.3.0');

    // Plugin JavaScript hozzáadása
    wp_enqueue_script('woosync-script', plugin_dir_url(__FILE__) . 'js/woosync-script.js', array('jquery'), '1.0', true);

    // BootStrap JavaScript hozzáadása
    wp_enqueue_script('bootstrap-js', plugin_dir_url(__FILE__) . 'js/bootstrap.min.js', array('jquery'), '5.3.0', true);

    // Lokalizáció az AJAX hívásokhoz
    wp_localize_script('woosync-script', 'woosync_ajax_obj', array(
      'ajax_url' => admin_url('admin-ajax.php'),
      'security' => wp_create_nonce('woosync_ajax_nonce')
    ));
  }

  function woosyncSettingsPage()
  {
  ?>
    This is the WooSync Page I have to add more text.
  <?php }

  function settingsSubPage()
  {
    include_once(plugin_dir_path(__FILE__) . 'includes/woosync-settings-page.php');
  }

  function woosyncAuthPage()
  {
    include_once(plugin_dir_path(__FILE__) . 'includes/woosync-authentication.php');
  }

  function generate_api_key_callback()
  {
    // Generate a random API key
    $api_key = wp_generate_password(32, false);

    // Save the API key in the database
    update_option('woosync_api_key', $api_key);

    // Return the generated API key
    echo '<div class="wrap">
            <p>Your API Key: ' . esc_html($api_key) . '</p>
            <button class="copy-api-key-btn" data-api-key="' . esc_attr($api_key) . '">Copy API Key</button>
            <form method="post" action="">
              <input type="hidden" name="woosync_reset_key" value="1">
              <button type="submit" class="reset-api-key-btn">Reset API Key</button>
            </form>
          </div>';

    // It's important to exit after echoing the response
    wp_die();
  }

  function reset_api_key_callback()
  {
    delete_option('woosync_api_key');
    echo '<div class="wrap">
            <p>API Key reset successfully.</p>
            <button id="generate-api-key-btn">Generate API Key</button>
          </div>';
    wp_die();
  }

  // Szinkronizáció és változások ellenőrzése
  function sync_and_check_changes_callback() {
    include_once(plugin_dir_path(__FILE__) . 'includes/woosync-sync.php');

    // Szinkronizáció és változások ellenőrzése
    $result = syncAndCheckChanges();

    // AJAX válasz küldése a kliensnek
    wp_send_json_success($result);
    

  }
}

new WooSync();
?>
