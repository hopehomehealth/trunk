<?
$db->check_cookie($loginUrl, $host);
$flag = req('flag');
$token = substr($_COOKIE['5fe845d7c136951446ff6a80b8144467'], 1, -1);
if ($flag == '1') {
    // ��ȡ������
    $date = req('date');//����
    $unitPrice = req('danjias');//��Ʊ����
    $num = req('shuliangs');//��Ʊ����
    $totlePrice = $unitPrice * $num;//Ӧ�����
    $name = addslashes(htmlspecialchars($db->to_utf8(req('name'))));//����
    $phone = req('phone');//�ֻ���
    $email = req('email');//����
    $idcard = req('idcard');//���֤��
    $code = req('code');//��֤��
    $scode = $_SESSION['scode'];//session�е���֤��
    $lvGoodsName = req('lvGoodsName');//¿������Ʒ����
    $lvGoodsName = $db->to_utf8($lvGoodsName);
    $ticketType = req('ticketType');//��Ʊ����
    $goodsId = req('goodsId');//��ƷID
    $lvProductId = req('lvProductId');//¿�����ƷID
    $lvGoodsId = req('lvGoodsId');//¿������ƷID
    $ways = $db->to_utf8($_SESSION['ways']);//��԰��ʽ
    //��Ʊ�¶���
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
    //��������ҳ�������Ĳ���
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
    //��������ҳ�������Ĳ���
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


// ����֧���ӿڻ�ȡ֧������id
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