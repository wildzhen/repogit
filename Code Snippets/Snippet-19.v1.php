<?php

/**
 * @snippet       WooCommerce Remove Product Permalink of Product @ Order Table
 * @how-to        CUBX DESIGN
 * @sourcecode    http://cubx.ci
 * @author        Cubx Squad
 * @testedwith    WooCommerce 3.5
 */

add_filter( 'woocommerce_order_item_permalink', '__return_false' );
