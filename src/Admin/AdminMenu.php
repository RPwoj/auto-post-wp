<?php
namespace AutoPost\Admin;

use AutoPost\Services\Post;

class AdminMenu {
    public function register() {
        add_action('admin_menu', [$this, 'addMenuPage']);
    }

    public function addMenuPage() {
        add_menu_page('Auto Post', 'Auto Post', 'manage_options', 'auto-post', [$this, 'render']);
    }

    public function render(): void {
        (new Post())->get();
        require AUTO_POST_PLUGIN_PATH . '/templates/admin-panel-template.php';
    }
}