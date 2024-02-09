<?php
// Ha az fájl nem közvetlenül lett elérve a WordPressen keresztül, akkor ne hajtsa végre a műveletet
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Törölje a bővítmény által létrehozott beállításokat a WordPress beállításokból
delete_option('woosync_cron_interval');

// Egyéb tisztítási műveletek, például adatbázis táblák törlése, ha szükséges
global $wpdb;
$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}woosync_products");

// Ha más specifikus műveleteket kell végrehajtani, akkor itt lehet őket hozzáadni

