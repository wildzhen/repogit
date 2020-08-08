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
              $style_ver = filemtime( $themecsspath );
              wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ), $style_ver );
          }
      endif;
      add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

      // END ENQUEUE PARENT ACTION

      @ini_set( 'upload_max_size' , '120M' );
      @ini_set( 'post_max_size', '120M');
      @ini_set( 'max_execution_time', '300' );
      @ini_set( 'max_input_size' , '180' );

      /************** EBOUTIK - STYLE 1 **************/
      /***** EBOUTIK - JAVASCRIPT ENQUEUE *****/


      function my_eboutik_scripts() {
          wp_enqueue_script('main.js', get_stylesheet_directory_uri()  . '/js/main.js', true );

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
          return $translated;
      }

      /*Woocommerce Remove Zoom Lightbox */

      add_action( 'after_setup_theme', 'woo_remove_zoom_lightbox_theme_support', 99 );
      function woo_remove_zoom_lightbox_theme_support() {
        remove_theme_support( 'wc-product-gallery-zoom' );
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
      ** Remove "Products" from Yoast SEO breadcrumbs in WooCommerce
      */
      add_filter( 'wpseo_breadcrumb_links', function( $links ) {

          // Check if we're on a WooCommerce page
          // Checks if key 'ptarchive' is set
          // Checks if 'product' is the value of the key 'ptarchive', in position 1 in the links array
          if ( is_woocommerce() && isset( $links[1]['ptarchive'] ) && 'product' === $links[1]['ptarchive'] ) {

              // True, remove 'Products' archive from breadcrumb links
              unset( $links[1] );

          }

          // Rebase array keys
          $links = array_values( $links );

          // Return modified array
          return $links;

      });

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
              <style type="text/css">
                ul.cart-list{
                  list-style: none;
                }

.cart-contents {
    position: relative;
    display: flex !important;
    flex-flow: column nowrap;
    justify-content: center;
}

.cart-contents:before {
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    content: "\f290" !important;
    font-size: 30px;
    color: #000;
    margin-bottom: 4px;
}

.cart-contents:hover {
    text-decoration: none;
}

.cart-contents-count {
	position: absolute;
    	top: 15px;
   	right: 1px;
   	transform: translateY(-105%) translateX(25%);
	font-family: Arial, Helvetica, sans-serif;
	font-weight: normal;
	font-size: 12px;
	line-height: 22px;
	height: 22px;
   	width: 22px;
	vertical-align: middle;
	text-align: center;
	color: #fff;
    	background: red;
    	border-radius: 50%;
      border-color:#000;
    	padding: 1px;
}
              </style>
              <ul class="cart-list">
              <li>
                <a class="menu-item cart-contents" href="<?php echo $cart_url; ?>" title="My Basket">
            <?php
              if ( $cart_count > 0 ) {
            ?>
              <span class="cart-contents-count"><?php echo $cart_count; ?></span>
              <?php
              }
              ?>
              </a>
              <a href="<?php
      echo $cart_url ?>" class="cart-title">Panier</a>
              </li>
              </ul>
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
          <a class="cart-contents menu-item" href="<?php echo $cart_url; ?>" title="<?php _e( 'Voir votre panier' ); ?>">
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

      /* Archive page Category Title Display */
      function caty() {
      return '<div class="cat-title">'. single_term_title('',false) . '</div>';
      }
      add_shortcode('cat', 'caty');

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


      function OF_woo_category_widget_func(){
        ob_start();
        if ( is_tax( 'product_cat' ) ) {
          ?>
          <style type="text/css">
            li.level1-child {
                margin-left: 10px;
            }
            li.level2-child {
                margin-left: 15px;
            }
            li.level3-child {
                margin-left: 20px;
            }
            li.level4-child {
                margin-left: 25px;
            }
          </style>
          <?php
          $curr_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
          $curr_term_parents = get_ancestors($curr_term->term_id, 'product_cat');
          $parent_terms = array();
          if(!empty($curr_term->parent)){
            $parent_terms[] = $curr_term->parent;
            $parent_term1 = get_term_by('id', $curr_term->parent, 'product_cat');
            if(!empty($parent_term1->parent)){
              $parent_terms[] = $parent_term1->parent;
              $parent_term2 = get_term_by('id', $parent_term1->parent, 'product_cat');
              if(!empty($parent_term2->parent)){
                $parent_terms[] = $parent_term2->parent;
                $parent_term3 = get_term_by('id', $parent_term2->parent, 'product_cat');
                if(!empty($parent_term3->parent)){
                  $parent_terms[] = $parent_term3->parent;
                }
              }
            }
          }

          echo '<div id="woocommerce_product_categories-4" class="et_pb_widget woocommerce widget_product_categories">';
          $curr_term_children = get_terms(
            array(
              'taxonomy' => 'product_cat',
              'hide_empty' => false,
              'fields' => 'all',
              'parent' => $curr_term->term_id
            )
          );
          if(!empty($parent_terms)){
            $parent_terms_count = count($parent_terms);
            $parent_terms_count = $parent_terms_count - 1;;
            $main_cat = get_term_by('id', $parent_terms[0], 'product_cat');
            echo '<div class="cat-title"><a href="'.get_term_link($main_cat->term_id).'">'.$main_cat->name.'</a></div>';
          } else {
            echo '<div class="cat-title"><a href="'.get_term_link($curr_term->term_id).'">'.$curr_term->name.'</a></div>';
          }
          echo '<ul class="product-categories">';
          if($curr_term_children){
            foreach($curr_term_children as $child1){
              echo '<li class="level1-child cat-item cat-item-'.$child1->term_id.'"><a href="'.get_term_link($child1->term_id).'">'.$child1->name.'</a></li>';
              $child1_term_children = get_terms(
                array(
                  'taxonomy' => 'product_cat',
                  'hide_empty' => false,
                  'fields' => 'all',
                  'parent' => $child1->term_id
                )
              );
              if($child1_term_children){
                foreach($child1_term_children as $child2){
                  echo '<li class="level2-child cat-item cat-item-'.$child2->term_id.'"><a href="'.get_term_link($child2->term_id).'">'.$child2->name.'</a></li>';
                  /*$child2_term_children = get_terms(
                    array(
                      'taxonomy' => 'product_cat',
                      'hide_empty' => false,
                      'fields' => 'all',
                      'parent' => $child2->term_id
                    )
                  );
                  if($child2_term_children){
                    foreach($child2_term_children as $child3){
                      echo '<li class="level3-child cat-item cat-item-'.$child3->term_id.'"><a href="'.get_term_link($child3->term_id).'">'.$child3->name.'</a></li>';
                      $child3_term_children = get_terms(
                        array(
                          'taxonomy' => 'product_cat',
                          'hide_empty' => false,
                          'fields' => 'all',
                          'parent' => $child3->term_id
                        )
                      );
                      if($child3_term_children){
                        foreach($child3_term_children as $child4){
                          echo '<li class="level4-child cat-item cat-item-'.$child4->term_id.'"><a href="'.get_term_link($child4->term_id).'">'.$child4->name.'</a></li>';
                        }
                      }
                    }
                  }*/
                }
              }
            }
          } else {
            $curr_term_parent_children = get_terms(
              array(
                'taxonomy' => 'product_cat',
                'hide_empty' => false,
                'fields' => 'all',
                'parent' => $curr_term->parent
              )
            );
            if($curr_term_parent_children){
              foreach($curr_term_parent_children as $parent_child1){
                echo '<li class="level2-child cat-item cat-item-'.$parent_child1->term_id.'"><a href="'.get_term_link($parent_child1->term_id).'">'.$parent_child1->name.'</a></li>';
              }
            }
          }
          echo '</ul>';
          echo '</div>';
        }
        return ob_get_clean();
      }
      add_shortcode( 'OF_woo_category_widget', 'OF_woo_category_widget_func' );

      /* BRAND SHORTCODE */

      function single_brands()
      {
      global $product;

      $brand = $product->get_attribute('pa_marques');
      if (empty($brand)) return;
      return '<div class="loop-brands">'.$brand.'</div>';
      }

      add_shortcode('brands','single_brands');

/* Woocommerce Add Brands to Catalog Page Through Attributes FOR STYLE 2 CATALOG */

add_action('woocommerce_shop_loop_item_title', 'brands', 9);

function brands()
{
global $product;

$ok="N/A";
$brand = $product->get_attribute('pa_marques');
if (empty($brand)) echo '<span class="nobrd">' .$ok. '</span>';
echo '<span class="loop-brands">'.$brand.'</span>';

}
      /**** Code for Price range display fix *******/

      add_filter( 'woocommerce_variable_price_html', 'bbloomer_variation_price_format_min', 9999, 2 );

      function bbloomer_variation_price_format_min( $price, $product ) {
        $prices = $product->get_variation_prices( true );
        $min_price = current( $prices['price'] );
        $price = sprintf( __( 'A partir de: %1$s', 'woocommerce' ), wc_price( $min_price ) );
        return '<div class="content">' .$price . '</div>';
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
              $price = $prices[0] !== $prices[1] ? sprintf( __( 'A partir de: %1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

              // Sale Price
              $prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
              sort( $prices );
              $saleprice = $prices[0] !== $prices[1] ? sprintf( __( 'A partir de: %1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

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
                      display:none !important;
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
                                      $('div.content').hide();
                                  });

                              $('p.price').html($('div.woocommerce-variation-price > span.price').html()).append('<p class="availability">'+$('div.woocommerce-variation-availability').html()+'</p>');
                              console.log($('input.variation_id').val());
                          } else {
                              $('p.price').html($('div.hidden-variable-price').html());
                              if($('p.availability'))
                                  $('p.availability').remove();
                              console.log('NULL');
                              $('div.content').hide();
                          }
                      });
                  });
              </script>
              <?php

              echo '
              <div class="hidden-variable-price" >'.$price.'</div>';

          endif;
      }

      /* Showing product thumbnail @Checkout ***/

      /**
       * @snippet       WooCommerce Show Product Image @ Checkout Page
       * @author        Sandesh Jangam
       * @donate $7     https://www.paypal.me/SandeshJangam/7
       */

      add_filter( 'woocommerce_cart_item_name', 'ts_product_image_on_checkout', 10, 3 );

      function ts_product_image_on_checkout( $name, $cart_item, $cart_item_key ) {

          /* Return if not checkout page */
          if ( ! is_checkout() ) {
              return $name;
          }

          /* Get product object */
          $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

          /* Get product thumbnail */
          $thumbnail = $_product->get_image();

          /* Add wrapper to image and add some css */
          $image = '<div class="ts-product-image" style="width: 52px; display: inline-block; padding-right: 7px; vertical-align: middle;">'
                      . $thumbnail .
                  '</div>';

          /* Prepend image to name and return it */
          return $image . $name;
      }



/* Save item SKU inside Order Details in Database */

add_action( 'woocommerce_add_order_item_meta', 'majemedia_save_item_sku_order_itemmeta', 10, 3 );
function majemedia_save_item_sku_order_itemmeta( $item_id, $values, $cart_item_key ) {
    ?>
    <style type="text/css">
            .wc-item-meta {
                display:none !important;
            }
          </style>
<?php
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
    <h3 style="margin:5px 0;">Information Magasin</h3>
    <ul style="padding:0px;margin:5px 0;list-style:none;font-style:12px;">
    <li style="margin:0;font-size: 12px;
    line-height: 1.5;">Nom du magasin: '. $store_name . '</li>
    <li style="margin:0;font-size: 12px;
    line-height: 1.5;">Numéro de téléphone: '. $store_phone . '</li>
    <li style="margin:0;font-size: 12px;
    line-height: 1.5;">Addresse: '. $store_address . '</li>
    </ul></div>';
    }

// Add the Custom User Admin Field (store infos) as order meta data
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


/* REMOVE EXTRA META:: Only Display On Order Notification Email */

add_filter( 'woocommerce_order_item_get_formatted_meta_data', 'unset_specific_order_item_meta_data', 20, 2);
function unset_specific_order_item_meta_data($formatted_meta, $item){
            // Only on emails notifications

    foreach( $formatted_meta as $key => $meta ){
        if( in_array( $meta->key, array('parent_sku', 'variation_sku','store_name','store_phone','store_address','store_agent','sku') ) )
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
