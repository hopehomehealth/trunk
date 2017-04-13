<?
$db->check_cookie($loginUrl, $host);
$flag = req('flag');
$token = substr($_COOKIE['5fe845d7c136951446ff6a80b8144467'], 1, -1);
if ($flag == '1') {
    // 获取表单数据
    $date = req('date');//日期
    $unitPrice = req('danjias');//门票单价
    $num = req('shuliangs');//门票数量
    $totlePrice = $unitPrice * $num;//应付金额
    $name = addslashes(htmlspecialchars($db->to_utf8(req('name'))));//姓名
    $phone = req('phone');//手机号
    $email = req('email');//邮箱
    $idcard = req('idcard');//身份证号
    $code = req('code');//验证码
    $scode = $_SESSION['scode'];//session中的验证码
    $lvGoodsName = req('lvGoodsName');//驴妈妈商品名称
    $lvGoodsName = $db->to_utf8($lvGoodsName);
    $ticketType = req('ticketType');//门票类型
    $goodsId = req('goodsId');//产品ID
    $lvProductId = req('lvProductId');//驴妈妈产品ID
    $lvGoodsId = req('lvGoodsId');//驴妈妈商品ID
    $ways = $db->to_utf8($_SESSION['ways']);//入园方式
    //门票下订单
    $urla =  $host . "/travel/interface/order/saveTicketOrder";
    $ticketList = '[{"goodsId":"' . $lvGoodsId . '","num":"' . $num . '","totlePrice":"' . $totlePrice . '","ticketType":"' . $ticketType . '","unitPrice":"' . $unitPrice . '","goodsName":"' . $lvGoodsName . '"}]';
    $travellerList = '[{"credentials":"' . $idcard . '","credentialsType":"ID_CARD","email":"' . $email . '","mobile":"' . $phone . '","name":"' . $name . '","personType":""}]';
    $dataa = array('goodsId' => $goodsId, 'userId' => '', 'token' => $token, 'lvProductId' => $lvProductId, 'ticketList' => $ticketList, 'departdate' => $date, 'payPrice' => $totlePrice, 'travellerList' => $travellerList, 'userType' => '0');
    $rsta = $db->api_post($urla, $dataa);
    $arra = json_decode($rsta, true);
    $datas = $arra['data'];
    $info = $db->to_gbk($arra['msg']);
    if ($arra['status'] != '0000'){
        echo "<script>alert('$info');history.go(-1)</script>";
    }
    $_SESSION['orderCode'] = $datas['orderCode'] ;
    $orderCode = $datas['orderCode'];
    $_SESSION['payPrice'] = $datas['payPrice'];
    $payPrice = $datas['payPrice'];
    $payTime = $datas['payTime'];
    $goodsName  = $datas['goodsName'];
} else if ($flag == '3'){
    //订单详情页传过来的参数
    $lvGoodsName = $db->to_utf8($_POST['lvGoodsName']);
    $goodsName = $db->to_utf8($_POST['goodsName']);
    $payPrice = req('payPrice');
    $orderCode = req('orderCode');
    $payTime = req('payTime');
    $jishi = ceil($payTime/60000);
    if ($orderCode != '') {
        $_SESSION['orderCode'] = $orderCode;
    }
    if ($payPrice != '') {
        $_SESSION['payPrice'] = $payPrice;
    }
}else{
    //订单详情页传过来的参数
    $lvGoodsName = $_POST['lvGoodsName'];
    $goodsName = $_POST['goodsName'];
    $payPrice = req('payPrice');
    $orderCode = req('orderCode');
    $payTime = req('payTime');
    $jishi = ceil($payTime/60000);
    if ($orderCode != '') {
        $_SESSION['orderCode'] = $orderCode;
    }
    if ($payPrice != '') {
        $_SESSION['payPrice'] = $payPrice;
    }
}


// 调用支付接口获取支付网关id
$trans['token'] = $token;
$url =  $host . "/travel/interface/pay/getPayWays";
$brr = $db->api_post($url, $trans);
$brra = json_decode($brr, true);
$zhifu = $brra['data'];



function seo()
{
    global $g_sitename, $c_goods;
    ?>
    <meta name="keywords" content="<?= $c_goods['goods_name'] ?>"/>
    <meta name="description"
          content="<?= $c_goods['goods_name'] ?> <?= str_replace("\n", "", removehtml($c_goods['summary'])) ?> "/>
    <?
}

?>