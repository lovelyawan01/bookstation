<?php  
/**
 *
 * functions.php
 *
 */

	if ( ! function_exists( 'laptopfusion_setup' )) {
		function laptopfusion_setup()
		{
			$lang_dir = get_stylesheet_directory_uri() . '/assets/language';
			load_theme_textdomain( 'laptopfusion', $lang_dir );
			add_theme_support( 'automatic_feed_links' );
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'post-formats', [
				'gallery', 'link', 'audio', 'video', 'quote'
			] );

			register_nav_menus( [
				'top-menu' => __( 'Top Menu', 'laptopfusion'),
				'footer-menu' => __( 'Footer Menu', 'laptopfusion'),
			] );
		}
		add_action( 'after_setup_theme', 'laptopfusion_setup' );
	}

	if ( ! function_exists( 'laptopfusion_widget_init' )) {
		function laptopfusion_widget_init() {
			$widget = [
				'name' => __( 'Sidebar One'),
				'id' => 'sidebar-one',
				'description' => __( 'Apears in sidebar Column One'),
				'class' => '',
				'before_widget' => '<ul class="check">',
				'after_widget' => '</ul>',
				'before_title' => '<div class="widget-title"><h4>', 
				'after_title' =>  '</h4><hr></div>'
			];

			register_sidebar( $widget );

			$widget = [
				'name' => __( 'Sidebar Two'),
				'id' => 'sidebar-two',
				'description' => __( 'Apears in sidebar Column Two'),
				'class' => '',
				'before_widget' => '<ul class="check">',
				'after_widget' => '</ul>',
				'before_title' => '<div class="widget-title"><h4>', 
				'after_title' =>  '</h4><hr></div>'
			];

			register_sidebar( $widget );
		}
		add_action( 'widgets_init', 'laptopfusion_widget_init' );
	}