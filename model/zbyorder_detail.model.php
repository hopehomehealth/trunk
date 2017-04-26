<?
$db->check_cookie($loginUrl, $host);
$orderCode = req('orderCode');
//退款产品信息检验
$post['orderCode'] = $orderCode;
$post['token'] = substr($_COOKIE['5fe845d7c136951446ff6a80b8144467'],1,-1);
$refund_product = juhecurl($host."/travel/interface/zby/zbyRefundInfo",$post, 1);
$refund_product = json_decode($refund_product, true);
$refund_product = array_iconv($refund_product);
$refund_product_data = $refund_product['data'];
$isChange = $refund_product_data['isChange'];

//确认会团
if(req('flag') == 'cf'){
    $confirm_return = juhecurl($host."/travel/interface/zby/confirmBackGroup",$post, 1);
    $confirm_return = json_decode($confirm_return, true);
    $confirm_return = array_iconv($confirm_return);
    $confirm_return_data = $confirm_return['data'];
}

//订单详情展示
function get_order_detail()
{
    global $host;
    $post['orderCode'] = req('orderCode');
    $post['token'] = substr($_COOKIE['5fe845d7c136951446ff6a80b8144467'],1,-1);
    $order_detail = juhecurl($host . "/travel/interface/zby/v3.2/getZbyOrderDtail_v3.2", $post, 1);
    $order_detail = json_decode($order_detail, true);
    $order_detail = array_iconv($order_detail);
//    if ($order_detail['status'] != '0000') {
//        exit('订单失败');
//    }
    return $order_detail;
}



$order_detail = get_order_detail();
$order_detail_data = $order_detail['data'];
$orderStatus = $order_detail_data['orderStatus'];
//取消订单
if($_GET['flag'] == 'cn'){
    $cancle_order = juhecurl($host."/travel/interface/order/cancleUserOrder",$post, 1);
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
//$st = 4;
//?>