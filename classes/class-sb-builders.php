<?php  
if (!defined('ABSPATH')){exit;}


class SB_Builders{
	function __construct(){
		add_action('add_meta_boxes',array($this,'sb_register_metabox'));
	}

	function sb_register_metabox(){
		add_meta_box( 'sb-metabox', __( 'Happy Coding!', SB_TEXTDOMAIN), array($this,'sb_builder_textareas_callback'), 'scratch_builder' );
	}

	function sb_builder_textareas_callback(){
		?>
		<h2>HTML</h2>
    	<textarea id="sb_build_html" name="sb_build_html"></textarea>
		<?php
	}
}

new SB_Builders;