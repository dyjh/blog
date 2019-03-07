<?php get_header();

$post_extend = get_post_meta( get_the_ID(), 'extend_info', true );
$post_extend = wp_parse_args( (array) $post_extend, array( 
		'post_layout'    => '1',
	) 
);
if( $post_extend ){
	$template_name = $post_extend['post_layout'];
}else{
	$template_name = '1';
}

get_template_part( 'template-parts/single', $template_name );

get_footer();