<?php  
if (!defined('ABSPATH')){exit;}


class SB_Builders{
	function __construct(){
		add_action('add_meta_boxes',array($this,'sb_register_metabox'));
	}

	function sb_register_metabox(){
		add_meta_box( 'sb-metabox', __( 'Builds', SB_TEXTDOMAIN), array($this,'sb_builder_textareas_callback'), 'scratch_builder' );
	}

	function sb_builder_textareas_callback(){
		echo "test";
	}
}

new SB_Builders;