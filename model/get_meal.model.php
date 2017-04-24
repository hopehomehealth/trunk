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
    <li class=\"product_name\">�ײ�����</li>
    <li class=\"hotel_contain\">�����Ƶ�</li>
    <li class=\"ticket_contain\">������Ʊ</li>
    <li class=\"product_mounts\">���</li>
    <li class=\"product_price\">�۸�</li>
    <li class=\"product_select\">ѡ��</li>
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
            <li class=\"ticket_contain1\">$ticketName<br>�����羰��</li>
            <li class=\"product_mounts1\">����</li>
            <li class=\"product_price1\"><b>&yen;$adultPrice</b>/��</li>
            <li class=\"product_select1 select_selected\">
                <span></span>
                <input type='hidden' value='$packageId'>
                <input type='hidden' value='$isPackage'>
                <input type='hidden' value='$min'>
                <input type='hidden' value='$max'>
            </li>
        </ul>
        <div class=\"hide_content\">
            ��ĩ��Ȫ��Ʊ2�ţ�1С�����ʲ�ݮ������1����������˹��������ȯ20Ԫ��������166Ԫ���ϣ������������ֲ����������1Ȧ�����10֧�����10����˫�����г�1Ȧ�����Ҹ�ũ����԰����8�ۣ��Ҹ�ũ����԰��ժ8.5�ۣ��μ��������������������Ѷ�����˫����<i></i>
        </div>
       <div class=\"product_name_tips\">
            ������ͳ�׷�����˫����ͣ�<i></i>
        </div>
        <div class=\"ticket_contain_tips\">
            ����������������Ʊ���ţ���ʿ��С�򡢱�����籩���٣��ܿ˴���֮�����ؼ���ð�գ��ֳ������ݳ�����̨���ݣ��������֣�<i></i>
        </div>
        <div class=\"change_rule_tips\">
            ����ȡ�����޸Ķ���������2017-04-24 12:00ǰ�����˿���ڿ۳��ײ�ȫ�����á��������ó���δȷ�������鹺��ȡ���ա�<i></i>
        </div>
       <div class=\"change_rule\">�˸Ĺ���</div>
       <div class='fangcha' style='float: right'>3213</div>
    </div>";
}

echo "<div class=\"feiyongshuoming\">
    <h3>����˵��</h3>
    <ul>
        <li>��ס������������Ƶ�ͷ�1��1����ѡ���ͣ�</li>
        <li>���ԡ���ס�����峿�Ƶ��������2�ݣ���ߡ�1.2�׵Ķ�ͯ��Ͱ����˱�׼58Ԫ/���շѣ�</li>
        <li>���Ρ�������Ʊ4ѡ1���������羰��/��������Ȫ/��԰/��԰/�����¾������������µ�ʱ����ѡ��ȷ�����徰�����ơ�����ʱ�估����������</li>
        <li>&nbsp;&nbsp;��������2017.12.31�գ������ڼ���ס���˾�������5¥��Է����������9���Żݣ����ʡ��ؼ۲ˡ���ˮ���⣩</li>
    </ul>
    <dl>
        <dt>��ܰ��ʾ:</dt>
        <dd>1.�ײ����ݼ����������ɰ������</dd>
        <dd>2.�ײ��ܼۻ�������ݺͳ������ڱ仯</dd>
        <dd>3.������������������������ס���ںͷ��;���</dd>
    </dl>
</div>";
?>

