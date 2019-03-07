<?php get_header();
$author_type = xintheme('author_region');
if($author_type == 'list1' ) : include( 'template-parts/list-1.php' );
elseif($author_type == 'list2') : include( 'template-parts/list-2.php' );
elseif($author_type == 'list3') : include( 'template-parts/list-3.php' );
elseif($author_type == 'list4') : include( 'template-parts/list-4.php' );
else : include( 'template-parts/list-1.php' );
endif;
get_footer(); 