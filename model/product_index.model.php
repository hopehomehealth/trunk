<? 
//shouxu|chufa|gonglue
$c_key = req('key');

// 最新分类下的文章列表
function get_portal_article($limit){
	global $db, $g_siteid, $c_key, $g_portal_key; 

	$sql = "SELECT * FROM `t_article_catalog` WHERE `site_id`='$g_siteid' AND `cat_key`='$c_key' ";  
	$news_cat = $db->get_one($sql); 

	if(notnull($news_cat) == false){
		$sql = "INSERT INTO `t_article_catalog` (`site_id`, `cat_type`, `parent_id`, `cat_name`, `cat_key`, `order_id`) VALUES ('$g_siteid', '0', '0', '".$g_portal_key[$c_key]."', '$c_key', '0')";
		$db->query($sql); 
		
		// 更新查询
		$sql = "SELECT * FROM `t_article_catalog` WHERE `site_id`='$g_siteid' AND `cat_key`='$c_key' ";  
		$news_cat = $db->get_one($sql); 
	}
 
	$sql = "SELECT * FROM `t_article_thread` WHERE `site_id`='$g_siteid' AND `cat_id`='".$news_cat['cat_id']."' ORDER BY `order_id` ASC LIMIT 0, $limit";  
	return $db->get_all($sql); 
}

// 最新分类下的文章列表
function get_portal_goods($limit){
	global $db, $g_siteid, $c_key; 
 
	if($c_key == 'shouxu'){
		$goods_type = '5';
	}
	if($c_key == 'chufa'){
		$goods_type = '8';
	}
	if($c_key == 'faxian'){
		$goods_type = '2';
	}

	$sql = "SELECT a.* FROM `t_goods_thread` a WHERE a.`site_id`='$g_siteid' AND a.`is_sale`=1 AND a.`goods_type`='$goods_type' ORDER BY a.`order_id` ASC, a.`goods_id` DESC ";
	return $db->get_all($sql); 
}

$type_file_array = array( 
	'3' => 'product_visa',  
	'6' => 'product_ship', 
);

$goods_type_key		= req('goods_type_key');
$c_goods_type		= $g_product_type_id[$goods_type_key];
$model_file			= dirname(__FILE__).'/'.$type_file_array[$c_goods_type].'.model.php';

if(is_file($model_file)){
	include($model_file);
} else{
	include('product_line.model.php');
}

?>