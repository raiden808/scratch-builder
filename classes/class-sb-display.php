<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}


class SB_Display{

	function sb_build_display($atts = []){
		
		$a = shortcode_atts(array( 
		'build_id' =>  ''),$atts );

		ob_start();

		

		return ob_get_clean();
	}

}

new SB_Display;