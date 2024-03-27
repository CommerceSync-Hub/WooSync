add_action( 'wp_ajax_generate_api_key', 'generate_api_key_callback' );
function generate_api_key_callback() {
    // Itt generálhatod az új API kulcsot és mentheted az adatbázisba

    // Válaszként visszaadhatod az új kulcsot
    $new_key = 'generated_key';
    echo $new_key;

    wp_die(); // Mindig fontos a wp_die hívása a WordPress AJAX kérésekben
}

add_action( 'wp_ajax_reset_api_key', 'reset_api_key_callback' );
function reset_api_key_callback() {
    check_ajax_referer( 'woosync_reset_key_nonce', 'security' );

    // Itt törölheted az adatbázisból az API kulcsot

    // Válaszként visszaadhatod a sikeres reset üzenetet
    echo 'API key reset successful';

    wp_die(); // Mindig fontos a wp_die hívása a WordPress AJAX kérésekben
}
