<?php
/*
Plugin Name: CAHNRS Story Wall
Description: A custom archive design for a specified category.
Author: CAHNRS, philcable
Version: 0.1.0
*/

class CAHNRSWP_Story_Wall {

	// Placeholder for now
	var $category = 'elson-floyd';

	/**
	 * Start the plugin and apply associated hooks.
	 */
	public function __construct() {
		add_filter( 'template_include', array( $this, 'template_include' ), 1 );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ), 11 );
	}

	/**
	 * Include custom templates.
	 *
	 * @param string $template
	 *
	 * @return string
	 */
	public function template_include( $template ) {
		if ( is_category( $this->category ) ) {
			$template = plugin_dir_path( __FILE__ ) . 'templates/archive.php';
		}
		/*if ( in_category( $this->category ) ) {
			$template = plugin_dir_path( __FILE__ ) . 'templates/single.php';
		}*/
		return $template;
	}

	/**
	 * Enqueue scripts and styles used on the front end.
	 */
	public function wp_enqueue_scripts() {
		if ( is_category( $this->category ) ) {
			wp_enqueue_style( 'cahnrs-story-wall-css', plugin_dir_url( __FILE__ ) . 'css/story-wall.css' );
			//wp_enqueue_script( 'cahnrs-story-wall-js', plugin_dir_url( __FILE__ ) . 'js/story-wall.js', array(), '', true );
		}
		//if ( in_category( $this->$category ) ) {}
	}

}

new CAHNRSWP_Story_Wall();