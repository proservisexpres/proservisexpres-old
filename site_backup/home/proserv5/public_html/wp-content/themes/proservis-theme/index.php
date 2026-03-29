<?php
// Fallback — если front-page.php не сработал
get_header();

if (have_posts()):
  while (have_posts()): the_post();
    the_content();
  endwhile;
endif;

get_footer();
