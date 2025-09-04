<?php

/**
 * Manages the Random Lorem Generator plugin shortcode.
 * 
 * This file is responsible for defining and managing the attributes, content, and tag for the Random Lorem Generator shortcode.
 * 
 * @since 1.0.0
 * 
 * @package Random_Lorem_Generator
 * @subpackage Random_Lorem_Generator/Includes
 * @version 1.0.0
 */

namespace Random_Lorem_Generator\Includes\Shortcodes;

/**
 * Manages the Random Lorem Generator plugin shortcode.
 * 
 * This class is responsible for defining and managing the properties and
 * behaviour of the Random Lorem Generator shortcode, including its attributes, content,
 * and tag.
 * 
 * @since 1.0.0
 * @package Random_Lorem_Generator
 * @subpackage Random_Lorem_Generator/Includes
 * @author Lightbulb Devs <dev@lightbulbdevs.com>
 */
class Random_Lorem_Shortcode {

    /**
     * Stores the shortcode attributes.
     *
     * @since 1.0.0
     * @access public
     * @var array $shortcode_atts The shortcode attributes.
     */
    public $shortcode_atts = array();

    /**
     * Stores the shortcode content.
     *
     * @since 1.0.0
     * @access public
     * @var string $shortcode_content The shortcode content.
     */
    public $shortcode_content = '';

    /**
     * Stores the shortcode tag.
     *
     * @since 1.0.0
     * @access public
     * @var string $shortcode_tag The shortcode tag.
     */
    public $shortcode_tag = '';

    /**
     * Registers the Random Lorem Generator shortcode.
     * 
     * Checks if the shortcode tag already exists. If not, it presets the shortcode
     * parameters and registers the shortcode.
     *
     * @since 1.0.0
     * @return void
     */
    public function register() {
        /**
         * Add Random Lorem Generator shortcode.
         */
        if ( ! shortcode_exists( $this->shortcode_tag ) ) {
            $this->preset_shortcode_parameters();
            
            add_shortcode( $this->shortcode_tag, array( $this, 'get_shortcode_content' ) );
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
     * @param array  $atts    Shortcode attributes (not currently used).
     * @param string $content Shortcode content (not currently used).
     * @param string $tag     Shortcode tag (not currently used).
     * @return string The shortcode content.
     */
    public function get_shortcode_content( $atts = array(), $content = '', $tag = '' ) {
        $atts = $this->shortcode_atts;

        $content = $this->shortcode_content;

        $tag = $this->shortcode_tag;
        
        return $content;
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
    public function preset_shortcode_parameters() {
        $this->set_shortcode_atts();
        
        $this->set_shortcode_content();

        $this->set_shortcode_tag();
    }

    /**
     * Sets the shortcode attributes.
     *
     * @since 1.0.0
     * @return void
     */
    private function set_shortcode_atts() {
        $this->shortcode_atts = array();
    }
    
    /**
     * Sets the shortcode content.
     *
     * @since 1.0.0
     * @return void
     */
    private function set_shortcode_content() {
        $this->shortcode_content = '<p class="random-lorem-generator-shortcode-pargraph"></p>';
    }

    /**
     * Sets the shortcode tag.
     *
     * @since 1.0.0
     * @return void
     */
    private function set_shortcode_tag() {
        $this->shortcode_tag = 'randomlorem';
    }
    
}