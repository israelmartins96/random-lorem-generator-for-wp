<?php

/**
 * Fired during plugin activation.
 * 
 * @since 0.1.0
 * 
 * @package Random_Lorem_Generator
 * @subpackage Random_Lorem_Generator/Includes
 * @version 1.0.0
 */

namespace Random_Lorem_Generator\Includes\Base;

/**
 * Fired during plugin activation.
 * 
 * This class defines all code necessary to run during the plugin's activation.
 * 
 * @since 0.1.0
 * @package Random_Lorem_Generator
 * @subpackage Random_Lorem_Generator/Includes
 * @author Lightbulb Devs <dev@lightbulbdevs.com>
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