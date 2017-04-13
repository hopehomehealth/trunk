<?
$is_index = true;

// PPT列表
function index_ppt($ppt_type, $limit=0){
	global $db, $g_siteid;

	if($limit>0) $ler = "LIMIT 0, $limit";
  
	$sql = "SELECT * FROM `t_site_ppt` WHERE `site_id`='$g_siteid' AND ppt_type='$ppt_type' ORDER BY order_id ASC $ler ";  
	return $db->get_all($sql);       
}

// 友情链接
function index_link(){
	global $db, $g_siteid;

	$sql = "SELECT * FROM `t_friendlink` WHERE `site_id`='$g_siteid' ORDER BY `order_id` ASC ";  
	return $db->get_all($sql);  
}

// 通知动态
function last_notice($limit){
	global $db, $g_siteid;

	$sql = "SELECT `cat_id` FROM `t_article_catalog` WHERE `site_id`='$g_siteid' AND `cat_key`='notice' ";  
	$cat_id = $db->get_value($sql);

	$sql = "SELECT * FROM `t_article_thread` WHERE `site_id`='$g_siteid' AND `cat_id`='$cat_id' ORDER BY `order_id` ASC LIMIT 0, $limit"; 
	return $db->get_all($sql);  
}

// 微信首页图标
function index_weixin_nav(){
	global $db, $g_siteid;

	$sql = "SELECT * FROM `t_wx_home_nav` WHERE `site_id`='$g_siteid' AND `state`='1' ORDER BY `order_id` ASC ";  
	return $db->get_all($sql);  
}

// 微信首页图标
function index_weixin_dist(){
	global $db, $g_siteid;

	$sql = "SELECT * FROM `t_wx_home_dist` WHERE `site_id`='$g_siteid' AND `state`='1' ORDER BY `order_id` ASC ";  
	return $db->get_all($sql);  
}

function index_subject_list($mode_key, $limit=7){
	global $db, $g_siteid;
  
	$sql = "SELECT  b.*, a.* FROM t_goods_join a, t_goods_thread b, t_goods_mode c WHERE a.`site_id`='$g_siteid' AND a.goods_id=b.goods_id  AND a.mode_id=c.mode_id AND c.mode_key='$mode_key' ORDER BY a.order_id ASC LIMIT 0,$limit"; 
	return $db->get_all($sql);  
} 

// 查询主题
function query_mode($mode_key, $mode_title='首页推荐（自动）'){
	global $db, $g_siteid;  

	$sql = "SELECT * FROM t_goods_mode WHERE `mode_key`='$mode_key' "; 
	$rs = $db->get_one($sql); 

	if($rs['mode_id']==''){
		$sql = "INSERT INTO `t_goods_mode` ( `site_id` , `mode_name` , `mode_key` , `order_id`) VALUES ( '$g_siteid', '$mode_title' , '$mode_key', '1')";
		$db->query($sql); 

		$sql = "SELECT * FROM t_goods_mode WHERE `mode_key`='$mode_key' "; 
		$rs = $db->get_one($sql); 
	}

	return $rs;
}


function seo(){
	global $g_sitename, $g_page_title, $g_page_keywords, $g_page_description;
?>
<title><? $g_page_title!='' ? print $g_page_title : $g_sitename; ?></title>
<meta name="keywords" content="<?=$g_page_keywords?>" />
<meta name="description" content="<?=$g_page_description?>" />
<?}?>