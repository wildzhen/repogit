<?php
  /* Archive page Category Title Display */
function caty() {
return '<div class="cat-title">'. single_term_title('',false) . '</div>';
}
add_shortcode('cat', 'caty');
