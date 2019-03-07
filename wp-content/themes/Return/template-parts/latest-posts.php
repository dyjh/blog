<aside id="content-bottom-widgets-2" class="col-md-12 content-bottom-widgets content-bottom-widgets-2">
<div class="widget-area">
<section id="widget_windmill_latest_posts-3" class="widget widget_windmill_latest_posts">
<h2 class="widget-title">最新文章</h2>
<div class="row latest-posts-grid content-grid">
<?php
	$args = array(
	'caller_get_posts' => 1,
	'posts_per_page' => 6,
	'paged' => $paged
	);
	query_posts($args);
	if ( have_posts() ) : ?>
<?php while (have_posts()) : the_post(); ?>
<?php if( has_post_format( 'aside' ) ){ //小图?>
<div class="col-sm-6 col-md-4 grid-item">
	<article class="post-card has-post-thumbnail">
	<div class="post-card-media">
		<a class="post-card-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php
			$thumbnail = xintheme('thumbnail');
			if ($thumbnail == 'timthumb') {?>
			<img width="768" height="512" src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo xintheme_thumb(); ?>&w=768&h=512&zc=1" alt="<?php the_title(); ?>">
			<?php } else { } ?>
			<?php if ($thumbnail == 'qiniu') {?>
			<?php wpjam_post_thumbnail(array(768,512),$crop=1);?>
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
		<div class="post-card-content">
			<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 130,"……"); ?>
		</div>
	</div>
	</article>
</div>
<?php } else if ( has_post_format( 'gallery' )) { //特色 ?>
<div class="col-sm-6 col-md-4 grid-item">
	<article class="post-card has-post-thumbnail post-card-image">
	<div class="post-card-media">
		<a class="post-card-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php
			$thumbnail = xintheme('thumbnail');
			if ($thumbnail == 'timthumb') {?>
			<img src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo xintheme_thumb(); ?>&w=830&h=553&zc=1" alt="<?php the_title(); ?>" width="830" height="553">
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
<?php } else{ //标准 ?>
<div class="col-sm-6 col-md-4 grid-item">
	<article class="post-card has-post-thumbnail">
	<div class="post-card-media">
		<a class="post-card-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php
			$thumbnail = xintheme('thumbnail');
			if ($thumbnail == 'timthumb') {?>
			<img width="768" height="512" src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo xintheme_thumb(); ?>&w=768&h=512&zc=1" alt="<?php the_title(); ?>">
			<?php } else { } ?>
			<?php if ($thumbnail == 'qiniu') {?>
			<?php wpjam_post_thumbnail(array(768,512),$crop=1);?>
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
		<div class="post-card-content">
			<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 130,"……"); ?>
		</div>
	</div>
	</article>
</div>
<?php } ?>
<?php endwhile; ?>
<?php else : ?>
<?php endif; ?>
</div>
</section>
</div>
</aside>