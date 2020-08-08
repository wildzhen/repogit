<?php
  // display an 'Out of Stock' label on archive pages
  add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_stock', 8 );
  function woocommerce_template_loop_stock() {
      global $product;
      if ( ! $product->managing_stock() && ! $product->is_in_stock() )
          echo '<p class="stock out-of-stock">Rupture De Stock</p>';
  }
  // display an 'Out of Stock' Message on product page
  function cb_out_of_stock() {
      global $product;
      if ( ! $product->managing_stock() && ! $product->is_in_stock() )
          echo '<p class="out-of-stock-sg">Ce produit est en rupture de stock</p>';
  }
  add_action( 'woocommerce_before_add_to_cart_form', 'cb_out_of_stock', 40 );
