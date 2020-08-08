<?php

/* Display Rating Count on Loop  M-C01*/

add_filter( 'woocommerce_product_get_rating_html', function ( $html, $rating, $count ) {
	global $product;
	if ( $html && is_archive() && $product) {
		$html .= sprintf( '<div class="cubx-rating-count">(%s)</div>', $product->get_rating_count() );
	}

	return $html;
} , 10, 3 );
