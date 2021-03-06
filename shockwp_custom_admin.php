<?php
/*
Plugin Name: SHOCKWP Custom Admin
Plugin URI: https://github.com/SHOCKStudio/SHOCKWP_Custom_Admin
Description: Custom Admin Panel and login
Version: 1.0.46
Author: SHOCKStudio Sp. z o.o.
Author URI: https://shockstudio.pl
GitHub Plugin URI: https://github.com/SHOCKStudio/SHOCKWP_Custom_Admin
*/

// login error hide
function no_wordpress_errors(){
  return 'Something is wrong!';
}
add_filter( 'login_errors', 'no_wordpress_errors' );

// redirect loguot
add_action('wp_logout','auto_redirect_after_logout');
function auto_redirect_after_logout(){
  wp_redirect( home_url() );
  exit();
}

// redirect to home panel login
function my_login_logo_url() {
  return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );
function my_login_logo_url_title() {
  return 'Panel zarządzania';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

// default theme admin and remove switcher
function oz_change_admin_color( $result ) {
  return 'default';
}
add_filter( 'get_user_option_admin_color', 'oz_change_admin_color' );
remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

// add admin style panel and login page
function admin_style() {
  wp_enqueue_style('admin-styles', plugin_dir_url( __FILE__ ) .'public/css/adminbase_customshock.css');
}
add_action('admin_enqueue_scripts', 'admin_style');
function custom_login() {
	echo '<link rel="stylesheet" type="text/css" href="' . plugin_dir_url( __FILE__ ) .'public/css/adminbase_customshock.css" />'; 
  //echo '<link rel="stylesheet" type="text/css" href="' . get_template_directory_uri().'/admin-style.css" />'; 
}
add_action('login_head', 'custom_login');

function my_login_logo() {
  echo "<style type='text/css'>
  body.login-action-login {
    background-image: url('".plugin_dir_url( __FILE__ )."public/img/bglogin.jpg');
  }
  </style>";
}
add_action( 'login_enqueue_scripts', 'my_login_logo' );
