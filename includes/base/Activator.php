<?php

/**
 * Fired during plugin activation.
 * 
 * @since 0.1.0
 * 
 * @package LoremPress
 * @subpackage LoremPress/Includes
 */

namespace LoremPress\Includes\Base;

/**
 * Fired during plugin activation.
 * 
 * This class defines all code necessary to run during the plugin's activation.
 * 
 * @since 0.1.0
 * @package LoremPress
 * @subpackage LoremPress/Includes
 * @author Israel Martins <hello@israelmartins.com>
 */
class Activator {
    
    /**
     * Ensures that WordPress rewrite rules are refreshed when the plugin is activated.
     *
     * @since 0.1.0
     */
    public static function activate() {
        flush_rewrite_rules();
    }

}