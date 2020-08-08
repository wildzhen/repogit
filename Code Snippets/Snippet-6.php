<?php
      // Woocommerce Variable Product Option Selection - Remove Text

      add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'dropdown_variation_attribute_options', 10, 1 );
      function dropdown_variation_attribute_options( $args ){

          // For attribute "Couleur"
          if( 'pa_couleur' == $args['attribute'] )
              $args['show_option_none'] = __( 'Choissisez une couleur', 'woocommerce' );

          // For attribute "Sizes"
          if( 'pa_taille' == $args['attribute'] )
              $args['show_option_none'] = __( 'Choisissez une taille', 'woocommerce' );

          return $args;
      }
