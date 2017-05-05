<?

$db->check_cookie($loginUrl, $host);
//截取
function jiequ($num,$data){
    if(mb_strlen($data,'gbk')>$num){
        return mb_substr($data, 0, $num,'gbk').'...';
    }else{
        return $data;
    }

}

$getUrl = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//获取套餐信息
$tc['lvProductId'] = req('lvProductId');
$tc['packageId'] = req('packageId');
$tc['departDate'] = req('departDate');

$api_url = $host.'/travel/interface/zby/v3.2/getZbyPackageList_v3.2?lvProductId='.$tc['lvProductId'].'&packageId='.$tc['packageId'].'&departDate='.$tc['departDate'];

$tcs = array_iconv(json_decode(juhecurl("$api_url", false, 0),true),'utf-8','gbk');
//设置变量
$taocan = $tcs['data'][0];
$token = substr($_COOKIE['5fe845d7c136951446ff6a80b8144467'], 1, -1);
//判断按人安份
$is_package = $taocan['isPackage'];
//var_dump($tcs);echo '<br>'; 
//订单接口参数
$post['token'] = $token;
$post['goodsId'] = $taocan['goodsId'];//'8017691';//
$post['lvProductId'] = $taocan['lvProductId'];//'9999999';//
$post['packageId'] = $tc['packageId'];//'6666666';//
$post['departdate'] = $tc['departDate'];//'2017-05-31';
$post['payPrice'] = str_replace("￥","",req('payPrice')) ;//'150';//
$post['adultNum'] = $_GET['adultNum'];//'1';//
$post['kidNum'] = $_GET['childNum'];//'1';//
if($taocan['isPackage'] == 'true'){//按份卖
    $post['packageNum'] = req('packageNum');//'3';//

}else{//按人卖
    
    $post['roomCount'] = req('roomCount');//'0';//

}


//游玩人数量判断  
if($taocan['travellerName']=='TRAV_NUM_ONE'){
    $num = 1;
}elseif ($taocan['travellerName'] == 'TRAV_NUM_ALL'){
    $num = $post['adultNum']+$post['kidNum'];
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
        $travellerList[$i]['ename'] = gbk_to_utf8(req('eName_'.$i));
        $travellerList[$i]['personType'] = gbk_to_utf8(req('personType_'.$i));
        $travellerList[$i]['mobile'] = req('mobile_'.$i);
        $travellerList[$i]['email'] = req('email_'.$i);
        $travellerList[$i]['credentials'] = req('credentials_'.$i);
        $travellerList[$i]['credentialsType'] = 'ID_CARD';
        $travellerList[$i]['gender'] = req('gender_'.$i);
        $travellerList[$i]['birthday'] = req('birthday_'.$i);
        //var_dump($travellerList[$i]);
        //去除空值
        
    }
    $post['travellerList'] = json_encode($travellerList);

     //测试 先传空
     //var_dump($post);
     $dingdan = array_iconv(json_decode($db->api_post("$host/travel/interface/zbyV3.2/saveZbyOrder",$post),true),'utf-8','gbk');
     $orderCode = $dingdan['data']['orderCode'];
     $goodsName = $dingdan['data']['goodsName'];
     $payTime = $dingdan['data']['payTime'];
     $departdate = $dingdan['data']['departdate'];
     $payPrice = $dingdan['data']['payPrice'];
     $peopleNum = $dingdan['data']['peopleNum'];
     $unitPrice = $dingdan['data']['unitPrice'];
     $lvGoodsName = $dingdan['data']['lvGoodsName'];
    
}
//请求/travel/interface/zby/v3.2/getNumberSelection_v3.2获取roomMax

//$xuangou = json_decode($db->api_post("$host/travel/interface/zbyV3.2/saveZbyOrder",$xuan),true);
//ajax请求/travel/interface/zby/v3.2/getDiffRoomNum_v3.2获取房差数量集合


?>