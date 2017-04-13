<?
//$db->check_cookie();
$dat['orderCode'] = $_GET['orderCode'];
$dat['token'] =  str_replace('#','%23',$_COOKIE['5fe845d7c136951446ff6a80b8144467']);
$dat['token'] = trim($dat['token'],'"');
$post['token'] = substr($_COOKIE['5fe845d7c136951446ff6a80b8144467'],1,-1);
//var_dump($_REQUEST);
//申请退款
$orderCode = req('orderCode');
$refundReasonCode = req('refundReasonCode');

//$post['token'] = $_COOKIE['5fe845d7c136951446ff6a80b8144467'];
$dat['orderCode'] = req('orderCode');
//退款原因

function get_refund_season()
{
    global $host;


    $refund_season = juhecurl($host . "/travel/interface/menpiao/refundReasons", false, 0);
//    $refund_season = $db->api_post($host."/travel/interface/menpiao/refundReasons", $post, true);

    $refund_season = json_decode($refund_season, true);
    $refund_season = array_iconv($refund_season, 'UTF-8', 'GBK');
    return $refund_season;
}

//检验产品
//$cookie = $_COOKIE['5fe845d7c136951446ff6a80b8144467'];
//function get_refund_info($orderCode,$cookie)
//{
//    global $host;
    $post['orderCode'] = $orderCode;

    $refund_product = $db->api_post($host."/travel/interface/menpiao/ticketRefundInfo", $post);
    $refund_product = json_decode($refund_product, true);
    $refund_product = array_iconv($refund_product, 'UTF-8', 'GBK');
//    return $refund_product;
//}



$refund_season = get_refund_season();
//$refund_product = get_refund_info($orderCode,$cookie);


$refund_reason_data = $refund_season['data'];
$refund_product_data = $refund_product['data'];




$nowUrl = $db->getUrl();
if(strstr($nowUrl,'?')){
	$flag = '&flag=qx';

}else{
	$flag = '?flag=qx';
}
if(strstr($nowUrl,'?')){
    $flagc = '&flag=cf';
}else{
    $flagc = '?flag=cf';
}
if(strstr($nowUrl,'?')){
    $flagr = '&flag=rf';
}else{
    $flagr = '?flag=rf';
}

$aurl = str_replace($flag, '', $nowUrl);//取消
$burl = str_replace($flagc, '', $nowUrl);//重发
$curl = str_replace($flagr, '', $nowUrl);//退款

//取消订单
if($_GET['flag']=='qx'){
    $res = json_decode($db->api_post($host."/travel/interface/order/cancleUserOrder",$dat),true);
}
//重发凭证
if($_GET['flag']=='cf'){
	$msg = json_decode($db->api_post($host."/travel/interface/retransmissionCertificate",$dat),true);
}

$abc = req('flag');

//退款
if($abc == 'rf'){
    $postt['token'] = substr($_COOKIE['5fe845d7c136951446ff6a80b8144467'],1,-1);
    $postt['orderCode'] = $orderCode;
    $postt['refundReasonCode'] = $refundReasonCode;

    $require_refund = $db->api_post($host."/travel/interface/menpiao/refundTicket", $postt);
    $require_refund = json_decode($require_refund, true);
    $require_refund = array_iconv($require_refund, 'UTF-8', 'GBK');
    $require_refund_data = $require_refund['data'];
}


//门票订单详情

$data = json_decode($db->api_post($host."/travel/interface/menpiao/getTickectOrderDetail",$dat),true);

$data = array_iconv($data);
$pay_detail = $data['data'];
$orderTicketItem = $pay_detail['orderTicketItem'];
$totalFee = $pay_detail['totalFee'];
$orderInfoExceptTicket = $pay_detail['orderInfoExceptTicket'];
$orderStatus = $orderInfoExceptTicket['orderStatus'];
$credenceStatus = $orderInfoExceptTicket['credenceStatus'];
$touristList = $pay_detail['touristList'];//游玩人列表
$paymentType = $orderInfoExceptTicket['paymentType'];//支付方式

$ur = $host . "/travel/interface/menpiao/getTicketProductDetail";
$da = array();
$da['lvProductId'] = $orderInfoExceptTicket['productId'];
$da['scenicId'] = $orderInfoExceptTicket['scenicId'];
$rst = $db->api_post($ur, $da);//echo $da['scenicId'];
$arr = json_decode($rst, true);
$obj = $arr['data'];
$list = $obj['ticketMapList']['0']['ticketList']['0'];//var_dump($obj['ticketMapList']);die;
$jingdian = $obj['scenicSpotList'];


if($orderStatus == 5 || $orderStatus == 6 || $orderStatus == 7 || $orderStatus == 8){
	$st = 0;
}elseif($credenceStatus == 'CREDENCE_SEND' && $orderStatus == 2){
	$st = 1;
}elseif($orderStatus == 1){
	$st = 2;
}elseif($credenceStatus == 'CREDENCE_NO_SEND' && $orderStatus == 2) {
	$st = 3;
}elseif($credenceStatus == 'USED' && $orderStatus == 2){
	$st = 4;
}
$rstatus = req('rstatus');
if($rstatus == '0000'){
    $st = 0;
}
