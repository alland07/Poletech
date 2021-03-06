<?php

/**
 * Portfolio_WP functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Portfolio_WP
 */

function poletech_supports(){
	add_theme_support('menus');
	register_nav_menu('header','En tête du menu');//permet la création d'un nouveau menu
}
/*
function poletech_register_assets()
{
	wp_register_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'); //src css
	// wp_register_script('bootstrap','src',['popper'],['jquery'],[],false, true); cette ligne veut dire que l'on a besoin de popper et de jquery pour lancer le script 
	// wp_register_script('popper','src,[],false, true');
	// wp_deregister_script('jquery'); Remplace la version de wp de jquery 
	// wp_register_script('jquery','src',[dependance],false, true); par la notre && le true est use pour mettre le script dans le footer
	// pour du js
	wp_enqueue_style('bootstrap'); //lance le css
	// wp_enqueue_script('bootstrap');
}*/

//Création du/des css externes
function poletech_css_assets(){
	wp_register_style('perso', get_template_directory_uri() . '/css/poletech.css');
	wp_enqueue_style('perso');
}
function poletech_title_separator()
{
	return '|';
}
function poletech_document_title_parts($title)
{
	unset($title['tagline']);
	return $title;
}
function Poletech_menu_class($classes){
	$classes[]='menu-header';
	return $classes; 
}
add_action('after_setup_theme', 'poletech_supports');
add_action('wp_enqueue_scripts', 'portfolio_wp_scripts');
// add_action('wp_enqueue_scripts', 'poletech_register_assets'); Charger bootstrap et toutes ses dépendances
add_action('wp_enqueue_scripts', 'poletech_css_assets'); // Charge mon css perso
add_filter('document_title_separator', 'poletech_title_separator'); //Les filtres sont comme des tuyaux qui permettent d'altérer une valeur
add_filter('document_title_parts', 'poletech_document_title_parts');
add_filter('nav_menu_css_class','Poletech_menu_class');







if (!function_exists('portfolio_wp_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function portfolio_wp_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Portfolio_WP, use a find and replace
		 * to change 'portfolio_wp' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('portfolio_wp', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array(
			'menu-1' => esc_html__('Primary', 'portfolio_wp'),
		));

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('portfolio_wp_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support('custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		));
	}
endif;
add_action('after_setup_theme', 'portfolio_wp_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function portfolio_wp_content_width()
{
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters('portfolio_wp_content_width', 640);
}
add_action('after_setup_theme', 'portfolio_wp_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function portfolio_wp_widgets_init()
{
	register_sidebar(array(
		'name'          => esc_html__('Sidebar', 'portfolio_wp'),
		'id'            => 'sidebar-1',
		'description'   => esc_html__('Add widgets here.', 'portfolio_wp'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
}
add_action('widgets_init', 'portfolio_wp_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function portfolio_wp_scripts()
{
	wp_enqueue_style('portfolio_wp-style', get_stylesheet_uri());

	wp_enqueue_script('portfolio_wp-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true);

	wp_enqueue_script('portfolio_wp-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}
