<?php
namespace AutoPost;

use AutoPost\Admin\Setup;

class Plugin {
    public function init() {
        (new Setup())->init();
    }
}