<?
$db->check_cookie($loginUrl, $host);
$flag = req('flag');
$payPrice = req('payPrice');
$orderCode = req('orderCode');
$payTime = req('payTime');
$departdate = req('departdate');
if($flag == '1') {
    $goodsName = req('goodsName');
    $lvGoodsName = req('lvGoodsName');
}else if($flag == '2'){
    $goodsName = utf8_to_gbk(req('goodsName'));
    $lvGoodsName = utf8_to_gbk(req('lvGoodsName'));
}
//echo $payTime;
$trans['token'] = substr($_COOKIE['5fe845d7c136951446ff6a80b8144467'],1,-1);
$pay_way = juhecurl($host . "/travel/interface/pay/getPayWays", $trans, 1);
$pay_way = json_decode($pay_way, true);
$pay_way = array_iconv($pay_way, 'UTF-8', 'GBK');
//    var_dump($pay_way);
if ($pay_way['status'] != '0000'){
    exit($pay_way['msg']);
}
$pay_way_data = $pay_way['data'];
?>