<?php
if (!defined('ABSPATH')){
	exit; // Exit if accessed directly
}

class SB_Post_Type{
	function __construct() {
	    add_action('init',array($this,'scratch_builder_postype'));
	    add_action('init',array($this,'scratch_builder_taxonomy'));
		add_action( 'restrict_manage_posts', array($this,'sb_filter_list') );
		add_filter( 'parse_query',array($this,'sb_perform_filtering'));
	}
	function scratch_builder_postype() {

		$labels = array(
			'name'                  => _x( 'Scratch Builds', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'Scratch Build', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'Scratch Builder', 'text_domain' ),
			'name_admin_bar'        => __( 'Scratch Builder', 'text_domain' ),
			'archives'              => __( 'Build Archives', 'text_domain' ),
			'attributes'            => __( 'Build Attributes', 'text_domain' ),
			'parent_item_colon'     => __( 'Parent Build:', 'text_domain' ),
			'all_items'             => __( 'All Builds', 'text_domain' ),
			'add_new_item'          => __( 'Add New Build', 'text_domain' ),
			'add_new'               => __( 'Add New', 'text_domain' ),
			'new_item'              => __( 'New Build', 'text_domain' ),
			'edit_item'             => __( 'Edit Build', 'text_domain' ),
			'update_item'           => __( 'Update Build', 'text_domain' ),
			'view_item'             => __( 'View Build', 'text_domain' ),
			'view_items'            => __( 'View Builds', 'text_domain' ),
			'search_items'          => __( 'Search Build', 'text_domain' ),
			'not_found'             => __( 'Not found', 'text_domain' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
			'featured_image'        => __( 'Featured Image', 'text_domain' ),
			'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
			'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
			'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
			'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
			'items_list'            => __( 'Items list', 'text_domain' ),
			'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
			'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
		);


		$args = array(
			'label'                 => __( 'Build Type', 'text_domain' ),
			'description'           => __( 'Post Type Description', 'text_domain' ),
			'labels'                => $labels,
			'supports'              => array( 'title' ),
			'taxonomies'            => array( 'build_type' ),
			'hierarchical'          => true,
			'public'                => false,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_icon'             => 'dashicons-editor-code',
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);

		register_post_type( 'scratch_builder', $args );
	}

	// Register Custom Taxonomy
	function scratch_builder_taxonomy() {

		$labels = array(
			'name'                       => _x( 'Build Types', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'Build Type', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'                  => __( 'Build Types', 'text_domain' ),
			'all_items'                  => __( 'All Build Types', 'text_domain' ),
			'parent_item'                => __( 'Parent Type', 'text_domain' ),
			'parent_item_colon'          => __( 'Parent Tyype:', 'text_domain' ),
			'new_item_name'              => __( 'New Type Name', 'text_domain' ),
			'add_new_item'               => __( 'Add New Type', 'text_domain' ),
			'edit_item'                  => __( 'Edit Type', 'text_domain' ),
			'update_item'                => __( 'Update Type', 'text_domain' ),
			'view_item'                  => __( 'View Type', 'text_domain' ),
			'separate_items_with_commas' => __( 'Separate Type with commas', 'text_domain' ),
			'add_or_remove_items'        => __( 'Add or remove Type', 'text_domain' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
			'popular_items'              => __( 'Popular Types', 'text_domain' ),
			'search_items'               => __( 'Search Types', 'text_domain' ),
			'not_found'                  => __( 'Not Found', 'text_domain' ),
			'no_terms'                   => __( 'No Types', 'text_domain' ),
			'items_list'                 => __( 'Types list', 'text_domain' ),
			'items_list_navigation'      => __( 'Types list navigation', 'text_domain' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => false,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'build_type', array( 'scratch_builder' ), $args );
	}

	//display cats for filter
	function sb_filter_list() {
	    $screen = get_current_screen();
	    global $wp_query;
	    if ( $screen->post_type == 'scratch_builder' ) {
	        wp_dropdown_categories( array(
	            'show_option_all' => 'Show Build Type',
	            'taxonomy' => 'build_type',
	            'name' => 'build_type',
	            'orderby' => 'build_type',
	            'selected' => ( isset( $wp_query->query['build_type'] ) ? $wp_query->query['build_type'] : '' ),
	            'hierarchical' => false,
	            'depth' => 3,
	            'show_count' => false,
	            'hide_empty' => true,
	        ) );
	    }
	}


	//displays filtered category
	function sb_perform_filtering( $query ) {
	    $qv = &$query->query_vars;
	    if ( ( $qv['build_type'] ) && is_numeric( $qv['build_type'] ) ) {
	        $term = get_term_by( 'id', $qv['build_type'], 'build_type' );
	        $qv['build_type'] = $term->slug;
	    }
	}
}

new SB_Post_Type;