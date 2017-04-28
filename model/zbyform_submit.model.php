<?
/*if(req('flag') == 1){
    $canshu = $db->base64url_encode($_SERVER['QUERY_STRING']);
    $dizhi = $_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
    $wangzhi = $dizhi.$canshu;




    header("location: http://$wangzhi");
}
$canshu = */
$db->check_cookie($loginUrl, $host);
$getUrl = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//获取套餐信息
$tc['lvProductId'] = req('lvProductId');
$tc['packageId'] = req('packageId');
$tc['departDate'] = req('departDate');
//var_dump($tc);
$api_url = $host.'/travel/interface/zby/v3.2/getZbyPackageList_v3.2?lvProductId='.$tc['lvProductId'].'&packageId='.$tc['packageId'].'&departDate='.$tc['departDate'];

$tcs = array_iconv(json_decode(juhecurl("$api_url", false, 0),true),'utf-8','gbk');
//设置变量
$taocan = $tcs['data'][0];
$token = substr($_COOKIE['5fe845d7c136951446ff6a80b8144467'], 1, -1);
//判断按人安份
$is_package = $taocan['isPackage'];
//var_dump($tcs);echo '<br>'; 
//订单接口参数
$post['token'] = $token;//"{\"token1\":\"34d996bc-bc3f-4ed5-8020-868a68398352%2315122991536%23%25E5%2585%259A%25E5%25A6%25B9%25E5%25AD%2590%2376061060000000341\",\"token2\":\"2C8EBC684DBE4F930096E68FE24F8550F53F78A0E79634E0F6668F99659D83BB449A51AF37EADCA8D775097E26A6A13958D3B455DF850CFE35567C783187C0EE7A4D04972B0B38E271997D96941AD1A8\"}";
$post['goodsId'] = $taocan['goodsId'];//'8017691';//
$post['lvProductId'] = $taocan['lvProductId'];//'9999999';//
$post['packageId'] = $tc['packageId'];//'6666666';//
$post['departdate'] = $tc['departDate'];//'2017-05-31';
$post['payPrice'] = str_replace("￥","",req('payPrice')) ;//'150';//
if($taocan['isPackage'] == 'true'){//按份卖
    $post['packageNum'] = req('packageNum');//'3';//
}else{//按人卖
    $post['adultNum'] = req('adultNum');//'1';//
    $post['childNum'] = req('childNum');//'1';//
    $post['roomCount'] = req('roomCount');//'0';//
}
//游玩人数量判断  
if($taocan['travellerName']=='TRAV_NUM_ONE'){
    $num = 1;
}elseif ($taocan['travellerName'] == 'TRAV_NUM_ALL'){
    $num = $post['adultNum']+$post['childNum'];
}else{
    $num = 0;
}

//生成订单
$flag = req('flag');
if($flag == 'check'){
    $post['bookerName'] = gbk_to_utf8(req('bookerName'));
    $post['bookerMobile'] = req('bookerMobile');
    $post['bookerEmail'] = req('bookerEmail');
    $post['emergencyName'] = gbk_to_utf8(req('emergencyName'));
    $post['emergencyMobile'] = req('emergencyMobile');
    //游玩人数组处理
    
    for($i=0;$i<$num;$i++){
        $travellerList[$i]['name'] = gbk_to_utf8(req('name_'.$i));
        $travellerList[$i]['eName'] = gbk_to_utf8(req('eName_'.$i));
        $travellerList[$i]['personType'] = gbk_to_utf8(req('personType_'.$i));
        $travellerList[$i]['mobile'] = req('mobile_'.$i);
        $travellerList[$i]['email'] = req('email_'.$i);
        $travellerList[$i]['credentials'] = req('credentials_'.$i);
        $travellerList[$i]['credentialsType'] = 'ID_CARD';
        $travellerList[$i]['gender'] = req('gender_'.$i);
        $travellerList[$i]['birthday'] = req('birthday_'.$i);
        //去除空值
        $travellerList[$i] = array_filter($travellerList[$i]);
    }
    $post['travellerList'] = json_encode($travellerList);
    
     $post = array_filter($post);
     //测试 先传空
     $post['travellerList'] = '';
     $dingdan = array_iconv(json_decode($db->api_post("192.168.3.177/travel/interface/zbyV3.2/saveZbyOrder",$post),true),'utf-8','gbk');
     $orderCode = $dingdan['data']['orderCode'];
     $goodsName = $dingdan['data']['goodsName'];
     $payTime = $dingdan['data']['payTime'];
     $departdate = $dingdan['data']['departdate'];
     $payPrice = $dingdan['data']['payPrice'];
     $peopleNum = $dingdan['data']['peopleNum'];
     $unitPrice = $dingdan['data']['unitPrice'];
     $lvGoodsName = $dingdan['data']['lvGoodsName'];

}





/*//校验订单


if($flag == 'check'){
    $check_form = juhecurl($host . "/travel/interface/order/saveZbyOrder", $post, 1);
    $check_form = json_decode($check_form, true);

    $check_form = array_iconv($check_form, 'UTF-8', 'GBK');
//    var_dump($check_form);die;
    $check_form_data = $check_form['data'];
    $errormsg = $check_form['msg'];
    if ($check_form['status'] != '0000'){
        echo "<script>alert('$errormsg');</script>";
        exit();
    }

    $goodsName = $check_form_data['goodsName'];
    $payPrice = $check_form_data['payPrice'];
    $orderCode = $check_form_data['orderCode'];
    $payTime = $check_form_data['payTime'];
//    var_dump($check_form_data);
//    $js = "<script>window.location.href='/zhoubianyou/zbyonline_pay-".$goodsName."-".$payPrice."-".$orderCode.".html?time=$payTime'; </script>";
//    echo $js;

}*/

/*function get_product_detail()
{
    global $host;
    $post['token'] = substr($_COOKIE['5fe845d7c136951446ff6a80b8144467'],1,-1);
//    $post['token'] = '{"clienttoken":"7A4D2543F258FD7062F842ADD950496ADEADB75BEE76FFBD2B153AD5F2BFEE823863DA9C55A8BF58DEB73C9CCABC30326EC113721043ABA98B3EE1771A41993AA089FAEC25AFEE98F057BAFED0D7B2F1","clienttype":"1","devicetoken":"1","ordertoken":"1","wxcityid":"1"}';
//    $post['goodsId'] = '8000000';

    $product_detail = juhecurl($host . "/travel/interface/zby/getGoodsDtail", $post, 1);
    $product_detail = json_decode($product_detail, true);
    $product_detail = array_iconv($product_detail);
    return $product_detail;
}*/
?>