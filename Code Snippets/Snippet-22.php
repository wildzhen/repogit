<?php

// Add the user roles as order meta data in Database
add_action( 'woocommerce_add_order_item_meta', 'add_store_info', 10, 2 );
function add_store_info( $item_id, $cart_item_key ) {

$store_name = get_field('store_name', 'user_1');
$store_phone = get_field( 'store_phone', 'user_1');
$store_address = get_field( 'store_address','user_1');
$store_agent = get_field( 'store_agent','user_1');

    wc_add_order_item_meta( $item_id, 'store_name', $store_name , false );
    wc_add_order_item_meta( $item_id, 'store_phone', $store_phone , false );
    wc_add_order_item_meta( $item_id, 'store_address', $store_address , false );
    wc_add_order_item_meta( $item_id, 'store_agent', $store_agent , false );

}
