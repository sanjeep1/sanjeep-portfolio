<?php
/**
 * Sanjeep Portfolio — functions.php
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'SP_VERSION',   '1.0.0' );
define( 'SP_DIR',       get_template_directory() );
define( 'SP_URI',       get_template_directory_uri() );
define( 'SP_ASSETS',    SP_URI . '/assets' );

/* ─────────────────────────────────────────────
   1. THEME SETUP
───────────────────────────────────────────── */
add_action( 'after_setup_theme', function () {
    load_theme_textdomain( 'sanjeep-portfolio', SP_DIR . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery', 'caption', 'style', 'script' ] );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'wp-block-styles' );

    // Custom image sizes
    add_image_size( 'portrait',  600, 750, true );
    add_image_size( 'project',   900, 600, true );
    add_image_size( 'thumb',     400, 300, true );

    register_nav_menus( [
        'primary' => __( 'Primary Navigation', 'sanjeep-portfolio' ),
    ] );
} );

/* ─────────────────────────────────────────────
   2. ENQUEUE SCRIPTS & STYLES
───────────────────────────────────────────── */
add_action( 'wp_enqueue_scripts', function () {
    // Google Fonts
    wp_enqueue_style(
        'sp-fonts',
        'https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Mono:ital,wght@0,300;0,400;1,300&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap',
        [],
        null
    );

    // Main compiled Tailwind CSS
    wp_enqueue_style(
        'sp-main',
        SP_ASSETS . '/css/main.css',
        [ 'sp-fonts' ],
        SP_VERSION
    );

    // Main JS (defer)
    wp_enqueue_script(
        'sp-main',
        SP_ASSETS . '/js/main.js',
        [],
        SP_VERSION,
        [ 'strategy' => 'defer', 'in_footer' => true ]
    );

    // Pass data to JS
    wp_localize_script( 'sp-main', 'spData', [
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'sp-contact' ),
        'homeUrl' => home_url(),
    ] );
} );

/* ─────────────────────────────────────────────
   4. REGISTER CUSTOM POST TYPE: Projects
───────────────────────────────────────────── */
add_action( 'init', function () {
    register_post_type( 'project', [
        'labels' => [
            'name'               => __( 'Projects', 'sanjeep-portfolio' ),
            'singular_name'      => __( 'Project', 'sanjeep-portfolio' ),
            'add_new'            => __( 'Add New Project', 'sanjeep-portfolio' ),
            'add_new_item'       => __( 'Add New Project', 'sanjeep-portfolio' ),
            'edit_item'          => __( 'Edit Project', 'sanjeep-portfolio' ),
            'new_item'           => __( 'New Project', 'sanjeep-portfolio' ),
            'view_item'          => __( 'View Project', 'sanjeep-portfolio' ),
            'search_items'       => __( 'Search Projects', 'sanjeep-portfolio' ),
            'not_found'          => __( 'No projects found', 'sanjeep-portfolio' ),
            'not_found_in_trash' => __( 'No projects found in Trash', 'sanjeep-portfolio' ),
            'menu_name'          => __( 'Projects', 'sanjeep-portfolio' ),
        ],
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => [ 'slug' => 'projects' ],
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-layout',
        'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
        'show_in_rest'       => true,
    ] );

    // Taxonomy: Project Category
    register_taxonomy( 'project_cat', 'project', [
        'labels'            => [
            'name'          => __( 'Project Categories', 'sanjeep-portfolio' ),
            'singular_name' => __( 'Project Category', 'sanjeep-portfolio' ),
            'search_items'  => __( 'Search Categories', 'sanjeep-portfolio' ),
            'all_items'     => __( 'All Categories', 'sanjeep-portfolio' ),
            'edit_item'     => __( 'Edit Category', 'sanjeep-portfolio' ),
            'update_item'   => __( 'Update Category', 'sanjeep-portfolio' ),
            'add_new_item'  => __( 'Add New Category', 'sanjeep-portfolio' ),
            'new_item_name' => __( 'New Category Name', 'sanjeep-portfolio' ),
            'menu_name'     => __( 'Categories', 'sanjeep-portfolio' ),
        ],
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => [ 'slug' => 'project-category' ],
        'show_in_rest'      => true,
    ] );
} );

/* ─────────────────────────────────────────────
   6. HELPERS
───────────────────────────────────────────── */

/**
 * Get featured projects for homepage.
 */
function sp_get_featured_projects( int $limit = 5 ): WP_Query {
    return new WP_Query( [
        'post_type'      => 'project',
        'post_status'    => 'publish',
        'posts_per_page' => $limit,
        'meta_query'     => [
            [ 'key' => 'proj_featured', 'value' => '1', 'compare' => '=' ],
        ],
        'meta_key'       => 'proj_order',
        'orderby'        => 'meta_value_num',
        'order'          => 'ASC',
    ] );
}

/* ─────────────────────────────────────────────
   7. REMOVE UNWANTED ADMIN ITEMS
───────────────────────────────────────────── */
add_action( 'admin_menu', function () {
    // Keep it clean — remove unused default menu items
    remove_menu_page( 'edit-comments.php' );
} );

// Clean up head
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );