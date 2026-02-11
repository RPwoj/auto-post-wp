<?php

namespace GoldPrices\Admin;

use DateTime;

class AdminOptions {
    public $currentDatetime;

    public function __construct() {
        $datetime = new DateTime();
        $this->currentDatetime = $datetime->format('Y-m-d H:i:s');
    }

    public function register() {
        register_activation_hook(GOLD_PRICES_PLUGIN_PATH, [$this, 'addPriceLastChange']);
    }

    public function addPriceLastChange() {
        if (!get_option('gp_price_last_updated')) add_option('gp_price_last_updated', $this->currentDatetime);
    }

    public function updatePriceLastChange() {
        update_option('gp_price_last_updated', $this->currentDatetime);
    }

    public function getPriceLastChange() {
        return get_option('gp_price_last_updated');
    }
}