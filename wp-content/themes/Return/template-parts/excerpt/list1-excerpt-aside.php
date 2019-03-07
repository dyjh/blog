<div class="col-xs-12 col-sm-6 col-md-4 masonry-item js-masonry-item">
	<article class="post-item has-post-thumbnail">
	<div class="post-item-media">
		<a class="post-item-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php
			$thumbnail = xintheme('thumbnail');
			if ($thumbnail == 'timthumb') {?>
			<img width="150" height="150" src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo xintheme_thumb(); ?>&w=150&h=150&zc=1" alt="<?php the_title(); ?>">
			<?php } else { } ?>
			<?php if ($thumbnail == 'qiniu') {?>
			<?php wpjam_post_thumbnail(array(150,150),$crop=1);?>
			<?php } else { } ?>
		</a>
	</div>
	<div class="post-item-caption">
		<header class="post-item-header">
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
		<h2 class="post-item-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		</header>
	</div>
	</article>
</div>