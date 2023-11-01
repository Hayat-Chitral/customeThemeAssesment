<?php 
function enqueue_custom_styles() {
    wp_enqueue_style('bootstrap1', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.3/css/bootstrap.min.css');
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css'); 
    wp_enqueue_style('custom-style3', get_template_directory_uri() . '/assests/css/custom-style.css', array(), '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');

function enqueue_custom_scripts() {
    wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/cloudinary-jquery/2.13.0/cloudinary-jquery.min.js');
    wp_enqueue_script('bootstrap3', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.3/js/bootstrap.min.js');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

// Add custom classes to navigation menu items
function custom_menu_item_classes($classes) {
    $classes[] = 'nav-item';
    return $classes;
}
add_filter('nav_menu_css_class', 'custom_menu_item_classes', 10, 4);


// Add custom classes to navigation menu anchor tags
function custom_nav_menu_link_attributes($atts) {
    $atts['class'] = 'nav-link';
    return $atts;
}
add_filter('nav_menu_link_attributes', 'custom_nav_menu_link_attributes', 10, 4);


// Fetch Flags and Name from API
function fetch_countries_data_shortcode() {
    $response = wp_remote_get('https://restcountries.com/v3.1/all?fields=name,flags');

    if (is_array($response) && !is_wp_error($response)) {
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        if ($data) {
            $output = '<ul>';
            foreach ($data as $country) {
                if (isset($country['name']['common']) && isset($country['flags'][0])) {
                    $output .= '<li><img src="' . $country['flags'][0] . '" style="width:30px;height:auto;"> ' . $country['name']['common'] . '</li>';
                }
            }
            $output .= '</ul>';
            return $output;
        } else {
            return 'No data found.';
        }
    } else {
        return 'Failed to fetch data. Error: ' . wp_remote_retrieve_response_message($response);
    }
}
add_shortcode('display_countries', 'fetch_countries_data_shortcode');

