<?
include '../config.php';
$orderCode =$_POST['orderCode'];
$flag = $_POST['flag'];
$token = substr($_COOKIE['5fe845d7c136951446ff6a80b8144467'],1,-1);
//退款产品信息检验
if(!empty($orderCode) && $flag == 'chk') {
    $post1 = array('orderCode' => $orderCode, 'token' => $token);
    $refund_product = juhecurl($host . "/travel/interface/zby/v3.2/zbyRefundInfo_v3.2", $post1, 1);
    $refund_product = json_decode($refund_product, true);
    $refund_product_data = $refund_product['data'];
    $refundReasonList = $refund_product_data['refundReasonList'];
    $isChange = $refund_product_data['isChange'];
    $failReason = $refund_product_data['failReason'];
    echo $isChange;
//var_dump($refund_product);
}
//判断用户是否完成支付
if(!empty($orderCode) && $flag == 'complete') {

    $post2 = array('orderCode' => $orderCode, 'token' => $token);
    $complete = juhecurl($host . "/travel/interface/zby/v3.2/judgeIsPay", $post2, 1);
    $complete = json_decode($complete, true);
    if($complete['status'] == '0000') echo 'true';else echo 'false';
}
