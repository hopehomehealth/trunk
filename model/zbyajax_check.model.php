<?
include '../config.php';
$orderCode =$_POST['orderCode'];
$flag = req('flag');
$token = substr($_COOKIE['5fe845d7c136951446ff6a80b8144467'],1,-1);
//退款产品信息检验
if(!empty($orderCode) && $flag == 'chk') {
    $post1 = array('orderCode' => $orderCode, 'token' => $token);
    $refund_product = juhecurl($host . "/travel/interface/zby/zbyRefundInfo", $post1, 1);
    $refund_product = json_decode($refund_product, true);
    $refund_product_data = $refund_product['data'];
    $refundReasonList = $refund_product_data['refundReasonList'];
    $isChange = $refund_product_data['isChange'];
    $failReason = $refund_product_data['failReason'];
    echo $isChange;
//var_dump($refund_product);
}

