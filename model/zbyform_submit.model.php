<?
//$db->check_cookie($loginUrl, $host);
$token = substr($_COOKIE['5fe845d7c136951446ff6a80b8144467'], 1, -1);
//判断按人安份
$is_package = req('is_package');
//生成订单
$flag = req('flag');
if($flag == 'check'){
    $post['token'] = $token;
    $post['id'] = $realid;
    $post['lvProductId'] = req('lvProductId');
    $post['packageId'] = req('packageId');
    $post['departdate'] = req('departdate');
    $post['payPrice'] = req('payPrice');
    $post['bookerName'] = req('bookerName');
    $post['bookerMobile'] = req('bookerMobile');
    $post['bookerEmail'] = req('bookerEmail');
    $post['emergencyName'] = req('emergencyName');
    $post['emergencyMobile'] = req('emergencyMobile');
    $post['userType'] = req('userType');
    //游玩人数量判断  
    if(req('traveller_name')=='TRAV_NUM_ONE'){
        $num = 1;
    }elseif (req('traveller_name') == 'TRAV_NUM_ALL'){
        $num = req('adultNum')+req('childNum');
    }else{
        $num = 0;
    }
    //游玩人数组处理
    
    for($i=0;$i<$num;$i++){
        $travellerLis[$i]['name'] = req('name_'.$i);
        $travellerLis[$i]['enName'] = req('enName_'.$i);
        $travellerLis[$i]['personType'] = req('personType_'.$i);
        $travellerLis[$i]['mobile'] = req('mobile_'.$i);
        $travellerLis[$i]['email'] = req('email_'.$i);
        $travellerLis[$i]['credentials'] = req('credentials_'.$i);
        $travellerLis[$i]['credentialsType'] = 'ID_CARD';
        $travellerLis[$i]['gender'] = req('gender_'.$i);
        $travellerLis[$i]['birthday'] = req('birthday_'.$i);
        //去除空值
        $travellerLis[$i] = array_filter($travellerLis[$i]);
    }
    $post['travellerLis'] = $travellerLis;
    if(req('is_package') == 'true'){//按份卖
        $post['packageNum'] = req('packageNum');
     }else{//按人卖
        $post['adultNum'] = req('adultNum');
        $post['childNum'] = req('childNum');
        $post['roomCount'] = req('roomCount');
     }
     $post = array_filter($post);
     $dingdan = array_iconv(json_decode($db->api_post($host."/travel/interface/zbyV3.2/saveZbyOrderV_3.2",$post),true),'utf-8','gbk');
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

function get_product_detail()
{
    global $host;
    $post['token'] = substr($_COOKIE['5fe845d7c136951446ff6a80b8144467'],1,-1);
//    $post['token'] = '{"clienttoken":"7A4D2543F258FD7062F842ADD950496ADEADB75BEE76FFBD2B153AD5F2BFEE823863DA9C55A8BF58DEB73C9CCABC30326EC113721043ABA98B3EE1771A41993AA089FAEC25AFEE98F057BAFED0D7B2F1","clienttype":"1","devicetoken":"1","ordertoken":"1","wxcityid":"1"}';
//    $post['goodsId'] = '8000000';

    $product_detail = juhecurl($host . "/travel/interface/zby/getGoodsDtail", $post, 1);
    $product_detail = json_decode($product_detail, true);
    $product_detail = array_iconv($product_detail);
    return $product_detail;
}
$num = 2;
?>