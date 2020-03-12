<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */


function travel_tour_widgets_init() {
		
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'travel-tour' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );



	register_sidebar( array(
		'name'          => esc_html__( 'Testimonials', 'travel-tour' ),
		'id'            => 'testimonials',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="item widget-testimonials %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );


    register_sidebar( array(
        'name'          => esc_html__( 'Header Slider', 'travel-tour' ),
        'id'            => 'header_slider',
        'description'   => '',
        'before_widget' => '<div class="container-fluid"><div class="row">',
        'after_widget'  => '</div></div>'
    ) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget', 'travel-tour' ),
		'id'            => 'footer-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	
}
add_action( 'widgets_init', 'travel_tour_widgets_init' );


?>