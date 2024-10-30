<?php

add_action( 'admin_menu', 'cds_maps_wp_menu_cb' );
function cds_maps_wp_menu_cb() {
  add_menu_page(
    'cds maps wp',
     'cds maps wp settings',
      'manage_options',
       'cds-maps-settings',
        'cds_maps_wp_settings_cb'
    );
}

function cds_maps_wp_settings_cb() {
    	if ( !current_user_can( 'manage_options' ) )  {
    		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    	}
    	include 'settings.php';
}

function cds_maps_admin_enqueue() {
    wp_enqueue_script( 'cds_maps_wp_admin_js', plugins_url(CDS_MAPS_WP_NAME.'/assets/js/admin.js') );
    wp_enqueue_style( 'cds_maps_wp_admin_css', plugins_url(CDS_MAPS_WP_NAME.'/assets/css/admin.css') );
    wp_enqueue_style( 'cds_maps_admin_icons', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
    wp_enqueue_script( 'maps-places',"http://maps.google.com/maps/api/js?key=".get_option('cds-maps-wp-api')."&libraries=places");
    wp_enqueue_script( 'jquery-ui',"https://code.jquery.com/ui/1.12.1/jquery-ui.js");
}
add_action( 'admin_enqueue_scripts', 'cds_maps_admin_enqueue' );

function cds_maps_wp_enqueue_script() {
  wp_enqueue_script( 'maps',"http://maps.google.com/maps/api/js?key=".get_option('cds-maps-wp-api')."&libraries=places");
}
add_action( 'wp_enqueue_scripts', 'cds_maps_wp_enqueue_script');

add_filter( 'plugin_row_meta', 'cds_maps_wp_row_meta', 4, 10 );
function cds_maps_wp_row_meta( $plugin_meta, $plugin_file, $plugin_data, $status ) {

    if ( $plugin_file == "cds-maps-wp/cds-maps-wp.php") {
            $ret = '<div class="cds-maps-wp-row-meta" style="margin-top:10px; color:#333; display:block; white-space:normal;">';
            $ret .= '<p>View my <a target="_blank" href="https://codepen.io/carmine96/">codepen</a></p>';
            $ret .= '</div>';
            array_push( $plugin_meta, $ret );
    }
    return $plugin_meta;
}

function adding_cds_maps_wp_meta_boxes( $post_type, $post ) {
  add_meta_box(
          'cds-maps-wp-box',
          __( 'cds maps wp' ),
          'cds_maps_wp_meta_cb',
          array('post','page'),
          'normal',
          'core'
  );
}
add_action( 'add_meta_boxes', 'adding_cds_maps_wp_meta_boxes', 10, 2 );

function cds_maps_wp_meta_cb(){
   include 'meta_box_maps_wp.php';
}

function cds_maps_wp_short_cb( $atts,$content = null) {
     $a = shortcode_atts( array(
	      'width' => '250px',
	      'height' => '250px',
        'centers' => '',
        'json' => '',
        'drag' => 'true',
        'zoom' => '14',
        'titles' => '',
        'descs' => ''
     ), $atts );

    ob_start();

      include( plugin_dir_path( __FILE__ ) . '/short.php');

    return ob_get_clean();
}
add_shortcode( 'cds-maps-wp-code', 'cds_maps_wp_short_cb' );

?>
