<?php

/**
 * Fired during plugin deactivation.
 * 
 * @since 0.1.0
 * 
 * @package LoremPress
 * @subpackage LoremPress/Includes
 */

namespace LoremPress\Includes\Base;

/**
 * Fired during plugin deactivation.
 * 
 * This class defines all code necessary to run during the plugin's deactivation.
 * 
 * @since 0.1.0
 * @package LoremPress
 * @subpackage LoremPress/Includes
 * @author Israel Martins <hello@israelmartins.com>
 */
class Deactivator {
    
    /**
     * Ensures that WordPress rewrite rules are refreshed when the plugin is deactivated.
     *
     * @since 0.1.0
     */
    public static function deactivate() {
        flush_rewrite_rules();
    }

}