<?php
namespace GoldPrices\Admin;

use GoldPrices\Admin\AdminMenu;
use GoldPrices\Admin\AdminAssets;
use GoldPrices\Admin\GoldPricePost;

class Setup {
    public function init() {
        (new AdminMenu())->register();
        (new AdminAssets())->register();
        (new GoldPricePost())->register();
    }
}