<?php
namespace AutoPost\Services;

use WP_query;


class Post {
    public $data = false;

    public function get($number = -1) {

        $args = array(
            'numberposts' => $number,
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            $this->data = $query->posts;
        }

        return $this->data;
    }

}