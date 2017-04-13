<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
 

$sql = "SELECT * FROM t_wx_home_nav WHERE site_id='$g_siteid' ORDER BY order_id ASC";  
$nav_list = $db->get_all($sql); 

$sql = "SELECT `cat_key` FROM t_goods_catalog WHERE site_id='$g_siteid' GROUP BY `cat_key`";  
$cat_key_letter = $db->get_all($sql); 

//["Alabama","Alaska"]
$typeahead .= '["/groupbuy/", "/zhoubian/", "/guonei/", "/chujing/", "/gentuanyou/", "/ziyouxing/", "/menpiao/", "/jiudian/", "/qianzheng/", "/zhuche/", "/youlun/", "/jiaotong/", "/tuozhan/", "/techan/"';
if(notnull($cat_key_letter)){
	foreach ($cat_key_letter as $val){ 
		$typeahead .= ', "/'.$val['cat_key'].'/"';
	}
}
$typeahead .= ']';
?>

