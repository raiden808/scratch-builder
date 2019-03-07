<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}


class SB_Display{

	function __construct(){
		add_shortcode( 'sb_build', array($this,'sb_build_display_callback') );
	}

	function sb_build_display_callback($atts = [], $content = null){
		
		$a = shortcode_atts(array( 
		'build_id' =>  ''),$atts );

		$build_id = esc_attr($a['build_id']);

		ob_start();

		echo get_post_meta( $build_id, 'sb_build_css', true );

		$build_html = get_post_meta( $build_id, 'sb_build_html', true );

		//allow shortcode to be called inside the scratch html body
		echo do_shortcode(sprintf($build_html,do_shortcode($content)));

		echo get_post_meta( $build_id, 'sb_build_js', true );

		return ob_get_clean();
	}
}

new SB_Display;