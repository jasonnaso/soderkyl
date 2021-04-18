<?php



/**
 * ACF options page
 */
if (function_exists('acf_add_options_page'))  
{
    // add parent
    $parent = acf_add_options_page(array(
        'page_title'    => 'Temainställningar',
        'menu_title'    => 'Temainställningar',
        'redirect'      => true
    ));

    // add sub page
    acf_add_options_sub_page(array(
        'page_title'    => 'Sidhuvud',
        'menu_title'    => 'Sidhuvud',
        'parent_slug'   => $parent['menu_slug'],
    ));

    // add sub page
    acf_add_options_sub_page(array(
        'page_title'    => 'Sidfot',
        'menu_title'    => 'Sidfot',
        'parent_slug'   => $parent['menu_slug'],
    ));

    // add sub page
    acf_add_options_sub_page(array(
        'page_title'    => 'E-postinställningar',
        'menu_title'    => 'E-postinställningar',
        'parent_slug'   => $parent['menu_slug'],
    ));
}

/**
 * WordPress: Init
 * @return void
 */
add_action('init', function()
{
    /**
     * WordPress: Registers theme support for a given feature.
     * @return void
     */
    add_theme_support('title-tag');

    /**
     * WordPress: Registers theme support for a given feature.
     * @return void
     */
    add_theme_support('post-thumbnails');

    /**
     * WordPress: Registers theme support for a given feature.
     * @return void
     */
    add_theme_support('post-formats', array('gallery'));


    /**
     * WordPress: Registers a single custom Navigation Menu in the custom menu editor
     * @return void
     */
    register_nav_menu('primary', 'Primär meny');

    /**
     * WordPress: Registers a single custom Navigation Menu in the custom menu editor
     * @return void
     */
    register_nav_menu('produktkategorier', 'Produktkategorier');

    /**
     * WordPress: Create or modify a post type.
     * @return void
     */
    register_post_type('produkt', array(
        'labels' => array(
            'name'          => 'Produkter',
            'singular_name' => 'Produkt',
        ),
        'public'		=> true,
        'has_archive'	=> true,
        'menu_icon'		=> 'dashicons-cart',
        'supports'		=> array('title', 'editor', 'excerpt', 'thumbnail', 'revisions'),
        'taxonomies'	=> array('produktkategori'),
        // 'rewrite'		=> array('slug' => 'produkter')

    ));

    /**
     * WordPress: Create or modify a taxonomy.
     * @return void
     */
    register_taxonomy('produktkategori', array('produkt'), array(
        'labels'        => array(
            'name'              => 'Produktkategorier',
            'singular_name'     => 'Produktkategori',
        ),
        'hierarchical'	=> true,
        'sort'			=> true,
        'rewrite' => array(
            'hierarchical' => true,
            'slug'          => 'produkter',
            'with_front'    => false
        )
    ));

    add_filter('excerpt_more', function($more)
    {
        global $post;
        return ' ... <a href="'. get_permalink($post->ID) . '">Läs mer</a>';
    });

    add_filter('excerpt_length', function($length)
    {
        return 40;
    }, 999);
});

/**
 * WordPress: Fires after the query variable object is created, but before the actual query is run.
 * @return void
 */
add_action('pre_get_posts', function($query)
{
    if (is_archive() && is_post_type_archive('produkt') || is_archive() && is_tax('produktkategori'))
    {
        $query->set('order', 'asc');
        $query->set('orderby', 'title');
    }
});

/**
 * Nitea: Get attachment
 * @param  integer $attachment_id
 * @param  string $size
 * @return array
 */
function getImage($attachment_id, $size = 'full')
{
    $size_array = array();
    $srcset     = '';
    $sizes      = '';

    $image_meta = wp_get_attachment_metadata($attachment_id);
    $image_alt  = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
    $image      = wp_get_attachment_image_src($attachment_id, $size);

    list($src, $width, $height) = $image;

    if (is_array($image_meta)) {
        $size_array = array( absint( $width ), absint( $height ) );
        $srcset     = wp_calculate_image_srcset( $size_array, $src, $image_meta, $attachment_id );
        $sizes      = wp_calculate_image_sizes( $size_array, $src, $image_meta, $attachment_id );
    }

    return array(
        'src'       => $src,
        'srcset'    => $srcset,
        'sizes'     => $sizes,
        'alt'       => $image_alt
    );
}


/**
 * Add till ny logo till log in page
 */
add_action("login_head", function() {
echo "
    <style>
        body.login #login h1 a {
        background: url('".get_bloginfo('template_url')."/images/logo-log-in.png') no-repeat scroll center top transparent;height: 150px;width: 319px;}
    </style>";
});


// DIRECTORY_SEPARATOR Adds a slash compatible with server environment / __DIR__ Find which directory the file im in is located
/**
 * WordPress: Enqueue scripts and styles
 * @return void
 */
add_action('wp_enqueue_scripts', function()
{
   $website_json        = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'website.json');
   $json_website_json   = json_decode($website_json);


    if(!is_admin()) {
        wp_dequeue_script('wp-embed');
        wp_dequeue_style('wp-block-library');
    }

    // Javascripts // True means footer---False means header
    wp_register_script('js', get_stylesheet_directory_uri() . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'all.min.js', array('jquery'), $json_website_json->js, true);
    wp_enqueue_script('js');
    wp_localize_script('js', 'ajax', array(
        'url' => admin_url('admin-ajax.php')
    ));

    // Stylesheets
    wp_register_style('css', get_template_directory_uri() . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'all.min.css', array(), $json_website_json->css, 'all');
    wp_enqueue_style('css');
});


/**
 * Require walker
 */
require 'lib/walker/bs4Navwalker.php';







add_filter('post_type_link', function($post_link, $post, $leavename, $sample)
{
    if (false !== strpos($post_link, '%produktkategori%'))
    {
        $event_type_term = get_the_terms($post->ID, 'produktkategori');

        if ($event_type_term)
        {
            $post_link = str_replace( '%produktkategori%', array_pop( $event_type_term )->slug, $post_link );
        }
    }

    return $post_link;

}, 10, 4);



/**
 * WordPress: WordPress Header Clean Up
 * @return void
 */
 add_action('init', function()
{
    if (!is_admin())
    {
        /**
         * WordPress: Removes the link to the Really Simple Discovery service endpoint.
         * @return void
         */
        remove_action('wp_head', 'rsd_link');

        /**
         * WordPress: Removes the links to the extra feeds such as category feeds.
         * @return void
         */
        remove_action('wp_head', 'feed_links_extra', 3);

        /**
         * WordPress: Removes the links to the general feeds.
         * @return void
         */
        remove_action('wp_head', 'feed_links', 2);

        /**
         * WordPress: Removes the links to the Windows Live Writer manifest file.
         * @return void
         */
        remove_action('wp_head', 'wlwmanifest_link');

        /**
         * WordPress: Removes the shortlinks to the current page.
         * @return void
         */
        remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

        /**
         * WordPress: Removes the relational links for the posts adjacent to the current post for single post pages.
         * @return void
         */
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

        /**
         * WordPress: Removes the XHTML generator output.
         * @return void
         */
        remove_action('wp_head', 'wp_generator');

        /**
         * WordPress: Removes the links to REST API.
         * @return void
         */
        remove_action('wp_head', 'rest_output_link_wp_head', 10);

        /**
         * WordPress: Removes the links to oEmbed discovery scripts.
         * @return void
         */
        remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);

        /**
         * WordPress: Removes the links to oEmbed scripts.
         * @return void
         */
        remove_action('wp_head', 'wp_oembed_add_host_js');

        /**
         * WordPress: Removes the links to Emoji detection scripts.
         * @return void
         */
        remove_action('wp_head', 'print_emoji_detection_script', 7);

        /**
         * WordPress: Removes the links to emoji-related styles.
         * @return void
         */
        remove_action('wp_print_styles', 'print_emoji_styles');

        /**
         * WordPress: Removes the REST API endpoint.
         * @return void
         */
        remove_action('rest_api_init', 'wp_oembed_register_route');

        /**
         * WordPress: Removes the oEmbed results filter.
         * @return void
         */
        remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

        /**
         * WordPress: Removes the REST API link in HTTP headers.
         * @return void
         */
        remove_action('template_redirect', 'rest_output_link_header', 11, 0);

        /**
         * WordPress: Filters the URL where emoji SVG images are hosted.
         * @return void
         */
        add_filter('emoji_svg_url', '__return_false');

        /**
         * WordPress: Add defer attribute to script tags.
         * @return void
         */
        function add_defer_attribute($tag, $handle)
        {
            return str_replace(' src', ' defer src', $tag);
        }

        add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);
    }
});








