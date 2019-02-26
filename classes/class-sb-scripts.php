<?php
if (!defined('ABSPATH')){
	exit; // Exit if accessed directly
}

class SB_Scripts{

	function sb_admin_scripts(){
		$screen = get_current_screen();
		$supported_post_type = array('scratch_builder');

		//restrict build js
		if(in_array($screen->post_type, $supported_post_type)){

			//base js
			wp_enqueue_script( 'sb-mirror-main', SB_PLUGIN_URL . 'assets/code_mirror/js/codemirror.js' );

			//extension js
			wp_enqueue_script( 'sb-mirror-xml', SB_PLUGIN_URL . 'assets/code_mirror/js/xml.js' );
			wp_enqueue_script( 'sb-mirror-active', SB_PLUGIN_URL . 'assets/code_mirror/js/active-line.js' );
			wp_enqueue_script( 'sb-mirror-active', SB_PLUGIN_URL . 'assets/code_mirror/js/active-line.js' );

			//base css
			wp_enqueue_style( 'sb-mirror-style', SB_PLUGIN_URL . 'assets/code_mirror/css/codemirror.css' );

			//theme css
			wp_enqueue_style( 'sb-mirror-theme', SB_PLUGIN_URL . 'assets/code_mirror/css/base16-dark.css' );
			wp_enqueue_style( 'sb-mirror-ocean', SB_PLUGIN_URL . 'assets/code_mirror/css/oceanic-next.css' );
		
		}
	}
}

new SB_Scripts;