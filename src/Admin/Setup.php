<?php
namespace AutoPost\Admin;

use AutoPost\Admin\AdminMenu;
use AutoPost\Admin\AdminAssets;
use AutoPost\Admin\GoldPricePost;

class Setup {
    public function init() {
        (new AdminMenu())->register();
        (new AdminAssets())->register();
        (new GoldPricePost())->register();
    }
}