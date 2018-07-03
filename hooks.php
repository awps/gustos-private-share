<?php

use GustosPrivateShare\Display;
use GustosPrivateShare\Localize;
use GustosPrivateShare\Modifier;

// No direct access allowed!
if ( ! defined('ABSPATH')) {
    exit;
}

add_action('init', [new Localize(), 'add']);
add_action('init', [new Modifier(), 'addFilters']);
add_action('gustos_single_recipe_content', [new Display(), 'render'], 150);
