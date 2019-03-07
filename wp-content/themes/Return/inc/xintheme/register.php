<?php
function theme_load_scripts() {
    wp_register_style( 'bootstrap', get_stylesheet_directory_uri().'/css/bootstrap.css', array(), XinTheme, 'all'  );
	wp_register_style( 'style', get_stylesheet_directory_uri().'/css/style.css', array(), XinTheme, 'all'  );
	wp_register_style( 'slick', get_stylesheet_directory_uri().'/css/slick.css', array(), XinTheme, 'all'  );
    wp_register_style( 'slick-theme', get_stylesheet_directory_uri().'/css/slick-theme.css', array(), XinTheme, 'all'  );
	wp_register_style( 'font-awesome', get_stylesheet_directory_uri().'/inc/frame/assets/css/font-awesome.css', array(), XinTheme, 'all'  );
	wp_register_style( 'ionicons', get_stylesheet_directory_uri().'/css/ionicons.min.css', array(), XinTheme, 'all'  );

    wp_register_script( 'jquery', get_stylesheet_directory_uri() . '/js/jquery.js', array(), XinTheme, FALSE );
    wp_register_script( 'init-masonry', get_stylesheet_directory_uri() . '/js/init-masonry.js', array('jquery'), XinTheme, true );
    wp_register_script( 'slick', get_stylesheet_directory_uri() . '/js/slick.min.js', array('jquery'), XinTheme, true );
	wp_register_script( 'functions', get_stylesheet_directory_uri() . '/js/functions.js', array('jquery'), XinTheme, true );
	wp_register_script( 'masonry', get_stylesheet_directory_uri() . '/js/masonry.min.js', array('jquery'), XinTheme, true );
	//wp_register_script( 'init-carousel-1', get_stylesheet_directory_uri() . '/js/init-carousel-1.js', array('jquery'), XinTheme, true );
	//wp_register_script( 'imagesloaded', get_stylesheet_directory_uri() . '/js/imagesloaded.min.js', array('jquery'), XinTheme, true );
	//wp_register_script( 'skip-link-focus-fix', get_stylesheet_directory_uri() . '/js/skip-link-focus-fix.js', array('jquery'), XinTheme, true );
	wp_register_script( 'affix-sidebar', get_stylesheet_directory_uri() . '/js/affix-sidebar.js', array('jquery'), XinTheme, true );
    //wp_localize_script( 'jquery', 'site_url', array("ajax_url"=>admin_url("admin-ajax.php"),"url_theme"=>get_template_directory_uri() ) );
    
    if (!is_admin()) {

        wp_enqueue_style('bootstrap');
		wp_enqueue_style('style');
		wp_enqueue_style('slick');
		wp_enqueue_style('slick-theme');
		wp_enqueue_style('font-awesome');
		wp_enqueue_style('ionicons');

        wp_enqueue_script('jquery');
        wp_enqueue_script('init-masonry');
        wp_enqueue_script('slick');
		wp_enqueue_script('functions');
		wp_enqueue_script('masonry');
		//wp_enqueue_script('init-carousel-1');
		//wp_enqueue_script('imagesloaded');
		//wp_enqueue_script('skip-link-focus-fix');
		wp_enqueue_script('affix-sidebar');
        
    
        
    }
    
}
add_action('wp_enqueue_scripts', 'theme_load_scripts');