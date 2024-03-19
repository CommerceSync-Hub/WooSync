<?php
function syncAndCheckChanges() {
    // Szinkronizáció a termékek adattábláival
    $product_changes = syncProducts();

    // Szinkronizáció a felhasználók adattábláival
    $user_changes = syncUsers();

    // Eredmény ellenőrzése
    if ($product_changes || $user_changes) {
        // Ha változás történt, akkor visszaadjuk az üzenetet
        return 'Sync successful! Changes detected.';
    } else {
        // Ha nincs változás, akkor is visszaadjuk az üzenetet
        return 'Sync successful! No changes detected.';
    }
}

function syncProducts() {
    global $wpdb;

    // Termékek szinkronizálása
    $external_db_connection = mysqli_connect("external_host", "external_username", "external_password", "external_database");

    if (!$external_db_connection) {
        return false;
    }

    $query = "SELECT * FROM termektabla";
    $result = mysqli_query($external_db_connection, $query);

    // A WordPress adatbázisba való szinkronizálás
    while ($row = mysqli_fetch_assoc($result)) {
        $wpdb->insert($wpdb->prefix . 'products', array(
            'column_name' => $row['column_name']
            // Adatbázis oszlopok és értékek felsorolása
        ));
    }

    mysqli_close($external_db_connection);

    return true;
}

function syncUsers() {
    global $wpdb;

    // Felhasználók szinkronizálása
    $external_db_connection = mysqli_connect("external_host", "external_username", "external_password", "external_database");

    if (!$external_db_connection) {
        return false;
    }

    $query = "SELECT * FROM felhasznalok";
    $result = mysqli_query($external_db_connection, $query);

    // A WordPress felhasználók táblába való szinkronizálás
    while ($row = mysqli_fetch_assoc($result)) {
        $wpdb->insert($wpdb->users, array(
            'user_login' => $row['user_login'],
            'user_email' => $row['user_email'],
            // Adatbázis oszlopok és értékek felsorolása
        ));
    }

    mysqli_close($external_db_connection);

    return true;
}


?>
