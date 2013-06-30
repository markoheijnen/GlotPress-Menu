<?php

class Theme_Menu extends GP_Plugin {
	public $id = 'theme_menu';

	public function __construct() {
		parent::__construct();

		add_action( 'init', array( $this, 'load_style' ) );
		add_action( 'after_notices', array( $this, 'add_menu' ) );
	}

	public function load_style() {
		if( is_ssl() )
			$url = gp_url_ssl( gp_url_public_root() );
		else
			$url = gp_url_public_root();

		wp_enqueue_style( 'menu', $url . '/plugins/menu/menu.css', array( 'base' ) );
	}

	public function add_menu() {
		$items = array(
			'/projects' => __( 'Projects' )
		);
		$items = apply_filters( 'glotpress_menu', $items );

		if( count( $items ) == 1 )
			return;

		echo '<ul class="menu">';

		foreach( $items as $link => $name ) {
			echo '<li><a href="' . $link . '">' . $name . '</a></li>';
		}

		echo '</ul>';
	}
}

GP::$plugins->theme_menu = new Theme_Menu;