<?php

/**
 * Plugin Name: My Plugin
 * Plugin URI: www.kssitservices.com
 * Description: My Plugin Description - KSS IT Group
 * Version: 1.0.0
 * Author: KSS IT Group
 */


 if(!defined('ABSPATH')) {
    header("Location: /");
    die("You are not allowed to access this file directly.");

 };

 function my_plugin_activate() {
    // Do something
    global $wpdb, $table_prefix;
    $wp_emp = $table_prefix.'emp';

    $q = "CREATE TABLE IF NOT EXISTS `$wp_emp` (
        `ID` INT(11) NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(255) NOT NULL,
        `email` VARCHAR(255) NOT NULL,
        `status` BOOLEAN NOT NULL,
        PRIMARY KEY (`ID`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";

    $wpdb->query($q);


     // $q = "INSERT INTO `$wp_emp` (`ID`, `name`, `email`, `status`)
           // VALUES(1, 'KSS IT Group', 'support@kssitservices.com', 1);";

      $data = array(
          'name' => 'KSS IT Group',
          'email' => 'support@kssit.com',
          'status' => 1);

      $wpdb -> insert($wp_emp, $data);
 }

 function my_plugin_deactivate() {
    // Do something
    global $wpdb, $table_prefix;
    $wp_emp = $table_prefix.'emp';
    $q = "DROP TABLE IF EXISTS `$wp_emp`;";

      $wpdb->query($q);
 }

 register_activation_hook(__FILE__, 'my_plugin_activate');
 register_deactivation_hook(__FILE__, 'my_plugin_deactivate');


 function my_plugin_shortcode() {
    echo "Hello World";
 }

 function mp_shortcode($atts) {
   $atts = shortcode_atts (array (
      'msg' => "I'm Akshay", 
      'note' => "This plugin is developed by KSS IT Group"
   ), $atts); 

   ob_start();
   ?>

   <h1>This is Header</h1>

   <?php
   $html = ob_get_clean();

   include 'image_gallery.php';
   //include 'notice.php';
   //return $html;
   //return "Hello World". $atts['msg'] .' '. $atts['note'];
 }

 add_shortcode('my_plugin', 'my_plugin_shortcode');
 add_shortcode('ozevac_plugin', 'mp_shortcode');


 function my_custom_style() {
      wp_enqueue_style('my_custom_style', plugins_url('css/style.css', __FILE__));
 }
 
 function my_custom_scripts() {
   $path = plugins_url('js/main.js', __FILE__);
   $dep = array('jquery');
   $ver = filemtime(plugin_dir_path(__FILE__) . 'js/main.js');
   wp_enqueue_script('my-custom-js', $path, $dep, $ver, true);

 }




 add_action('wp_enqueue_scripts', 'my_custom_scripts');
