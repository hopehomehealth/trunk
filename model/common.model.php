<?
$back_url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"'); 
$encrypted = $db->encrypt($back_url);
setcookie( MD5("backurl"), $encrypted ,  time() + 3600,  "/",'bus365.com');
/// 产品或信息不存在
function notfound(){
	header('HTTP/1.1 404 Not Found');
	header("status: 404 Not Found");
	header('Location:/404.php');
	exit;
} 

/// 产品标题分词
function ft_split($str){
	$chars = array(); 

	preg_match_all("/[a-zA-Z&]+/", $str, $out, PREG_SET_ORDER);
	foreach ($out as &$v) {
		$chars[] = $v[0];
	}

	preg_match_all("/[0-9]+/", $str, $out, PREG_SET_ORDER);
	foreach ($out as &$v) {
		$chars[] = $v[0];
	}

	$str_utf8 = mb_convert_encoding($str, "UTF-8", "GBK"); 
	preg_match_all("/[\x{4e00}-\x{9fa5}]/u", $str_utf8, $out, PREG_SET_ORDER);
	foreach ($out as &$v) {
		$chars[] = mb_convert_encoding($v[0], "GBK", "UTF-8");
	}
 
	$chars = array_unique($chars);  

	return $chars;
} 


// 读取站点列表
function get_site(){
	global $db;
 
	$sql = "SELECT * FROM `t_site_config` WHERE `state`='1' ORDER BY site_id ASC ";  
	return $db->get_all($sql); 
}

// 读取菜单列表
function get_menu($parent_id='0', $limit='6'){
	global $db, $g_siteid;
 
	$sql = "SELECT * FROM `t_site_menu` WHERE unshow='0' AND `parent_id`='$parent_id' AND `site_id`='$g_siteid' ORDER BY order_id ASC LIMIT 0,$limit";  
	return $db->get_all($sql); 
}

// 读取浮动导航
function get_hotspot($parent_id){
	global $db, $g_siteid;
 
	$sql = "SELECT * FROM `t_site_hotspot` WHERE `site_id`='$g_siteid' AND `parent_id`='$parent_id' ORDER BY `order_id` ASC";  
	return $db->get_all($sql); 
} 

// PPT列表
function get_ppt($ppt_type, $limit=0){
	global $db, $g_siteid;

	if($limit>0) $ler = "LIMIT 0, $limit";
  
	$sql = "SELECT * FROM `t_site_ppt` WHERE `site_id`='$g_siteid' AND ppt_type='$ppt_type' ORDER BY order_id ASC $ler ";  
	return $db->get_all($sql);       
}

// 读取浮动导航(热门)
function get_hotspot_recommend($id){
	global $db, $g_siteid;

	$hs2 = get_hotspot($id);
	if(notnull($hs2)){
		$i = 1;
		foreach ($hs2 as $v2){ 
			$hs3 = get_hotspot($v2['hotspot_id']);

			if(notnull($hs3)){
				foreach ($hs3 as $v3){ 
					if($i>3) break;
					$recommend[] = $v3; 
					$i++;
				}
			}
		}
	}
	return $recommend;
} 

// 读取文章类别
function get_article_catalog($parent_id='0', $limit=''){
	global $db, $g_siteid;
	if($limit!=''){
		$ler = "LIMIT 0, $limit";
	}
	$sql = "SELECT * FROM `t_article_catalog` WHERE `parent_id`='$parent_id' AND `site_id`='$g_siteid' ORDER BY order_id ASC $ler ";  
	return $db->get_all($sql); 
}

// 读取产品下级类别
function get_goods_catalog($parent_id='0', $limit=''){
	global $db, $g_siteid;
	if($limit!=''){
		$ler = "LIMIT 0, $limit";
	}
	$sql = "SELECT * FROM `t_goods_catalog` WHERE `parent_id`='$parent_id' AND `site_id`='$g_siteid' ORDER BY order_id ASC $ler ";  
	return $db->get_all($sql); 
}

// 读取产品下级类别
function get_current_goods_catalog($cat_id){
	global $db, $g_siteid;
	 
	$sql = "SELECT * FROM `t_goods_catalog` WHERE `cat_id`='$cat_id' AND `site_id`='$g_siteid' ";  
	return $db->get_one($sql); 
}

// 根据类别关键词，查询文章列表
function get_article_list($cat_key, $limit=''){
	global $db, $g_siteid;

	if($limit!=''){
		$ler = "LIMIT 0, $limit";
	}
	$sql = "SELECT a.* FROM `t_article_thread` a, t_article_catalog b WHERE a.`cat_id`=b.`cat_id` AND b.`cat_key`='$cat_key' AND a.`site_id`='$g_siteid' ORDER BY a.order_id ASC, a.thread_id DESC $ler ";  
	return $db->get_all($sql); 
}

// 根据类别关键词，查询文章内容
function get_page_content($page_key){
	global $db, $g_siteid;

	$sql = "SELECT * FROM `t_page` WHERE `site_id`='$g_siteid' AND `key`='$page_key' LIMIT 0,1 ";  
	return $db->get_one($sql); 
}

// 查询类别下的产品数量
function get_catalog_goods_number($cat_id='0'){
	global $db, $g_siteid; 

	if($cat_id!='0'){
		$qer = " AND a.`cat_id`='$cat_id' ";
	}
 
	$sql = "SELECT COUNT(*) FROM `t_goods_thread` a WHERE a.`site_id`='$g_siteid' AND a.`is_sale`=1 $qer ";    
 
	return $db->get_value($sql); 
} 

// 查询最近浏览的产品列表
function get_goods_browse_list($limit='4'){
	global $db, $g_siteid;
 
	$sql = "SELECT * FROM `t_goods_thread` a, `t_goods_browse` b WHERE a.`goods_id`=b.`goods_id` AND b.`session_id`='".sessionid()."' AND a.`site_id`='$g_siteid' AND b.`site_id`='$g_siteid' ORDER BY b.browse_id DESC LIMIT 0, $limit";  
	return $db->get_all($sql); 
} 

//// 查询热门的产品列表
//function get_hot_goods_list($cat_id='0', $limit='2'){
//	global $db, $g_siteid;
//
//	if($cat_id!='0'){
//		$qer = " AND a.`cat_id`='$cat_id' ";
//	}
//
//	$sql = "SELECT a.* FROM `t_goods_thread` a WHERE a.`site_id`='$g_siteid' AND a.`is_sale`=1 AND a.`is_hot`=1 $qer ORDER BY a.`goods_id` DESC LIMIT 0,$limit";
//
//	return $db->get_all($sql);
//}

// 查询热门的产品列表
function get_hot_goods_list($cat_id='0', $limit='2'){
    global $db, $g_siteid;

    if($cat_id!='0'){
        $qer = " AND a.`cat_id`='$cat_id' ";
    }
    $sql = "SELECT * FROM ( SELECT a.goods_name AS goods_name, a.min_price AS min_price, a.goods_image AS goods_image, a.goods_id AS goods_id, a.goods_type AS goods_type, a.`lv_scenic_id` AS lv_scenic_id, a.`market_price` AS market_price FROM `t_goods_thread` a WHERE a.`is_hot` = '1' AND a.`is_sale` = 1 AND a.goods_type = 1 UNION SELECT tg.goods_name AS goods_name, MIN(sku.lv_b2b_price) AS min_price, img.lv_img_url AS goods_image, tg.lv_product_id AS goods_id, tg.goods_type AS goods_type, tg.lv_scenic_id AS lv_scenic_id, sku.lv_market_price AS market_price FROM t_goods_sku sku LEFT JOIN t_goods_thread tg ON tg.lv_product_id = sku.goods_id LEFT JOIN t_goods_image img ON img.lv_product_id = tg.lv_product_id WHERE sku.lv_good_status = 'true' AND sku.lv_product_status = 'true' AND tg.goods_type = 4 AND tg.is_hot = '1' ) AS aaa ORDER BY goods_id DESC LIMIT 0,$limit;";

    return $db->get_all($sql);
}



function query_in_catalog($catalogs){
	global $db, $g_siteid; 

	$sql = "SELECT * FROM `t_goods_catalog` WHERE `cat_id` IN ($catalogs) AND `site_id`='$g_siteid' ORDER BY `cat_name` ASC, `order_id` ASC";  
	return $db->get_all($sql); 
}

function get_ad($ad_key, $start='', $limit=''){
	global $db, $g_siteid; 

	if($start!='' && $limit!=''){
		$ler = " LIMIT $start, $limit";
	}

	$sql = "SELECT * FROM `t_site_ad` WHERE `site_id`='$g_siteid' AND `ad_key`='$ad_key' ORDER BY `order_id` ASC $ler ";  
	return $db->get_all($sql); 
} 

function query_son_catalog($parent_catalog_id, $limit=0, $is_hot=false){
	global $db, $g_siteid;

	if($is_hot==true){
		$qer = ' AND `is_hot`=1';
	}
	if($limit>0){
		$ler = " LIMIT 0, $limit";
	}

	$sql = "SELECT * FROM `t_goods_catalog` WHERE `parent_id`='$parent_catalog_id' AND `site_id`='$g_siteid' $qer ORDER BY `order_id` ASC $ler";  
	return $db->get_all($sql); 
}

function query_parent_catalog($catalog_id){
	global $db, $g_siteid; 

	$sql = " SELECT `parent_id` FROM `t_goods_catalog` WHERE `cat_id`='$catalog_id' AND `site_id`='$g_siteid' LIMIT 0,1 ";   
	$parent_id = $db->get_value($sql); 

	$sql = "SELECT * FROM `t_goods_catalog` WHERE cat_id='$parent_id' AND `site_id`='$g_siteid' LIMIT 0,1 ";   
	return $db->get_one($sql); 
}

// 读取热门产品分类
function query_hot_catalog($limit=0){
	global $db, $g_siteid;
 
	if($limit>0){
		$ler = " LIMIT 0, $limit";
	}

	$sql = "SELECT * FROM `t_goods_catalog` WHERE `site_id`='$g_siteid' AND `is_hot`=1 ORDER BY `order_id` ASC $ler";  
	return $db->get_all($sql); 
}

function list_goods_parent_catalog( $this_catalog_id ){
	global $db, $g_siteid, $this_parent_catalog;

	$sql = "SELECT * FROM `t_goods_catalog` WHERE `cat_id`='$this_catalog_id' AND `site_id`='$g_siteid'";  
	$this_row = $db->get_one($sql);  
		
	if( $this_row['cat_id'] != '' ){
		$this_parent_catalog[] = $this_row; 
	}
 
	if( $this_row['parent_id'] != '' && $this_row['parent_id'] != '0' ){  
		list_goods_parent_catalog($this_row['parent_id']); 
	}
}

// 新闻文章列表
function query_news_list($cat_key, $limit=3, $keywords=''){
	global $db, $g_siteid;

	if($keywords!=''){
		$qer = "AND b.title LIKE '%".$keywords."%'";
	}

	$sql = "SELECT * FROM t_article_catalog a, t_article_thread b WHERE a.`cat_id`=b.`cat_id` AND a.`site_id`='$g_siteid' AND b.`site_id`='$g_siteid' AND a.cat_key='$cat_key' $qer ORDER BY b.thread_id DESC LIMIT 0,$limit";
	return $db->get_all($sql);  
}

// 查询热点导航
function query_hotspot($parent_id, $is_hot='0'){
	global $db, $g_siteid;
	
	if($is_hot=='1'){
		$qer = " AND `is_hot`='1'";
	}

	$sql = "SELECT * FROM t_site_hotspot WHERE site_id='$g_siteid' AND parent_id='$parent_id' $qer ORDER BY `order_id` ASC";  
	return $db->get_all($sql); 
}
 
function query_hot_hotspot($parent_id){
	global $db, $g_siteid;

	$rs_array = array();

	$hotspot1 = query_hotspot('0', 0);
	if(notnull($hotspot1)){
		foreach ($hotspot1 as $val1){  
			if($val1['is_hot']=='1'){
				$rs_array[] = $val1;
			}
			
			$hotspot2 = query_hotspot($val1['hotspot_id'], 0);
			if(notnull($hotspot2)){
				foreach ($hotspot2 as $val2){  
					if($val2['is_hot']=='1'){
						$rs_array[] = $val2;
					}

					$hotspot3 = query_hotspot($val2['hotspot_id'], 0);
					if(notnull($hotspot3)){
						foreach ($hotspot3 as $val3){  
							if($val3['is_hot']=='1'){
								$rs_array[] = $val3;
							}
						}
					} 
				}
			}
		}
	}

	return $rs_array;
}


// 团购/抢购
// $sale_type 1=团购 2=抢购
function query_promotion_goods($sale_type, $limit=2){ 
	global $db, $g_siteid;

	$sql = "SELECT * FROM `t_goods_thread` WHERE `is_sale`=1 AND `sale_type`='$sale_type' AND `site_id`='$g_siteid' AND `sale_start`<='".date('Y-m-d H:i:s')."' AND `sale_end`>='".date('Y-m-d H:i:s')."' ORDER BY `is_hot` DESC, `order_id` ASC, `goods_id` DESC LIMIT 0, $limit";
	return $db->get_all($sql); 
}


// 查询主题的产品列表
function query_mode_goods($mode_id, $limit=2){
	global $db, $g_siteid; 

	$sql = "SELECT  b.*, a.* FROM t_goods_join a, t_goods_thread b WHERE a.`site_id`='$g_siteid' AND a.goods_id=b.goods_id AND a.mode_id='$mode_id' ORDER BY a.order_id ASC  LIMIT 0, $limit"; 
	return $db->get_all($sql); 
}

// 查询首页楼层列表
function floor_list($parent_id, $goods_type='', $limit=''){
	global $db, $g_siteid; 

	if($limit!=''){
		$ler = "LIMIT 0,$limit ";
	}

	$sql = "SELECT a.* FROM `t_goods_floor` a WHERE a.`site_id`='$g_siteid' AND a.`goods_type`='$goods_type'  AND a.`parent_id`='$parent_id' AND a.`state`='1' ORDER BY a.`order_id` ASC $ler"; 
	return $db->get_all($sql); 
}


// 查询首页楼层列表
function floor_goods_list($floor_id, $limit=''){
	global $db, $g_siteid, $floor_id;

	if($limit!=''){
		$ler = "LIMIT 0,$limit ";
	}

	// 已加入产品
//	$sql = "SELECT b.* FROM `t_goods_floor_goods` a, `t_goods_thread` b WHERE a.`site_id`='$g_siteid' AND a.`goods_id`=b.`goods_id` AND a.`floor_id`='$floor_id' ORDER BY a.`goods_id` ASC $ler ";

    $sql = "SELECT m.* FROM (SELECT
    a.order_id AS order_id,
	td.goods_name AS goods_name,
	td.lv_product_id AS goods_id,
	td.goods_type AS goods_type,
	td.lv_scenic_id AS lv_scenic_id,
	MIN(sku.lv_b2b_price) AS price,
	img.lv_img_url AS image
	
FROM
	`t_goods_floor_goods` a
LEFT JOIN `t_goods_thread` td ON a.`goods_id` = td.`goods_id`
LEFT JOIN t_goods_sku sku ON sku.goods_id = td.lv_product_id
LEFT JOIN t_goods_image img ON img.lv_product_id = td.lv_product_id
WHERE
	a.`site_id` = '$g_siteid'
AND a.`floor_id` = '$floor_id'
AND sku.lv_good_status = 'true'
AND sku.lv_product_status = 'true'
AND sku.departdate >= CURDATE()
AND td.`site_id` = '$g_siteid'
AND td.goods_id IS NOT NULL
GROUP BY
	td.goods_id 
UNION
	SELECT
	    tf.order_id AS order_id,
		tg.goods_name AS goods_name,
		tg.goods_id AS goods_id,
		tg.goods_type AS goods_type,
		'' AS lv_scenic_id,
		tg.min_price AS price,
		tg.goods_image AS image
		
	FROM
		t_goods_floor_goods tf
	LEFT JOIN t_goods_thread tg ON tg.goods_id = tf.goods_id
	WHERE
		tf.site_id = '$g_siteid' AND tf.`floor_id` = '$floor_id' AND tg.`site_id` = '$g_siteid' AND tg.goods_id IS NOT NULL
) m WHERE m.price <> 0 ORDER BY m.`order_id` ASC $ler";
	return $db->get_all($sql);
}

//查询楼层的图片和价格
function get_image($lv_product_id){
    global $db;
    $sql = "SELECT a.`lv_img_url` FROM t_goods_image a WHERE a.lv_product_id = $lv_product_id";
    return implode('',$db->get_one($sql));
}
function get_price($lv_product_id){
    global $db;
    $sql = "SELECT MIN(b.lv_b2b_price) FROM t_goods_sku b WHERE b.goods_id = $lv_product_id";
    return implode('',$db->get_one($sql));
}

function floor_ad_one($floor_id){
	global $db, $g_siteid;  

	// 已加入产品
	$sql = "SELECT a.* FROM `t_goods_floor_topic` a WHERE a.`site_id`='$g_siteid' AND a.`floor_id`='$floor_id' ORDER BY a.`order_id` ASC LIMIT 0,1 ";
	return $db->get_one($sql);
}

// 帮助目录列表
function help_cat_list($limit){
	global $db, $g_siteid;

	
	$sql = "SELECT * FROM `t_help_catalog` WHERE `site_id`='$g_siteid' ORDER BY `order_id` ASC LIMIT 0, $limit";  
	$rs = $db->get_all($sql);   

	if(notnull($rs) == false){
		$datasql = "INSERT INTO `t_help_catalog` ( `site_id`, `cat_name`, `order_id` ) VALUES( $g_siteid, '预订说明', 0 ),( $g_siteid, '支付说明', 1 ),( $g_siteid, '会员政策', 2 ),( $g_siteid, '其他说明', 3 );";
		$db->query($datasql); //内置模拟数据

		return $db->get_all($sql); //重新查询

	} else {
		return $rs;
	}
}


// 帮助列表
function help_list($cat_id, $limit, $is_hot=''){
	global $db, $g_siteid;

	if($cat_id != -1){
		$qer .= " AND `cat_id`='$cat_id' ";
	} 

	if($is_hot=='1'){
		$qer .= ' AND `is_hot`=1 ';
	} 

	$sql = "SELECT * FROM t_help_thread WHERE `site_id`='$g_siteid' $qer ORDER BY order_id ASC, help_id ASC LIMIT 0, $limit";  
	$rs = $db->get_all($sql);  

	if(notnull($rs) == false){
		$datasql = "INSERT INTO `t_help_thread` ( `site_id`, `cat_id`, `title`, `content` ) VALUES('$g_siteid', '$cat_id', '帮助文章测试1', '帮助文章测试，请在网站控制面板重新编辑！' ), ('$g_siteid', '$cat_id', '帮助文章测试2', '帮助文章测试，请在网站控制面板重新编辑！' ), ('$g_siteid', '$cat_id', '帮助文章测试3', '帮助文章测试，请在网站控制面板重新编辑！' )";
		$db->query($datasql); //内置模拟数据

		return $db->get_all($sql); //重新查询
	} else { 
		return $rs;
	}
}


//// 帮助详细
//function help_detail($help_id){
//	global $db, $g_siteid;
//	$sql = "SELECT * FROM t_help_thread WHERE `site_id`='$g_siteid' AND `help_id`='$help_id' LIMIT 1";
//	return $db->get_one($sql);
//}
//
//
//// 最近浏览的产品列表
//function get_guess_list($limit){
//	global $db, $g_siteid, $g_userid, $query_sql;
//
//	if($g_userid==''){
//		$g_userid='-1';
//	}
//
//	$sql = "SELECT a.*, b.`addtime` AS browse_time FROM `t_goods_thread` a, (SELECT * FROM `t_goods_browse` t WHERE t.`site_id`='$g_siteid' AND (t.`session_id`='".sessionid()."' OR t.`user_id`='$g_userid') GROUP BY t.`goods_id`) b WHERE a.`goods_id`=b.`goods_id` AND a.`is_sale`=1 ORDER BY b.`browse_id` DESC LIMIT 0, $limit ";
////	echo $sql;
//	$rs = $db->get_all($sql);
//
//	if(notnull($rs) == false){
//		if($query_sql==''){
//			$sql ="SELECT a.* FROM `t_goods_thread` a WHERE a.`site_id`='$g_siteid' AND a.`is_sale`=1 AND a.`is_hot`=1 LIMIT 0, $limit";
//		} else {
//			$sql ="SELECT * FROM ($query_sql) tmp WHERE tmp.`is_hot`=1 LIMIT 0, $limit";
//		}
//		$rs = $db->get_all($sql);
//	}
//
//	return $rs;
//}

// 根据父ID查询分类列表（商家）
function get_shop_cat_list($parent_id){
	global $db, $g_siteid, $g_shopid;

	$sql = "SELECT * FROM `t_shop_goods_catalog` WHERE `site_id`='$g_siteid' AND `shop_id`='$g_shopid' AND `parent_id`='$parent_id' ORDER BY order_id ASC";  
	return $db->get_all($sql); 
} 

// 获取URL
function get_goods_url($cat_key, $goods_id){
	global $g_www_url; 

	return $g_www_url.'product/detail-'.$goods_id.'.html';
}

// 获取URL
function get_news_url($thread_id){
	global $db, $g_siteid, $g_www_url; 
 
	return $g_www_url.'news/detail-'.$thread_id.'.html';
}


// 最近浏览的产品列表
function get_guess_list($limit){
    global $db, $g_siteid, $g_userid, $query_sql;
    echo $g_userid;
    if($g_userid==''){
        $g_userid='-1';
    }

$sql = "SELECT * FROM ( SELECT a.goods_name AS goods_name, a.min_price AS min_price, a.goods_image AS goods_image, b.`addtime` AS browse_time, b.`browse_id` AS browse_id, b.goods_id AS goods_id , a.goods_type AS  goods_type, a.`lv_scenic_id` AS lv_scenic_id FROM `t_goods_thread` a, ( SELECT * FROM `t_goods_browse` t WHERE t.`site_id` = ".$g_siteid." -- AND (t.`session_id` = 'va774fkr72pftmclfn135c0dm5'OR t.`user_id` = '-1')
GROUP BY t.`goods_id` ) b WHERE a.`goods_id` = b.`goods_id` AND a.`is_sale` = 1 AND a.goods_type = 1 -- ORDER BY b.`browse_id` DESC
UNION SELECT tg.goods_name AS goods_name, MIN(sku.lv_b2b_price) AS min_price, img.lv_img_url AS goods_image, tb.`addtime` AS browse_time, tb.`browse_id` AS browse_id, tg.lv_product_id AS goods_id , tg.goods_type AS goods_type, tg.lv_scenic_id AS lv_scenic_id FROM t_goods_sku sku LEFT JOIN t_goods_thread tg ON tg.lv_product_id = sku.goods_id LEFT JOIN t_goods_image img ON img.lv_product_id = tg.lv_product_id LEFT JOIN t_goods_browse tb ON tb.goods_id = tg.goods_id WHERE sku.lv_good_status = 'true' AND sku.lv_product_status = 'true' AND tg.goods_type = 4 AND tb.`site_id` = ".$g_siteid." -- AND (tb.`session_id` = 'va774fkr72pftmclfn135c0dm5'OR tb.`user_id` = '-1')
-- ORDER BY tb.`browse_id` DESC
) AS aaa ORDER BY browse_id DESC limit 0,$limit;";

//    $sql = "SELECT * FROM ( SELECT a.goods_name AS goods_name, a.min_price AS min_price, a.goods_image AS goods_image, b.`addtime` AS addtime, b.`browse_id` AS browse_id, 1 FROM `t_goods_thread` a, ( SELECT * FROM `t_goods_browse` t WHERE t.`site_id` = '801' -- AND (t.`session_id` = 'va774fkr72pftmclfn135c0dm5'OR t.`user_id` = '-1')
//GROUP BY t.`goods_id` ) b WHERE a.`goods_id` = b.`goods_id` AND a.`is_sale` = 1 AND a.goods_type = 1 -- ORDER BY b.`browse_id` DESC
//UNION SELECT tg.goods_name AS goods_name, MIN(sku.lv_b2b_price) AS min_price, img.lv_img_url AS goods_image, tb.`addtime` AS addtime, tb.`browse_id` AS browse_id, 4 FROM t_goods_sku sku LEFT JOIN t_goods_thread tg ON tg.lv_product_id = sku.goods_id LEFT JOIN t_goods_image img ON img.lv_product_id = tg.lv_product_id LEFT JOIN t_goods_browse tb ON tb.goods_id = tg.goods_id WHERE sku.lv_good_status = 'true' AND sku.lv_product_status = 'true' AND tg.goods_type = 4 AND tb.`site_id` = '801' -- AND (tb.`session_id` = 'va774fkr72pftmclfn135c0dm5'OR tb.`user_id` = '-1')
//-- ORDER BY tb.`browse_id` DESC
//) AS aaa ORDER BY browse_id DESC limit 0,$limit;";
    $rs = $db->get_all($sql);

    if(notnull($rs) == false){
        if($query_sql==''){
            $sql ="SELECT a.* FROM `t_goods_thread` a WHERE a.`site_id`='$g_siteid' AND a.`is_sale`=1 AND a.`is_hot`=1 LIMIT 0, $limit";
        } else {
            $sql ="SELECT * FROM ($query_sql) tmp WHERE tmp.`is_hot`=1 LIMIT 0, $limit";
        }
        $rs = $db->get_all($sql);
    }

    return $rs;
}
?>