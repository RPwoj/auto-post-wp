<?php
/**
* Plugin Name: Auto post
*/

if (!defined('ABSPATH')) exit;

define('AUTO_POST_PLUGIN_PATH', plugin_dir_path(__FILE__));

use AutoPost\Plugin;

(new Plugin())->init();