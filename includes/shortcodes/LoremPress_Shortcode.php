<?php

/**
 * The plugin shortcode.
 * 
 * @since 0.2.0
 * 
 * @package LoremPress
 * @subpackage LoremPress/Includes
 */

namespace LoremPress\Includes\Shortcodes;

/**
 * The plugin shortcode.
 * 
 * This class defines all code necessary to run during the plugin's activation.
 * 
 * @since 0.1.0
 * @package LoremPress
 * @subpackage LoremPress/Includes
 * @author Israel Martins <hello@israelmartins.com>
 */
class LoremPress_Shortcode {

    public $lorempress_atts = array();

    public $lorempress_content = '';

    public $lorempress_tag;
    
    public function lorempress_get_shortcode_content( $lorempress_atts, $lorempress_content, $lorempress_tag ) {
        return $lorempress_content;
    }
    
    public function lorempress_preset_shortcode() {
        $this->set_lorempress_atts();
        
        $this->set_lorempress_content();

        $this->set_lorempress_tag();
    }

    public function set_lorempress_atts() {
        $this->lorempress_atts = array();
    }
    
    public function set_lorempress_content() {
        $this->lorempress_content = 'Hello from LoremPress (by Lightbulb Devs)';
    }

    public function set_lorempress_tag() {
        $this->lorempress_tag = 'lorempress';
    }
    
}