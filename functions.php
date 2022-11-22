<?php

add_action( 'wp_enqueue_scripts', 'memart_enqueue_styles', 10, 1 );

function memart_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css',
        array(), 
       '0.1.2' // this only works if you have Version in the style header
    );
}

function memart_pick_random_order( $query ) {
    if(!is_admin() && $query->is_tag()) {
        if(is_tag()) {
            $query->set('orderby', 'rand');
            $query->set('posts_per_page', 1);
        }
    }
}

add_action('pre_get_posts', 'memart_pick_random_order');

/**
 * Add a span around the title prefix so that the prefix can be hidden with CSS
 * if desired.
 * Note that this will only work with LTR languages.
 *
 * @param string $title Archive title.
 * @return string Archive title with inserted span around prefix.
 */

function hap_hide_the_archive_title( $title ) {

    // Skip if the site isn't LTR, this is visual, not functional.
    // Should try to work out an elegant solution that works for both directions.
    if ( is_rtl() ) {
        return $title;
    }

    // Split the title into parts so we can wrap them with spans.
    $title_parts = explode( ': ', $title, 2 );

    // Glue it back together again.
    if ( ! empty( $title_parts[1] ) ) {
        $title = wp_kses(
            $title_parts[1],
            array(
                'span' => array(
                    'class' => array(),
                ),
            )
        );
        $title = '<span class="screen-reader-text">' . esc_html( $title_parts[0] ) . ': </span>' . $title;
    }

    return $title;

}

add_filter( 'get_the_archive_title', 'hap_hide_the_archive_title' );