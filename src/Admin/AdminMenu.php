<?php
namespace GoldPrices\Admin;

class AdminMenu {
    public function register() {
        add_action('admin_menu', [$this, 'addMenuPage']);
    }

    public function addMenuPage() {
        add_menu_page('Gold Prices Plugin', 'Gold Prices Plugin', 'manage_options', 'gold-prices-plugin', [$this, 'render']);
    }

    public function render(): void {
        require GOLD_PRICES_PLUGIN_PATH . '/templates/admin-panel-template.php';
    }
}