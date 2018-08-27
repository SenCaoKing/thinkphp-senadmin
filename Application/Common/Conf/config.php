<?php
return array(
	/* 附加设置 */
	'SHOW_PAGE_TRACE'        => true, // 是否显示调试面板
    'URL_CASE_INSENSITIVE'   => false, // url区分大小写
    'TAGLIB_BUILD_IN'        => 'Cx,Common\Tag\My', // 加载自定义标签
    'LOAD_EXT_CONFIG'        => 'db', // 加载网站设置文件
    'TMPL_PARSE_STRING'      => array(
        '__OSS__'            => OSS_URL,
        '__PUBLIC__'         => OSS_URL.__ROOT__.'/Public',
        '__ADMIN_CSS__'      => __ROOT__.trim(TMPL_PATH, '.').'Admin/Public/css',
        '__ADMIN_JS__'       => __ROOT__.trim(TMPL_PATH, '.').'Admin/Public/js',
        '__ADMIN_IMAGES__'   => OSS_URL.trim(TMPL_PATH, '.').'Admin/Public/images',
        '__ADMIN_ACEADMIN__' => OSS_URL.__ROOT__.'/Public/statics/aceadmin',
        '__PUBLIC_CSS__'     => __ROOT__.trim(TMPL_PATH, '.').'Public/css',
        '__PUBLIC_JS__'      => __ROOT__.trim(TMPL_PATH, '.').'Public/js',
        '__PUBLIC_IMAGES__'  => OSS_URL.trim(TMPL_PATH, '.').'Public/images',
    ),

    /* 页面设置 */
    'TMPL_EXCEPTION_FILE'   => APP_DEBUG ? THINK_PATH.'Tpl/think_exception.tpl' : './Template/default/Home/Public/404.html',
    'TMPL_ACTION_ERROR'     => TMPL_PATH.'/Public/dispatch_jump.tpl', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'   => TMPL_PATH.'/Public/dispatch_jump.tpl', // 默认成功跳转对应的模板文件

    /* 其他设置 */
    'RONGLIAN_ACCOUNT_SID'  => '', // 容联云通讯 主账号 accountSid
    'RONGLIAN_ACCOUNT_TOKEN'=> '', // 容联云通讯 主账号 token accountToken
    'RONGLIAN_APPID'        => '', // 容联云通讯 应用Id appid
    'RONGLIAN_TEMPLATE_ID'  => '', // 容联云通讯 模板id

    'GEETEST_ID'             => '034b9cc862456adf05398821cefc94eb', // 极验id  仅供测试使用
    'GEETEST_KEY'            => 'b7f064b9ae813699de794303f0b0e76f', // 极验key 仅供测试使用
);