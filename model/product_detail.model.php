<?
/// 首页标识
$is_goods_detail = true;

//  产品ID
$c_goods_id = req('goodsId');

// 产品详细信息
$sql = "SELECT * FROM t_goods_thread WHERE goods_id='$c_goods_id' AND site_id='$g_siteid' LIMIT 0,1";
$c_goods = $db->get_one($sql);

// 产品类型
$c_goods_type = $c_goods['goods_type'];

//// 非法调用
//if($c_goods['goods_id']==''){
//	header('Location:/404.php');
//	exit;
//}

// 产品主图
$c_goods_image = "/upfiles/$g_siteid/".$c_goods['goods_image'];


// 产品图册
$sql = "SELECT * FROM t_goods_image WHERE site_id='$g_siteid' AND goods_id='$c_goods_id' ORDER BY image_id ASC LIMIT 0,3";
$c_goods_image_list = $db->get_all($sql);


// 评论列表
function get_comment_list(){
    global $db, $g_siteid, $c_goods_id;

    $sql = "SELECT a.*, b.account, b.username, b.nickname FROM t_goods_comment a, t_user b WHERE a.user_id=b.user_id AND a.site_id='$g_siteid' AND a.goods_id='$c_goods_id' AND a.is_first='1' ORDER BY a.comment_id DESC ";
    return $db->get_all($sql);
}

// 平均评分
function get_avg_comment_score(){
    global $db, $g_siteid, $c_goods_id;

    $sql = "SELECT AVG(`comment_star`) FROM t_goods_comment a WHERE a.site_id='$g_siteid' AND a.goods_id='$c_goods_id' AND a.is_first='1' ";

    $rs = $db->get_value($sql);
    $rs = number_format($rs, 1);
    return $rs;
}

// 评论总数
function get_total_comment($level=''){
    global $db, $g_siteid, $c_goods_id;

    if($level!=''){
        $qer = "AND a.`comment_level`='$level' ";
    }
    $sql = "SELECT COUNT(*) FROM t_goods_comment a WHERE a.site_id='$g_siteid' AND a.goods_id='$c_goods_id' AND a.is_first='1' $qer ";
    $rs = $db->get_value($sql);

    if($rs=='') {
        $rs = 0;
    }
    return $rs;
}

// 评论列表
$comment_list = get_comment_list();

if(notnull($comment_list)){
    $stat_comment_total = get_total_comment(); //评论总数

    if($stat_comment_total>0){

        $comment_a_rate = get_total_comment('A') / get_total_comment() * 100;
        $comment_b_rate = get_total_comment('B') / get_total_comment() * 100;
        $comment_c_rate = get_total_comment('C') / get_total_comment() * 100;

        $avg_comment_score = get_avg_comment_score(); //平均分
    }
}


// 订单总数
if($g_misc['show_rand_number']=='1'){  //模拟人数
    $range = explode(',', $g_misc['rand_number_range']);
    $show_rand_number = mt_rand($range[0], $range[1]);
    $stat_order_total = $show_rand_number;
} else {
    $sql = "SELECT SUM(`adult_num`)+SUM(`kid_num`) FROM t_user_order WHERE site_id='$g_siteid' AND goods_id='$c_goods_id' ";
    $stat_order_total = $db->get_value($sql);
    if($stat_order_total=='') {
        $stat_order_total = 0;
    }
}


// 查询该产品的第一个分类


/// 查询该类的全部父类
$this_parent_catalog = array();

function list_parent_catalog($this_catalog_id){
    global $db, $g_siteid, $this_parent_catalog;

    $sql = "SELECT * FROM `t_goods_catalog` WHERE `cat_id`='$this_catalog_id' AND `site_id`='$g_siteid'";
    $this_row = $db->get_one($sql);

    if($this_row['cat_id']!=''){
        $this_parent_catalog[] = $this_row;
    }

    if($this_row['parent_id']!='' && $this_row['parent_id']!='0'){
        list_parent_catalog($this_row['parent_id']);
    }
}

// 执行遍历所有父类
list_parent_catalog($c_goods['cat_id']);


/// 产品相关店铺
$sql = "SELECT * FROM `t_shop` WHERE `shop_id`='".$c_goods['shop_id']."'";
$c_shop = $db->get_one($sql);

$c_shop_name = $c_shop['shop_name'];
$c_shop_url  = 'http://'.$c_shop['shop_domain'].'.'.$g_shop_root_domain;

if($c_shop_name == ''){
    $c_shop_name = $g_profile['company'].'(自营)';
    $c_shop_url  = 'javascript:void(0)';
}


$sql = "SELECT *, DATE_FORMAT(`departdate`,'%Y%m%d') AS ymd FROM `t_goods_sku` WHERE `site_id`='$g_siteid' AND `goods_id`='$c_goods_id' AND `departdate`>='".date('Y-m-d')."'";
$c_goods_sku = $db->get_all($sql);
if(notnull($c_goods_sku)){
    foreach ($c_goods_sku as $sval){
        $adult_price_array[$sval['ymd']] = $sval['adult_price'];
        $adult_stock_array[$sval['ymd']] = $sval['adult_stock'];
        $kid_price_array[$sval['ymd']]   = $sval['kid_price'];
        $kid_stock_array[$sval['ymd']]   = $sval['kid_stock'];
        $diff_price_array[$sval['ymd']]  = $sval['diff_price'];
    }
}

/// 价格体系
$adult_price  = $adult_price_array;//unserialize(stripslashes($c_goods['adult_price']));
$kid_price	  = $kid_price_array;//unserialize(stripslashes($c_goods['kid_price']));
$diff_price	  = $diff_price_array;//unserialize(stripslashes($c_goods['diff_price']));
$adult_stock  = $adult_stock_array;
$kid_stock	  = $kid_stock_array;

/// 日常内容
$all_days		= unserialize(stripslashes($c_goods['content_day']));
$all_titles		= $all_days['title'];
$all_contents	= $all_days['content'];
$all_tools		= $all_days['tool'];
$all_images		= $all_days['image'];

$goodsId = req('goodsId');
$productId = req('productId');
$url = $host . "/travel/interface/zbyV3.2/getZbyGoodsDtailV_3.2?goodsId=" . $goodsId;
$rst = $db->api_post($url);
$arr = json_decode($rst, true);
$data = $arr['data'];

$scheduling = $data['scheduling'];

//热门推荐
$pageSize = '3';
$homePage = '1';
$url = $host . "/travel/interface/zby/getHotZbyGoodsList";
$post1 = array('pageSize' => $pageSize, 'homePage' => $homePage);
$tuijian = $db->api_post($url, $post1);
$tuijian = json_decode($tuijian, true);

function seo(){
    global $g_sitename, $c_goods;
    ?>
    <title><?=$c_goods['goods_name']?>_<?=$g_sitename?></title>
    <meta name="keywords" content="<?=$c_goods['goods_name']?>" />
    <meta name="description" content="<?=$c_goods['goods_name']?> <?=str_replace("\n","",removehtml($c_goods['summary']))?> " />
    <?
}
?>