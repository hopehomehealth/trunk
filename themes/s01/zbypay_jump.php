<?
header("Content-type: text/html; charset=utf-8");
$post['totalprice'] = req('totalprice');
$post['orderno'] = req('orderno');
$post['topayinfoid'] = req('topayinfoid');
$post['token'] = substr($_COOKIE['5fe845d7c136951446ff6a80b8144467'],1,-1);

$aaa = $post['orderno'];
$post['successpage'] = 'traveld.bus365.cn/zhoubianyou/zbypay_success-' . $aaa . '.html';
$url = $host . '/travel/interface/pay/createpayparam';
$pay_parameter = juhecurl($url, $post, 1);
$pay_parameter = json_decode($pay_parameter, true);
$errormsg = $db->to_utf8("支付失败!");;
// 判断返回参数
if ($pay_parameter['status'] != '0000') {
    echo "<script>alert('$errormsg');window.location.href = '/zhoubian/';</script>";
    exit;
}

if ($post['topayinfoid'] == '65') {
    echo $pay_parameter['data'];
    $js = '<script>document.getElementById("form_payment").submit();</script>';
    echo $js;
}else if ($post['topayinfoid'] == '71') {
    $url = 'http://' . $host . '/travel/interface/pay/scanQRCode?code_url=' . $pay_parameter['data'];
    echo $url;
} else if ($post['topayinfoid'] == '189') {
    echo $pay_parameter['data'];
    $js = "<script>document.getElementById('form_payment').submit();</script>";
    echo $js;
}




?>