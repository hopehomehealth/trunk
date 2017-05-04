<?
include('../config.php');
header("Content-type:text/html;charset=gbk");
function to_gbk($str){
    return mb_convert_encoding($str, 'gbk', 'utf-8');
}
$post = array();
$post['lvProductId'] = $_POST['productId'];
$post['departDate'] = $_POST['departDate'];
$url = $host. "/travel/interface/zby/v3.2/getZbyPackageByGoodsId_v3.2";
$data = $db->api_post($url, $post);
$arr = json_decode($data, true);
$datas = $arr['data'];
//echo var_dump($data);

echo "<ul class=\"byPart_title\">
    <li class=\"product_name\">套餐名称</li>
    <li class=\"hotel_contain\">包含酒店</li>
    <li class=\"ticket_contain\">包含门票</li>
    <li class=\"product_mounts\">库存</li>
    <li class=\"product_price\">价格</li>
    <li class=\"product_select\">选择</li>
</ul>";

foreach ($datas['list'] as $key => $val) {
    $packageId = to_gbk($val['packageId']);//套餐ID
    $packageName = to_gbk($val['packageName']);//套餐名
    $packageNames = to_gbk($db->jiequ(9,$val['packageName']));
    if( !is_null($val['hotelList']) ){
        $hotelName = to_gbk($val['hotelList']['0']['hotelName']);//酒店名
        $hotelNames = $db->jiequ(10,$hotelName);
        $hotelInfo = to_gbk($val['hotelList']['0']['hotelInfo']);//酒店简介
    } else {
        $hotelNames = '当前套餐无酒店';
    }
    if( !is_null($val['hotelList']) ) {
        $ticketName = to_gbk($val['ticketList']['0']['ticketName']);//门票名
        $ticketNames = $db->jiequ(10, $ticketName);
        $ticketInfo = to_gbk($val['ticketList']['0']['ticketInfo']);//门票简介
    } else {
        $ticketNames = '当前套餐无门票';
    }
    $lvStock = to_gbk($val['skuList']['0']['lvStock']);//库存
    $changeRuler = to_gbk($val['skuList']['0']['changeRuler']);//退改规则
    $adultPrice = to_gbk($val['skuList']['0']['adultPrice']);
    $kidPrice = to_gbk($val['skuList']['0']['kidPrice']);
    $adultNum = to_gbk($val['adultNum']);
    $kidNum = to_gbk($val['childNum']);
    $isPackage = to_gbk($val['isPackage']);//true是按份
    $min = to_gbk($val['min']);
    $max = to_gbk($val['max']);
    $roomMax = to_gbk($val['roomMax']);//最大房间数
    //判断按人还是按份，计算价格
    if ($isPackage == 'true') {
        $price = $adultPrice * $adultNum + $kidPrice * $kidNum;
    } else {
        $price = $adultPrice;
        $diffPrice = to_gbk($val['skuList']['0']['diffPrice']);
    }
    //判断库存
    if ($lvStock == '-1') {
        $lvStock = '暂缺';
    } else {
        $lvStock = '充足';
    }
    echo "<div class=\"byPart_cont\">
        <ul>
            <li class=\"product_name1\"><a title='$packageName'>$packageNames</a></li>
            <li class=\"hotel_contain1\"><a title='$hotelInfo'>$hotelNames</a></li>
            <li class=\"ticket_contain1\"><a title='$ticketInfo'>$ticketNames</a></li>
            <li class=\"product_mounts1\">$lvStock</li>";
            if($isPackage == 'false'){
                echo "<li class=\"product_price1\">成人：<b>&yen;$adultPrice</b><br>儿童：<b>&yen;$kidPrice</b></li>";
            }else{
                echo "<li class=\"product_price1\"><b>&yen;$price</b>/份</li>";
            }
            echo "<li class=\"product_select1\">
                <span></span>
                <input type='hidden' name='packageId' value='$packageId'>
                <input type='hidden' name='isPackage' value='$isPackage'>
                <input type='hidden' name='min' value='$min'>
                <input type='hidden' name='max' value='$max'>
                <input type='hidden' name='roomMax' value='$roomMax'>
                <input type='hidden' name='adultPrice' value='$adultPrice'>
                <input type='hidden' name='kidPrice' value='$kidPrice'>
                <input type='hidden' name='adultNum' value='$adultNum'>
                <input type='hidden' name='kidNum' value='$kidNum'>
                <input type='hidden' name='diffPrice' value='$diffPrice'>
            </li>
        </ul>
        <div class=\"hide_content\">
            <i></i>
        </div>
       <div class=\"product_name_tips\">
            $packageName<i></i>
        </div>
        <div class=\"ticket_contain_tips\">
            $ticketInfo<i></i>
        </div>
        <div class=\"change_rule_tips\">
            $changeRuler<i></i>
        </div>
       <div class=\"fcj_box\">
                 <div class=\"change_rule\">退改规则</div>
";
    if ($isPackage == 'false') {
        echo "<div class=\"fangchajia\">
                </div>";
    }
    echo "
 </div>
    </div>";
}

//echo "<div class=\"feiyongshuoming\">
//    <h3>费用说明</h3>
//    <ul>
//        <li>【住】扬州杨鹏大酒店客房1间1晚（自选房型）</li>
//        <li>【吃】入住次日清晨酒店自助早餐2份（身高≥1.2米的儿童早餐按成人标准58元/份收费）</li>
//        <li>【游】景点门票4选1【瘦西湖风景区/瘦西湖温泉/何园/个园/大明寺景区】（敬请下单时自行选择确定具体景点名称、游玩时间及游玩人数）</li>
//        <li>&nbsp;&nbsp;即日起至2017.12.31日，凡此期间入住客人均可享受5楼湖苑餐厅零点餐饮9折优惠（海鲜、特价菜、酒水除外）</li>
//    </ul>
//    <dl>
//        <dt>温馨提示:</dt>
//        <dd>1.套餐内容及出行人数可按需调整</dd>
//        <dd>2.套餐总价会根据内容和出行日期变化</dd>
//        <dd>3.礼包赠送与否及所赠内容由您入住日期和房型决定</dd>
//    </dl>
//</div>";
?>

