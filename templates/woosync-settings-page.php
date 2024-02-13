// Initialize the plugin
function woosync_init() {
    // Initialize sync functionality
    $sync = new WooSync_Sync();
    $sync->init();

    // Initialize authentication functionality
    $authentication = new WooSync_Authentication();
    $authentication->init();

    // Add settings page
    add_action('admin_menu', 'woosync_add_settings_page');

    // Register plugin settings
    add_action('admin_init', 'woosync_register_settings');
}
add_action('plugins_loaded', 'woosync_init');

// Add settings page
function woosync_add_settings_page() {
    add_options_page('WooSync Settings', 'WooSync', 'manage_options', 'woosync_settings_page', 'woosync_settings_page_callback');
}

// Settings page callback
function woosync_settings_page_callback() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields('woosync_settings_group'); ?>
            <?php do_settings_sections('woosync_settings_page'); ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Register plugin settings
function woosync_register_settings() {
    register_setting('woosync_settings_group', 'woosync_cron_interval');

    add_settings_section('woosync_cron_section', 'Cron Schedule', 'woosync_cron_section_callback', 'woosync_settings_page');

    add_settings_field('woosync_cron_interval', 'Select Sync Interval', 'woosync_cron_interval_callback', 'woosync_settings_page', 'woosync_cron_section');
}

// Cron section callback
function woosync_cron_section_callback() {
    echo 'Select how often you want to synchronize the database:';
}

// Cron interval dropdown callback
function woosync_cron_interval_callback() {
    $cron_interval = get_option('woosync_cron_interval', 'daily');
    ?>
    <select name="woosync_cron_interval">
        <option value="hourly" <?php selected($cron_interval, 'hourly'); ?>>Hourly</option>
        <option value="daily" <?php selected($cron_interval, 'daily'); ?>>Daily</option>
        <option value="twicedaily" <?php selected($cron_interval, 'twicedaily'); ?>>Twice Daily</option>
        <option value="weekly" <?php selected($cron_interval, 'weekly'); ?>>Weekly</option>
    </select>
    <?php
}
