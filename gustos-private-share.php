<?php
/*
Plugin Name: [Gustos] - Share private recipes
Plugin URI: http://gustos.xyz/
Description: Share private recipes. This is an extension for <a href="http://bit.ly/get-gustos">Gustos Theme</a>
Author: Andrei Surdu
Version: 1.0.0
Author URI: http://zerowp.com/
Text Domain: gustos-private-share
Domain Path: /lang
*/

define('SPRG_VERSION', '1.0.0');

/* No direct access allowed!
---------------------------------------------------------------------------- */
if ( ! defined('ABSPATH')) {
    exit;
}

/* Plugin constants
---------------------------------------------------------------------------- */
define('SPRG_PLUGIN_FILE', __FILE__);
define('SPRG_PLUGIN_BASENAME', plugin_basename(__FILE__));
define('SPRG_PATH', plugin_dir_path(__FILE__));
define('SPRG_URL', plugin_dir_url(__FILE__));

/* Hook after the classes from "Gustos" theme are loaded
---------------------------------------------------------------------------- */
add_action('gustos_autoload', function () {
    Awps\Loader::loadClasses(SPRG_PATH . 'src', 'GustosPrivateShare');

    require_once SPRG_PATH . 'hooks.php';
});
