<?php
namespace AutoPost\AdminPanel;

class AdminAssets {
    public function register() {
        add_action( 'admin_enqueue_scripts', [$this, 'enqueueAssets'], 10, 1 );
    }

    public function enqueueAssets() {
        wp_register_script('admin-script', AUTO_POST_PLUGIN_URL . 'assets/admin/admin-script.js');
        wp_enqueue_script( 'admin-script' );
    }
}