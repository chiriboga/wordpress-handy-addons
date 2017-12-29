<?php


/**
 * Automatically adds featured image to the RSS Feed
 */
function featuredtoRSS($content) {
global $post;
if ( has_post_thumbnail( $post->ID ) ){
$content = '<div>' . get_the_post_thumbnail( $post->ID, 'medium', array( 'style' => 'margin-bottom: 15px;' ) ) . '</div>' . $content;
}
return $content;
}
add_filter('the_excerpt_rss', 'featuredtoRSS');
add_filter('the_content_feed', 'featuredtoRSS');



/**
 * Remove Wordpress Version Number
 */
function wpb_remove_version() {
return '';
}
add_filter('the_generator', 'wpb_remove_version');



/**
 * Add Custom Dashboard Widget
 */
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

function my_custom_dashboard_widgets() {
global $wp_meta_boxes;

wp_add_dashboard_widget('custom_help_widget', 'Theme Support', 'custom_dashboard_help');
}

function custom_dashboard_help() {
	echo '<p>INFORMATION HERE</p>';
}



/**
 * Hide Login Errors
 */
function no_wordpress_errors(){
  return 'Something is wrong!';
}
add_filter( 'login_errors', 'no_wordpress_errors' );



/**
 * Remove Welcome Panel
 */
 remove_action('welcome_panel', 'wp_welcome_panel');



  /**
 * Remove junk from head
 */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);




/**
* Only keeps 3 Post revisions in Database
*/
define( 'WP_POST_REVISIONS', 3 );

/**
* Empty trash after set amount of days.
*/
define ('EMPTY_TRASH_DAYS', 1);

/**
* Allows the ability to add Shortcode within the widget area.
*/
add_filter('widget_text','do_shortcode');

/**
* Make sure none of the RSS Feeds are cached
*/
function do_not_cache_feeds(&$feed) {
    $feed->enable_cache(false);
}
add_action( 'wp_feed_options', 'do_not_cache_feeds' );

/**
* REMOVE WP EMOJI
*/
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );





/**
* Adds more mime types to wordpress than the default ones
*/
function modify_post_mime_types($post_mime_types) {
    $post_mime_types['application/pdf'] = array(__('PDF'), __('Manage PDF'), _n_noop('PDF <span class="count">(%s)</span>', 'PDF <span class="count">(%s)</span>'));
    return $post_mime_types;
}
add_filter('post_mime_types', 'modify_post_mime_types');





/**
 * Shortcode for WP function get_template_directory_uri();
 */
// Add Shortcode
function bfp_get_template_directory() {

    $directory = get_template_directory_uri();
    // Code
    return $directory;
}
add_shortcode( 'template_directory', 'bfp_get_template_directory' );


function url_shortcode() {
    return get_bloginfo('url');
}
add_shortcode('url','url_shortcode');

