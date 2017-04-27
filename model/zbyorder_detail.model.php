<?
$db->check_cookie($loginUrl, $host);
$orderCode = req('orderCode');
$token = substr($_COOKIE['5fe845d7c136951446ff6a80b8144467'],1,-1);
$refundReasonCode = req('refundReasonCode');
//退款产品信息检验
$post1 = array('orderCode' => $orderCode, 'token' => $token);
$refund_product = juhecurl($host . "/travel/interface/zby/zbyRefundInfo", $post1, 1);
$refund_product = json_decode($refund_product, true);
$refund_product = array_iconv($refund_product);
$refund_product_data = $refund_product['data'];
$refundReasonList = $refund_product_data['refundReasonList'];
$isChange = $refund_product_data['isChange'];
$failReason = $refund_product_data['failReason'];
//echo "<pre>";
//var_dump($refund_product_data);
//    if (!$isChange !== "true"){
//        echo "<script>alert('该产品不能申请退款！');history.go(-1)</script>";
//        exit;
//    }
//    var_dump($refund_product_data);
//}
//退款申请
if(req('flag') == 'rf'){
    $post2 = array('orderCode' => $orderCode, 'refundReasonCode' => $refundReasonCode);
    $require_refund = juhecurl($host."/travel/interface/zby/refundZby",$post2, 1);
    $require_refund = json_decode($require_refund, true);
    $require_refund = array_iconv($require_refund);
    $require_refund_data = $require_refund['data'];
    $refund_message = $require_refund_data['message'];
    var_dump($require_refund_data);
}
?>
<form action="<?=$g_self_domain?>/zhoubianyou/zbyrefund-<?=$orderCode;?>.html" method="post" id="refundForm">
    <input type="hidden" name="message" id="payPrice" value="<?=$refund_message;?>">
    <input type="hidden" name="goodsName" id="goodsName" value="<?=$goodsName;?>">
</form>
<?
if (notnull($require_refund_data)){
    $js = "<script>document.getElementById('refundForm').submit();</script>";
    echo $js;
}

//确认会团
if(req('flag') == 'cf'){
    $post3 = array('orderCode' => $orderCode, 'token' => $token);
    $confirm_return = juhecurl($host."/travel/interface/zby/confirmBackGroup",$post3, 1);
    $confirm_return = json_decode($confirm_return, true);
    $confirm_return = array_iconv($confirm_return);
    $confirm_return_data = $confirm_return['data'];
}

//订单详情展示
$post4 = array('orderCode' => $orderCode, 'token' => $token);
$order_detail = juhecurl($host . "/travel/interface/zby/v3.2/getZbyOrderDtail_v3.2", $post4, 1);
$order_detail = json_decode($order_detail, true);
$order_detail = array_iconv($order_detail);
//    if ($order_detail['status'] != '0000') {
//        exit('订单失败');
//    }
//var_dump($order_detail);
$order_detail_data = $order_detail['data'];
$orderStatus = $order_detail_data['orderStatus'];
//取消订单
if($_GET['flag'] == 'cn'){
    $post5 = array('orderCode' => $orderCode, 'token' => $token);
    $cancle_order = juhecurl($host."/travel/interface/order/cancleUserOrder",$post5, 1);
    $cancle_order = json_decode($cancle_order, true);
    $cancle_order = array_iconv($cancle_order);
    $cancle_order_data = $cancle_order['data'];
//    echo "<pre>";
//    var_dump($cancle_order);
}

//按钮对应状态判断
$st = 1;
if($orderStatus == 5 || $orderStatus == 6 || $orderStatus == 7 || $orderStatus == 8){
    $st = 0;
}elseif($orderStatus == 2){
    $st = 1;
}elseif($orderStatus == 4){
    $st = 2;
}elseif($orderStatus == 3) {
    $st = 3;
}elseif($orderStatus == 1){
    $st = 4;
}
$rstatus = req('rstatus');
if($rstatus == '0000'){
    $st = 0;
}
$st = 1;
//?>