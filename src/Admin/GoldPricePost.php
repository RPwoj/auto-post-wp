<?php
namespace GoldPrices\Admin;

class GoldPricePost {

    public function register() {
        add_action('init', [$this, 'registerGoldPrices']);
        add_action('add_meta_boxes', [$this, 'addPriceMetaBox']);
        add_action('init', [$this, 'registerPriceMeta']);
        // add_action('init', [$this, 'deleteAllGoldPrices']);
    }

    // for debug only
    public function deleteAllGoldPrices() {
        if (!current_user_can('delete_posts')) return;

        $posts = get_posts([
            'post_type'   => 'gold-price',
            'numberposts' => -1,
            'fields'      => 'ids',
        ]);

        foreach ($posts as $post_id) {
            wp_delete_post($post_id, true);
        }
    }

    public function registerGoldPrices() {
        $args = array(
            'public' => true,
            'label'  => 'Gold prices',
            'supports' => array('title'),
        );

        register_post_type('gold-price', $args);
    }
    
    public function registerPriceMeta() {
        $postID = isset($_GET['post']) ? (int) $_GET['post'] : null;
        if (!get_post_meta($postID, 'price')) {
            add_post_meta($postID, 'price', 0);
        }
    }

    public function addPriceMetaBox() {
        add_meta_box('price', 'Price', [$this, 'showPriceMetaBox'], 'gold-price');
    }

    public function showPriceMetaBox() {
        $postID = isset($_GET['post']) ? (int) $_GET['post'] : null;
        $price = get_post_meta($postID, 'price', true);
        echo '<input name="price" type="text" pattern="\d*" value="'. $price .'"/>';
    }

}