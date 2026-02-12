<?php
namespace GoldPrices\Admin;

use GoldPrices\Services\DataGold;

class CronManager {
    public function register() {
        add_action('gp_update_prices_hook', [$this, 'updatePrices']);

        if (!wp_next_scheduled('gp_update_prices_hook')) {
            wp_schedule_event(time(), 'twicedaily', 'gp_update_prices_hook');
        }
    }

    public function updatePrices() {
        (new DataGold())->savePrices();
    }
}