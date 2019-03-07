<?php if( xintheme('xintheme_push') ) :
//检测主题更新
function create_dwb_menu() {
  global $wp_admin_bar;
$menu_id = 'dwb';
  $content = wp_remote_retrieve_body( wp_remote_get('http://www.xintheme.com/api?id=339 

') );
$content_obj = json_decode($content,true); #JSON内容转换为PHP对象
	if($content_obj){
		$bben = $content_obj['Version'];
		$downlink = $content_obj['Link'];
		$my_theme = wp_get_theme();
		$dqbb = $my_theme->get( 'Version' );
		if($dqbb < $bben){
		$wp_admin_bar->add_menu(array('id' => $menu_id, 'title' => __('<span class="update-plugins count-2" style="display: inline-block;background-color: #d54e21;color: #fff;font-size: 9px;font-weight: 600;border-radius: 10px;z-index: 26;height: 18px;margin-right: 5px;"><span class="update-count" style="display: block;padding: 0 6px;line-height: 17px;">1</span></span>主题有更新，请及时查看！！！'), 'href' => $downlink));	
		}
	} 
}
add_action('admin_bar_menu', 'create_dwb_menu', 2000);
endif;
