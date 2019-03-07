<div class="col-xs-12 col-sm-6 col-md-4 masonry-item js-masonry-item">
	<article class="post-card has-post-thumbnail post-card-image">
	<div class="post-card-media">
		<a class="post-card-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php
			$thumbnail = xintheme('thumbnail');
			if ($thumbnail == 'timthumb') {?>
			<img width="830" height="553" src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo xintheme_thumb(); ?>&w=880&h=553&zc=1" alt="<?php the_title(); ?>">
			<?php } else { } ?>
			<?php if ($thumbnail == 'qiniu') {?>
			<?php wpjam_post_thumbnail(array(830,553),$crop=1);?>
			<?php } else { } ?> 
		</a>
	</div>
	<div class="post-card-caption">
		<header class="post-card-header">
		<div class="post-card-header-meta">
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
		<h2 class="post-card-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		</header>
	</div>
	</article>
</div>