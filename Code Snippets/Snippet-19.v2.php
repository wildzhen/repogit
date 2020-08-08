<?php

/**
 * Adds product images to the WooCommerce order emails table
 * Uses WooCommerce 2.5 or newer
 *
 * @param string $output the buffered email order items content
 * @param \WC_Order $order
 * @return $output the updated output
 */
function sww_add_images_woocommerce_emails( $output, $order ) {

	// set a flag so we don't recursively call this filter
	static $run = 0;

	// if we've already run this filter, bail out
	if ( $run ) {
		return $output;
	}

	$args = array(
		'show_image'   	=> true,
		'image_size'    => array( 150, 150 ),
	);

	// increment our flag so we don't run again
	$run++;

	// if first run, give WooComm our updated table
	return $order->email_order_items_table( $args );
}
add_filter( 'woocommerce_email_order_items_table', 'sww_add_images_woocommerce_emails', 10, 2 );
