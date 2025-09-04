<?php

/**
 * Core initialiser for the Random Lorem Generator plugin.
 * 
 * This file is responsible for gathering and registering all the essential
 * service classes that comprise the plugin's functionality.
 * 
 * @since 1.0.0
 * 
 * @package Random_Lorem_Generator
 * @subpackage Random_Lorem_Generator/Includes
 * @version 1.0.0
 */

namespace Random_Lorem_Generator\Includes;

/**
 * Main initialiser class for the Random Lorem Generator plugin.
 * 
 * This class orchestrates the registration of all plugin services,
 * ensuring that all components are properly set up and hooked into WordPress.
 * 
 * @since 1.0.0
 * @package Random_Lorem_Generator
 * @subpackage Random_Lorem_Generator/Includes
 * @author Lightbulb Devs <dev@lightbulbdevs.com>
 */
final class Init {
    
    /**
     * Store all classes in an array.
     * 
     * These classes are intended to be instantiated and have their
     * register method called during the plugin's initialisation.
     * 
     * @since       1.0.0
     * @return      array full list of classes.
    */
    public static function get_services() {
        $services = array(
            \Random_Lorem_Generator\Includes\Base\Enqueue::class,
            \Random_Lorem_Generator\Includes\Shortcodes\Random_Lorem_Shortcode::class
        );
        
        return $services;
    }
    
    /**
     * Loop through classes, initialise each, and call the register method if it exists.
     * 
     * This method is the entry point for activating the functionalities
     * defined within each service class.
     * 
     * @since       1.0.0
     * @return void
    */
    public static function register_services() {
        foreach ( self::get_services() as $class ) {
            $service = self::instantiate( $class );

            if ( method_exists( $service, 'register' ) ) {
                $service->register();
            }
        }
    }

    /**
     * Creates new instance of a class.
     * 
     * This is a helper method used internally to instantiate service classes.
     * 
     * @since       1.0.0
     * @param       class $class.
     * @return      class $service new instance of the class.
    */
    private static function instantiate( $class ) {
        $service = new $class();

        return $service;
    }

}