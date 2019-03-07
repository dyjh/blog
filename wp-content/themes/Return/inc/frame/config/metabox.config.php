<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// METABOX OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options      = array();


// -----------------------------------------
// Post Metabox Options                    -
// -----------------------------------------
$options[]    = array(
  'id'        => 'extend_info',
  'title'     => '扩展选项',
  'post_type' => 'post',
  'context'   => 'normal',
  'priority'  => 'default',
  'sections'  => array(

    	array(
     		'fields' => array(
				array(
					'id'    => 'post_layout',
					'type'  => 'radio',
					'title' => '文章页样式',
				    'options' => array(
						'1'   => '标准样式',
						'2'   => '标题上方特色图',
						'3' => '全屏标题背景图',
				    ),
				    'default'   => '1',
				    'radio'     => true,
				    'attributes'   => array(
						'data-depend-id' => 'post_layout',
					),
		    	),
		    	array(
					'id'        => 'header_img',
					'type'      => 'image',
					'title'     => '头图设置',
					'desc'      => '上传一张显示在文章顶部的图片',
					'add_title' => '选择头图',
					'dependency'=> array(
						'post_layout',
						'any',
						'2,3'
					)
				),

     		),
    	),

    // end: a section
  ),
);

CSFramework_Metabox::instance( $options );
