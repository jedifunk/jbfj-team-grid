<?php
/*
	Plugin Name: JBFJ Team Grid
	Author: Bryce Flory
	Author URI: http://bryceflory.com
	Version: 1.0
*/

// CPT for Team Members
add_action( 'init', 'register_cpt_team_member' );

function register_cpt_team_member() {

    $labels = array( 
        'name' => _x( 'Team', 'team_member' ),
        'singular_name' => _x( 'Team Member', 'team_member' ),
        'add_new' => _x( 'Add New', 'team_member' ),
        'add_new_item' => _x( 'Add New Team Member', 'team_member' ),
        'edit_item' => _x( 'Edit Team Member', 'team_member' ),
        'new_item' => _x( 'New Team Member', 'team_member' ),
        'view_item' => _x( 'View Team Member', 'team_member' ),
        'search_items' => _x( 'Search Team', 'team_member' ),
        'not_found' => _x( 'No team found', 'team_member' ),
        'not_found_in_trash' => _x( 'No team found in Trash', 'team_member' ),
        'parent_item_colon' => _x( 'Parent Team Member:', 'team_member' ),
        'menu_name' => _x( 'Team', 'team_member' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,        
        'supports' => array( 'title', 'editor', 'thumbnail' ),        
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20, 
        'menu_icon' => plugins_url('team-grid/lib/img/user--plus.png'),      
        'show_in_nav_menus' => false,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'team_member', $args );
}

//Add CSS
add_action('wp_print_styles', 'team_grid_styles');

function team_grid_styles() {
	//register
	wp_register_style('team_grid', plugins_url('lib/css/slide-down.css', __FILE__));
	
	//enqueue
	if ( is_page_template( 'page-team.php') ) {
		wp_enqueue_style('team_grid');
	}
}

//Add Javascript
add_action('wp_print_scripts', 'team_grid_scripts');

function team_grid_scripts() {
	//register
	wp_register_script('app-folders', plugins_url('lib/js/jquery.app-folders.js', __FILE__), array('jquery'));
	wp_register_script('team_grid', plugins_url('lib/js/jquery.app-folders.js', __FILE__));
	
	//enqueue
	if ( is_page_template( 'page-team.php') ) {
		wp_enqueue_script('app-folders');
		wp_enqueue_script('team_grid');
	}
}