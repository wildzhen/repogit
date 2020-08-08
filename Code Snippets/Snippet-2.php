<?php

// Woocommerce Remove Zoom Lightbox

        add_action( 'after_setup_theme', 'woo_remove_zoom_lightbox_theme_support', 99 );
        function woo_remove_zoom_lightbox_theme_support() {
            remove_theme_support( 'wc-product-gallery-zoom' );
        }
