<?php

    /*** CART PAGE CROSS SELLS ***/

    // Remove Cross Sells From Default Position

    remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );


    // ---------------------------------------------
    // Add them back UNDER the Cart Table

    add_action( 'woocommerce_after_cart_table', 'woocommerce_cross_sell_display' );

    // ---------------------------------------------
    // Display Cross Sells on 3 columns instead of default 4

    add_filter( 'woocommerce_cross_sells_columns', 'bbloomer_change_cross_sells_columns' );

    function bbloomer_change_cross_sells_columns( $columns ) {
    return 4;
    }
