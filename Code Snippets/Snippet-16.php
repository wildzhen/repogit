<?php

  /**** CODE FOR PRICE VARIATION  ****/
  add_filter( 'woocommerce_variable_price_html', 'bbloomer_variation_price_format_min', 9999, 2 );

  function bbloomer_variation_price_format_min( $price, $product ) {
  $prices = $product->get_variation_prices( true );
  $min_price = current( $prices['price'] );
  $price = sprintf( __( '%1$s', 'woocommerce' ), wc_price( $min_price ) );
  return $price;
  }
  // removing the price of variable products
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

  // Change location of price on single product
  add_action( 'woocommerce_single_product_summary', 'custom_wc_template_single_price', 10 );
  function custom_wc_template_single_price(){
      global $product;

      // Variable product only
      if($product->is_type('variable')):

          // Main Price
          $prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
          $price = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

          // Sale Price
          $prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
          sort( $prices );
          $saleprice = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

          if ( $price !== $saleprice && $product->is_on_sale() ) {
              $price = '<del>' . $saleprice . $product->get_price_suffix() . '</del> <ins>' . $price . $product->get_price_suffix() . '</ins>';
          }

          ?>
          <style>
              div.woocommerce-variation-price,
              div.woocommerce-variation-availability,
              div.hidden-variable-price {
                  height: 0px !important;
                  overflow:hidden;
                  position:relative;
                  line-height: 0px !important;
                  font-size: 0% !important;
                  visibility: hidden !important;
              }
              .single p.availability {
      display: none;
  }
          </style>
          <script>
              jQuery(document).ready(function($) {
                  // When variable price is selected by default
                  setTimeout( function(){
                      if( 0 < $('input.variation_id').val() && null != $('input.variation_id').val() ){
                          if($('p.availability'))
                              $('p.availability').remove();

                          $('p.price').html($('div.woocommerce-variation-price > span.price').html()).append('<p class="availability">'+$('div.woocommerce-variation-availability').html()+'</p>');
                          console.log($('div.woocommerce-variation-availability').html());
                      }
                  }, 300 );

                  // On live variation selection
                  $('select').blur( function(){
                      if( 0 < $('input.variation_id').val() && null != $('input.variation_id').val() ){
                          if($('.price p.availability') || $('.price p.stock') )
                              $('p.price p').each(function() {
                                  $(this).remove();
                              });

                          $('p.price').html($('div.woocommerce-variation-price > span.price').html()).append('<p class="availability">'+$('div.woocommerce-variation-availability').html()+'</p>');
                          console.log($('input.variation_id').val());
                      } else {
                          $('p.price').html($('div.hidden-variable-price').html());
                          if($('p.availability'))
                              $('p.availability').remove();
                          console.log('NULL');
                      }
                  });
              });
          </script>
          <?php

          echo '
          <div class="hidden-variable-price" >'.$price.'</div>';

      endif;
  }a
