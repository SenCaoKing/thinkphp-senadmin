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
function create_xls($data, $filename='simple.xls'){
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
    exit;
}

/**
 * 数据转csv格式的Excel
 * @param array  $data     需要转的数组
 * @param string $header   要生成的Excel表头
 * @param string $filename 生成的Excel文件名
 * 示例数组：
    $data = array(
        '1,2,3,4,5',
        '6,7,8,9,0',
        '1,3,5,6,7'
    );
    $header='用户名,密码,头像,性别,手机号';
 */
function create_csv($data, $header=null, $filename='simple.csv'){
    // 如果手动设置表头；则放在第一行
    if(!is_null($header)){
        array_unshift($data, $header);
    }
    // 防止没有添加文件后缀
    $filename=str_replace('.csv', '', $filename).'.csv';
    ob_clean();
    Header("Content-type: application/octet-stream");
    Header("Accept-Ranges: bytes ");
    Header("Content-Disposition: attachment; filename=".$filename);
    foreach($data as $k => $v){
        // 如果是二位数组；转成一位
        if(is_array($v)){
            $v=implode(',', $v);
        }
        // 替换掉换行
        $v=preg_replace('/\s*/', '', $v);
        // 解决导出的数字会显示成科学计数法的问题
        $v=str_replace(',', "\t,", $v);
        // 转成gbk以兼容office乱码的问题
        echo iconv('UTF-8', 'GBK', $v)."\t\r\n";
    }
}

/**
 * geetest检测验证码
 */
function geetest_check_verify($data){
    $geetest_id=C('GEETEST_ID');
    $geetest_key=C('GEETEST_KEY');
    $geetest=new \Org\Xb\Geetest($geetest_id, $geetest_key);
    $user_id=$_SESSION['geetest']['user_id'];
    if($_SESSION['geetest']['gtserver']==1){
        $result=$geetest->success_validate($data['geetest_challenge'], $data['geetest_validate'], $data['geetest_seccode'], $user_id);
        if($result){
            return true;
        }else{
            return false;
        }
    }else{
        if($geetest->fail_validate($data['geetest_challenge'], $data['geetest_validate'], $data['geetest_seccode'])){
            return true;
        }else{
            return false;
        }
    }
}

/**
 * 上传文件类型控制 此方法仅限ajax上传使用
 * @param string  $path    字符串 保存文件路径示例： /Upload/image/
 * @param string  $format  文件格式限制
 * @param integer $maxSize 允许的上传文件最大值 52428800
 * @return boolean          返回ajax的json格式数据
 */
function ajax_upload($path='file', $format='empty', $maxSize='52428800'){
    ini_set('max_execution_time', '0');
    // 去除两边的/
    $path=trim($path, '/');
    // 添加Upload根目录
    $path=strtolower(substr($path, 0, 6))==='upload' ? ucfirst($path) : 'Upload/'.$path;
    // 上传文件控制
    $ext_arr=array(
        'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
        'photo' => array('jpg', 'jpeg', 'png'),
        'flash' => array('swf', 'flv'),
        'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
        'file'  => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2', 'pdf')
    );
    if(!empty($_FILES)){
        // 上传文件配置
        $config=array(
            'maxSize'  => $maxSize,            // 上传文件最大为50M
            'rootPath' => './',                // 文件上传保存的根路径
            'savePath' => './'.$path.'/',      // 文件上传的保存路径（相对于根路径）
            'saveName' => array('uniqid', ''), // 上传文件的保存规则，支持数组和字符串方式定义
            'autoSub'  => true,                // 自动使用子目录保存上传文件 默认为true
            'exts'     => isset($ext_arr[$format]) ? $ext_arr[$format] : '',
        );

        // 实例化上传
        $upload=new \Think\Upload($config);
        // 调用上传方法
        $info=$upload->upload();

        $data=array();
        if(!$info){
            // 返回错误信息
            $error=$upload->getError();
            $data['error_info']=$error;
            echo json_encode($data);
        }else{
            // 返回成功信息
            foreach($info as $file){
                $data['name']=trim($file['savepath'].$file['savename'],'.');

                echo json_encode($data);
            }
        }
    }
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
