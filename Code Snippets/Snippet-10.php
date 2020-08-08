<?php

      /* Display Items Sizes on Shop Loop */
      add_action( 'woocommerce_shop_loop_item_title', 'display_size_attribute', 5 );
      function display_size_attribute() {
          global $product;

          $mysize="N/A";
          $pointure = $product->get_attribute('pa_taille');
      if( empty( $pointure)) echo '<div class="attribute-size">' .$mysize. '</div>';
      if( ! empty( $pointure ) ) {
          if( $product->is_type( 'simple' ) ){
              $taxonomy= 'pa_taille';
              echo '<div class="attribute-size">' . $product->get_attribute($taxonomy) . '</div>';
          }
          if ( $product->is_type('variable') ) {
              $taxonomy = 'pa_taille';
              echo '<div class="attribute-size">' . $product->get_attribute($taxonomy) . '</div>';
          }
      }


  }
