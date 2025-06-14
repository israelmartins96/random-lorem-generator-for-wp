<?php
/**
 * LoremPress
 *
 * @package             LoremPress
 * @author              Lightbulb Devs
 * @copyright           Copyright (c) 2025, Lightbulb Devs
 * @license             GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:         LoremPress
 * Plugin URI:          https://lightbulbdevs.com/lorempress/wp/
 * Description:         Add dummy text content as a placeholder while creating your WordPress website, web page, blog post etc.
 * Version:             0.2.1
 * Requires at least:   5.2
 * Requires PHP:        7.2
 * Author:              Lightbulb Devs
 * Author URI:          https://lightbulbdevs.com
 * Donate link:         https://lightbulbdevs.com/lorempress/wp/donate/
 * License:             GPL v2 or later
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:          https://lightbulbdevs.com/lorempress/wp/update/
 * Text Domain:         lorempress
 * Domain Path:         /languages/
 */

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2025 Lightbulb Devs
 */

use \LoremPress\Includes\Shortcodes\LoremPress_Shortcode;

/**
 * Abort if this file is accessed directly.
 */
defined( 'ABSPATH' ) || exit;

/**
 * Current plugin version.
 * 
 * @since 0.1.0
 */
! defined( 'LOREMPRESS_VERSION' ) ? define( 'LOREMPRESS_VERSION', '0.2.1' ) : '';

/**
 * Plugin root path.
 * 
 * @since 0.1.0
 */
! defined( 'LOREMPRESS_PLUGIN_PATH' ) ? define( 'LOREMPRESS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) ) : '';

/**
 * Plugin base URL.
 * 
 * @since 0.2.1
 */
! defined( 'LOREMPRESS_PLUGIN_URL' ) ? define( 'LOREMPRESS_PLUGIN_URL', plugin_dir_url( __FILE__ ) ) : '';

/**
 * Require Composer Autoload.
 */
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * Runs during plugin activation.
 * In includes/base/Activator.php
 * 
 * @since 0.1.0
 */
function activate_lorempress() {
    \LoremPress\Includes\Base\Activator::activate();
}

/**
 * Runs during plugin deactivation.
 * In includes/base/Deactivator.php
 *
 * @since 0.1.0
 */
function deactivate_lorempress() {
    \LoremPress\Includes\Base\Deactivator::deactivate();
}

/**
 * Registers activation hook.
 */
register_activation_hook( __FILE__, 'activate_lorempress' );

/**
 * Registers deactivation hook.
 */
register_deactivation_hook( __FILE__, 'deactivate_lorempress' );

/**
 * Create new LoremPress shortcode object if the corresponding class exists.
 */
if ( class_exists( '\LoremPress\\Includes\\Shortcodes\\LoremPress_Shortcode' ) ) {
    $lorempress_shortcode = new LoremPress_Shortcode;
    
    /**
     * Set initial values for the attributes, content, and tag of the shortcode object.
     */
    $lorempress_shortcode->lorempress_preset_shortcode_parameters();
}

/**
 * Add LoremPress shortcode.
 */
if ( ! shortcode_exists( $lorempress_shortcode->lorempress_shortcode_tag ) ) {
    add_shortcode( $lorempress_shortcode->lorempress_shortcode_tag, array( $lorempress_shortcode, 'lorempress_get_shortcode_content' ) );
}

/**
 * Registers the LoremPress dummy text generator script and localises data for it.
 *
 * This function registers the main JavaScript file for the LoremPress plugin.
 * It also passes the plugin's base URL to the JavaScript,
 * allowing the script to dynamically locate its data files.
 *
 * @since 1.0.0
 * @return void
 */
function lorempress_register_scripts() {
    /**
     * Registers the 'lorempress-dummy-text-generator' script.
     *
     * @see https://developer.wordpress.org/reference/functions/wp_register_script/
     */
    wp_register_script(
        'lorempress-dummy-text-generator',
        LOREMPRESS_PLUGIN_URL . 'assets/src/js/lorempress-dummy-text-generator.js',
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
 * Make the script ready for enqueuing.
 *
 * @see https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts/
 */
add_action( 'wp_enqueue_scripts', 'lorempress_register_scripts' );

/**
 * Conditionally enqueue the LoremPress dummy text generator script.
 *
 * This function checks if the 'lorempress' shortcode exists on the current
 * page or post content. If found, it enqueues the 'lorempress-dummy-text-generator'
 * JavaScript file only on the front-end.
 *
 * @param string $content The content of the post or page.
 * @return string The content of the post or page (unchanged).
 */
function lorempress_enqueue_dummy_text_script( $content ) {
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

/**
 * Hook into the content filter to check for the lorempress shortcode before the content is displayed.
 */
add_filter( 'the_content', 'lorempress_enqueue_dummy_text_script' );