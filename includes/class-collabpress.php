<?php
class CollabPress {
    public function __construct() {
        // Add admin menu
        add_action('admin_menu', [$this, 'add_admin_menu']);

        // Enqueue styles and scripts
        add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);

        // Handle AJAX requests
        add_action('wp_ajax_collabpress_save_task', [$this, 'save_task']);
        add_action('wp_ajax_collabpress_get_tasks', [$this, 'get_tasks']);
        add_action('wp_ajax_collabpress_delete_task', [$this, 'delete_task']);
    }

    // Add menu item in WordPress admin
    public function add_admin_menu() {
        add_menu_page(
            'CollabPress',
            'CollabPress',
            'manage_options',
            'collabpress',
            [$this, 'render_dashboard'],
            'dashicons-groups',
            6
        );
    }

    // Load CSS/JS
    public function enqueue_scripts() {
        wp_enqueue_style('collabpress-admin-style', plugins_url('assets/css/admin-style.css', __FILE__));
        wp_enqueue_script('collabpress-admin-script', plugins_url('assets/js/admin-script.js', __FILE__), ['jquery'], null, true);

        // Localize script for AJAX URL
        wp_localize_script('collabpress-admin-script', 'collabpress_ajax', [
            'ajaxurl' => admin_url('admin-ajax.php')
        ]);
    }

    // Render the dashboard
    public function render_dashboard() {
        require_once plugin_dir_path(__FILE__) . '../templates/dashboard.php';
    }

    // Save a task via AJAX
    public function save_task() {
        global $wpdb;
        $data = $_POST['data'];
        parse_str($data, $task);

        $wpdb->insert($wpdb->prefix . 'collabpress_tasks', [
            'task_name' => sanitize_text_field($task['task_name']),
            'description' => sanitize_textarea_field($task['description']),
            'assigned_to' => sanitize_email($task['assigned_to']),
            'due_date' => sanitize_text_field($task['due_date']),
            'status' => sanitize_text_field($task['status'])
        ]);

        wp_die();
    }

    // Get all tasks via AJAX
    public function get_tasks() {
        global $wpdb;
        $tasks = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}collabpress_tasks");
        echo json_encode($tasks);
        wp_die();
    }

    // Delete a task via AJAX
    public function delete_task() {
        global $wpdb;
        $id = intval($_POST['id']);
        $wpdb->delete($wpdb->prefix . 'collabpress_tasks', ['id' => $id]);
        wp_die();
    }
}