<?php
namespace GoldPrices\Services;

class Helpers {
    public function jsonToArray($data) {
        return json_decode($data, true);
    }

    public function replaceDotInNumber($number) {
        return str_replace('.', ',', $number);
    }
}