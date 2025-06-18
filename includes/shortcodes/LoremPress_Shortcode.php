<?php

/**
 * Manages the LoremPress plugin shortcode.
 * 
 * This file is responsible for defining and managing the attributes, content, and tag for the LoremPress shortcode.
 * 
 * @since 1.0.0
 * 
 * @package LoremPress
 * @subpackage LoremPress/Includes
 * @version 1.0.0
 */

namespace LoremPress\Includes\Shortcodes;

/**
 * Manages the LoremPress plugin shortcode.
 * 
 * This class is responsible for defining and managing the properties and
 * behaviour of the LoremPress shortcode, including its attributes, content,
 * and tag.
 * 
 * @since 1.0.0
 * @package LoremPress
 * @subpackage LoremPress/Includes
 * @author Israel Martins <hello@israelmartins.com>
 */
class LoremPress_Shortcode {

    /**
     * Stores the shortcode attributes.
     *
     * @since 1.0.0
     * @access public
     * @var array $lorempress_shortcode_atts The shortcode attributes.
     */
    public $lorempress_shortcode_atts = array();

    /**
     * Stores the shortcode content.
     *
     * @since 1.0.0
     * @access public
     * @var string $lorempress_shortcode_content The shortcode content.
     */
    public $lorempress_shortcode_content = '';

    /**
     * Stores the shortcode tag.
     *
     * @since 1.0.0
     * @access public
     * @var string $lorempress_shortcode_tag The shortcode tag.
     */
    public $lorempress_shortcode_tag = '';

    /**
     * Registers the LoremPress shortcode.
     * 
     * Checks if the shortcode tag already exists. If not, it presets the shortcode
     * parameters and registers the shortcode.
     *
     * @since 1.0.0
     * @return void
     */
    public function register() {
        /**
         * Add LoremPress shortcode.
         */
        if ( ! shortcode_exists( $this->lorempress_shortcode_tag ) ) {
            $this->lorempress_preset_shortcode_parameters();
            
            add_shortcode( $this->lorempress_shortcode_tag, array( $this, 'lorempress_get_shortcode_content' ) );
        }
    }
    
    /**
     * Retrieves the shortcode content.
     *
     * This method currently reassigns the instance properties to the local variables,
     * but the parameters passed to the function are not used. It then returns the
     * shortcode content stored in the instance property.
     *
     * @since 1.0.0
     * @param array  $lorempress_atts    Shortcode attributes (not currently used).
     * @param string $lorempress_content Shortcode content (not currently used).
     * @param string $lorempress_tag     Shortcode tag (not currently used).
     * @return string The shortcode content.
     */
    public function lorempress_get_shortcode_content( $lorempress_atts = array(), $lorempress_content = '', $lorempress_tag = '' ) {
        $lorempress_atts = $this->lorempress_shortcode_atts;

        $lorempress_content = $this->lorempress_shortcode_content;

        $lorempress_tag = $this->lorempress_shortcode_tag;
        
        return $lorempress_content;
    }
    
    /**
     * Presets the shortcode's attributes, content, and tag.
     *
     * This method calls the individual setter methods to initialise the shortcode's
     * properties with default values.
     *
     * @since 1.0.0
     * @return void
     */
    public function lorempress_preset_shortcode_parameters() {
        $this->set_lorempress_shortcode_atts();
        
        $this->set_lorempress_shortcode_content();

        $this->set_lorempress_shortcode_tag();
    }

    /**
     * Sets the shortcode attributes.
     *
     * @since 1.0.0
     * @return void
     */
    private function set_lorempress_shortcode_atts() {
        $this->lorempress_shortcode_atts = array();
    }
    
    /**
     * Sets the shortcode content.
     *
     * @since 1.0.0
     * @return void
     */
    private function set_lorempress_shortcode_content() {
        $this->lorempress_shortcode_content = '<p class="lorempress-shortcode-pargraph"></p>';
    }

    /**
     * Sets the shortcode tag.
     *
     * @since 1.0.0
     * @return void
     */
    private function set_lorempress_shortcode_tag() {
        $this->lorempress_shortcode_tag = 'lorempress';
    }
    
}