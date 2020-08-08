<?php
    // Exit if accessed directly
    if ( !defined( 'ABSPATH' ) ) exit;

    // BEGIN ENQUEUE PARENT ACTION
    // AUTO GENERATED - Do not modify or remove comment markers above or below:

    if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
        function chld_thm_cfg_locale_css( $uri ){
            if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
                $uri = get_template_directory_uri() . '/rtl.css';
            return $uri;
        }
    endif;
    add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

    if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
        function chld_thm_cfg_parent_css() {
            wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
        }
    endif;
    add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

    // END ENQUEUE PARENT ACTION

    @ini_set( 'upload_max_size' , '120M' );
    @ini_set( 'post_max_size', '120M');
    @ini_set( 'max_execution_time', '300' );
    @ini_set( 'max_input_size' , '180' );

    /************** EBOUTIK - STYLE 3 **************/
    /***** EBOUTIK - JAVASCRIPT ENQUEUE */

    function my_eboutik_scripts() {
        wp_enqueue_script('main.js', get_stylesheet_directory_uri()  . '/js/main.js', array(), date("h:i:s") );

    }
    add_action('wp_enqueue_scripts', 'my_eboutik_scripts');



    /**** EBOUTIK- WOOCOMMERCE *****/

    // Change WooCommerce "Related products" text

    add_filter('gettext', 'change_rp_text', 10, 3);
    add_filter('ngettext', 'change_rp_text', 10, 3);

    function change_rp_text($translated, $text, $domain)
    {
        if ($text === 'Related products' && $domain === 'woocommerce') {
            $translated = esc_html__('Recommandations', $domain);
        }
        $translated= str_replace("Filtrer les termes", "Rechercher", $translated);
        $translated= str_replace("Afficher uniquement les produits en vente", "Voir les soldes", $translated);
        $translated= str_replace("Next", "Suivant", $translated);
        $translated= str_replace("Previous", "Precédent", $translated);
        return $translated;
    }

    // Woocommerce Remove Zoom Lightbox

    add_action( 'after_setup_theme', 'woo_remove_zoom_lightbox_theme_support', 99 );
    function woo_remove_zoom_lightbox_theme_support() {
        remove_theme_support( 'wc-product-gallery-zoom' );
    }

    // Woocommerce Add Brands to Catalog Page Through Attributes FOR STYLE 2 CATALOG

    add_action('woocommerce_shop_loop_item_title', 'brands', 9);

    function brands()
    {
    global $product;

    $ok="N/A";
    $brand = $product->get_attribute('pa_marques');
    if (empty($brand)) echo '<span class="nobrd">' .$ok. '</span>';
    echo '<span class="loop-brands">'.$brand.'</span>';

    }

    // Change Sales Badge Text

    add_filter('woocommerce_sale_flash', 'woocommerce_custom_sale_text', 10, 3);
    function woocommerce_custom_sale_text($text, $post, $_product)
    {
        return '<span class="onsale">Solde!</span>';
    }


    // Woocommerce Pricing Symbol - Remove  & replace all currency symbols

    function sww_remove_wc_currency_symbols( $currency_symbol, $currency ) {
        $currency_symbol = ' FCFA';
        return $currency_symbol;
    }
    add_filter('woocommerce_currency_symbol', 'sww_remove_wc_currency_symbols', 10, 2);

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


    /**** EBOUTIK - Breadcrumbs *****/

    add_filter('et_before_main_content','cubx_breadcrumbs');
    function cubx_breadcrumbs(){
    if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb( '<div class="et_pb_row et_pb_row_0_tb_body et_pb_gutters1 et_pb_row_1-4_3-4 b-container">
    <div id="breadcrumbs">','</div></div>' );
    }
    }

/*
** Paste in functions.php
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

    /*** Product Archive Display
    // Remove prices
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

    // Move title in new container, move "formatted price" in the same container

    remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 ); // Remove title form original position
    add_action('woocommerce_shop_loop_item_title', 'abChangeProductsTitle', 10 ); // Insert title in new position ( out of main container )
    function abChangeProductsTitle() {
    $price = get_post_meta( get_the_ID(), '_regular_price', true); // Retrieve products regular price
    $formatted_price = wc_price( $price ); // Formatted price by adding decimal
        echo '<a class="be_prod_title" href="'.get_the_permalink().'"><h2 class="woocommerce-loop-product__title">' . get_the_title() . '</h2><span class="price"><span class="woocommerce-Price-amount amount">'. $formatted_price .'</span></span></a>'; // Print new html with title and price
    }
    // Force 3 columns Everywhere (STYLE 1)
    * Change number or products per row to 3

    add_filter('loop_shop_columns', 'loop_columns', 999);
    if (!function_exists('loop_columns')) {
        function loop_columns() {
            return 3; // 3 products per row
        }
    }

    /* Montrer les Tailles */
    add_action( 'woocommerce_shop_loop_item_title', 'display_size_attribute', 5 );
    function display_size_attribute() {
        global $product;

        $mysize="N/A";
        $pointure = $product->get_attribute('pa_taille');
    if( empty( $pointure)) echo '<div class="attribute-size">' .$mysize. '</div>';
    if( ! empty( $pointure ) ) {
        if( $product->is_type( 'simple' ) ){
            $taxonomy= 'pa_taille';
            echo '<div class="attribute-size">' . $product->get_attribute($taxonomy) . '</div>';
        }
        if ( $product->is_type('variable') ) {
            $taxonomy = 'pa_taille';
            echo '<div class="attribute-size">' . $product->get_attribute($taxonomy) . '</div>';
        }
    }


}
    /*** CART PAGE CROSS SELLS ***/

    // Remove Cross Sells From Default Position

    remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );


    // ---------------------------------------------
    // Add them back UNDER the Cart Table

    add_action( 'woocommerce_after_cart_table', 'woocommerce_cross_sell_display' );

    // ---------------------------------------------
    // Display Cross Sells on 3 columns instead of default 4

    add_filter( 'woocommerce_cross_sells_columns', 'bbloomer_change_cross_sells_columns' );

    function bbloomer_change_cross_sells_columns( $columns ) {
    return 4;
    }


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

    /*** WOOCOMMERCE ACCOUNT PAGE  ***/
    //Woocommerce Custom Registration Form

    function wooc_extra_register_fields() {?>
        <p class="form-row form-row-first">
        <label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?><span class="required">*</span></label>
        <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
        </p>
        <p class="form-row form-row-last">
        <label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?><span class="required">*</span></label>
        <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
        </p>
        <p class="form-row form-row-wide">
        <label for="reg_billing_phone"><?php _e( 'Phone', 'woocommerce' ); ?></label>
        <input type="text" class="input-text" name="billing_phone" id="reg_billing_phone" value="<?php esc_attr_e( $_POST['billing_phone'] ); ?>" />
        </p>
        <div class="clear"></div>
        <?php
    }
    add_action( 'woocommerce_register_form_start', 'wooc_extra_register_fields' );


    /*** WOOCOMMERCE CART PAGE  ***/
    // cart page return to shop link
    add_filter( 'woocommerce_return_to_shop_redirect', 'tm_get_shop_link' );
    // continue shopping redirect
    add_filter( 'woocommerce_continue_shopping_redirect', 'tm_get_shop_link' );
    function tm_get_shop_link() {
    return get_site_url().'/';
    } // end function


    /* BRAND SHORTCODE */

    function single_brands()
    {
    global $product;

    $ok="N/A";
    $brand = $product->get_attribute('pa_marques');
    if (empty($brand))return '<div class="nobrd">' .$ok. '</div>';
    return '<div class="loop-brands">'.$brand.'</div>';
    }

    add_shortcode('brands','single_brands');

    /**** CODE FOR PRICE VARIATION  ****/
    add_filter( 'woocommerce_variable_price_html', 'bbloomer_variation_price_format_min', 9999, 2 );

    function bbloomer_variation_price_format_min( $price, $product ) {
    $prices = $product->get_variation_prices( true );
    $min_price = current( $prices['price'] );
    $price = sprintf( __( '%1$s', 'woocommerce' ), wc_price( $min_price ) );
    return $price;
    }
    // removing the price of variable products
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

    // Change location of
    add_action( 'woocommerce_single_product_summary', 'custom_wc_template_single_price', 10 );
    function custom_wc_template_single_price(){
        global $product;

        // Variable product only
        if($product->is_type('variable')):

            // Main Price
            $prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
            $price = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

            // Sale Price
            $prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
            sort( $prices );
            $saleprice = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

            if ( $price !== $saleprice && $product->is_on_sale() ) {
                $price = '<del>' . $saleprice . $product->get_price_suffix() . '</del> <ins>' . $price . $product->get_price_suffix() . '</ins>';
            }

            ?>
            <style>
                div.woocommerce-variation-price,
                div.woocommerce-variation-availability,
                div.hidden-variable-price {
                    height: 0px !important;
                    overflow:hidden;
                    position:relative;
                    line-height: 0px !important;
                    font-size: 0% !important;
                    visibility: hidden !important;
                }
                .single p.availability {
        display: none;
    }
            </style>
            <script>
                jQuery(document).ready(function($) {
                    // When variable price is selected by default
                    setTimeout( function(){
                        if( 0 < $('input.variation_id').val() && null != $('input.variation_id').val() ){
                            if($('p.availability'))
                                $('p.availability').remove();

                            $('p.price').html($('div.woocommerce-variation-price > span.price').html()).append('<p class="availability">'+$('div.woocommerce-variation-availability').html()+'</p>');
                            console.log($('div.woocommerce-variation-availability').html());
                        }
                    }, 300 );

                    // On live variation selection
                    $('select').blur( function(){
                        if( 0 < $('input.variation_id').val() && null != $('input.variation_id').val() ){
                            if($('.price p.availability') || $('.price p.stock') )
                                $('p.price p').each(function() {
                                    $(this).remove();
                                });

                            $('p.price').html($('div.woocommerce-variation-price > span.price').html()).append('<p class="availability">'+$('div.woocommerce-variation-availability').html()+'</p>');
                            console.log($('input.variation_id').val());
                        } else {
                            $('p.price').html($('div.hidden-variable-price').html());
                            if($('p.availability'))
                                $('p.availability').remove();
                            console.log('NULL');
                        }
                    });
                });
            </script>
            <?php

            echo '
            <div class="hidden-variable-price" >'.$price.'</div>';

        endif;
    }
    /* Activate for Eboutik Style 3 catalogs Move Rating on loop

    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 11 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 12 );
*/

/* Activate for Model C01, */

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_price', 9 );



/* Save item SKU inside Order Details in Database */

add_action( 'woocommerce_add_order_item_meta', 'majemedia_save_item_sku_order_itemmeta', 10, 3 );
function majemedia_save_item_sku_order_itemmeta( $item_id, $values, $cart_item_key ) {
        $item_sku  =  get_post_meta( $values[ 'product_id' ], '_sku', true );

        $item_has_variation  =  ( ! empty( $values[ 'variation_id' ] ) ? true : false );

        if( $item_has_variation ) {

                wc_add_order_item_meta( $item_id, 'parent_sku', $item_sku, false );

                $variation_sku  =  get_post_meta( $values[ 'variation_id' ], '_sku', true );
                wc_add_order_item_meta( $item_id, 'variation_sku', $variation_sku, false );

        }
        else {

                wc_add_order_item_meta( $item_id, 'sku', $item_sku , false );

        }

}


add_filter( 'woocommerce_order_item_get_formatted_meta_data', 'unset_specific_order_item_meta_data', 10, 2);
function unset_specific_order_item_meta_data($formatted_meta, $item){
    // Only on emails notifications
    if( is_admin() || is_wc_endpoint_url() )
        return $formatted_meta;

    foreach( $formatted_meta as $key => $meta ){
        if( in_array( $meta->key, array('parent_sku', 'variation_sku') ) )
            unset($formatted_meta[$key]);
    }
    return $formatted_meta;
}

/**
 * @snippet       WooCommerce Remove Product Permalink @ Order Table
 * @how-to        Get CustomizeWoo.com FREE
 * @sourcecode    https://businessbloomer.com/?p=20455
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 3.5
 */

add_filter( 'woocommerce_order_item_permalink', '__return_false' );


/* Remove Billing and Shipping from email new order */
function removing_customer_details_in_emails( $order, $sent_to_admin, $plain_text, $email ){
$wmail = WC()->mailer();
remove_action( 'woocommerce_email_customer_details', array( $wmail, 'email_addresses' ), 20, 3 );
}
add_action( 'woocommerce_email_customer_details', 'removing_customer_details_in_emails', 5, 4 );


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


// Add the user roles as order meta data in Database
add_action( 'woocommerce_add_order_item_meta', 'add_store_info', 10, 2 );
function add_store_info( $item_id, $cart_item_key ) {

$store_name = get_field('store_name', 'user_1');
$store_phone = get_field( 'store_phone', 'user_1');
$store_address = get_field( 'store_address','user_1');
$store_agent = get_field( 'store_agent','user_1');

    wc_add_order_item_meta( $item_id, 'store_name', $store_name , false );
    wc_add_order_item_meta( $item_id, 'store_phone', $store_phone , false );
    wc_add_order_item_meta( $item_id, 'store_address', $store_address , false );
    wc_add_order_item_meta( $item_id, 'store_agent', $store_agent , false );

}

/* Display Rating Count on Loop  M-C01*/

add_filter( 'woocommerce_product_get_rating_html', function ( $html, $rating, $count ) {
	global $product;
	if ( $html && is_archive() && $product) {
		$html .= sprintf( '<div class="cubx-rating-count">(%s)</div>', $product->get_rating_count() );
	}

	return $html;
} , 10, 3 );

/* DYNAMIC RESULT COUNT DISPLAY */

function OF_footer_scripts(){
?>
<script type="text/javascript">
  jQuery(document).ready(function(){
    if(jQuery(".prdctfltr_showing").length != 0){
      var total_displayed = jQuery("ul.products li.product").length;
      var prdctfltr_showing = jQuery(".prdctfltr_showing").html();
      jQuery.ajax({
          url: '<?php echo site_url() ?>/wp-admin/admin-ajax.php',
          type: 'post',
          data: {
              action: 'foundTotalResults',
              total_displayed: total_displayed,
              prdctfltr_showing: prdctfltr_showing,
          },
          success: function( data ) {
            jQuery(".prdctfltr_showing").html(data);
          }
      });
    }

    jQuery(document).ajaxComplete(function(event, xhr, settings) {
      //console.log(settings.data);
      var ajax_settings = settings.data;
      if(ajax_settings.indexOf("prdctfltr_respond_") > 0){
        var total_displayed = jQuery("ul.products li.product").length;
        var prdctfltr_showing = jQuery(".prdctfltr_showing").html();
        jQuery.ajax({
            url: '<?php echo site_url() ?>/wp-admin/admin-ajax.php',
            type: 'post',
            data: {
                action: 'foundTotalResults',
                total_displayed: total_displayed,
                prdctfltr_showing: prdctfltr_showing,
            },
            success: function( data ) {
              jQuery(".prdctfltr_showing").html(data);
            }
        });
      }
    });
  });
</script>
<?php
}
add_action( 'wp_footer', 'OF_footer_scripts', 4500 );
function foundTotalResults_func(){
  $total_displayed = $_POST['total_displayed'];
  $prdctfltr_showing = $_POST['prdctfltr_showing'];
  preg_match_all('!\d+!', $prdctfltr_showing, $matches);
  print_r($matches);
  /*echo esc_html__( 'Showing', 'xforwoocommerce' ) . ' ' . absint( 1 ) . ' - ' . absint( $total_displayed ) . ' ' . esc_html__( 'of', 'xforwoocommerce' ) . ' ' . absint( $total_products ) . ' ' . esc_html__( 'results', 'xforwoocommerce' );*/
  wp_die();
}
add_action( 'wp_ajax_nopriv_foundTotalResults', 'foundTotalResults_func' );
add_action( 'wp_ajax_foundTotalResults', 'foundTotalResults_func' );
