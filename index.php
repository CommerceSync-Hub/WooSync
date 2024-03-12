<?php
/**
 * Plugin Name: WooSync
 * Description: A plugin to synchronize products from a desktop application to WooCommerce.
 * Version: 1.0.1
 * Author: Teszáry Péter
 * Text Domain: woosync
 * Domain Path: /languages
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */



// Kilépés közvetlen hozzáférés esetén.
if( !defined( 'ABSPATH' ) ) exit;

class WooSync 
{
  function __construct() {
    add_action( 'admin_menu', array($this, 'ourMenu') );
  } 

  function ourMenu()  {
    add_menu_page('WooSync', 'WooSync', 'manage_options', 'ourwoosyncplugin', array($this, 'woosyncSettingsPage'), 'dashicons-smiley', 111);
    add_submenu_page( 'ourwoosyncplugin', 'WooSync Authentication', 'Authentication', 'manage_options', 'woosync-authentication', array($this, 'woosyncAuthPage'));
    add_submenu_page( 'ourwoosyncplugin', 'WooSync Settings', 'Options', 'manage_options', 'woosync-settings', array($this, 'settingsSubPage'));
  }
  function woosyncSettingsPage() { ?>
     Hello World.
  <?php }

  function settingsSubPage() { ?>
    This is the Settings Sub Page
  <?php }

function woosyncAuthPage() { ?>
    This is the AUTH Sub Page
  <?php }

  }


$WooSync = new WooSync();