<?php
//小工具显示分类ID
add_action('optionsframework_after','show_category', 100);
function show_category() {
    global $wpdb;
    $request = "SELECT $wpdb->terms.term_id, name FROM $wpdb->terms ";
    $request .= " LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ";
    $request .= " WHERE $wpdb->term_taxonomy.taxonomy = 'category' ";
    $request .= " ORDER BY term_id asc";
    $categorys = $wpdb->get_results($request);
    echo '<div class="uk-panel uk-panel-box" style="margin-bottom: 20px;"><h3 style="margin-top: 0; margin-bottom: 15px; font-size: 18px; line-height: 24px; font-weight: 400; text-transform: none; color: #666;">可能会用到的分类ID</h3>';
    echo "<ul>";
    foreach ($categorys as $category) { 
        echo  '<li style="margin-right: 10px;float:left;">'.$category->name."（<code>".$category->term_id.'</code>）</li>';
    }
    echo "</ul></div>";
}
//激活小工具
if( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => '全站侧栏',
		'id'            => 'widget_right',
		'before_widget' => '<div class="widget %2$s">', 
		'after_widget' => '</div>', 
		'before_title' => '<div class="box-moder hot-article"><h3>', 
		'after_title' => '</h3></div>' 
	));
	register_sidebar(array(
		'name'          => '首页侧栏',
		'id'            => 'widget_sidebar',
		'before_widget' => '<div class="widget %2$s">', 
		'after_widget' => '</div>', 
		'before_title' => '<div class="box-moder hot-article"><h3>', 
		'after_title' => '</h3></div>' 
	));

	register_sidebar(array(
		'name'          => '文章页侧栏',
		'id'            => 'widget_post',
		'before_widget' => '<div class="widget %2$s">', 
		'after_widget' => '</div>', 
		'before_title' => '<div class="box-moder hot-article"><h3>', 
		'after_title' => '</h3></div>' 
	));
	
	register_sidebar(array(
		'name'          => '页面侧栏',
		'id'            => 'widget_page',
		'before_widget' => '<div class="widget %2$s">', 
		'after_widget' => '</div>', 
		'before_title' => '<div class="box-moder hot-article"><h3>', 
		'after_title' => '</h3></div>' 
	));
	
	register_sidebar(array(
		'name'          => '分类/标签/搜索页侧栏',
		'id'            => 'widget_other',
		'before_widget' => '<div class="widget %2$s">', 
		'after_widget' => '</div>', 
		'before_title' => '<div class="box-moder hot-article"><h3>', 
		'after_title' => '</h3></div>' 
	));

}
include_once get_template_directory() .'/inc/widgets/index.php';