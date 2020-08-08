<?php

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
