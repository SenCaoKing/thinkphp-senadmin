<?php
/**
 * 生成二维码
 * @param string  $url  utl链接
 * @param integer $size 尺寸 纯数字
 */
function qrcode($url, $size=4){
    Vendor('Phpqrcode.phpqrcode');
    // 如果没有http 则添加
    if (strpos($url, 'http') === false) {
        $url = 'http://'.$url;
    }
    QRcode::png($url, false, QR_ECLEVEL_L, $size, 2, false, 0xFFFFFF, 0x000000);
}

/**
 * 发送 容联云通讯 验证码
 * @param  int $phone 手机号
 * @param  int $code  验证码
 * @return bool       是否发送成功
 */
function send_sms_code($phone, $code){
    // 请求地址，格式如下，不需要写 https://
    $serverIP = 'app.cloopen.com';
    // 请求端口
    $serverPort = '8883';
    // REST版本号
    $softVersion = '2013-12-26';
    // 主账号
    $accountSid = C('RONGLIAN_ACCOUNT_SID'); // 配置项配置
    // 主账号Token
    $accountToken = C('RONGLIAN_ACCOUNT_TOKEN'); // 配置项配置
    // 应用Id
    $appId = C('RONGLIAN_APPID'); // 配置项配置
    $rest = new \Org\Xb\Rest($serverIP, $serverPort, $softVersion);
    $rest->setAccount($accountSid, $accountToken);
    $rest->setAppId($appId);
    // 发送模板短信
    $result =$rest->sendTemplateSMS($phone, array($code, 5), 59939);
    if($result == NULL) {
        return false;
    }
    if($result->statusCode != 0) {
        return false;
    }else{
        return true;
    }
}