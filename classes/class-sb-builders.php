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
		wp_nonce_field( basename( __FILE__ ), 'sb_build_nonce' );
		?>
		<h2>HTML</h2>
    	<textarea id="sb_build_html" name="sb_build_html"><?php echo get_post_meta( $post->ID, 'sb_build_html', true);?></textarea>
		<h2>JS</h2>
    	<textarea id="sb_build_js"   name="sb_build_js"><?php echo get_post_meta( $post->ID, 'sb_build_js', true);?></textarea>
		<h2>CSS</h2>
    	<textarea id="sb_build_css"  name="sb_build_css"><?php echo get_post_meta( $post->ID, 'sb_build_css', true);?></textarea>
		<?php
		$this->sb_builder_mirror_init();
	}

	function sb_builder_mirror_init(){
		?>
		<script type="text/javascript">
			var mixedMode = {
				name: "htmlmixed",
				scriptTypes: [{matches: /\/x-handlebars-template|\/x-mustache/i,
				               mode: null},
				              {matches: /(text|application)\/(x-)?vb(a|script)/i,
				               mode: "vbscript"}]
			};

			var a = ["sb_build_html","sb_build_js","sb_build_css"];
			var x = 0;

			a.forEach(function(entry) {
				x++;
				var z = CodeMirror.fromTextArea(document.getElementById(entry), {
				  mode: mixedMode,
				  styleActiveLine: true,
				  lineNumbers: true,
				  lineWrapping: true
				});

				if(x <= 1){
					z.setOption("theme", "oceanic-next");	
				}else{
					z.setOption("theme", "base16-dark");
				}
			});
		</script>
		<?php
	}

	function sb_builder_save($post_id){
		if ( !isset( $_POST['sb_build_nonce'] ) || !wp_verify_nonce( $_POST['sb_build_nonce'], basename( __FILE__ ) ) ){
			return;
		}

		if(isset($_POST['sb_build_html'])){
	    	update_post_meta( $post_id, 'sb_build_html', $_POST['sb_build_html'] );
	    } 

	    if(isset($_POST['sb_build_js'])){
	    	update_post_meta( $post_id, 'sb_build_js', $_POST['sb_build_js'] );
	    } 

	    if(isset($_POST['sb_build_css'])){
	    	update_post_meta( $post_id, 'sb_build_css', $_POST['sb_build_css'] );
	    } 
	}

}

new SB_Builders;