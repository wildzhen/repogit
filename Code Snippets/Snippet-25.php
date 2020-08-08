<?php
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
