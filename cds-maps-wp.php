<?php
/*
Plugin Name: cds maps wp
Plugin URI: http://cds1996.altervista.org/portfolio/cds-maps
Description: Custom Google Maps for WordPress.
Author: Carmine De santis
Author URI: http://cds1996.altervista.org/
Text Domain: cds-maps-wp
License: GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Version: 1.0
*/

define( 'CDS_MAPS_WP_VERSION', '1.0' );
define( 'CDS_MAPS_WP_PLUGIN', __FILE__ );
define( 'CDS_MAPS_WP_BASENAME', plugin_basename( CDS_MAPS_WP_PLUGIN ) );
define( 'CDS_MAPS_WP_NAME', trim( dirname( CDS_MAPS_WP_BASENAME ), '/' ) );
define( 'CDS_MAPS_WP_DIR', untrailingslashit( dirname( CDS_MAPS_WP_NAME ) ) );

// richiama
require_once 'assets/include/functions.php';

?>
