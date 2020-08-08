<?php
    /**** CART ICON SHORTCODE  ******/
    add_shortcode ('woo_cart_but', 'woo_cart_but' );
    /**
    * Create Shortcode for WooCommerce Cart Menu Item
    */
    function woo_cart_but() {
        ob_start();

            $cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count
            $cart_url = wc_get_cart_url();  // Set Cart URL

            ?>
            <ul class="cart-list">
            <li><a class="menu-item cart-contents" href="<?php echo $cart_url; ?>" title="My Basket">
            <?php
            if ( $cart_count > 0 ) {
        ?>
                <span class="cart-contents-count"><?php echo $cart_count; ?></span>
            <?php
            }
            ?>
            </a></li></ul>
            <p>Panier</p>
            <?php

        return ob_get_clean();

    }

    add_filter( 'woocommerce_add_to_cart_fragments', 'woo_cart_but_count' );
    /**
    * Add AJAX Shortcode when cart contents update
    */
    function woo_cart_but_count( $fragments ) {

        ob_start();

        $cart_count = WC()->cart->cart_contents_count;
        $cart_url = wc_get_cart_url();

        ?>
        <a class="cart-contents menu-item" href="<?php echo $cart_url; ?>" title="<?php _e( 'View your shopping cart' ); ?>">
        <?php
        if ( $cart_count > 0 ) {
            ?>
            <span class="cart-contents-count"><?php echo $cart_count; ?></span>
            <?php
        }
            ?></a>
        <?php

        $fragments['a.cart-contents'] = ob_get_clean();

        return $fragments;
    }
