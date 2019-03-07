<?php
//精简WordPress后台顶部工具栏
function my_edit_toolbar($wp_toolbar) {
	$wp_toolbar->remove_node('wp-logo'); //去掉Wordpress LOGO
	//$wp_toolbar->remove_node('site-name'); //去掉网站名称
	//$wp_toolbar->remove_node('updates'); //去掉更新提醒
	//$wp_toolbar->remove_node('comments'); //去掉评论提醒
	//$wp_toolbar->remove_node('new-content'); //去掉新建文件
	//$wp_toolbar->remove_node('top-secondary'); //用户信息
}
add_action('admin_bar_menu', 'my_edit_toolbar', 999);

//添加后台顶部工具栏菜单  
function custom_adminbar_menu( $meta = TRUE ) {  
    global $wp_admin_bar;  
        if ( !is_user_logged_in() ) { return; }  
        if ( !is_super_admin() || !is_admin_bar_showing() ) { return; }  
    $wp_admin_bar->add_menu( array(  
        'id' => 'custom_menu',  
        'title' => __( '<img src="'.get_stylesheet_directory_uri().'/inc/frame/assets/images/setting.png" width="25" height="25" /> 网站设置' ) ,      /* 设置菜单名 */  
		'href' => 'themes.php?page=xintheme'  )
	); 
    $wp_admin_bar->add_menu( array(  
        'parent' => 'custom_menu',  
        'id'     => 'custom_links',  
        'title' => __( '主题设置'),            /* 设置链接名*/  
        'href' => 'themes.php?page=xintheme',      /* 设置链接地址 */  
        'meta'  => array( target => '_self' ) )  
    ); 	
    $wp_admin_bar->add_menu( array(  
        'parent' => 'custom_menu',  
        'id'     => 'seo',  
        'title' => __( 'SEO优化'),            /* 设置链接名*/  
        'href' => 'themes.php?page=xintheme-seo',      /* 设置链接地址 */  
        'meta'  => array( target => '_self' ) )  
    ); 
    $wp_admin_bar->add_menu( array(  
        'parent' => 'custom_menu',  
        'id'     => 'rumen',  
        'title' => __( '网站地图'),            /* 设置链接名*/  
        'href' => 'themes.php?page=baidu_sitemap_china',      /* 设置链接地址 */  
        'meta'  => array( target => '_self' ) )  
    ); 
    $wp_admin_bar->add_menu( array(  
        'parent' => 'custom_menu',  
        'id'     => 'custom_clean',  
        'title' => __( '数据库清理'),            /* 设置链接名*/  
        'href' => 'themes.php?page=wp_clean_up_admin.php',      /* 设置链接地址 */  
        'meta'  => array( target => '_self' ) )  
    ); 
    $wp_admin_bar->add_menu( array(  
        'parent' => 'custom_menu',  
        'id'     => 'faq',  
        'title' => __( '帮助中心'),            /* 设置链接名*/  
        'href' => 'http://www.xintheme.com/support',      /* 设置链接地址 */  
        'meta'  => array( target => '_blank' ) )  
    ); 

   /* sub-menu */  
    $wp_admin_bar->add_menu( array(  
        'parent' => 'custom_menu',  
        'id'     => 'jishuzhichi',  
        'title' => __( '技术支持'),       /* 设置子菜单名 */  
		'href'  => '#')  /* 设置链接地址 */  
    );  
            /* menu links */  
            $wp_admin_bar->add_menu( array(  
                'parent'    => 'jishuzhichi',  
                'title'     => '客服001',             /* 设置链接名 */  
                'href'  => 'http://wpa.qq.com/msgrd?v=3&uin=670088886&site=qq&menu=yes', /* 设置链接地址 */  
                'meta'  => array( target => '_blank' ) )  
            );  
            $wp_admin_bar->add_menu( array(  
                'parent'    => 'jishuzhichi',  
                'title'     => '客服002',           /* 设置链接名 */   
                'href'  => 'http://wpa.qq.com/msgrd?v=3&uin=1114872587&site=qq&menu=yes',  /* 设置链接地址 */ 
                'meta'  => array( target => '_blank' ) )  
            );  
            $wp_admin_bar->add_menu( array(  
                'parent'    => 'jishuzhichi',  
                'title'     => '客服003',           /* 设置链接名 */   
                'href'  => 'http://wpa.qq.com/msgrd?v=3&uin=940433341&site=qq&menu=yes',  /* 设置链接地址 */ 
                'meta'  => array( target => '_blank' ) )  
            );  

	
}  
add_action( 'admin_bar_menu', 'custom_adminbar_menu', 35 );
function custom_menu_css() {  
    $custom_menu_css = '<style type="text/css">  
        #wp-admin-bar-custom_menu img { margin:0 0 -4px 0; } /** moves icon over */  
        #wp-admin-bar-custom_menu { width:75px; } /** sets width of custom menu */  
		#wp-admin-bar-custom_menu {width:92px;}
		.wp-first-item.wp-not-current-submenu.wp-menu-separator,.hide-if-no-customize{display: none;}
    </style>';  
    echo $custom_menu_css;  
}  
add_action( 'admin_head', 'custom_menu_css' );
//删除后台外观 编辑选项
function remove_submenu() {   
// 删除"外观"下面的子菜单"编辑"   
remove_submenu_page( 'themes.php', 'theme-editor.php' );   
}   

if ( is_admin() ) {   
add_action('admin_init','remove_submenu');   
}  

