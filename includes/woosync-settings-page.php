<div class="wrap container">
  <h1>WooSync Cron Jobs</h1>
  <p class="text--info-large">You can set the Cron Jobs here for syncing the Product Bridge (Desktop) and the WordPress Database.</p>
  <form method="post" action="options.php">
    <?php settings_fields('woosync_settings'); ?>
    <table class="table">
      <tbody>
        <tr>
          <th scope="row"><label for="woosync_api_key">API Key</label></th>
          <td><input type="text" name="woosync_api_key" id="woosync_api_key" value="<?php echo esc_attr(get_option('woosync_api_key')); ?>" class="form-control"></td>
        </tr>
        <tr>
          <th scope="row"><label for="woosync_sync_interval">Sync Interval</label></th>
          <td>
            <select name="woosync_sync_interval" id="woosync_sync_interval" class="form-control">
              <option value="1" <?php selected(get_option('woosync_sync_interval'), '1'); ?>>Hourly</option>
              <option value="6" <?php selected(get_option('woosync_sync_interval'), '6'); ?>>Every 6 Hours</option>
              <option value="12" <?php selected(get_option('woosync_sync_interval'), '12'); ?>>Daily</option>
              <option value="128" <?php selected(get_option('woosync_sync_interval'), '128'); ?>>Weekly</option>
              <option value="60" <?php selected(get_option('woosync_sync_interval'), '60'); ?>>Every Minute</option>
            </select>
          </td>
        </tr>
        <tr id="minute-input-row" style="display: none;">
          <th scope="row">Sync Interval (in minutes)</th>
          <td>
            <input type="number" name="woosync_sync_interval_minutes" id="woosync_sync_interval_minutes" value="<?php echo esc_attr(get_option('woosync_sync_interval_minutes')); ?>" class="form-control" min="1">
          </td>
        </tr>
      </tbody>
    </table>
    <button type="button" class="btn btn-primary mb-3" id="save-settings"><?php submit_button('Save Settings', 'primary', 'submit', false); ?></button>
  </form>
  <button type="button" class="btn btn-success" id="sync-now">Sync Now</button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var syncIntervalSelect = document.getElementById('woosync_sync_interval');
  var minuteInputRow = document.getElementById('minute-input-row');

  syncIntervalSelect.addEventListener('change', function() {
    if (this.value === '60') {
      minuteInputRow.style.display = 'table-row';
    } else {
      minuteInputRow.style.display = 'none';
    }
  });

  document.getElementById('sync-now').addEventListener('click', function() {
    // Végrehajtjuk a szinkronizációt és visszajelzést adunk a felhasználónak
    alert('Syncing Now...');
    // Itt kell megvalósítani a szinkronizációt és az eredmény ellenőrzését
    // Ha változás történt, akkor vissza kell adni a felhasználónak
    // Ha nincs változás, akkor is vissza kell adni a felhasználónak, hogy nincs változás
  });
});
</script>
