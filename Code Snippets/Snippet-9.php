<?php
/*
** Remove "Products" from Yoast SEO breadcrumbs in WooCommerce
*/
  add_filter( 'wpseo_breadcrumb_links', function( $links ) {

      // Check if we're on a WooCommerce page
      // Checks if key 'ptarchive' is set
      // Checks if 'product' is the value of the key 'ptarchive', in position 1 in the links array
      if ( is_woocommerce() && isset( $links[1]['ptarchive'] ) && 'Shop' === $links[1]['ptarchive'] ) {

          // True, remove 'Products' archive from breadcrumb links
          unset( $links[1] );

      }

      // Rebase array keys
      $links = array_values( $links );

      // Return modified array
      return $links;

  });

  add_filter('wpseo_breadcrumb_single_link' ,'remove_shop', 10 ,2);
  function remove_shop($link_output, $link ){
      if( $link['text'] == 'Shop' ) {
          $link_output = '';
      }
      return $link_output;
  }
