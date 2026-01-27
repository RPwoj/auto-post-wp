<?php
namespace AutoPost\AdminPanel;

use AutoPost\AdminPanel\AdminMenu;
use AutoPost\AdminPanel\AdminAssets;

class Setup {
    public function init() {
        (new AdminMenu())->register();
        (new AdminAssets())->register();
    }
}