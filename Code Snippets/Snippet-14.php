<?php

  /*** WOOCOMMERCE CART PAGE  ***/
  // cart page return to shop link
  add_filter( 'woocommerce_return_to_shop_redirect', 'tm_get_shop_link' );
  // continue shopping redirect
  add_filter( 'woocommerce_continue_shopping_redirect', 'tm_get_shop_link' );
  function tm_get_shop_link() {
  return get_site_url().'/';
  }
