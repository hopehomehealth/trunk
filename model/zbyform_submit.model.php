<?

if($_GET['flage']==1){
    $getUrl = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $url_canshu = str_replace('?', '',substr($getUrl,stripos($getUrl, '?')));
    $url_canshu = $g_self_domain.'/zhoubianyou/zbyform_submit-2.html?'.$db->encrypt($url_canshu);
    header("location: $url_canshu");
}
if($_GET['flage']==2){
    $getUrl = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $url_canshu = str_replace('?', '',substr($getUrl,stripos($getUrl, '?'))) ;
    $url_canshu = $db->decrypt($url_canshu);
    parse_str($url_canshu);
    $url_form = str_replace('?', '',substr($getUrl,stripos($getUrl, '?')));

}
$db->check_cookie($loginUrl, $host);
//截取
function jiequ($num,$data){
    if(mb_strlen($data,'gbk')>$num){
        return mb_substr($data, 0, $num,'gbk').'...';
    }else{
        return $data;
    }

} 

//
//获取套餐信息
$tc['lvProductId'] = $lvProductId;
$tc['packageId'] = $packageId;
$tc['departDate'] = $departDate;

$api_url = $host.'/travel/interface/zby/v3.2/getZbyPackageList_v3.2?lvProductId='.$tc['lvProductId'].'&packageId='.$tc['packageId'].'&departDate='.$tc['departDate'];

$tcs = array_iconv(json_decode(juhecurl("$api_url", false, 0),true),'utf-8','gbk');
//设置变量
$taocan = $tcs['data'][0];
$token = substr($_COOKIE['5fe845d7c136951446ff6a80b8144467'], 1, -1);
//判断按人安份
$is_package = $taocan['isPackage'];
$diffPrice = $taocan['diffPrice'];
//$packageNum = req('packageNum');
$onePrice = $taocan['adultNum']*$taocan['adultPrice'];
//$roomPrice = req('roomPrice');
//var_dump($tcs);echo '<br>'; 
//订单接口参数
$post['token'] = $token;
$post['goodsId'] = $taocan['goodsId'];//'8017691';//
$post['lvProductId'] = $taocan['lvProductId'];//'9999999';//
$post['packageId'] = $tc['packageId'];//'6666666';//
$post['departdate'] = $tc['departDate'];//'2017-05-31';
/*$post['payPrice'] = req('payPrice');//'150';//
$post['adultNum'] = req('adultNum');//'1';//
$post['kidNum'] = req('childNum');//'1';//*/
if($taocan['isPackage'] == 'true'){//按份卖
    $post['packageNum'] = $packageNum;//'3';//
    //$packageNum =req('packageNum');
}else{//按人卖
    
    $post['roomCount'] = $roomCount;//'0';//
    //$roomCount = req('roomCount');
}
//游玩人数量判断  
if($taocan['travellerName']=='TRAV_NUM_ONE'){
    $num = 1;
}elseif ($taocan['travellerName'] == 'TRAV_NUM_ALL' && $is_package=='false'){
    $num = ($adultNum+$childNum);
}elseif($taocan['travellerName'] == 'TRAV_NUM_ALL' && $is_package=='true'){
    $num = ($taocan['adultNum']+$taocan['childNum'])*$packageNum;
}else{
    $num = 0;
}
$payPrice1 = $payPrice;
//$adultNum = $adultNum;
$kidNum = $childNum;
//生成订单
$flag = req('flag');
if($flag == 'check'){

    if($taocan['isPackage'] == 'true'){//按份卖
        $post['packageNum'] = $_POST['packageNum'];//'3';//
    }else{//按人卖
        
        $post['roomCount'] = $POST['roomCount'];//'0';//
    }
    $post['payPrice'] = $_POST['payPrice'];//'150';//
    $payPrice1 = $_POST['payPrice'];
    $post['adultNum'] = $_POST['adultNum'];//'1';//
    $adultNum = $_POST['adultNum'];
    $post['kidNum'] = $_POST['childNum'];//'1';//
    $kidNum = $_POST['childNum'];
    $packageNum = $_POST['packageNum'];
    $post['roomCount'] = req('roomCount');
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
     //var_dump($post);die;
     //
     $dingdan = array_iconv(json_decode($db->api_post("$host/travel/interface/zbyV3.2/saveZbyOrder",$post),true),'utf-8','gbk');
     $orderCode = $dingdan['data']['orderCode'];
     if(!empty($orderCode)){
        $goodsName = $dingdan['data']['goodsName'];
         $payTime = $dingdan['data']['payTime'];
         $departdate = $dingdan['data']['departdate'];
         $payPrice = $dingdan['data']['payPrice'];
         $peopleNum = $dingdan['data']['peopleNum'];
         $unitPrice = $dingdan['data']['unitPrice'];
         $lvGoodsName = $dingdan['data']['lvGoodsName'];
     }
     

    
}
if($taocan['isPackage'] == 'false'){
//请求/travel/interface/zby/v3.2/getNumberSelection_v3.2获取roomMax
$xuan['goodsId'] = $taocan['goodsId'];
$xuan['packageId'] = $tc['packageId'];
$xuan['departDate'] = $tc['departDate'];
$xuan['isPackage'] = $taocan['isPackage'];
$xuan['min'] = $taocan['min'];
$xuan['max'] = $taocan['max'];
$xuangou = $host . "/travel/interface/zby/v3.2/getNumberSelection_v3.2";
$xuangou = $db->api_post($xuangou, $xuan);
$xuangou = json_decode($xuangou, true);
$datass = $xuangou['data'];
$adultmin = $datass['0'];
$adultmax = $datass['1'];
$roomMax = $taocan['roomMax'];

//ajax请求/travel/interface/zby/v3.2/getDiffRoomNum_v3.2获取房差数量集合


$fang['adultNum'] = $adultNum;
$fang['roomMax'] = $roomMax;
$fang['goodsType'] = $goodsType;
$fang['isPackage'] = $is_package;
$diffPrice = $roomPrice;
$url = $host . "/travel/interface/zby/v3.2/getDiffRoomNum_v3.2";
$data = $db->api_post($url, $fang);
$arr = json_decode($data, true);
$fangcha = $arr['data'];
}
if($taocan['travellerName']=='TRAV_NUM_ONE'||$taocan['travellerName']=='TRAV_NUM_NO'){
    $jiahao = 1;
}
if($_GET['check']=='check'){
    $jiahao = '';
}
?>