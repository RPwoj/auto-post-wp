<?php
namespace GoldPrices\Services;

use GoldPrices\Services\Helpers;
use GoldPrices\Admin\AdminOptions;

class DataGold {
    public function register() {
        add_action('wp_ajax_save_gold_prices', [$this, 'savePrices']);
        add_action('wp_ajax_nopriv_save_gold_prices', [$this, 'savePrices']);
        add_action( 'save_post', [$this, 'updatePriceMeta'] );
    }

    public function get($number = 5) {
        $url = 'https://api.nbp.pl/api/cenyzlota/last/' . $number .'/?format=json';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    public function savePrices() {
        $dataRaw = $this->get();
        $data = (new Helpers())->jsonToArray($dataRaw);
        $dataUpdated = false;
        $dates = [];
    
        foreach($data as $price) {
            $dateExist = $this->checkPriceByDate($price['data']);
            $dates[] = $price['data'];
            if (!$dateExist) {
                $this->createNewGoldPrice($price['data'], $price['cena']);
                $dataUpdated = true;
            }
        }

        if ($dataUpdated) {
            $priceToRemove = $this->checkPriceToRemove(min($dates));
            $priceRemoved = $this->removePrice($priceToRemove);
            (new AdminOptions())->updatePriceLastChange();
        }
        
        wp_send_json(['info' => $priceRemoved]);
    }

    public function createNewGoldPrice($date, $price) {
        $args = array(
            'post_title'    => $date,
            'post_type'     => 'gold-price',
            'post_status'   => 'publish',
            'post_date'     => $date,
        );
        
        $postID = wp_insert_post($args);
        $this->updatePriceMeta($postID, $price);
    }

    public function updatePriceMeta($postID, $price = null) {
        if (defined(constant_name: 'DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (isset($_POST['price'])) $price = $_POST['price'];
        update_post_meta($postID, 'price', number_format($price, 2, ',', ''));
    }

    public function checkPriceByDate($date) {
        $price = get_posts([
            'post_type'   => 'gold-price',
            'numberposts' => -1,
            'fields'      => 'ids',
            'date_query'     => [
                [
                    'before'    => $date . ' 23:59:59',
                    'after'    => $date . ' 00:00:00',
                    'inclusive'  => true,
                ],
            ],
        ]);

        return $price[0];
    }

    public function checkPriceToRemove($date) {
        $price = get_posts([
            'post_type'   => 'gold-price',
            'numberposts' => -1,
            'fields'      => 'ids',
            'date_query'     => [
                [
                    'before' => $date,
                ],
            ],
        ]);

        return $price[0];
    }
    
    public function removePrice($id) {
        $price = wp_delete_post( $id, false);

        return $price;
    }
}