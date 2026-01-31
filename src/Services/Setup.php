<?php
namespace GoldPrices\Services;

use GoldPrices\Services\DataGold;

class Setup {
    public function init() {
        (new DataGold())->register();
    }
}