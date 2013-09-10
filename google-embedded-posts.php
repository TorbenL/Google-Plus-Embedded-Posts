<?php
/*
Plugin Name: Google+ Embedded Posts
Plugin URI: http://www.torbenleuschner.de/blog/886/google-beitrage-per-wordpress-plugin-einbetten/
Description: Add Google+ posts to your Wordpress blog. You can embed a post via shortcode [gp-post href=""] in your articles or pages.
Author: Torben Leuschner
Author URI: http://www.torbenleuschner.de
Version: 1.0
*/

function gp_embedded_register_shortcodes()
{
    add_shortcode('gp-post', 'gp_embedded_post');
}

function gp_embedded_post($a)
{
    if(!$a['href'])
        return '<div style="color:red;">Google+ Post: Shortcode parameter "href" is required</div>';

    if(strpos($a['href'], 'google.') === false)
        return '<div style="color:red;">Google+ Post: Shortcode parameter "href" must contain a valid Google URL</div>';

    return '
	<script>window.___gcfg = {lang: \''.esc_js( gp_embedded_get_language() ).'\'};</script>
    <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
    <div class="g-post" data-href="'.esc_attr( $a['href'] ).'"></div>';
}


function gp_embedded_get_language()
{
    $lang = get_bloginfo('language');
    $codes = explode('-', $lang);

    return $codes[0];
}


add_action( 'init', 'gp_embedded_register_shortcodes');
?>
