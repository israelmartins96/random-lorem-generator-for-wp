<?php

/**
 * Core initialiser for the LoremPress plugin.
 * 
 * This file is responsible for gathering and registering all the essential
 * service classes that comprise the plugin's functionality.
 * 
 * @since 1.0.0
 * 
 * @package LoremPress
 * @subpackage LoremPress/Includes
 * @version 1.0.0
 */

namespace LoremPress\Includes;

/**
 * Main initialiser class for the LoremPress plugin.
 * 
 * This class orchestrates the registration of all plugin services,
 * ensuring that all components are properly set up and hooked into WordPress.
 * 
 * @since 1.0.0
 * @package LoremPress
 * @subpackage LoremPress/Includes
 * @author Israel Martins <hello@israelmartins.com>
 */
final class Init {
    
    /**
     * Store all classes in an array.
     * 
     * These classes are intended to be instantiated and have their
     * register method called during the plugin's initialisation.
     * 
     * @return      array full list of classes.
     * @since       1.0.0
    */
    public static function get_services() {
        $services = array(
            \LoremPress\Includes\Base\Enqueue::class,
            \LoremPress\Includes\Shortcodes\LoremPress_Shortcode::class
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
     * @param       class $class
     * @return      class new instance of the class
     * @since       1.0.0
    */
    private static function instantiate( $class ) {
        $service = new $class();

        return $service;
    }

}