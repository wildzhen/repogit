
jQuery(document).ready(function($) {
		var countprod= '<div class="prdctfltr_showing cbx">Afficher 1 - 6 de 12 résultats</div>'
    $("span.prdctfltr_showing").remove();
		$(this).find('#cat-title').append(countprod)

  $( document ).ajaxComplete(function( event,request, settings ) {
  var ajax_settings = settings.data;
  if(ajax_settings.indexOf("prdctfltr_respond_") > 0){
      if ( $('.prdctfltr_sc .prdctfltr_wc').hasClass('pf_after_ajax') ) {
        $(document).find('#cat-title').append(countprod);
      }
}
});
});
