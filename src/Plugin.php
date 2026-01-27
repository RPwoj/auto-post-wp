<?php
namespace AutoPost;

use AutoPost\AdminPanel\Setup;

class Plugin {
    public function init() {
        (new Setup())->init();
    }
}