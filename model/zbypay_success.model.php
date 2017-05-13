<?
$db->check_cookie($loginUrl, $host);
$post['token'] = substr($_COOKIE['5fe845d7c136951446ff6a80b8144467'],1,-1);
$post['orderCode'] = req('orderCode');
$pay_success = juhecurl($host . "/travel/interface/zby/v3.2/getZbyOrderDtail_v3.2", $post, 1);
$pay_success = json_decode($pay_success, true);
$pay_success = array_iconv($pay_success);
//var_dump($pay_success);
if ($pay_success['status'] != '0000'){
    exit($pay_success['msg']);
}
$pay_success_data = $pay_success['data'];

$payPrice = $pay_success_data['payPrice'];
$goodsName = $pay_success_data['goodsName'];
$payTime = $pay_success_data['leftPayTime'];
$lvGoodsName = $pay_success_data['lvGoodsName'];
$orderCode = $pay_success_data['orderCode'];

?>