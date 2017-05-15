<?
//  产品ID
$c_goods_id = req('goodsId');

$goodsId = req('goodsId');
$productId = req('productId');
$url = $host . "/travel/interface/zby/v3.2/getZbyGoodsDtail_v3.2?goodsId=" . $goodsId;
$rst = $db->api_post($url);
$arr = json_decode($rst, true);
$data = $arr['data'];
$scheduling = $data['scheduling'];
$_SESSION['childPriceInfo'] = $db->to_gbk($data['childPriceInfo']);
$c_goods_type = $data['goodsType'];
if($data['srcProv'] == $data['departureCity']){
    $chufa = $data['departureCity'];
} else {
    $chufa = $data['srcProv'].$data['departureCity'];
}
if($data['distProv'] == $data['distCity']){
    $daoda = $data['distCity'];
} else {
    $daoda = $data['distProv'].$data['distCity'];
}
//热门推荐
$pageSize = '6';
$homePage = '1';
$url = $host . "/travel/interface/zby/getHotZbyGoodsList";
$post1 = array('pageSize' => $pageSize, 'homePage' => $homePage);
$tuijian = $db->api_post($url, $post1);
$tuijian = json_decode($tuijian, true);
$tuijian = array_iconv($tuijian);
$tuijian_data = $tuijian['data'];

function jiequ($data,$num=54){
    if(mb_strwidth($data,'gbk')>=$num){
        return mb_strimwidth($data, 0, $num-1,'...','gbk');
    }else{
        return $data;
    }

}

function seo(){
    global $g_sitename, $c_goods;
    ?>
    <title><?=$c_goods['goods_name']?>_<?=$g_sitename?></title>
    <meta name="keywords" content="<?=$c_goods['goods_name']?>" />
    <meta name="description" content="<?=$c_goods['goods_name']?> <?=str_replace("\n","",removehtml($c_goods['summary']))?> " />
    <?
}
?>