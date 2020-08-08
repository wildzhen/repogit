<?php

$dom = new DOMDocument;

$dom->loadHTML($str);

foreach($dom->getElementsByTagName('ul') as $ul) {

   $count = $ul->getElementsByTagName('li')->length;

   var_dump($count);

}


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
              echo '<ul class="submenu">';
              echo '<li class="level2-child cat-item cat-item-'.$child2->term_id.'"><a href="'.get_term_link($child2->term_id).'">'.$child2->name.'</a></li>';
              echo '</ul>';
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
            echo '<ul class="submenu">';
            echo '<li class="level2-child cat-item cat-item-'.$parent_child1->term_id.'"><a href="'.get_term_link($parent_child1->term_id).'">'.$parent_child1->name.'</a></li>';
            echo '</ul>';
          }
        }
      }
      echo '</ul>';
      echo '</div>';
    }
    return ob_get_clean();
  }
  add_shortcode( 'OF_woo_category_widget', 'OF_woo_category_widget_func' );
