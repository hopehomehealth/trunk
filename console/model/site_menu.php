<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}

$sql = "SELECT max(order_id)+1 FROM t_site_menu WHERE site_id='$g_siteid'";  
$max_order_id = $db->get_value($sql); 

$sql = "SELECT * FROM t_site_menu WHERE site_id='$g_siteid' AND parent_id='0' ORDER BY menu_id ASC";  
$parents = $db->get_all($sql); 

$sql = "SELECT * FROM t_site_menu WHERE site_id='$g_siteid' ORDER BY parent_id ASC, order_id ASC";  
$menus = $db->get_all($sql); 

include(dirname(__FILE__).'/site_ppt.php');

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

