<?php
namespace AutoPost\AdminPanel;

use AutoPost\AdminPanel\AdminMenu;

class Setup {
    public function init() {
        (new AdminMenu())->register();
    }
}