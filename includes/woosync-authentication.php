<div class="wrap container">
  <h1 class="mb-4">WooSync Authentication</h1>
  <p class="mb-4 text--info-large">You can generate and copy or reset your API key here. It will be stored in the database</p>
  <?php 
  $existing_key = get_option( 'woosync_api_key' );
  ?>
  <div class="card">
    <div class="card-body">
      <?php if ( $existing_key ) : ?>
        <p class="text--info">Your API Key: <?php echo esc_html( $existing_key ); ?></p>
        <button class="btn btn-success copy-api-key-btn" data-api-key="<?php echo esc_attr( $existing_key ); ?>">Copy API Key</button>
        <form method="post" action="" class="d-inline">
          <input type="hidden" name="woosync_reset_key" value="1">
          <button type="submit" class="btn btn-danger reset-api-key-btn">Reset API Key</button>
        </form>
      <?php else: ?>
        <button id="generate-api-key-btn" class="btn btn-success">Generate API Key</button>
      <?php endif; ?>
    </div>
  </div>
</div>
