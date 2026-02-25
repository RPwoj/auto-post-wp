<?php
namespace GoldPrices\Admin;

class AdminAssets {
    public function register() {
        add_action('admin_enqueue_scripts', [$this, 'enqueueAssets'], 10, 1);
    }

    public function enqueueAssets() {
        wp_register_script(
            'admin-script',
            GOLD_PRICES_PLUGIN_URL . 'assets/admin/admin-script.js',
            ['jquery'],
            '1.0',
            true
        );

        wp_localize_script(
        'admin-script',
        'goldPricesAdmin',
        [
            'ajaxUrl' => admin_url('admin-ajax.php'),
        ]
    );

        wp_enqueue_script('admin-script');
    }
}