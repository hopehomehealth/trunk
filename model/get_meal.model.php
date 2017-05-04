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
    <li class=\"product_name\">�ײ�����</li>
    <li class=\"hotel_contain\">�����Ƶ�</li>
    <li class=\"ticket_contain\">������Ʊ</li>
    <li class=\"product_mounts\">���</li>
    <li class=\"product_price\">�۸�</li>
    <li class=\"product_select\">ѡ��</li>
</ul>";

foreach ($datas['list'] as $key => $val) {
    $packageId = to_gbk($val['packageId']);//�ײ�ID
    $packageName = to_gbk($val['packageName']);//�ײ���
    $packageNames = to_gbk($db->jiequ(9,$val['packageName']));
    if( !is_null($val['hotelList']) ){
        $hotelName = to_gbk($val['hotelList']['0']['hotelName']);//�Ƶ���
        $hotelNames = $db->jiequ(10,$hotelName);
        $hotelInfo = to_gbk($val['hotelList']['0']['hotelInfo']);//�Ƶ���
    } else {
        $hotelNames = '��ǰ�ײ��޾Ƶ�';
    }
    if( !is_null($val['hotelList']) ) {
        $ticketName = to_gbk($val['ticketList']['0']['ticketName']);//��Ʊ��
        $ticketNames = $db->jiequ(10, $ticketName);
        $ticketInfo = to_gbk($val['ticketList']['0']['ticketInfo']);//��Ʊ���
    } else {
        $ticketNames = '��ǰ�ײ�����Ʊ';
    }
    $lvStock = to_gbk($val['skuList']['0']['lvStock']);//���
    $changeRuler = to_gbk($val['skuList']['0']['changeRuler']);//�˸Ĺ���
    $adultPrice = to_gbk($val['skuList']['0']['adultPrice']);
    $kidPrice = to_gbk($val['skuList']['0']['kidPrice']);
    $adultNum = to_gbk($val['adultNum']);
    $kidNum = to_gbk($val['childNum']);
    $isPackage = to_gbk($val['isPackage']);//true�ǰ���
    $min = to_gbk($val['min']);
    $max = to_gbk($val['max']);
    $roomMax = to_gbk($val['roomMax']);//��󷿼���
    //�жϰ��˻��ǰ��ݣ�����۸�
    if ($isPackage == 'true') {
        $price = $adultPrice * $adultNum + $kidPrice * $kidNum;
    } else {
        $price = $adultPrice;
        $diffPrice = to_gbk($val['skuList']['0']['diffPrice']);
    }
    //�жϿ��
    if ($lvStock == '-1') {
        $lvStock = '��ȱ';
    } else {
        $lvStock = '����';
    }
    echo "<div class=\"byPart_cont\">
        <ul>
            <li class=\"product_name1\"><a title='$packageName'>$packageNames</a></li>
            <li class=\"hotel_contain1\"><a title='$hotelInfo'>$hotelNames</a></li>
            <li class=\"ticket_contain1\"><a title='$ticketInfo'>$ticketNames</a></li>
            <li class=\"product_mounts1\">$lvStock</li>";
            if($isPackage == 'false'){
                echo "<li class=\"product_price1\">���ˣ�<b>&yen;$adultPrice</b><br>��ͯ��<b>&yen;$kidPrice</b></li>";
            }else{
                echo "<li class=\"product_price1\"><b>&yen;$price</b>/��</li>";
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
                 <div class=\"change_rule\">�˸Ĺ���</div>
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
//    <h3>����˵��</h3>
//    <ul>
//        <li>��ס������������Ƶ�ͷ�1��1����ѡ���ͣ�</li>
//        <li>���ԡ���ס�����峿�Ƶ��������2�ݣ���ߡ�1.2�׵Ķ�ͯ��Ͱ����˱�׼58Ԫ/���շѣ�</li>
//        <li>���Ρ�������Ʊ4ѡ1���������羰��/��������Ȫ/��԰/��԰/�����¾������������µ�ʱ����ѡ��ȷ�����徰�����ơ�����ʱ�估����������</li>
//        <li>&nbsp;&nbsp;��������2017.12.31�գ������ڼ���ס���˾�������5¥��Է����������9���Żݣ����ʡ��ؼ۲ˡ���ˮ���⣩</li>
//    </ul>
//    <dl>
//        <dt>��ܰ��ʾ:</dt>
//        <dd>1.�ײ����ݼ����������ɰ������</dd>
//        <dd>2.�ײ��ܼۻ�������ݺͳ������ڱ仯</dd>
//        <dd>3.������������������������ס���ںͷ��;���</dd>
//    </dl>
//</div>";
?>

