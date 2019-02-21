<?php
if (!defined('ABSPATH')){
	exit; // Exit if accessed directly
}

class SB_Post_Type{
	function __construct() {
	    add_action('init',array($this,'scratch_builder_postype'));
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
			'label'                 => __( 'Scratch Build', 'text_domain' ),
			'description'           => __( 'Post Type Description', 'text_domain' ),
			'labels'                => $labels,
			'supports'              => array( 'title' ),
			'taxonomies'            => array( 'build_type' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_icon'             => 'dashicons-editor-code',
			'menu_position'         => 5,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'scratch_builder', $args );
	}
}

new SB_Post_Type;