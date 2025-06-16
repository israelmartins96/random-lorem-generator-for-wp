<?php

/**
 * Enqueues the LoremPress plugin scripts.
 * 
 * This file is responsible for enqueuing all scripts for the LoremPress plugin.
 * 
 * @since 1.0.0
 * 
 * @package LoremPress
 * @subpackage LoremPress/Includes
 * @version 1.0.0
 */

namespace LoremPress\Includes\Base;

/**
 * Handles the enqueuing of scripts for the LoremPress plugin.
 * 
 * This class is responsible for handling the enqueuing of the LoremPress plugin's scripts,
 * and when and where the scripts are loaded.
 * 
 * @since 1.0.0
 * @package LoremPress
 * @subpackage LoremPress/Includes
 * @author Israel Martins <hello@israelmartins.com>
 */
class Enqueue {

    /**
     * Registers all the hooks necessary for the Enqueue class.
     * 
     * This method adds actions and filters to WordPress to ensure
     * that scripts are correctly registered and enqueued when needed.
     * 
     * @since 1.0.0
     * @return void
     */
    public function register() {
        /**
         * Make the scripts ready for enqueuing.
         *
         * @see https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts/
         */
        add_action( 'wp_enqueue_scripts', array( $this, 'lorempress_register_scripts' ) );

        /**
         * Hook into the content filter to check for the lorempress shortcode before the content is displayed;
         * enqueues the script(s) on the front-end if the shortcode is present.
         */
        add_filter( 'the_content', array( $this, 'lorempress_enqueue_dummy_text_script' ) );
    }

    /**
     * Registers the LoremPress dummy text generator script and localises data for it.
     *
     * This method registers the main JavaScript file for the LoremPress plugin.
     * It also passes the plugin's base URL to the JavaScript,
     * allowing the script to dynamically locate its data files.
     *
     * @since 1.0.0
     * @return void
     */
    public function lorempress_register_scripts() {
        /**
         * Registers the 'lorempress-dummy-text-generator' script.
         *
         * @see https://developer.wordpress.org/reference/functions/wp_register_script/
         */
        wp_register_script(
            'lorempress-dummy-text-generator',
            LOREMPRESS_PLUGIN_URL . 'assets/js/lorempress-dummy-text-generator.min.js',
            array(),
            '1.0.0',
            true
        );

        /**
         * Localises data for the 'lorempress-dummy-text-generator' script.
         *
         * This makes PHP variables available as a JavaScript object.
         * The `pluginURL` key will be accessible in JavaScript as `loremPressData.pluginURL`.
         *
         * @see https://developer.wordpress.org/reference/functions/wp_localize_script/
         */
        wp_localize_script(
            'lorempress-dummy-text-generator',
            'loremPressData',
            array(
                'pluginURL' => LOREMPRESS_PLUGIN_URL
            )
        );
    }

    /**
     * Conditionally enqueue the LoremPress dummy text generator script.
     *
     * This method checks if the 'lorempress' shortcode exists on the current
     * page or post content. If found, it enqueues the 'lorempress-dummy-text-generator'
     * JavaScript file only on the front-end.
     *
     * @since 1.0.0
     * @param string $content The content of the post or page.
     * @return string The content of the post or page (unchanged).
     */
    public function lorempress_enqueue_dummy_text_script( $content ) {
        /**
         * Only proceed on the front-end.
         */
        if ( ! is_admin() ) {
            /**
             * Enqueue the dummy text generator script if the lorempress shortcode is present in the current post/page content.
             */
            if ( has_shortcode( $content, 'lorempress' ) ) {
                wp_enqueue_script( 'lorempress-dummy-text-generator' );
            }
        }
    
        /**
         * Return the unchanged content of the post/page.
         */
        return $content;
    }
    
}