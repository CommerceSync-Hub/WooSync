<div class="woosync-header">
    <div class="woosync-logo">
        <img src="<?php echo plugins_url( '../assets/commercesync-logo.png', __FILE__ ); ?>" alt="Woosync logo">
    </div>
    <nav class="woosync-menu">
            <ul>
                <li><a href="?page=woosync-info">Info</a></li>
                <li><a href="?page=woosync-authentication">Authentication</a></li>
                <li><a href="?page=woosync-settings">Settings</a></li>
                <li><a href="https://github.com/orgs/CommerceSync-Hub/repositories" target="_blank">Download Desktop</a></li>
                <li><a href="https://github.com/orgs/CommerceSync-Hub/repositories" target="_blank"><i class="fab fa-github"></i>GitHub</a></li>
                <li><a href="https://commercesync-hub.github.io/commerce-sync-docs/" target="_blank">Doc</a></li>
            </ul>
    </nav>
</div>

<div class="wrap container">
  <h1>WooSync Cron Jobs</h1>
  <p class="text--info-large">You can set the Cron Jobs here for syncing the Product Bridge (Desktop) and the WordPress Database.</p>
  <form method="post" action="options.php">
    <?php settings_fields('woosync_settings'); ?>
    <table class="table">
      <tbody>
        <!-- API kulcs rész eltávolítva -->
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
    <!-- "Save Settings" gomb változatlan -->
    <button type="submit" class="btn--woosync mb-3" id="save-settings">Save Settings</button>
    <!-- "Sync Now" gomb hozzáadása -->
    <button type="button" class="btn--woosync mb-3 ml-3" id="sync-now">Sync Now</button>
  </form>
</div>

<!-- JavaScript kód a Sync Now gomb működéséhez -->
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
