<?php
namespace AutoPost\Admin;

class GoldPricePost {

    public function register() {
        add_action( 'init', [$this, 'registerGoldPrices'] );
        add_action( 'add_meta_boxes', [$this, 'addPriceMetaBox'] );
        add_action( 'init', [$this, 'registerPriceMeta'] );
        add_action( 'save_post', [$this, 'savePrice'] );
    }

    public function registerGoldPrices() {
        $args = array(
            'public' => true,
            'label'  => 'Gold prices',
            'supports' => array('title'),
        );

        register_post_type( 'gold-prices', $args );
    }
    
    public function registerPriceMeta() {
        $postID = isset($_GET['post']) ? (int) $_GET['post'] : null;
        if (!get_post_meta($postID, 'price')) {
            add_post_meta($postID, 'price', 0);
        }
    }
    
    public function savePrice($postID, $price = null) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (isset($_POST['price'])) $price = $_POST['price'];
        update_post_meta($postID, 'price', $price);
    }

    public function addPriceMetaBox() {
        add_meta_box('price', 'Price', [$this, 'showPriceMetaBox'], 'gold-prices');
    }

    public function showPriceMetaBox() {
        $postID = isset($_GET['post']) ? (int) $_GET['post'] : null;
        $price = get_post_meta($postID, 'price', true);
        echo '<input name="price" type="text" pattern="\d*" value="'. $price .'"/>';
    }
    
}