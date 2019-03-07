<?php
date_default_timezone_set('Asia/Shanghai');
session_start();
require_once dirname( __FILE__ ) .'/inc/frame/cs-framework.php';
define('xintheme', TEMPLATEPATH.'/inc/xintheme');
    function xintheme_includeAll( $dir ){ 
        $dir = realpath( $dir );
        if($dir){
            $files = scandir( $dir );
            sort( $files );
            foreach( $files as $file ){
                if( $file == '.' || $file == '..' ){
                    continue;
                }elseif( preg_match('/.php$/i', $file) ){
                    include_once $dir.'/'.$file;
                }
            }
        }
    }
xintheme_includeAll( xintheme );