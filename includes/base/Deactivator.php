<?php

/**
 * Fired during plugin deactivation.
 * 
 * @since 0.1.0
 * 
 * @package Random_Lorem_Generator
 * @subpackage Random_Lorem_Generator/Includes
 * @version 1.0.0
 */

namespace Random_Lorem_Generator\Includes\Base;

/**
 * Fired during plugin deactivation.
 * 
 * This class defines all code necessary to run during the plugin's deactivation.
 * 
 * @since 0.1.0
 * @package Random_Lorem_Generator
 * @subpackage Random_Lorem_Generator/Includes
 * @author Lightbulb Devs <dev@lightbulbdevs.com>
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