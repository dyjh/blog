<script>
document.getElementById('body').className="featured-has-media single"; 
</script>
<div id="featured" class="featured featured-height-full">
	<div class="featured-item">
		<div class="featured-media">
				<?php
					$head_img = get_post_meta(get_the_ID(), 'extend_info', true);
					$header_img =  $head_img['header_img'];
					if( ! empty( $header_img ) ) :
                    $header_img = explode( ',', $head_img['header_img'] );
                    foreach ( $header_img as $id ) :
                    $header_img_src = wp_get_attachment_image_src( $id, 'full' );
				?>
			<img src="<?php echo $header_img_src[0];?>" alt="<?php the_title(); ?>" sizes="100vw" width="1920" height="1280">
			<?php endforeach;endif ?>
			<div class="featured-media-overlay">
			</div>
		</div>
		<div class="featured-caption">
			<div class="container">
				<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<div class="entry-header-meta">
					<span class="cat-links">
					<?php  
						$category = get_the_category();
						if($category[0]){
						echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
						};
					?>
					</span>
					<span class="posted-on">
						<a href="<?php the_permalink(); ?>" rel="bookmark">
							<time class="entry-date published" datetime="<?php the_time('Y-m-d h:m:s') ?>"><?php the_time('Y-m-d') ?></time>
						</a>
					</span>
				</div>
				</header>
			</div>
		</div>
	</div>
</div>
<div id="content" class="site-content">
	<div class="container">
		<div class="row">
			<div id="primary" class="col-md-8 content-area">
				<main id="main" class="site-main">
				<article id="post-78" class="post-78 post type-post status-publish format-image has-post-thumbnail hentry category-culture tag-culture tag-music tag-theatre post_format-post-format-image">
				<div class="entry-content">
				<?php while( have_posts() ): the_post(); $p_id = get_the_ID(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>
				</div>
				<footer class="entry-footer">
				<div class="entry-footer-meta">
					<span class="tags-links">
					<?php the_tags('', ' ', ''); ?>
					</span>
				</div>
				</footer>
				</article>
				<nav class="navigation post-navigation">
				<div class="nav-links">
				<?php
					$prev_post = get_previous_post();
					if(!empty($prev_post)):?>
					<div class="nav-previous">
						<a href="<?php echo get_permalink($prev_post->ID);?>" rel="prev">
						<span class="nav-link-thumbnail"><img src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo xintheme_prev_thumbnail_url(); ?>&w=150&h=150&zc=1" alt="<?php echo $prev_post->post_title;?>"></span>
						<span class="nav-link-meta">
						<span class="meta-nav" aria-hidden="true">上一篇</span>
						<span class="post-title"><?php echo $prev_post->post_title;?></span>
						</span>
						</a>
					</div>
				<?php endif;?>
				<?php
					$next_post = get_next_post();
					if(!empty($next_post)):?>
					<div class="nav-next">
						<a href="<?php echo get_permalink($next_post->ID);?>" rel="next">
						<span class="nav-link-meta">
						<span class="meta-nav" aria-hidden="true">下一篇</span>
						<span class="post-title"><?php echo $next_post->post_title;?></span>
						</span>
						<span class="nav-link-thumbnail"><img src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo xintheme_next_thumbnail_url(); ?>&w=150&h=150&zc=1" alt="<?php echo $next_post->post_title;?>"></span>
						</a>
					</div>
				<?php endif;?>
				</div>
				</nav>
				<div class="author-info">
					<div class="author-avatar">
						<?php echo get_avatar( get_the_author_meta('email'), '150' );?>
					</div>
					<div class="author-description">
						<h2 class="author-title">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" title="<?php echo get_the_author() ?>" rel="author"><?php echo get_the_author() ?></a>
						</h2>
						<p class="author-bio">
							<?php if(get_the_author_meta('description')){ echo the_author_meta( 'description' );}else{echo'我还没有学会写个人说明！'; }?>
						</p>
					</div>
				</div>
				<?php include( 'related.php' ); ?>
				<?php comments_template( '', true ); ?>
				</main>
			</div>
			<?php get_sidebar();?>
			<?php include( 'latest-posts.php' ); ?>
		</div>
	</div>
</div>