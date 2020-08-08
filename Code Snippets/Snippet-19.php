<?php

/* Save item SKU inside Order Details in Database */

add_action( 'woocommerce_add_order_item_meta', 'majemedia_save_item_sku_order_itemmeta', 10, 3 );
function majemedia_save_item_sku_order_itemmeta( $item_id, $values, $cart_item_key ) {
?>
<style type="text/css">
    .wc-item-meta {
        display:none !important;
    }
  </style>
<?php
$item_sku  =  get_post_meta( $values[ 'product_id' ], '_sku', true );

$item_has_variation  =  ( ! empty( $values[ 'variation_id' ] ) ? true : false );

if( $item_has_variation ) {

        wc_add_order_item_meta( $item_id, 'parent_sku', $item_sku, false );

        $variation_sku  =  get_post_meta( $values[ 'variation_id' ], '_sku', true );
        wc_add_order_item_meta( $item_id, 'variation_sku', $variation_sku, false );

}
else {

        wc_add_order_item_meta( $item_id, 'sku', $item_sku , false );

}

}
/* REMOVE EXTRA META:: Only Display On Order Notification Email */

add_filter( 'woocommerce_order_item_get_formatted_meta_data', 'unset_specific_order_item_meta_data', 20, 2);
function unset_specific_order_item_meta_data($formatted_meta, $item){
            // Only on emails notifications

    foreach( $formatted_meta as $key => $meta ){
        if( in_array( $meta->key, array('parent_sku', 'variation_sku','store_name','store_phone','store_address','store_agent','sku') ) )
            unset($formatted_meta[$key]);
    }
    return $formatted_meta;
}
