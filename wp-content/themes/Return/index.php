﻿<?php get_header();
$list_type = xintheme('list_region');
if($list_type == 'list1' ) : include( 'template-parts/list-1.php' );
elseif($list_type == 'list2') : include( 'template-parts/list-2.php' );
elseif($list_type == 'list3') : include( 'template-parts/list-3.php' );
elseif($list_type == 'list4') : include( 'template-parts/list-4.php' );
else : include( 'template-parts/list-1.php' );
endif;
get_footer();