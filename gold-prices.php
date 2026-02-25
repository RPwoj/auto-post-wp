<?php
/**
* Plugin Name: Gold Prices
*/

if (!defined('ABSPATH')) exit;

define('GOLD_PRICES_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('GOLD_PRICES_PLUGIN_URL', plugin_dir_url(__FILE__ ));

use GoldPrices\Plugin;

(new Plugin())->init();