<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$settings           = array(
  'menu_title'      => '主题设置',
  'menu_type'       => 'theme', // menu, submenu, options, theme, etc.
  'menu_slug'       => 'xintheme',
  'menu_position'   => 59,
  'menu_icon' => CS_URI.'/assets/images/setting.png',
  'ajax_save'       => false,
  'show_reset_all'  => false,
  'framework_title' => 'Return 主题设置<style>.cs-framework .cs-body {min-height: 700px;}</style>',
  //'framework_title' => '主题设置',
);
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options        = array();

$options[] = array(
	'name'  => 'logo',
	'title' => '网站图标',
	'icon'  => 'fa fa-flag',

  	'fields' => array(

  		array(
			'id'        => 'logo',
			'type'      => 'image',
			'title'     => '网站 LOGO',
			'desc'      => '上传网站 LOGO (建议 120*40 px)',
			'add_title' => '上传 LOGO',
		),

		array(
			'id'        => 'favicon',
			'type'      => 'image',
			'title'     => '网站 Favicon图标',
			'desc'      => '上传网站 Favicon图标',
			'add_title' => '上传 Favicon',
		),



	),
);

$options[] = array(
	'name'  => 'layout',
	'title' => '布局设置',
	'icon'  => 'fa fa-th-large',

  	'fields' => array(

    	array(
			'type'    => 'subheading',
			'content' => '首页轮播区域样式',
		),
    	array(
			'id'    => 'slide_region',
			'type'    => 'radio',
			'title' => '首页轮播区域',
		    'options' => array(
				'magazine'    => '多篇并列轮播',
				'silide'   => '单篇轮播（导航栏透明）',
				'silide2'  => '单篇轮播（黑底导航栏）',
		    ),
		    'default'   => 'magazine',
		    'desc'    => '选择首页轮播区域样式',
    	),
		
    	array(
			'type'    => 'subheading',
			'content' => '首页列表区域样式',
		),
    	array(
			'id'    => 'list_region',
			'type'    => 'radio',
			'title' => '首页列表区域',
		    'options' => array(
				'list1'    => '输出小图、标准、特色三种文章形式，瀑布流列表',
				'list2'   => '第1和7篇文章自动为大图模式，其他为特色或标准样式（小图同为标准样式）',
				'list3'  => '同上，增加侧边栏',
				'list4'  => '大图列表（单一样式）',
		    ),
		    'default'   => 'list1',
		    'desc'    => '选择首页列表区域样式',
    	),
		
    	array(
			'type'    => 'subheading',
			'content' => '搜索列表样式',
		),
    	array(
			'id'    => 'search_region',
			'type'    => 'radio',
			'title' => '搜索列表样式',
		    'options' => array(
				'list1'    => '输出小图、标准、特色三种文章形式，瀑布流列表',
				'list2'   => '第1和7篇文章自动为大图模式，其他为特色或标准样式（小图同为标准样式）',
				'list3'  => '同上，增加侧边栏',
				'list4'  => '大图列表（单一样式）',
		    ),
		    'default'   => 'list1',
		    'desc'    => '选择搜索列表样式',
    	),
		
    	array(
			'type'    => 'subheading',
			'content' => '作者列表样式',
		),
    	array(
			'id'    => 'author_region',
			'type'    => 'radio',
			'title' => '作者列表样式',
		    'options' => array(
				'list1'    => '输出小图、标准、特色三种文章形式，瀑布流列表',
				'list2'   => '第1和7篇文章自动为大图模式，其他为特色或标准样式（小图同为标准样式）',
				'list3'  => '同上，增加侧边栏',
				'list4'  => '大图列表（单一样式）',
		    ),
		    'default'   => 'list1',
		    'desc'    => '选择作者列表样式',
    	),
		
    	array(
			'type'    => 'subheading',
			'content' => '标签列表样式',
		),
    	array(
			'id'    => 'tag_region',
			'type'    => 'radio',
			'title' => '标签列表样式',
		    'options' => array(
				'list1'    => '输出小图、标准、特色三种文章形式，瀑布流列表',
				'list2'   => '第1和7篇文章自动为大图模式，其他为特色或标准样式（小图同为标准样式）',
				'list3'  => '同上，增加侧边栏',
				'list4'  => '大图列表（单一样式）',
		    ),
		    'default'   => 'list1',
		    'desc'    => '选择标签列表样式',
    	),

	),
);

$options[] = array(
	'name'  => 'footer',
	'title' => '底部设置',
	'icon'  => 'fa fa-caret-square-o-down',

  	'fields' => array(

  		array(
			'type'    => 'subheading',
			'content' => '底部信息',
		),

		
		array(
			'id'      => 'site_footer_info_switch',
			'type'    => 'switcher',
			'title'   => '底部小工具',
			'desc'    => '在底部显示关于我们、热评文章（3篇）、最新评论（3条）',
			'default' => false
		),
		
  		array(
			'id'       => 'site_footer_info',
			'type'     => 'wysiwyg',
			'title'    => '关于我们',
			'settings' => array(
				'textarea_rows' => 5,
				'tinymce'       => true,
				'media_buttons' => false,
			),
			'dependency'   => array( 'site_footer_info_switch', '==', true )
		),
		array(
			'id'      => 'footer_icp',
			'type'    => 'text',
			'title'   => '备案号',
			'attributes' => array(
            'style'    => 'width: 100%;'
			),
			'after'  => '<p class="cs-text-muted">输入网站备案号',
		),
		
		array(
			'type'    => 'subheading',
			'content' => '社交信息',
		),

		array(
			'id'      => 'footer_qq',
			'type'    => 'switcher',
			'title'   => 'QQ',
			'desc'    => '输入QQ即时通讯链接',
			'default' => false
		),
		array(
		  'id'      => 'footer_qq_url',
		  'type'    => 'text',
		  'title'   => 'QQ 客服链接',
          'attributes' => array(
            'style'    => 'width: 100%;'
          ),
		  'after'  => '<p class="cs-text-muted">填入在线客服链接，例如：http://wpa.qq.com/msgrd?v=3&uin=670088886&site=qq&menu=yes</p>',
		  'dependency'   => array( 'footer_qq', '==', true )
		),
		
		array(
			'id'      => 'footer_weibo',
			'type'    => 'switcher',
			'title'   => '微博',
			'desc'    => '输入微博链接',
			'default' => false
		),
		array(
		  'id'      => 'footer_weibo_url',
		  'type'    => 'text',
		  'title'   => '微博链接',
          'attributes' => array(
            'style'    => 'width: 100%;'
          ),
		  'dependency'   => array( 'footer_weibo', '==', true )
		),

		array(
			'id'      => 'footer_weixin',
			'type'    => 'switcher',
			'title'   => '微信',
			'desc'    => '上传微信二维码',
			'default' => false
		),
		array(
		  'id'      => 'footer_weixin_img',
		  'type'    => 'image',
		  'title'   => '微信',
		  'dependency'   => array( 'footer_weixin', '==', true )
		),
		
		array(
			'id'      => 'footer_mail',
			'type'    => 'switcher',
			'title'   => '邮箱',
			'desc'    => '输入邮箱账号',
			'default' => false
		),
		array(
		  'id'      => 'footer_mail_url',
		  'type'    => 'text',
		  'title'   => '邮箱账号',
          'attributes' => array(
            'style'    => 'width: 100%;'
          ),
		  'dependency'   => array( 'footer_mail', '==', true )
		),


	),
);

$options[] = array(
	'name'  => 'code',
	'title' => '添加代码',
	'icon'  => 'fa fa-code',

  	'fields' => array(
		array(
		  'id'      => 'head_code',
		  'type'    => 'textarea',
		  'title'   => '添加代码到头部',
		  'after'    => '<p class="cs-text-muted">出现在网站 head 中，主要用于验证网站...</p>',
		),
		array(
		  'id'      => 'foot_code',
		  'type'    => 'textarea',
		  'title'   => '添加代码到页脚',
		  'after'    => '<p class="cs-text-muted">出现在网站底部 body 前，主要用于站长统计代码...</p>',
		),
	),
);

$options[] = array(
	'name'  => 'optimization',
	'title' => '优化加速',
	'icon'  => 'fa fa-wordpress',

  	'fields' => array(
    	array(
			'id'    => 'thumbnail',
			'type'    => 'radio',
			'title' => '选择缩略图剪裁模式',
		    'options' => array(
				'timthumb'    => '使用timthumb.php剪裁缩略图',
				'qiniu'   => '使用七牛云存储剪裁缩略图（此功能需要安装七牛插件）',
		    ),
		    'default'   => 'timthumb',
    	),
		array(
			'id'      => 'xintheme_article',
			'type'    => 'switcher',
			'title'   => '登陆后台跳转到文章列表',
			'desc'    => 'WordPress登陆后一般是显示仪表盘页面，开启这个功能后登陆后台默认显示文章列表（默认开启）',
			'default' => true
		),
		array(
			'id'      => 'xintheme_wp_head',
			'type'    => 'switcher',
			'title'   => '移除顶部多余信息',
			'desc'    => '移除WordPress Head 中的多余信息，能够有效的提高网站自身安全（默认开启）',
			'default' => true
		),
		array(
			'id'      => 'xintheme_api',
			'type'    => 'switcher',
			'title'   => '禁用REST API',
			'desc'    => '禁用REST API、移除wp-json链接（默认关闭，如果你的网站没有做小程序或是APP，建议开启这个功能，禁用REST API）',
			'default' => false
		),
		array(
			'id'      => 'xintheme_pingback',
			'type'    => 'switcher',
			'title'   => 'XML-RPC',
			'desc'    => '此功能会关闭 XML-RPC 的 pingback 端口（默认开启，提高网站安全性）',
			'default' => true
		),
		array(
			'id'      => 'xintheme_feed',
			'type'    => 'switcher',
			'title'   => 'Feed',
			'desc'    => 'Feed易被利用采集，造成不必要的资源消耗（默认开启）',
			'default' => true
		),
		array(
			'id'      => 'xintheme_category',
			'type'    => 'switcher',
			'title'   => '去除分类标志',
			'desc'    => '去除链接中的分类category标志，有利于SEO优化，每次开启或关闭此功能，都需要重新保存一下固定链接！（默认关闭）',
			'default' => false
		),
		
	),
);

$options[] = array(
	'name'  => 'push',
	'title' => '更新推送',
	'icon'  => 'fa fa-bell',

  	'fields' => array(
		array(
			'id'      => 'xintheme_push',
			'type'    => 'switcher',
			'title'   => '主题更新推动',
			'desc'    => '开启后，主题每次更新用户都可在网站后台收到更新推送。（如果你用主题进行了二次开发，不需要进行官方更新，就可以关闭此功能！）',
			'default' => true
		),
	),
);

$options[] = array(
	'name'  => 'sponsor',
	'title' => '友情赞助',
	'icon'  => 'fa fa-qrcode',

  	'fields' => array(
		array(
			'id'      => 'xintheme_zanzhu',
			'type'    => 'image_select',
			'title'   => '友情赞助',
		    'options' => array(
				'wechat'   => get_stylesheet_directory_uri() . '/images/wechat.png',
				'alipay' => get_stylesheet_directory_uri() . '/images/alipay.png',
		    ),
		),
		array(
			'type'    => 'notice',
			'class'   => 'warning',
			'content' => '这款WordPress主题：Return，免费分享给大家，感谢你们长久以来的支持！请你们开启更新推送，主题会不定时更新！<br><br>主题使用过程中遇到任何问题都可联系我协助解决，我的博客地址：www.dahuzi.me',
		),
	),
);

CSFramework::instance( $settings, $options );
