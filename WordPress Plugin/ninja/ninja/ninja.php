<?php
/*
Plugin Name: Ninja Plugin
Description: USE SHORTCODE [cakelist] or [cakelist cat=abc]
Version:     1.4
Author:      Ninja
*/


if ( ! defined( 'ABSPATH' ) ) {
	die( 'Access denied.' );
}

define('NINJA_API_URL', 'https://cakeci.projectanddemoserver.com/');
define('NINJA_API_TOKEN', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNDMyMzlmMTczODBlZjE0NGRlYTUzMjJmZDM3MzUxN2IwYTQ0ODQ2MDQyMjIxYmQxYWUwZjAxZmEzMTlhNzY5OGY4NDQwZWVmMTcwMzM5NjgiLCJpYXQiOjE2Njc5MDgwOTUuNzExOTQsIm5iZiI6MTY2NzkwODA5NS43MTE5NDEsImV4cCI6MTY5OTQ0NDA5NS43MDc2MjcsInN1YiI6IjMiLCJzY29wZXMiOltdfQ.UbJhLg4wGKgGz3uCuK3-fPOWqBj1WRIKAPPl08Sve_GHVrtoxkeDcNMIdUFjFOPNmb9xjiO47eA_9kSzEoBcL76WeLsdHFWu51Eh1qt-M89XNAv3vf6ay_SKmNYA-RqKrnIm8OMERdZePA3hbyLpmJCDXr90C3w8A0HvP4hUhE1kThvJszhc9hOry4JQiAiT9lzJ_fuV6QYLesgvje40Vi5W0Gms2AELQzeQXf0UJi4ZnjLlDPA6cHsvqCID9f2jFIX3mVc2K_oQis8icLumEr-OTo5Enm6EEJheXhhI6-lVDWWSSp5svbLf6y0LuEvzuLeOeJ9WEyJUs5HiHTgho0pOs1WqvTjbbnl5jiEiux0WO041Os5QtrVq23jp7GUu4aerzAVRCkZGPx9MPR3IfIo2fhzAegOU4dSqK50i6MtoAfVtrfVqYm4bYNejjoWaWXbZkAaTZvfq2-CyQzYUANFxIKeSqIcnca_FiTmsogPUTyQ33EFdnbQsp-xBDDyJqX6bPmLF1qqFhdwsdjXTZx0bRZYQCyMNDdPQj8MHPZSlnxyDK-jvBELdDozMsfX7ZlqzkpSLdWvJrYyGlVaWzar5XASbh1KV_yFsTm-FXO51_lOAAiw5gseGbvxCOmqzWzUZrwikm1XYNpFkL7XUcKdTpwjoYMGPNu1VO8EpGFM');



register_activation_hook( __FILE__, 'ninja_plugin_activate' );
register_deactivation_hook( __FILE__, 'ninja_plugin_deactivate' );



require_once( __DIR__ . '/admin/add-page.php' );
require_once( __DIR__ . '/admin/list-page.php' );
require_once( __DIR__ . '/shortcode/list.php' );


add_action('wp_enqueue_scripts','ninja_client_script');
add_action('admin_enqueue_scripts','ninja_admin_script');


function ninja_client_script() {
    wp_enqueue_script( 'client-js', plugins_url( '/assets/js/client.js', __FILE__ ),array('jquery'));
    wp_enqueue_script( 'bootstrap-js', plugins_url( '/assets/js/bootstrap-4.4.1.js', __FILE__ ),array('jquery'));
    wp_enqueue_script( 'popper-js', plugins_url( '/assets/js/popper.min.js', __FILE__ ),array('jquery'));

    wp_enqueue_style('bootstrap-css', plugins_url( '/assets/css/bootstrap-4.4.1.css', __FILE__ ), array(), '0.1.0', 'all');
    wp_enqueue_style('style-css', plugins_url( '/assets/css/style.css', __FILE__ ), array(), '0.1.0', 'all');

    $api_data = array(
        'API_URL' => NINJA_API_URL,
        'API_TOKEN' => 'Bearer ' . NINJA_API_TOKEN
    );
    wp_localize_script( 'client-js', 'NINJA', $api_data );
}

function ninja_admin_script() {

    wp_enqueue_script( 'admin-js', plugins_url( '/admin/assets/js/admin.js', __FILE__ ));

    $api_data = array(
        'API_URL' => NINJA_API_URL,
        'API_TOKEN' => 'Bearer ' . NINJA_API_TOKEN
    );
    wp_localize_script( 'admin-js', 'NINJA', $api_data );
}

add_action('admin_menu', 'ninja_plugin_setup_menu');
 
function ninja_plugin_setup_menu(){
    add_menu_page( __( 'Ninja Cakes', 'ninja' ), __( 'Ninja Cakes', 'ninja' ), 'manage_options', 'ninja-plugin', 'ninja_admin_page_list');
    add_submenu_page( 'ninja-plugin', __( 'Add Ninja Cake', 'ninja' ), __( 'Add Ninja Cake', 'ninja' ),	'manage_options','ninja-plugin-add', 'ninja_admin_page_add');

}

function add_cors_http_header(){
    header("Access-Control-Allow-Origin: *");
}
add_action('init','add_cors_http_header');


function ninja_plugin_activate() {
	//flush_rewrite_rules();
}
function ninja_plugin_deactivate() {
	//flush_rewrite_rules();
}