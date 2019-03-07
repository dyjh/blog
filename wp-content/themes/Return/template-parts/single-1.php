<div id="content" class="site-content">
	<div class="container">
		<div class="row">
			<div id="primary" class="col-md-8 content-area">
				<main id="main" class="site-main">
				<article>
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