<?
include('do.common.php');
$arr = array();
$arr['orderno'] = $_POST['orderno'];//订单号
$orderno = $arr['orderno'];
$arr['payno'] = $_POST['payno'];//支付流水号
$arr['refundmoney'] = $_POST['refundmoney'];//应退金额
$arr['gatewayid'] = $_POST['gatewayid'];//网关ID
$arr['totalPrice'] = $_POST['totalPrice'];//总金额
$arr['refund_fee'] = $_POST['refund_fee'];//退款金额
if($arr['refundmoney'] == ''){
    echo "<script>alert('应退金额不能为空！');history.go(-1);</script>";
    exit();
}
//if($arr['refundmoney'] > $arr['refund_fee']){
//    echo "<script>alert('应退金额不能大于退款金额！');history.go(-1);</script>";
//    exit();
//}
$arr['security'] = md5("098f6bcd4621d373cade4e832627b4f6");//签名
$url = $host . "/travel/interface/refund";//接口地址
//接口传参
$rst = $db->api_post($url, $arr);
//对象转数组
$output = json_decode($rst, true);
$info = $db->to_gbk($output['msg']);
// 对接口返回的数据进行判断
if ($output['status'] != "0000") {
    $sql = "UPDATE `t_refund_fee_apply` SET `flag` = '4' WHERE `order_code` = '$orderno'";
    $db->query($sql);
    echo "<script>alert('退款失败！')</script>";
    $url = "./?cmd=".base64_encode("order_refund.php");
    gourl($url);
} else {
    $sql = "UPDATE `t_refund_fee_apply` SET `flag` = '2' WHERE `order_code` = '$orderno'";
    $db->query($sql);
    echo "<script>alert('退款成功！')</script>";
    $url = "./?cmd=".base64_encode("order_refund.php");
    gourl($url);
}