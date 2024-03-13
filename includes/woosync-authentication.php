<div class="wrap">
  <h1>WooSync Settings</h1>
  <?php 
  $existing_key = get_option( 'woosync_api_key' );
  if ( $existing_key ) : ?>
    <p>Your API Key: <?php echo esc_html( $existing_key ); ?></p>
    <button class="copy-api-key-btn" data-api-key="<?php echo esc_attr( $existing_key ); ?>">Copy API Key</button>
    <form method="post" action="">
      <input type="hidden" name="woosync_reset_key" value="1">
      <button type="submit" class="reset-api-key-btn">Reset API Key</button>
    </form>
  <?php else: ?>
    <button id="generate-api-key-btn">Generate API Key</button>
  <?php endif; ?>
</div>
