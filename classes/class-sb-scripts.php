<?php
if (!defined('ABSPATH')){
	exit; // Exit if accessed directly
}

class SB_Scripts{

	function sb_admin_scripts(){
		$screen = get_current_screen();
		$supported_post_type = array('scratch_builder');
	}

}

new SB_Scripts;