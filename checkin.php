<?php
/*
Plugin Name: Checkin
Description: This plugin will allow you to check where are you at any moment, directly from your blog.
Version: 1.0
Author: GeroNikolov
Author URI: http://geronikolov.com
License: GPLv2
*/

class CHECKIN {
    function __construct(){
        // Register the Checkins CPT
        add_action( "init", array( $this, "register_checkins_cpt" ) );

        // Register scripts and styles for the Back-end part
        add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_js' ), "1.0.0", "true" );
        add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_css' ) );

        // Register the Checkin Fields Metabox for the Checkins CPT
        add_action( "add_meta_boxes", array( $this, "register_checkin_metabox" ), 10, 2 );
    }

    function __desctruct(){}

    /*
    *   Function name: register_checkins_cpt
    *   Function arguments: NONE
    *   Function purpose: This function is used to initialize (register) the Checkins CPT to the WP Dashboard.
    */
    function register_checkins_cpt() {
        $labels = array(
            'name'               => _x( 'Checkins', 'post type general name', 'checkin' ),
    		'singular_name'      => _x( 'Checkin', 'post type singular name', 'checkin' ),
    		'menu_name'          => _x( 'Checkins', 'admin menu', 'checkin' ),
    		'name_admin_bar'     => _x( 'Checkin', 'add new on admin bar', 'checkin' ),
    		'add_new'            => _x( 'Add New', 'checkin', 'checkin' ),
    		'add_new_item'       => __( 'Add New Checkin', 'checkin' ),
    		'new_item'           => __( 'New Checkin', 'checkin' ),
    		'edit_item'          => __( 'Edit Checkin', 'checkin' ),
    		'view_item'          => __( 'View Checkin', 'checkin' ),
    		'all_items'          => __( 'All Checkins', 'checkin' ),
    		'search_items'       => __( 'Search Checkin', 'checkin' ),
    		'parent_item_colon'  => __( 'Parent Checkins:', 'checkin' ),
    		'not_found'          => __( 'No checkins found.', 'checkin' ),
    		'not_found_in_trash' => __( 'No checkins found in Trash.', 'checkin' )
        );

        $args = array(
            'labels'             => $labels,
            'description'        => __( 'Here you can add your checkins everytime you want to share your location with your visitors.', 'checkin' ),
    		'public'             => true,
    		'publicly_queryable' => true,
    		'show_ui'            => true,
    		'show_in_menu'       => true,
    		'query_var'          => true,
    		'rewrite'            => array( 'slug' => 'checkins' ),
    		'capability_type'    => 'post',
    		'has_archive'        => true,
    		'hierarchical'       => false,
    		'menu_position'      => null,
    		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'revisions' )
        );

        register_post_type( "checkin", $args );
    }

    // Register Admin JS
	function register_admin_JS() {
		wp_enqueue_script( 'checkin-admin-js', plugins_url( '/assets/scripts.js' , __FILE__ ), array('jquery'), '1.0', true );
	}

    // Register Admin CSS
	function register_admin_CSS( $hook ) {
		wp_enqueue_style( 'checkin-admin-css', plugins_url( '/assets/style.css', __FILE__ ), array(), '1.0', 'screen' );
	}

    /*
    *   Function name: register_checkin_metabox
    *   Function arguments: NONE [ $post_type, $post - NOT USED ]
    *   Function purpose: This function is used to generate the CHECKIN_CHECKIN_FIELDs meta box for the Checkins CPT.
    */
    function register_checkin_metabox( $post_type, $post ) {
        add_meta_box(
            "checkin_fields",
            "Checkin",
            array( $this, "build_checkin_fields_metabox" ),
            "checkin",
            "normal",
            "high"
        );
    }

    /*
    *   Function name: build_checkin_fields_metabox
    *   Function arguments: NONE
    *   Function purpose: This function is used to build the Checkin Fields name metabox.
    */
    function build_checkin_fields_metabox() {
        ?>

        <div id="venue-search-container" class="venue-search-container">
            <div id="venue-search-box" class="venue-search-box">
                <input type="text" id="town-search" class="search" placeholder="City name">
                <input type="text" id="venue-search" class="search" placeholder="Place name or just &quot;hookah&quot;?">
                <button type="button" id="search-controller" class="button button-primary button-large search-button">Search</button>
            </div>
            <div id="venues-list" class="venues-list">
            </div>
        </div>

        <?php
    }
}

$_CHECKIN_ = new CHECKIN;
?>
