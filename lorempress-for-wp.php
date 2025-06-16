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
 * Version:             1.0.0
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

use \LoremPress\Includes\Init;

/**
 * Abort if this file is accessed directly.
 */
defined( 'ABSPATH' ) || exit;

/**
 * Current plugin version.
 * 
 * @since 1.0.0
 */
! defined( 'LOREMPRESS_VERSION' ) ? define( 'LOREMPRESS_VERSION', '1.0.0' ) : '';

/**
 * Plugin root path.
 * 
 * @since 1.0.0
 */
! defined( 'LOREMPRESS_PLUGIN_PATH' ) ? define( 'LOREMPRESS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) ) : '';

/**
 * Plugin base URL.
 * 
 * @since 1.0.0
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
 * @since 1.0.0
 */
function activate_lorempress() {
    \LoremPress\Includes\Base\Activator::activate();
}

/**
 * Runs during plugin deactivation.
 * In includes/base/Deactivator.php
 *
 * @since 1.0.0
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
 * Initialise LoremPress functionalities if the initialisation class exists.
 */
if ( class_exists( '\LoremPress\\Includes\\Init' ) ) {
    Init::register_services();
}