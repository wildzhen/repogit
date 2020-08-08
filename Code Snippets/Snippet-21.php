<?php

/* Adding Store Information to Email-ACF */
add_action( 'woocommerce_email_customer_details', 'display_store_information', 99, 4 );
function display_store_information( $order, $sent_to_admin, $plain_text, $email ) {
// Only admin notifications
if( ! $sent_to_admin )
     return; // Exit

$store_name = get_field('store_name', 'user_1');
$store_phone = get_field('store_phone', 'user_1');
$store_address = get_field('store_address','user_1');

echo '<div class="block-info">
<h3 style="text-decoration:underline;margin:5px 0;">Information Magasin</h3>
<ul style="padding:0px;margin:5px 0;list-style:none;font-style:12px;">
<li style="margin:0;font-size: 12px;
line-height: 1.5;">Nom du magasin: '. $store_name . '</li>
<li style="margin:0;font-size: 12px;
line-height: 1.5;">Numéro de téléphone: '. $store_phone . '</li>
<li style="margin:0;font-size: 12px;
line-height: 1.5;">Addresse: '. $store_address . '</li>
</ul></div>';
}
