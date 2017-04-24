<?
include('config.php');
header("Content-type:text/html;charset=gbk");
function to_gbk($str){
    return mb_convert_encoding($str, 'gbk', 'utf-8');
}
$post = array();
$post['goodsId'] = $_POST['goodsId'];
$post['departDate'] = $_POST['departDate'];
$url = "wwwd.bus365.cn" . "/travel/interface/zbyV3.2/getZbyPackageByGoodsIdV_3.2";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$data = curl_exec($ch);
curl_close($ch);
$arr = json_decode($data, true);
$datas = $arr['data'];

echo "<ul class=\"byPart_title\">
    <li class=\"product_name\">套餐名称</li>
    <li class=\"hotel_contain\">包含酒店</li>
    <li class=\"ticket_contain\">包含门票</li>
    <li class=\"product_mounts\">库存</li>
    <li class=\"product_price\">价格</li>
    <li class=\"product_select\">选择</li>
</ul>";

foreach ($datas['list'] as $val) {
    $packageId =to_gbk($val['packageId']);
    $packageName =to_gbk($val['packageName']);
    $hotelName =to_gbk($val['hotelList']['0']['hotelName']);
    $ticketName =to_gbk($val['ticketList']['0']['ticketName']);
    $lvStock =to_gbk($val['skuList']['0']['lvStock']);
    $adultPrice =to_gbk($val['adultPrice']);
    $isPackage =to_gbk($val['isPackage']);
    $min =to_gbk($val['min']);
    $max =to_gbk($val['max']);
    echo "<div class=\"byPart_cont\">
        <ul>
            <li class=\"product_name1\">$packageId<br>$packageName</li>
            <li class=\"hotel_contain1\">$packageName<br>$hotelName</li>
            <li class=\"ticket_contain1\">$ticketName<br>西湖风景区</li>
            <li class=\"product_mounts1\">充足</li>
            <li class=\"product_price1\"><b>&yen;$adultPrice</b>/份</li>
            <li class=\"product_select1 select_selected\">
                <span></span>
                <input type='hidden' value='$packageId'>
                <input type='hidden' value='$isPackage'>
                <input type='hidden' value='$min'>
                <input type='hidden' value='$max'>
            </li>
        </ul>
        <div class=\"hide_content\">
            周末温泉门票2张，1小盒新鲜草莓，颈枕1个。普罗旺斯餐厅代金券20元（消费满166元以上），卡丁车俱乐部四项（卡丁车1圈、射箭10支、射击10发、双人自行车1圈），幸福农场菜园租赁8折，幸福农场菜园采摘8.5折，参加蓝调部落周年庆活动（消费多少送双倍）<i></i>
        </div>
       <div class=\"product_name_tips\">
            豪华总统套房（含双人早餐）<i></i>
        </div>
        <div class=\"ticket_contain_tips\">
            包含：东方明珠门票两张，迪士尼小镇、宝藏湾风暴来临；杰克船长之惊天特技大冒险（现场娱乐演出，舞台表演，室内娱乐）<i></i>
        </div>
        <div class=\"change_rule_tips\">
            如需取消、修改订单，请在2017-04-24 12:00前申请退款，过期扣除套餐全部费用。若您的旅程尚未确定，建议购买取消险。<i></i>
        </div>
       <div class=\"change_rule\">退改规则</div>
       <div class='fangcha' style='float: right'>3213</div>
    </div>";
}

echo "<div class=\"feiyongshuoming\">
    <h3>费用说明</h3>
    <ul>
        <li>【住】扬州杨鹏大酒店客房1间1晚（自选房型）</li>
        <li>【吃】入住次日清晨酒店自助早餐2份（身高≥1.2米的儿童早餐按成人标准58元/份收费）</li>
        <li>【游】景点门票4选1【瘦西湖风景区/瘦西湖温泉/何园/个园/大明寺景区】（敬请下单时自行选择确定具体景点名称、游玩时间及游玩人数）</li>
        <li>&nbsp;&nbsp;即日起至2017.12.31日，凡此期间入住客人均可享受5楼湖苑餐厅零点餐饮9折优惠（海鲜、特价菜、酒水除外）</li>
    </ul>
    <dl>
        <dt>温馨提示:</dt>
        <dd>1.套餐内容及出行人数可按需调整</dd>
        <dd>2.套餐总价会根据内容和出行日期变化</dd>
        <dd>3.礼包赠送与否及所赠内容由您入住日期和房型决定</dd>
    </dl>
</div>";
?>

