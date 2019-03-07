<?php
//主题启动后进仪表盘
add_action( 'load-themes.php', 'Init_theme' );
function Init_theme(){
  global $pagenow;

  if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
    // options-general.php 改成你的主题设置页面网址
    wp_redirect( admin_url( '/themes.php?page=xintheme' ) );
    exit;
  }
}
/*获取框架image图片地址*/
function xintheme_img ($id,$default){
    $cs_id= xintheme($id);
    if (!empty($cs_id )){
        $id_url= wp_get_attachment_image_src( $cs_id, 'full' );
        return $id_url[0];
    }
    elseif (empty($cs_id )){
        return $default;
    }
}
//SEO功能
include('seo/seo.php' );
//Sitemap
include('Sitemap/sitemap.php' );
// wp-clean-up插件集成
include('wp-clean-up/wp-clean-up.php' );
//访问计数
function record_visitors(){
    if (is_singular()) {global $post;
     $post_ID = $post->ID;
      if($post_ID) 
      {
          $post_views = (int)get_post_meta($post_ID, 'views', true);
          if(!update_post_meta($post_ID, 'views', ($post_views+1))) 
          {
            add_post_meta($post_ID, 'views', 1, true);
          }
      }
    }
}
add_action('wp_head', 'record_visitors');  

function post_views($before = '(点击 ', $after = ' 次)', $echo = 1)
{
  global $post;
  $post_ID = $post->ID;
  $views = (int)get_post_meta($post_ID, 'views', true);
  if ($echo) echo $before, number_format($views), $after;
  else return $views;
};
//文章形式
add_theme_support( 'post-formats', array( 'aside','gallery' ) );//默认的 日志、链接、图像 来当作下面的大图、无图、多图 来使用的
function rename_post_formats( $safe_text ) {
if ( $safe_text == '日志' )
return '小图';
if ( $safe_text == '相册' )
return '特色';
return $safe_text;
}
add_filter( 'esc_html', 'rename_post_formats' );
/*激活友情链接后台*/
add_filter( 'pre_option_link_manager_enabled', '__return_true' );
//自定义后台版权
function remove_footer_admin () {
echo '感谢选择 <a href="http://www.xintheme.com" target="_blank">XinTheme</a> 为您设计！</p>';
}
add_filter('admin_footer_text', 'remove_footer_admin');
//WordPress替换登陆后跳转的后台默认首页
if( xintheme('xintheme_article') ) :
function my_login_redirect($redirect_to, $request){
if( empty( $redirect_to ) || $redirect_to == 'wp-admin/' || $redirect_to == admin_url() )
return home_url("/wp-admin/edit.php");
else
return $redirect_to;
}
add_filter("login_redirect", "my_login_redirect", 10, 3);
endif;
//屏蔽仪表盘菜单
function remove_menus() {
global $menu;
$restricted = array(
__('Dashboard'),
//__('Tools'),
);
end ($menu);
while (prev($menu)){
$value = explode(' ',$menu[key($menu)][0]);
if(strpos($value[0], '<') === FALSE) {
if(in_array($value[0] != NULL ? $value[0]:"" , $restricted)){
unset($menu[key($menu)]);
}
}else {
$value2 = explode('<', $value[0]);
if(in_array($value2[0] != NULL ? $value2[0]:"" , $restricted)){
unset($menu[key($menu)]);
}
}
}
}
if (is_admin()){
// 屏蔽左侧菜单
add_action('admin_menu', 'remove_menus');
}
//添加特色缩略图支持
if ( function_exists('add_theme_support') )add_theme_support('post-thumbnails');
//输出缩略图地址
function xintheme_thumb(){
	global $post;
	if( $values = get_post_custom_values("thumb") ) {	//输出自定义域图片地址
		$values = get_post_custom_values("thumb");
		$post_thumbnail_src = $values [0];
	} elseif( has_post_thumbnail() ){    //如果有特色缩略图，则输出缩略图地址
		$thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
		$post_thumbnail_src = $thumbnail_src [0];
	} else {
		$post_thumbnail_src = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		if(!empty($matches[1][0])){
			$post_thumbnail_src = $matches[1][0];   //获取该图片 src
		}else{	//如果日志中没有图片，则显示随机图片
			$random = mt_rand(1, 9);
			$post_thumbnail_src = get_template_directory_uri().'/images/thumbs/'.$random.'.jpg';
			//如果日志中没有图片，则显示默认图片
			//$post_thumbnail_src = get_template_directory_uri().'/images/default_thumb.jpg';
		}
	};
	echo $post_thumbnail_src;
}
/**
 * WordPress 获取“上一篇”文章缩略图的图片地址
 */
function xintheme_prev_thumbnail_url() {
 $prev_post = get_previous_post();
 if ( get_post_meta($prev_post->ID, 'thumbnail', true) ) { //如果 post 的自定义字段中有 thumbnail，则显示 thumbnail 的值
 $image = get_post_meta($prev_post->ID, 'thumbnail', true);
 return $image; //在新添加文章的时候添加自定义字段 thumbnail,值为缩略图地址。
 } else {
 if ( has_post_thumbnail($prev_post->ID) ) { //如果上一篇的日志有缩略图，则显示上一篇日志的缩略图
 $img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $prev_post->ID ), 'thumbnail');
 return $img_src[0];
 } else {
 $content = $prev_post->post_content;
 preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
 $n = count($strResult[1]);
 if($n > 0){
 return $strResult[1][0];  //如果没有缩略图，但如果文章正文中有图片存在，默认把文章中第一张图片作为缩略图
 }else {
 $random = mt_rand(1, 9);
 return get_template_directory_uri().'/images/thumbs/'. $random .'.jpg';  //如果文章正文中没有图片（纯文字），从 random文件夹随机选取一张图片作为缩略图
 }
 }
 }
 }

/**
 * WordPress 获取“下一篇”文章缩略图的图片地址
 */
function xintheme_next_thumbnail_url() {
 $next_post = get_next_post();
 if ( get_post_meta($next_post->ID, 'thumbnail', true) ) { //如果 post 的自定义字段中有 thumbnail，则显示 thumbnail 的值
 $image = get_post_meta($next_post->ID, 'thumbnail', true);
 return $image;  //在新添加文章的时候添加自定义字段 thumbnail,值为缩略图地址。
 } else {
 if ( has_post_thumbnail($next_post->ID) ) { //如果下一篇的日志有缩略图，则显示下一篇日志的缩略图
 $img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $next_post->ID ), 'thumbnail');
 return $img_src[0];
 } else {
 $content = $next_post->post_content;
 preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
 $n = count($strResult[1]);
 if($n > 0){
 return $strResult[1][0];   //如果没有缩略图，但如果文章正文中有图片存在，默认把文章中第一张图片作为缩略图
 }else {
 $random = mt_rand(1, 9);
 return get_template_directory_uri().'/images/thumbs/'. $random .'.jpg';   //如果文章正文中没有图片（纯文字），从 random文件夹随机选取一张图片作为缩略图
 }
 }
 }
 }


//禁止WordPress自动生成缩略图
function ztmao_remove_image_size($sizes) {
unset( $sizes['small'] );
unset( $sizes['medium'] );
unset( $sizes['large'] );
return $sizes;
}
add_filter('image_size_names_choose', 'ztmao_remove_image_size');
//上传图片使用日期重命名
function uazoh_wp_upload_filter($file){  
$time=date("YmdHis");  
$file['name'] = $time."".mt_rand(1,100).".".pathinfo($file['name'] , PATHINFO_EXTENSION);  
return $file;  
}  
add_filter('wp_handle_upload_prefilter', 'uazoh_wp_upload_filter'); 
//禁用 auto-embeds
remove_filter( 'the_content', array( $GLOBALS['wp_embed'], 'autoembed' ), 8 );

//禁止谷歌字体
function remove_open_sans() {
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
    wp_enqueue_style('open-sans','');
}
add_action( 'init', 'remove_open_sans' );

//禁止代码标点转换
remove_filter('the_content', 'wptexturize');

//编辑器增强
 function enable_more_buttons($buttons) {
     $buttons[] = 'hr';
     $buttons[] = 'del';
     $buttons[] = 'sub';
     $buttons[] = 'sup'; 
     $buttons[] = 'fontselect';
     $buttons[] = 'fontsizeselect';
     $buttons[] = 'cleanup';   
     $buttons[] = 'styleselect';
     $buttons[] = 'wp_page';
     $buttons[] = 'anchor';
     $buttons[] = 'backcolor';
     return $buttons;
     }
add_filter("mce_buttons_3", "enable_more_buttons");
//字体增加
function custum_fontfamily($initArray){  
   $initArray['font_formats'] = "微软雅黑='微软雅黑';宋体='宋体';黑体='黑体';仿宋='仿宋';楷体='楷体';隶书='隶书';幼圆='幼圆';";  
   return $initArray;  
}  
add_filter('tiny_mce_before_init', 'custum_fontfamily');

//去掉描述P标签
function deletehtml($description) {
$description = trim($description);
$description = strip_tags($description,"");
return ($description);
}
add_filter('category_description', 'deletehtml');

//更多选项卡故障
function Uazoh_remove_help_tabs($old_help, $screen_id, $screen){
    $screen->remove_help_tabs();
    return $old_help;
}
add_filter('contextual_help', 'Uazoh_remove_help_tabs', 10, 3 );

/* 评论作者链接新窗口打开 */
function specs_comment_author_link() {
    $url    = get_comment_author_url();
    $author = get_comment_author();
    if ( empty( $url ) || 'http://' == $url )
        return $author;
    else
        return "<a target='_blank' href='$url' rel='external nofollow' class='url'>$author</a>";
}
add_filter('get_comment_author_link', 'specs_comment_author_link');

//修复 WordPress 找回密码提示“抱歉，该key似乎无效”

function reset_password_message( $message, $key ) {
 if ( strpos($_POST['user_login'], '@') ) {
 $user_data = get_user_by('email', trim($_POST['user_login']));
 } else {
 $login = trim($_POST['user_login']);
 $user_data = get_user_by('login', $login);
 }
 $user_login = $user_data->user_login;
 $msg = __('有人要求重设如下帐号的密码：'). "\r\n\r\n";
 $msg .= network_site_url() . "\r\n\r\n";
 $msg .= sprintf(__('用户名：%s'), $user_login) . "\r\n\r\n";
 $msg .= __('若这不是您本人要求的，请忽略本邮件，一切如常。') . "\r\n\r\n";
 $msg .= __('要重置您的密码，请打开下面的链接：'). "\r\n\r\n";
 $msg .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') ;
 return $msg;
}
add_filter('retrieve_password_message', 'reset_password_message', null, 2);

/*编辑器添加分页按钮*/
add_filter('mce_buttons','wysiwyg_editor');
function wysiwyg_editor($mce_buttons) {
    $pos = array_search('wp_more',$mce_buttons,true);
    if ($pos !== false) {
        $tmp_buttons = array_slice($mce_buttons, 0, $pos+1);
        $tmp_buttons[] = 'wp_page';
        $mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos+1));
    }
    return $mce_buttons;
}

//搜索结果排除所有页面
function search_filter_page($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts','search_filter_page');

//去掉图片外围标签p
function filter_ptags_on_images($content){
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '<div class="post-image">\1\2\3</div>', $content);
}
add_filter('the_content', 'filter_ptags_on_images');
//去除wordpress前台顶部工具条
show_admin_bar(false);
//移除顶部多余信息
if( xintheme('xintheme_wp_head') ) :
//remove_action( 'wp_head', 'wp_enqueue_scripts', 1 ); //Javascript的调用
remove_action( 'wp_head', 'feed_links', 2 ); //移除feed
remove_action( 'wp_head', 'feed_links_extra', 3 ); //移除feed
remove_action( 'wp_head', 'rsd_link' ); //移除离线编辑器开放接口
remove_action( 'wp_head', 'wlwmanifest_link' );  //移除离线编辑器开放接口
remove_action( 'wp_head', 'index_rel_link' );//去除本页唯一链接信息
remove_action('wp_head', 'parent_post_rel_link', 10, 0 );//清除前后文信息
remove_action('wp_head', 'start_post_rel_link', 10, 0 );//清除前后文信息
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'locale_stylesheet' );
remove_action('publish_future_post','check_and_publish_future_post',10, 1 );
remove_action( 'wp_head', 'noindex', 1 );
//remove_action( 'wp_head', 'wp_print_styles', 8 );//载入css
//remove_action( 'wp_head', 'wp_print_head_scripts', 9 );
remove_action( 'wp_head', 'wp_generator' ); //移除WordPress版本
remove_action( 'wp_head', 'rel_canonical' );
//remove_action( 'wp_footer', 'wp_print_footer_scripts' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'template_redirect', 'wp_shortlink_header', 11, 0 );
//add_action('widgets_init', 'my_remove_recent_comments_style');
//function my_remove_recent_comments_style() {
//global $wp_widget_factory;
//remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ,'recent_comments_style'));
//}
//禁止加载WP自带的jquery.js
//if ( !is_admin() ) { // 后台不禁止
//function my_init_method() {
//wp_deregister_script( 'jquery' ); // 取消原有的 jquery 定义
//}
//add_action('init', 'my_init_method'); 
//}
//wp_deregister_script( 'l10n' );
endif;
//隐藏帮助选项卡
add_filter( 'contextual_help', 'wpse50723_remove_help', 999, 3 );  
function wpse50723_remove_help($old_help, $screen_id, $screen){  
    $screen->remove_help_tabs();  
    return $old_help;  
}

//去除后台标题中的“—— WordPress”
add_filter('admin_title', 'wpdx_custom_admin_title', 10, 2);
function wpdx_custom_admin_title($admin_title, $title){
    return $title.' &lsaquo; '.get_bloginfo('name');
}
if( xintheme('xintheme_api') ) :
//去json*
add_filter('rest_enabled', '_return_false');
add_filter('rest_jsonp_enabled', '_return_false');
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
//禁用REST API、移除wp-json链接
add_filter('rest_enabled', '_return_false');
add_filter('rest_jsonp_enabled', '_return_false');
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
endif;
/**
 * Disable the emoji's
 */
function disable_emojis() {
 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'wp_print_styles', 'print_emoji_styles' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' );
 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
 add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
 }
 add_action( 'init', 'disable_emojis' );
/**
 * Filter function used to remove the tinymce emoji plugin.
 */
 function disable_emojis_tinymce( $plugins ) {
 if ( is_array( $plugins ) ) {
 return array_diff( $plugins, array( 'wpemoji' ) );
 } else {
 return array();
 }
 }
 //禁止头部加载s.w.org
function remove_dns_prefetch( $hints, $relation_type ) {
if ( 'dns-prefetch' === $relation_type ) {
return array_diff( wp_dependencies_unique_hosts(), $hints );
}
return $hints;
}
add_filter( 'wp_resource_hints', 'remove_dns_prefetch', 10, 2 );
/**
 * WordPress 关闭 XML-RPC 的 pingback 端口
 */
if( xintheme('xintheme_pingback') ) :
add_filter( 'xmlrpc_methods', 'remove_xmlrpc_pingback_ping' );
function remove_xmlrpc_pingback_ping( $methods ) {
	unset( $methods['pingback.ping'] );
	return $methods;
}
endif;
//给文章图片自动添加alt和title信息
add_filter('the_content', 'imagesalt');
function imagesalt($content) {
       global $post;
       $pattern ="/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
       $replacement = '<a$1href=$2$3.$4$5 alt="'.$post->post_title.'" title="'.$post->post_title.'"$6>';
       $content = preg_replace($pattern, $replacement, $content);
       return $content;
}
//文章自动nofollow
add_filter( 'the_content', 'xintheme_seo_wl');
function xintheme_seo_wl( $content ) {
    $regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>";
    if(preg_match_all("/$regexp/siU", $content, $matches, PREG_SET_ORDER)) {
        if( !empty($matches) ) {
   
            $srcUrl = get_option('siteurl');
            for ($i=0; $i < count($matches); $i++)
            {
                $tag = $matches[$i][0];
                $tag2 = $matches[$i][0];
                $url = $matches[$i][0];
   
                $noFollow = '';
                $pattern = '/target\s*=\s*"\s*_blank\s*"/';
                preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
                if( count($match) < 1 )
                    $noFollow .= ' target="_blank" ';
   
                $pattern = '/rel\s*=\s*"\s*[n|d]ofollow\s*"/';
                preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
                if( count($match) < 1 )
                    $noFollow .= ' rel="nofollow" ';
   
                $pos = strpos($url,$srcUrl);
                if ($pos === false) {
                    $tag = rtrim ($tag,'>');
                    $tag .= $noFollow.'>';
                    $content = str_replace($tag2,$tag,$content);
                }
            }
        }
    }
    $content = str_replace(']]>', ']]>', $content);
    return $content;
}
//禁止FEED
if( xintheme('xintheme_feed') ) :
function digwp_disable_feed() {
wp_die(__('<h1>Feed已经关闭, 请访问网站<a href="'.get_bloginfo('url').'">首页</a>!</h1>'));
}
add_action('do_feed', 'digwp_disable_feed', 1);
add_action('do_feed_rdf', 'digwp_disable_feed', 1);
add_action('do_feed_rss', 'digwp_disable_feed', 1);
add_action('do_feed_rss2', 'digwp_disable_feed', 1);
add_action('do_feed_atom', 'digwp_disable_feed', 1);
endif;
//去除分类标志代码
if( xintheme('xintheme_category') ) :
add_action( 'load-themes.php',  'no_category_base_refresh_rules');
add_action('created_category', 'no_category_base_refresh_rules');
add_action('edited_category', 'no_category_base_refresh_rules');
add_action('delete_category', 'no_category_base_refresh_rules');
function no_category_base_refresh_rules() {
	global $wp_rewrite;
	$wp_rewrite -> flush_rules();
}

// register_deactivation_hook(__FILE__, 'no_category_base_deactivate');
// function no_category_base_deactivate() {
// 	remove_filter('category_rewrite_rules', 'no_category_base_rewrite_rules');
// 	// We don't want to insert our custom rules again
// 	no_category_base_refresh_rules();
// }

// Remove category base
add_action('init', 'no_category_base_permastruct');
function no_category_base_permastruct() {
	global $wp_rewrite, $wp_version;
	if (version_compare($wp_version, '3.4', '<')) {
		// For pre-3.4 support
		$wp_rewrite -> extra_permastructs['category'][0] = '%category%';
	} else {
		$wp_rewrite -> extra_permastructs['category']['struct'] = '%category%';
	}
}

// Add our custom category rewrite rules
add_filter('category_rewrite_rules', 'no_category_base_rewrite_rules');
function no_category_base_rewrite_rules($category_rewrite) {
	//var_dump($category_rewrite); // For Debugging

	$category_rewrite = array();
	$categories = get_categories(array('hide_empty' => false));
	foreach ($categories as $category) {
		$category_nicename = $category -> slug;
		if ($category -> parent == $category -> cat_ID)// recursive recursion
			$category -> parent = 0;
		elseif ($category -> parent != 0)
			$category_nicename = get_category_parents($category -> parent, false, '/', true) . $category_nicename;
		$category_rewrite['(' . $category_nicename . ')/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$'] = 'index.php?category_name=$matches[1]&feed=$matches[2]';
		$category_rewrite['(' . $category_nicename . ')/page/?([0-9]{1,})/?$'] = 'index.php?category_name=$matches[1]&paged=$matches[2]';
		$category_rewrite['(' . $category_nicename . ')/?$'] = 'index.php?category_name=$matches[1]';
	}
	// Redirect support from Old Category Base
	global $wp_rewrite;
	$old_category_base = get_option('category_base') ? get_option('category_base') : 'category';
	$old_category_base = trim($old_category_base, '/');
	$category_rewrite[$old_category_base . '/(.*)$'] = 'index.php?category_redirect=$matches[1]';

	//var_dump($category_rewrite); // For Debugging
	return $category_rewrite;
}


// Add 'category_redirect' query variable
add_filter('query_vars', 'no_category_base_query_vars');
function no_category_base_query_vars($public_query_vars) {
	$public_query_vars[] = 'category_redirect';
	return $public_query_vars;
}

// Redirect if 'category_redirect' is set
add_filter('request', 'no_category_base_request');
function no_category_base_request($query_vars) {
	//print_r($query_vars); // For Debugging
	if (isset($query_vars['category_redirect'])) {
		$catlink = trailingslashit(get_option('home')) . user_trailingslashit($query_vars['category_redirect'], 'category');
		status_header(301);
		header("Location: $catlink");
		exit();
	}
	return $query_vars;
}
endif;
// 隐藏 姓，名 和 显示的名称，三个字段
add_action('show_user_profile','wpjam_edit_user_profile');
add_action('edit_user_profile','wpjam_edit_user_profile');
function wpjam_edit_user_profile($user){
	?>
	<script>
	jQuery(document).ready(function($) {
		$('#first_name').parent().parent().hide();
		$('#last_name').parent().parent().hide();
		$('#display_name').parent().parent().hide();
		$('.show-admin-bar').hide();
	});
	</script>
<?php
}

//更新时候，强制设置显示名称为昵称
add_action('personal_options_update','wpjam_edit_user_profile_update');
add_action('edit_user_profile_update','wpjam_edit_user_profile_update');
function wpjam_edit_user_profile_update($user_id){
	if (!current_user_can('edit_user', $user_id))
		return false;

	$user = get_userdata($user_id);

	$_POST['nickname']		= ($_POST['nickname'])?:$user->user_login;
	$_POST['display_name']	= $_POST['nickname'];

	$_POST['first_name']	= '';
	$_POST['last_name']		= '';
}

//面包屑
function get_breadcrumbs()
{
global $wp_query;
if ( !is_home() ){
// Add the Home link
echo '<li>当前位置：<a href="'. get_option('home') .'">首页</a></li>';
if ( is_category() )
{
$catTitle = single_cat_title( "", false );
$cat = get_cat_ID( $catTitle );
echo "<li><span>&gt;</span>". get_category_parents( $cat, TRUE, "<span>&gt;</span>" ) ."</li>";
}
elseif ( is_archive() && !is_category() )
{
echo "<li><span>&gt;</span>类目</li>";
}
elseif ( is_search() ) {
echo "<li><span>&gt;</span>搜索列表</li>";
}
elseif ( is_404() )
{
echo "<li><span>&gt;</span>404 Not Found</li>";
}
elseif ( is_single() )
{
$category = get_the_category();
$category_id = get_cat_ID( $category[0]->cat_name );
echo '<li><span>&gt;</span> '. get_category_parents( $category_id, TRUE, " <span>&gt;</span> " );
echo the_title('','', FALSE) ."</li>";
}
elseif ( is_page() )
{
$post = $wp_query->get_queried_object();
if ( $post->post_parent == 0 ){
echo "<li><span>&gt;</span> ".the_title('','', FALSE)."</li>";
} else {
$title = the_title('','', FALSE);
$ancestors = array_reverse( get_post_ancestors( $post->ID ) );
array_push($ancestors, $post->ID);
foreach ( $ancestors as $ancestor ){
if( $ancestor != end($ancestors) ){
echo '<li><span>&gt;</span> <a href="'. get_permalink($ancestor) .'">'. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</a></li>';
} else {
echo '<li><span>&gt;</span> '. strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) .'</li>';
}
}
}
}
// End the UL
}
}
/*识别当前作者身份*/
function xintheme_level() { 
$user_id=get_post(get_the_ID())->post_author;   
if(user_can($user_id,'install_plugins')){echo'<span>站长</span>';}   
elseif(user_can($user_id,'edit_others_posts')){echo'<span>编辑</span>';}elseif(user_can($user_id,'publish_posts')){echo'<span>作者</span>';}elseif(user_can($user_id,'delete_posts')){echo'<span>投稿者</span>';}elseif(user_can($user_id,'read')){echo'<span>订阅者</span>';}
}
//禁用：wp-embed.min.js
function disable_embeds_init() {  
    /* @var WP $wp */  
    global $wp;  
    // Remove the embed query var.  
    $wp->public_query_vars = array_diff( $wp->public_query_vars, array(  
        'embed',  
    ) );  
    // Remove the REST API endpoint.  
    remove_action( 'rest_api_init', 'wp_oembed_register_route' );  
    // Turn off  
    add_filter( 'embed_oembed_discover', '__return_false' );  
    // Don't filter oEmbed results.  
    remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );  
    // Remove oEmbed discovery links.  
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );  
    // Remove oEmbed-specific JavaScript from the front-end and back-end.  
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );  
    add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );  
    // Remove all embeds rewrite rules.  
    add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );  
}  
add_action( 'init', 'disable_embeds_init', 9999 );  
/** 
 * Removes the 'wpembed' TinyMCE plugin. 
 * 
 * @since 1.0.0 
 * 
 * @param array $plugins List of TinyMCE plugins. 
 * @return array The modified list. 
 */  
function disable_embeds_tiny_mce_plugin( $plugins ) {  
    return array_diff( $plugins, array( 'wpembed' ) );  
}  
/** 
 * Remove all rewrite rules related to embeds. 
 * 
 * @since 1.2.0 
 * 
 * @param array $rules WordPress rewrite rules. 
 * @return array Rewrite rules without embeds rules. 
 */  
function disable_embeds_rewrites( $rules ) {  
    foreach ( $rules as $rule => $rewrite ) {  
        if ( false !== strpos( $rewrite, 'embed=true' ) ) {  
            unset( $rules[ $rule ] );  
        }  
    }  
    return $rules;  
}  
/** 
 * Remove embeds rewrite rules on plugin activation. 
 * 
 * @since 1.2.0 
 */  
function disable_embeds_remove_rewrite_rules() {  
    add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );  
    flush_rewrite_rules();  
}  
register_activation_hook( __FILE__, 'disable_embeds_remove_rewrite_rules' );  
/** 
 * Flush rewrite rules on plugin deactivation. 
 * 
 * @since 1.2.0 
 */  
function disable_embeds_flush_rewrite_rules() {  
    remove_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );  
    flush_rewrite_rules();  
}   

register_deactivation_hook( __FILE__, 'disable_embeds_flush_rewrite_rules' );  
// 分页代码
if ( !function_exists('par_pagenavi') ) {
	function par_pagenavi( $p = 2 ) { // 取当前页前后各 2 页
		if ( is_singular() ) return; // 文章与插页不用
		global $wp_query, $paged;
		$max_page = $wp_query->max_num_pages;
		if ( $max_page == 1 ) return; // 只有一页不用
		if ( empty( $paged ) ) $paged = 1;
		
		if ( $paged > 1 ) p_link( $paged - 1, '上一页', '&lt;' );/* 如果当前页大于1就显示上一页链接 */
		if ( $paged > $p + 1 ) p_link( 1, '最前页' );
		if ( $paged > $p + 2 ) echo '<a class="page-numbers">...</a>';
		for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { // 中间页
			if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<a class='page-numbers current' href='javascript:void(0);'>{$i}</a> " : p_link( $i );
		}
		if ( $paged < $max_page - $p - 1 ) echo '<a class="page-numbers" href="javascript:void(0);">...</a> ';
		if ( $paged < $max_page - $p ) p_link( $max_page, '最后页' );
		if ( $paged < $max_page ) p_link( $paged + 1,'下一页', ' &gt;' );/* 如果当前页不是最后一页显示下一页链接 */
		echo '<a class="page-numbers" href="javascript:void(0);">' . $paged . ' / ' . $max_page . ' </a> '; // 显示页数
	}
	function p_link( $i, $title = '', $linktype = '' ) {
		if ( $title == '' ) $title = "第 {$i} 页";
		if ( $linktype == '' ) { $linktext = $i; } else { $linktext = $linktype; }
		echo "<a class='page-numbers' href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$linktext}</a> ";
	}
}
//侧边栏分类
function get_category_root_id($cat)  
{  
$this_category = get_category($cat); // 取得当前分类  
while($this_category->category_parent) // 若当前分类有上级分类时，循环  
{  
$this_category = get_category($this_category->category_parent); // 将当前分类设为上级分类（往上爬）  
}  
return $this_category->term_id; // 返回根分类的id号  
}
/* 搜索关键词为空 */
function mt_redirect_blank_search( $query_variables ) {
    if (isset($_GET['s']) && !is_admin()) {
        if (empty($_GET['s']) || ctype_space($_GET['s'])) {
            wp_redirect( home_url() );
            exit;
        }
    }
    return $query_variables;
}
add_filter( 'request', 'mt_redirect_blank_search' );
//评论列表
function weisay_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
global $commentcount,$wpdb, $post;
     if(!$commentcount) { 
          $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_post_ID = $post->ID AND comment_type = '' AND comment_approved = '1' AND !comment_parent");
          $cnt = count($comments);
          $page = get_query_var('cpage');
          $cpp=get_option('comments_per_page');
         if (ceil($cnt / $cpp) == 1 || ($page > 1 && $page  == ceil($cnt / $cpp))) {
             $commentcount = $cnt + 1;
         } else {
             $commentcount = $cpp * $page + 1;
         }
     }
?>
<li id="comment-<?php comment_ID() ?>" <?php comment_class(); ?>>
<article id="div-comment-<?php comment_ID() ?>" class="comment-body">
<footer class="comment-meta">
<div class="comment-author vcard">
	<?php echo get_avatar($comment,60); ?>
	<b class="fn"><?php comment_author_link() ?></b>
</div>
<!-- .comment-author -->
<div class="comment-metadata">
	<time>
		<?php comment_date() ?><?php comment_time() ?>
	</time>
</div>
</footer>
<div class="comment-content">

		<?php comment_text() ?>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<font style="color:#C00; font-style:inherit">您的评论正在等待审核中...</font>
		<?php endif; ?>

</div>
<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => "回复"))) ?>
</div>
</article>
<?php }
function weisay_end_comment() {
    echo '</li>';
}