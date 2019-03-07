	<footer id="colophon" class="site-footer">
	<div class="container">
		<?php if( xintheme('site_footer_info_switch') ) : ?>
		<aside id="footer-widgets" class="site-footer-widgets">
		<div class="widget-area">
			<section id="text-2" class="widget widget_text">
			<h2 class="widget-title">关于我们</h2>
			<div class="textwidget">
                <?php 
                    $footer_info = xintheme('site_footer_info');
                    if( $footer_info ){
                        echo $footer_info; 
                    }else{
                        echo '<p>以设计和技术创造极致用户体验 - www.xintheme.com</p>';}
                ?> 
			</div>
			</section><section id="recent-posts-2" class="widget widget_recent_entries">
			<h2 class="widget-title">热评文章</h2>
			<ul>
				<?php
					$post_num = 3; 
					$args = array(
					'post_password' => '',
					'post_status' => 'publish', 
					'post__not_in' => array($post->ID),
					'caller_get_posts' => 1, 
					'orderby' => 'comment_count', 
					'posts_per_page' => $post_num
					);
					$query_posts = new WP_Query();
					$query_posts->query($args);
				while( $query_posts->have_posts() ) { $query_posts->the_post(); ?>
				<li>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<span class="post-date"><?php the_time('Y-m-d') ?></span>
				</li>
					<?php } wp_reset_query();?>
			</ul>
			</section><section id="recent-comments-2" class="widget widget_recent_comments">
			<h2 class="widget-title">最新评论</h2>
			<ul id="recentcomments">
				<?php
					$comments = get_comments('status=approve&number=3&order=asc');
					foreach($comments as $comment) :
					$output =  '<li class="recentcomments"><span class="comment-author-link">' .get_comment_author().'</span>  <a href="' . esc_url( get_comment_link($comment->comment_ID) ) . '">' . $comment->comment_content . '</a></li>';
					echo $output;
				endforeach;?>
			</ul>
			</section>
		</div>
		</aside>
		<?php endif; ?>
		<div class="site-footer-info">
			<div class="footer-info-wrapper">
				<nav class="footer-navigation" aria-label="Secondary Menu">
				<div class="menu-footer-menu-container">
					<ul id="menu-footer-menu" class="secondary-menu">
						<li style="color: #c2c2c7;font-size: 14px;line-height: 1.4;">友情链接：</li><?php wp_list_bookmarks('title_li=&categorize=0&orderby=rand&limit=24'); ?>
					</ul>
				</div>
				</nav>
				<span class="copyright">
					Copyright <?php the_time('Y') ?>. All rights reserved.&nbsp;<?php echo xintheme('footer_icp');?>&nbsp;Theme by&nbsp;
				<a href="http://www.xintheme.com" target="_blank">XinTheme</a>
				</span>
			</div>
			<nav class="social-navigation" aria-label="Social Links Menu">
			<div class="menu-social-menu-container" ontouchstart>
				<ul id="menu-social-menu" class="social-links-menu">
					<?php 
					$footer_qq_url = xintheme('footer_qq_url');
					if( xintheme('footer_qq') ) : ?>
					<li><a class="qq" rel="nofollow" target="_blank" href="<?php echo $footer_qq_url; ?>"></a></li>
					<?php endif; ?>
					<?php 
					$footer_weibo_url = xintheme('footer_weibo_url');
					if( xintheme('footer_weibo') ) : ?>
					<li><a class="weibo" rel="nofollow" target="_blank" href="<?php echo $footer_weibo_url; ?>"></a></li>
					<?php endif; ?>
					<?php if( xintheme('footer_weixin') ) : ?>
					<li class="wechat"><a class="weixin"></a><div class="wechatimg"><img src="<?php echo xintheme_img('footer_weixin_img','');?>"></div></li>
					<?php endif; ?>
					<?php 
					$footer_mail_url = xintheme('footer_mail_url');
					if( xintheme('footer_mail') ) : ?>
					<li><a class="mail" rel="nofollow" target="_blank" href="mailto:<?php echo $footer_mail_url; ?>"></a></li>
					<?php endif; ?>
				</ul>
			</div>
			</nav>
		</div>
	</div>
	</footer>
</div>
<a id="scroll-to-top" class="scroll-to-top" href="#"></a>
<div id="search-overlay" class="search-overlay">
	<button type="button" class="search-overlay-close" aria-label="Close"><span class="screen-reader-text">Close</span></button>
	<form role="search" method="get" class="search-form" action="<?php bloginfo('url'); ?>">
		<label>
		<input type="search" class="search-field" placeholder="Search &hellip;" value="" name="s"/>
		</label>
		<button type="submit" class="search-submit"><span class="screen-reader-text">Search</span></button>
	</form>
</div>
<script type='text/javascript'>
var screenReaderText = {"expand":"expand child menu","collapse":"collapse child menu"};
</script>
<?php wp_footer(); ?>
<?php echo xintheme('foot_code');?>
</body>
</html>