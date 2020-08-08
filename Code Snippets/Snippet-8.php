<?php 
      /**** EBOUTIK - Breadcrumbs *****/

      add_filter('et_before_main_content','cubx_breadcrumbs');
      function cubx_breadcrumbs(){
      if ( function_exists('yoast_breadcrumb') ) {
      yoast_breadcrumb( '<div class="et_pb_row et_pb_row_0_tb_body et_pb_gutters1 et_pb_row_1-4_3-4 b-container">
      <div id="breadcrumbs">','</div></div>' );
      }
      }
