  <script>

  jQuery(document).ready(function($) {

  var seemore_html = '<a href="#" id="seeMore">Voir tous les filtres</a>';
  $(this).find('.prdctfltr_buttons').append(seemore_html);

  $( document ).ajaxComplete(function( event,request, settings ) {
  var ajax_settings = settings.data;
  if(ajax_settings.indexOf("prdctfltr_respond_") > 0){
      if ( $('.prdctfltr_sc .prdctfltr_wc').hasClass('pf_after_ajax') ) {
          $( document ).find('.prdctfltr_buttons').append(seemore_html);
      }
  }
  });
  });
  </script>
  <script>
  jQuery(document).ready(function($){
    $(".prdctfltr_filter_inner div.prdctfltr_filter").slice(0,3).show();
    $("#seeMore").click(function(e){
      e.preventDefault();
      $(".prdctfltr_filter_inner div.prdctfltr_filter:hidden").slice(0,25).fadeIn("slow");

      if($(".prdctfltr_filter_inner div.prdctfltr_filter:hidden").length == 0){
         $("#seeMore").fadeOut("slow");
        }
    });
  });
  </script>
