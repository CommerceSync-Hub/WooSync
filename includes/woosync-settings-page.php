<?php

// Ensure no output is sent before the buffer starts (prevents unexpected output errors)
ob_start();

// Check if accessed directly
if (!defined('ABSPATH')) {
  exit;
}

// Function to add settings page (definition moved here)
function woosync_add_settings_page() {
  add_options_page('WooSync Settings', 'WooSync', 'manage_options', 'woosync_settings_page', 'woosync_render_settings_page');
  // Hook the function to admin_page_hook (recommended)
  add_action('admin_page_hook', 'woosync_add_settings_page');
}

// Function to register settings
function woosync_register_settings() {
  register_setting( 'woosync_settings', 'woosync_api_key' );
  register_setting( 'woosync_settings', 'woosync_sync_interval' ); // Add other settings as needed
}

// Function to render the settings page
function woosync_render_settings_page() {
  // Flush any potential output buffering before rendering the page
  ob_flush();
  ?>
  <div class="wrap">
    <h1>WooSync Settings</h1>
    <form method="post" action="options.php">
      <?php settings_fields('woosync_settings'); ?>
      <table class="form-table">
        <tbody>
          <tr>
            <th scope="row"><label for="woosync_api_key">API Key</label></th>
            <td><input type="text" name="woosync_api_key" id="woosync_api_key" value="<?php echo esc_attr(get_option('woosync_api_key')); ?>" class="regular-text"></td>
          </tr>
          <tr>
            <th scope="row"><label for="woosync_sync_interval">Sync Interval</label></th>
            <td>
              <select name="woosync_sync_interval" id="woosync_sync_interval">
                <option value="1" <?php selected(get_option('woosync_sync_interval'), '1'); ?>>Hourly</option>
                <option value="6" <?php selected(get_option('woosync_sync_interval'), '6'); ?>>Every 6 Hours</option>
                <option value="12" <?php selected(get_option('woosync_sync_interval'), '12'); ?>>Daily</option>
              </select>
            </td>
          </tr>
        </tbody>
      </table>
      <?php submit_button('Save Settings'); ?>
    </form>
  </div>
  <?php
}

// Capture any remaining output and discard it (prevents unexpected output errors)
ob_end_clean();