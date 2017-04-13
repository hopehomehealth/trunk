<?
//curl传参获取门票详情
$url = $host . "/travel/interface/menpiao/getTicketProductDetail";
$data = array();
$data['lvProductId'] = req('lvProductId');
$data['scenicId'] = req('scenicId');
$rst = $db->api_post($url, $data);
$arr = json_decode($rst, true);
$obj = $arr['data'];

$list = $obj['ticketMapList']['0']['ticketList']['0'];
$lists = $obj['ticketMapList']['0']['ticketList'];
$jingdian = $obj['scenicSpotList'];

$_SESSION['ways'] = $list['ways'];
$_SESSION['lvGoodsName'] = $list['lvGoodsName'];
$_SESSION['lvProductId'] = $data['lvProductId'];
$_SESSION['lvGoodsId'] = $list['lvGoodsId'];
$ticketTypeName = $obj['ticketMapList']['0']['ticketTypeName'];
$ticketType = $list['ticketType'];

// 获取库存信息
$lvGoodsId = $_SESSION['lvGoodsId'];
$lvProductId = $_SESSION['lvProductId'];
$date = date('Y-m',time());
$arrs = array("lvGoodsId" => $lvGoodsId, "lvProductId" => $lvProductId, "date" => $date);
$urls = $host . "/travel/interface/menpiao/getLvGoodsTicketSku";
$rsts = $db->api_post($urls, $arrs);
$sku = json_decode($rsts, true);
$_SESSION['sku'] = $sku;

//获取热门推荐
$distCity = $obj['scenicInfo']['distCity'];
$datas = array('distCity' => $distCity, 'dataUser' => '1','goodsType' => '4', 'pageSize' => '8');
$urls = $host . "/travel/interface/ticket/getTicketHotGoodsListFromMongo";
$rsts = $db->api_post($urls, $datas);
$arrs = json_decode($rsts, true);
$recommends = $arrs['data']['webTicketHotList'];

function jiequ($num,$data){
    if(mb_strlen($data,'utf-8')>$num){
        return mb_substr($data, 0, $num,'utf-8').'...';
    }else{
        return $data;
    }

}

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