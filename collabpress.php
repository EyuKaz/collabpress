<?php
/*
Plugin Name: CollabPress
Description: Collaborative task management for WordPress teams.
Version: 1.0
Author: Eyu Kassa
*/

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Load dependencies
require_once plugin_dir_path(__FILE__) . 'includes/database.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-collabpress.php';

// Initialize the plugin
register_activation_hook(__FILE__, 'collabpress_activate');
function collabpress_activate() {
    require_once plugin_dir_path(__FILE__) . 'includes/database.php';
    CollabPress_Database::create_tables();
}

// Run the plugin
add_action('plugins_loaded', function() {
    new CollabPress();
});