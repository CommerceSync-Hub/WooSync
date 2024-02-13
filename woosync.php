<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <form method="post" action="options.php">
        <?php settings_fields('woosync_settings_group'); ?>
        <?php do_settings_sections('woosync_settings_page'); ?>
        <?php submit_button(); ?>
    </form>
</div>

<?php
// Add hidden field to trigger cron event
echo '<input type="hidden" id="woosync_cron_trigger" name="woosync_cron_trigger" value="1">';
?>

<script>
// Trigger cron event when page is loaded
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('woosync_cron_trigger').click();
});
</script>
