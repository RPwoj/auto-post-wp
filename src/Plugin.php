<?php
namespace GoldPrices;

use GoldPrices\Admin\Setup as Admin;
use GoldPrices\Services\Setup as Services;

class Plugin {
    public function init() {
        (new Admin())->init();
        (new Services())->init();
    }
}