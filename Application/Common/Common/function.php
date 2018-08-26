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

/**
 * 检测是否登录
 * @return boolean 是否登录
 */
function check_login(){
    if(!empty($_SESSION['user']['id'])){
        return true;
    }else{
        return false;
    }
}

/**
 * 生成pdf
 * @param string $html 需要生成的内容
 */
function pdf($html='<h1 style="color:red">hello word</h1>'){
    vendor('Tcpdf.tcpdf');
    $pdf = new \Tcpdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    // 设置打印模式
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nicola Asuni');
    $pdf->SetTitle('TCPDF Example 001');
    $pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
    // 是否显示页眉
    $pdf->setPrintHeader(false);
    // 设置页眉显示的内容
    $pdf->SetHeaderData('logo.png', 60, 'baijunyao.com', '白俊遥博客', array(0,64,255), array(0,64,128));
    // 设置页眉字体
    $pdf->setHeaderFont(Array('dejavusans', '', '12'));
    // 页眉距离顶部的距离
    $pdf->SetHeaderMargin('5');
    // 是否显示页脚
    $pdf->setPrintFooter(true);
    // 设置页脚显示的内容
    $pdf->setFooterData(array(0,64,0), array(0,64,128));
    // 设置页脚的字体
    $pdf->setFooterFont(Array('dejavusans', '', '10'));
    // 设置页脚距离底部的距离
    $pdf->SetFooterMargin('10');
    // 设置默认等宽字体
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    // 设置行高
    $pdf->setCellHeightRatio(1);
    // 设置左、上、右的间距
    $pdf->SetMargins('10', '10', '10');
    // 设置是否自动分页  距离底部多少距离时分页
    $pdf->SetAutoPageBreak(TRUE, '15');
    // 设置图像比例因子
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }
    $pdf->setFontSubsetting(true);
    $pdf->AddPage();
    // 设置字体
    $pdf->SetFont('stsongstdlight', '', 14, '', true);
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
    $pdf->Output('example_001.pdf', 'I');
}

/**
 * 数组转xls格式的excel文件
 * @param array  $data     需要生成Excel文件的数组
 * @param string $filename 生成的Excel文件名
 * 示例数据：
   $data = array(
        array(NULL, 2010, 2011, 2012),
        array('Q1', 12, 15, 21),
        array('Q2', 56, 73, 86),
        array('Q3', 52, 61, 69),
        array('Q4', 30, 32, 0),
   );
 */
function create_xls($data, $filename='simple.xls')
{
    ini_set('max_execution_time', '0');
    Vendor('PHPExcel.PHPExcel');
    $filename = str_replace('.xls', '', $filename) . '.xls';
    $phpexcel = new PHPExcel();
    $phpexcel->getProperties()
        ->setCreator("Maarten Balliauw")
        ->setLastModifiedBy("Maarten Balliauw")
        ->setTitle("Office 2007 XLSX Test Document")
        ->setSubject("Office 2007 XLSX Test Document")
        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Test result file");
    $phpexcel->getActiveSheet()->fromArray($data);
    $phpexcel->getActiveSheet()->setTitle('Sheet1');
    $phpexcel->setActiveSheetIndex(0);
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=$filename");
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0


    $objwriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
    $objwriter->save('php://output');

}

/**
 * 实例化page类
 * @param  integer $count 总数
 * @param  integer $limit 每页数量
 * @return subject        page类
 */
function new_page($count, $limit=10){
    return new \Org\Sen\Page($count, $limit);
}
