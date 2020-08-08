<?php
      // Woocommerce Pricing Symbol - Remove  & replace all currency symbols

      function sww_remove_wc_currency_symbols( $currency_symbol, $currency ) {
          $currency_symbol = ' FCFA';
          return $currency_symbol;
      }
      add_filter('woocommerce_currency_symbol', 'sww_remove_wc_currency_symbols', 10, 2);
