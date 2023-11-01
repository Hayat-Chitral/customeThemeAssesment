<?php
/**
* Plugin Name: FAQ
* Description: About Frequently Asked Questions
* Version: 1.0.0
* Author: Hayat Ali
*/

function create_faq_post_type() {
    register_post_type('faq', array(
        'labels' => array(
            'name' => 'FAQs',
            'singular_name' => 'FAQ',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor'),
    ));
}
add_action('init', 'create_faq_post_type');

function render_faqs_shortcode($atts) {
    $args = array(
        'post_type' => 'faq',
        'posts_per_page' => -1,
    );

    $faqs = new WP_Query($args);
    $output = '<div class="faq-container">';
    $output .= '<ul class="faq-list">';
        
    if ($faqs->have_posts()) {
        while ($faqs->have_posts()) {
            $faqs->the_post();
            $question = get_field('question'); 
            $answer = get_field('answer');
            $output .= '<li><strong>' . esc_html($question) . '</strong><br>' . wpautop(esc_html($answer)) . '</li>';
        }
        wp_reset_postdata();
    } else {
        $output .= 'No FAQs found.';
    }

    $output .= '</ul>';
    $output .= '</div>';

    return $output;
}
add_shortcode('faq', 'render_faqs_shortcode');

