
// Add Badge below price in loop

jQuery(document).ready(function($) {

var wobd_html = '<div class="wobd-text " id="wobd-badge">Solde!<div class="wobd-second-text"></div></div>';
$("#wobd-badge").remove();
$(this).find('.woocommerce-LoopProduct-link.woocommerce-loop-product__link').append(wobd_html);

$( document ).ajaxComplete(function( event,request, settings ) {
var ajax_settings = settings.data;
if(ajax_settings.indexOf("prdctfltr_respond_") > 0){
    if ( $('.prdctfltr_sc .prdctfltr_wc').hasClass('pf_after_ajax') ) {
        $('ul.products li').find('span.price').append(wobd_html);
    }
}
});
});

// Add badge  after last element of loop
jQuery(document).ready(function($) {
	$('ul.products li').each(function() {
		var onsale = $(this).find('.wobd-text-template-7.wobd-badges');
		$(this).find('.woocommerce-LoopProduct-link.woocommerce-loop-product__link').append(onsale)
	});
});

// Add Count Result after Page Title

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

// Add A collapsible column with button  for filter (Extra add 2 column settings and select box to color filter)

jQuery(document).ready(function($){
    $('.prdctfltr_pa_couleur').addClass('prdctfltr_terms_customized_select prdctfltr_2_columns');
   var colps_html = '<div id="colps" class="et_pb_module et_pb_code et_pb_code_1_tb_body"><div class="et_pb_code_inner"><button id="filter-collapse">Cacher le filtre</button></div>';
  $("#colps").remove();
  $(this).find('.prdctfltr-widget').prepend(colps_html);
  $('#filter-collapse').text('Cacher le filtre');
    // Do something on click...
    $('#filter-collapse').click(function(){
      $(this).toggleClass("clicked");
      $('#cbx-filter').toggle( "slide" );
      $('.flex-col-2').addClass('full');
      $('#filter-collapse.clicked').text('Voir le filtre');
      $('#filter-collapse.clicked').parents('#colps').prependTo($('form.woocommerce-ordering'));
      $('#filter-collapse').not( ".clicked" ).parents('form.woocommerce-ordering #colps').prependTo($('.prdctfltr-widget'));
      $('#filter-collapse').not( ".clicked" ).text('Cacher le filtre');
    });
    $( document ).ajaxComplete(function( event,request, settings ) {
      $('.prdctfltr_pa_couleur').addClass('prdctfltr_terms_customized_select prdctfltr_2_columns');
      var colps_html = '<div id="colps" class="et_pb_module et_pb_code et_pb_code_1_tb_body"><div class="et_pb_code_inner"><button id="filter-collapse">Cacher le filtre</button></div>';
    $("#colps").remove();
      $(this).find('.prdctfltr-widget').prepend(colps_html);
      $('#filter-collapse').text('Cacher le filtre');
                $('#filter-collapse').click(function(){
                  $(this).toggleClass("clicked");
                  $('#cbx-filter').toggle( "slide" );
                  $('.flex-col-2 ul.products.columns-3').css("padding","0 2%");
                  $('.flex-col-2').addClass('full');
                  $('#filter-collapse.clicked').text('Voir le filtre');
                  $('#filter-collapse.clicked').parents('#colps').prependTo($('form.woocommerce-ordering'));
                  $('#filter-collapse').not( ".clicked" ).parents('form.woocommerce-ordering #colps').prependTo($('.prdctfltr-widget'));
                  $('#filter-collapse').not( ".clicked" ).text('Cacher le filtre');
                });
            });
  });

// Replacing Text (Button Load more)
  jQuery(document).ready(function($) {
$('nav.woocommerce-pagination.prdctfltr-pagination.prdctfltr-pagination-load-more > a.button').html('<i class="fas fa-arrow-down"></i>');
    });


// Show / Hide Colors Swatch (hover) on Loop
jQuery(document).ready(function($){

    $('ul.products.columns-3 li').hover(function(){
        $(this).find('.variations_form.wvs-archive-variation-wrapper').addClass('visible');
    }, function() {
        $(this).find('.variations_form.wvs-archive-variation-wrapper').removeClass('visible');
    });

// Show / Hide Sizes (hover) on Loop Through Class
jQuery(document).ready(function($){
    $('ul.products li.product a.woocommerce-LoopProduct-link').hover(function(){
    $(this).find('div.attribute-size').addClass('visible');
}, function(){
    $(this).find('div.attribute-size').removeClass('visible');
});
});

// Show / Hide Sizes (hover) on Loop Version 2 Through CSS
jQuery(document).ready(function($){
    $('ul.products li.product a.woocommerce-LoopProduct-link').hover(function(){
    $(this).find('div.attribute-size').css('opacity', '1');
}, function(){
    $(this).find('div.attribute-size').css("opacity", '0');
});
});


// Limit Number of Filters Shown & Add Click display all (Part-1)

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

// Limit Number of Filters Shown  - Add a button to show all filters  (Part-2)
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

//SHow Hide Colors + Changes Sizes Weight
jQuery(document).ready(function($){

    $('ul.products.columns-3 li').hover(function(){
        $(this).find('.attribute-size').css("font-weight", "600");
        $(this).find('.variations_form.wvs-archive-variation-wrapper').css("opacity", "1");
    }, function() {
        $(this).find('.attribute-size').css("font-weight", "500");
        $(this).find('.variations_form.wvs-archive-variation-wrapper').css("opacity", "0");
    });

  $( document ).ajaxComplete(function() {
     $('ul.products.columns-3 li').hover(function(){
        $(this).find('.attribute-size').css("font-weight", "600");
        $(this).find('.variations_form.wvs-archive-variation-wrapper').css("opacity", "1");
    }, function() {
      $(this).find('.attribute-size').css("font-weight", "500");
      $(this).find('.variations_form.wvs-archive-variation-wrapper').css("opacity", "0");
    });
    });
    // Replace Load More Button Text
$('nav.woocommerce-pagination.prdctfltr-pagination.prdctfltr-pagination-load-more > a.button').text('<div class="container"><div class="content"><p>Hover me !</p><svg id="more-arrows"><polygon class="arrow-top" points="37.6,27.9 1.8,1.3 3.3,0 37.6,25.3 71.9,0 73.7,1.3 "/><polygon class="arrow-middle" points="37.6,45.8 0.8,18.7 4.4,16.4 37.6,41.2 71.2,16.4 74.5,18.7 "/><polygon class="arrow-bottom" points="37.6,64 0,36.1 5.1,32.8 37.6,56.8 70.4,32.8 75.5,36.1 "/></svg></div></div>');
});

jQuery(document).ready(function($){

    $('ul.products.columns-3 li').hover(function(){
        $(this).find('.variations_form.wvs-archive-variation-wrapper').css("opacity", "1");
    }, function() {
        $(this).find('.variations_form.wvs-archive-variation-wrapper').css("opacity", "0");
    });

  $( document ).ajaxComplete(function() {
     $('ul.products.columns-3 li').hover(function(){
        $(this).find('.variations_form.wvs-archive-variation-wrapper').css("opacity", "1");
    }, function() {
      $(this).find('.variations_form.wvs-archive-variation-wrapper').css("opacity", "0");
    });
    });
    });
