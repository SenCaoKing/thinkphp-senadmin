<?php
return array(
	//'配置项'=>'配置值'
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'laravel_test',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  '',    // 数据库表前缀

    'TAGLIB_BUILD_IN'       => 'Cx,Common\Tag\My', // 加载自定义标签

    /* 页面设置 */
    'TMPL_EXCEPTION_FILE'   => APP_DEBUG ? THINK_PATH.'Tpl/think_exception.tpl' : './Template/default/Home/Public/404.html',
    'TMPL_ACTION_ERROR'     => TMPL_PATH.'/Public/dispatch_jump.tpl', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'   => TMPL_PATH.'/Public/dispatch_jump.tpl', // 默认成功跳转对应的模板文件

);