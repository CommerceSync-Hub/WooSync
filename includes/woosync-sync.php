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
   
    return true; 
}

function syncUsers() {
   
    return false; 
}
?>
