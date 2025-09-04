<?php

/**
 * Define the internationalization functionality.
 * 
 * Loads and defines the internationalisation files for this plugin
 * so that it is ready for translation.
 * 
 * @since 1.0.0
 * 
 * @package Random_Lorem_Generator
 * @subpackage Random_Lorem_Generator/Includes
 * @version 1.0.0
 */

namespace Random_Lorem_Generator\Includes\Base;

/**
 * Define the internationalization functionality.
 * 
 * Loads and defines the internationalisation files for this plugin
 * so that it is ready for translation.
 * 
 * @since 1.0.0
 * @package Random_Lorem_Generator
 * @subpackage Random_Lorem_Generator/Includes
 * @author Lightbulb Devs <dev@lightbulbdevs.com>
 */

class i18n {

    /**
     * Registers all the hooks necessary for the I18n class.
     * 
     * Hooks into WordPress's initialisation process to ensure
     * that the plugin's text domain is loaded early, making
     * translations available throughout the plugin.
     * 
     * @since 1.0.0
     * @return void
     */
    public function register() {
        /**
         * Load the plugin's text domain during the 'init' action.
         * 
         * Using 'init' because 'plugins_loaded' is before 'init' and 
         * is too early for loading translations.
         * 
         * @see https://developer.wordpress.org/reference/functions/load_plugin_textdomain/#comment-7183
         * @see https://developer.wordpress.org/reference/hooks/init/
         */
        add_action('init', array( $this, 'load_plugin_text_domain' ));
    }
    
    /**
     * Loads the plugin's translated strings.
     * 
     * Tells WordPress where to find the translation files for the plugin,
     * based on the current locale. It uses the text domain defined in the
     * plugin header and points to the /languages directory.
     * 
     * @since 1.0.0
     * @return void
     */
    public function load_plugin_text_domain() {
        /**
         * Load the text domain for the Random Lorem Generator plugin.
         * 
         * @see https://developer.wordpress.org/reference/functions/load_plugin_textdomain/
         */
        load_plugin_textdomain(
            'random-lorem-generator',
            false,
            dirname( plugin_basename(__FILE__), 3 ) . '/languages'
        );
    }
    
}