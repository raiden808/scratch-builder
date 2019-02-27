<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}


class SB_Display{

	function sb_build_display($atts = []){
		ob_start();

		

		return ob_get_clean();
	}

}

new SB_Display;