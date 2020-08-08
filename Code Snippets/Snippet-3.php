<?php

// Woocommerce Add Brands to Catalog Page Through Attributes FOR STYLE 2 CATALOG

      add_action('woocommerce_shop_loop_item_title', 'brands', 9);

      function brands()
      {
      global $product;

      $ok="N/A";
      $brand = $product->get_attribute('pa_marques');
      if (empty($brand)) echo '<span class="nobrd">' .$ok. '</span>';
      echo '<span class="loop-brands">'.$brand.'</span>';

      }
