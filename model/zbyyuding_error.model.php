<?
//include '/config/config.php';
$db->check_cookie($loginUrl, $host);
$post['token'] = substr($_COOKIE['5fe845d7c136951446ff6a80b8144467'],1,-1);
$post['orderCode'] = req('orderCode');
//echo $post['orderCode'];
$pay_fail = juhecurl($host . "/travel/interface/zby/v3.2/getZbyOrderDtail_v3.2", $post, 1);
$pay_fail = json_decode($pay_fail, true);
$pay_fail = array_iconv($pay_fail);
//var_dump($pay_success);
if ($pay_fail['status'] != '0000'){
    exit($pay_fail['msg']);
}
$pay_fail_data = $pay_fail['data'];
//echo "<pre>";
//var_dump($pay_fail_data);
$payPrice = $pay_fail_data['payPrice'];
$goodsName = $pay_fail_data['goodsName'];
$payTime = $pay_fail_data['leftPayTime'];
$lvGoodsName = $pay_fail_data['lvGoodsName'];
$orderCode = $pay_fail_data['orderCode'];
$departdate = $pay_fail_data['playDate'];

?>