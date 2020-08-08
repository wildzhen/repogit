<?php

/* Remove Billing and Shipping from email new order */
function removing_customer_details_in_emails( $order, $sent_to_admin, $plain_text, $email ){
$wmail = WC()->mailer();
remove_action( 'woocommerce_email_customer_details', array( $wmail, 'email_addresses' ), 20, 3 );
}
add_action( 'woocommerce_email_customer_details', 'removing_customer_details_in_emails', 5, 4 );
