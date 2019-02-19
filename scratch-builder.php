<?php
/*
 * Plugin Name: Scratch Builder
 * Plugin URI: 
 * Description: A lite from scratch builder. Highly reusable!
 * Author: <a href="http://reydennalasa.com">Rey Den</a>
 * Text Domain: sb_text
 * Domain Path: /languages
 * Version: 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
//* Defined constant
define( 'SB_TEXTDOMAIN', 'sb_text' );
define( 'SB_VERSION', '0.0.0' );
define( 'SB_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'SB_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

//require_once(SB_PLUGIN_PATH.'/classes/class-hwp-scripts.php');