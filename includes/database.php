<?php
class CollabPress_Database {
    public static function create_tables() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'collabpress_tasks';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id INT AUTO_INCREMENT PRIMARY KEY,
            task_name VARCHAR(255) NOT NULL,
            description TEXT,
            assigned_to VARCHAR(255),
            due_date DATE,
            status VARCHAR(50)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}