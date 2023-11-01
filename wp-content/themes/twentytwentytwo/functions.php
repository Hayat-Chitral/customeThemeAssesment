<?php
/**
 * Twenty Twenty-Two functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Two
 * @since Twenty Twenty-Two 1.0
 */

function enqueue_bootstrap_and_datatable() {
    // Enqueue Bootstrap CSS
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', array(), '5.0.2');
    
    // Enqueue DataTables CSS from CDN
    wp_enqueue_style('datatable-css', 'https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css');

    // Enqueue jQuery from the CDN
    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), '3.6.0', true);
    
    // Enqueue Bootstrap JS from the CDN
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.0.2', true);
    
    // Enqueue DataTables JS from the CDN
    wp_enqueue_script('datatable-js', 'https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js', array('jquery'), '1.13.6', true);
}
add_action('wp_enqueue_scripts', 'enqueue_bootstrap_and_datatable');
add_action('admin_enqueue_scripts', 'enqueue_bootstrap_and_datatable');

// Init Data Table in Wordpress Admin Pannel
function data_table_init() { ?>
    <script>
        jQuery(document).ready(function($) {
            $('.data-table').DataTable();
        });
    </script>
<?php }
add_action('admin_footer', 'data_table_init');

if ( ! function_exists( 'twentytwentytwo_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function twentytwentytwo_support() {

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );

	}

endif;

add_action( 'after_setup_theme', 'twentytwentytwo_support' );

if ( ! function_exists( 'twentytwentytwo_styles' ) ) :

	/**
	 * Enqueue styles.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function twentytwentytwo_styles() {
		// Register theme stylesheet.
		$theme_version = wp_get_theme()->get( 'Version' );

		$version_string = is_string( $theme_version ) ? $theme_version : false;
		wp_register_style(
			'twentytwentytwo-style',
			get_template_directory_uri() . '/style.css',
			array(),
			$version_string
		);

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'twentytwentytwo-style' );

	}

endif;

add_action( 'wp_enqueue_scripts', 'twentytwentytwo_styles' );

// Add block patterns
require get_template_directory() . '/inc/block-patterns.php';
