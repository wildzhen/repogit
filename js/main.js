jQuery(document).ready(function($){
    var size_li = $(".prdctfltr_filter").length;
    var x=3;
    $('.prdctfltr_filter_inner .prdctfltr_filter:lt('+x+')').show();
$(document).on('mouseover',document, function() {
    $('#loadMore').click(function (e) {
        e.preventDefault();
        x= size_li;
        $('.prdctfltr_filter_inner .prdctfltr_filter:lt('+x+')').slideDown(600);
         $('#loadMore').show();
        if(x == size_li){
            $('#loadMore').fadeOut();
        }
    });
});
$(document).ajaxComplete(function() {
    var size_li = $(".prdctfltr_filter").length;
    var x=3;
    $('.prdctfltr_filter_inner .prdctfltr_filter:lt('+x+')').show();
    $('#loadMore').click(function (e) {
        e.preventDefault();
        x= size_li;
        $('.prdctfltr_filter_inner .prdctfltr_filter:lt('+x+')').slideDown(600);
         $('#loadMore').show();
        if(x == size_li){
            $('#loadMore').fadeOut();
        }
    });
});
    $('#lm').appendTo($('.prdctfltr_filter_inner'));
    $('#lm').clone().attr({"id":"cloned"}).appendTo($('ul.product-categories'));
$( document ).ajaxComplete(function( event,request, settings ) {
    if ( $('.prdctfltr_sc .prdctfltr_wc').hasClass('pf_after_ajax') ) {
        $(this).find('.prdctfltr_filter_inner').append($('#cloned'));
    }
});

  /* General Code Must Be Enabled */
     $(window).on("load",window,function(cbx_chkout){
    $('#billing_address_2').attr("placeholder", "Batiment, numéro d'appartement, numéro de villa, ilot...");
  });
});