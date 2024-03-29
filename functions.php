<?php
/**
 * UC Santa Cruz functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package UC_Santa_Cruz
 */

if ( ! function_exists( 'ucsc_underscore_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ucsc_underscore_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on UC Santa Cruz, use a find and replace
		 * to change 'ucsc-underscore' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ucsc-underscore', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'ucsc-underscore' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'ucsc_underscore_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'ucsc_underscore_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ucsc_underscore_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'ucsc_underscore_content_width', 640 );
}
add_action( 'after_setup_theme', 'ucsc_underscore_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ucsc_underscore_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ucsc-underscore' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ucsc-underscore' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ucsc_underscore_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ucsc_underscore_scripts() {
	wp_enqueue_style( 'roboto-condensed-garamond', 'https://fonts.googleapis.com/css?family=EB+Garamond:400,500,700|Roboto+Condensed:300,400,700|Roboto:300,400,500,700', array(), false );
	wp_enqueue_style( 'ucsc-main-style', 'https://static.ucsc.edu/_responsive/css/ucsc.css?t=20180412082400' );
	wp_enqueue_style( 'ucsc-underscore-style', get_stylesheet_uri() );

	wp_enqueue_script( 'ucsc-underscore-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'ucsc-underscore-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ucsc_underscore_scripts' );

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
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Jason's Functions
 */
/* add <span> elements around ampersand in title */
function bb_custom_site_title() {
	echo str_replace("&amp;","<span>&amp;</span>", get_bloginfo('name'));
    
}
/* add body class to 'about' page */
add_filter( 'body_class','my_body_classes' );
function my_body_classes( $classes ) {
	if (is_page('about')){
		$classes[] = 'left-column';
		$classes[] = 'dept';
	}   
    return $classes;
}

/* custom widget area*/

// function bb_register_custom_sidebars(){
// 	/** Register Home Page widget areas */
	
// 	register_sidebar( array(
	
// 		'id'			=> 'top-row-search',
	
// 		'name'			=> __( 'Top Row Search Widget'),
	
// 		'description'	=> __( 'This is the search widget for the header top row.'),
// 		// 'before_widget' => '<li id="%1$s" class="search widget %2$s">',
// 		// 'after_widget' => '</li>',
	
// 	) );
// 	}
	
// 	add_action ('widgets_init','bb_register_custom_sidebars');

function add_id_and_classes_to_page_menu( $ulclass ) {
	return preg_replace( '/<ul>/', '<ul id="mainNav" class="hasqsg">', $ulclass, 1 );
	}
add_filter( 'wp_page_menu', 'add_id_and_classes_to_page_menu' );
	