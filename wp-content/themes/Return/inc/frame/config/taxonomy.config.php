<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// TAXONOMY OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options     = array();

// -----------------------------------------
// Taxonomy Options                        -
// -----------------------------------------
$options[]   = array(
  'id'       => '_custom_category_options',
  'taxonomy' => 'category', // category, post_tag or your custom taxonomy name
  'fields'   => array(

    	array(
			'id'    => 'cat_layout',
			'type'    => 'radio',
			'title' => '布局样式',
		    'options' => array(
				'list1'    => '输出小图、标准、特色三种文章形式，瀑布流列表',
				'list2'   => '第1和7篇文章自动为大图模式，其他为特色或标准样式（小图同为标准样式）',
				'list3'  => '同上，增加侧边栏',
				'list4'  => '大图列表（单一样式）',
		    ),
		    'default'   => 'list1',
    	),
		
		array(
    		'id'      => 'cat_name_show',
    		'type'    => 'switcher',
    		'title'   => '分类名称显示',
    		'help'    => '开启后将显示当前分类名称。',
    		'default' => true,
    	),

  ),
);

$options[]   = array(
  'id'       => '_custom_taxonomy_options',
  'taxonomy' => 'post_tag', // category, post_tag or your custom taxonomy name
  'fields'   => array(

    array(
      'id'    => 'section_1_text',
      'type'  => 'text',
      'title' => 'Text Field',
    ),

  ),
);

CSFramework_Taxonomy::instance( $options );
