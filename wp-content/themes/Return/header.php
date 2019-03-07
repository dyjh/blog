<?php get_header();
$slide_type = xintheme('slide_region');
if($slide_type == 'magazine' ) : include( 'template-parts/magazine.php' );
elseif($slide_type == 'silide') : include( 'template-parts/silide.php' );
elseif($slide_type == 'silide2') : include( 'template-parts/silide2.php' );
else : include( 'template-parts/magazine.php' );
endif;