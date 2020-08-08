<?php

      // Woocommerce - Checkout Page

      add_filter( 'woocommerce_checkout_fields', 'bbloomer_set_checkout_field_input_value_default' );

      function bbloomer_set_checkout_field_input_value_default($fields) {
          $fields['billing']['billing_city']['default'] = 'Abidjan';
          return $fields;
      }

      function replace_text($text) {

          $text = str_replace('Billing address', 'Addresse', $text);
          return $text;
      }
      add_filter('the_content', 'replace_text');
