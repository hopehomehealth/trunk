<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}

// �̼ң���פ�̻����б�
$sql = "SELECT * FROM `t_shop` WHERE `site_id`='$g_siteid' ORDER BY order_id ASC";  
$shop_list = $db->get_all($sql); 

// ����ģ��
$sql = "SELECT * FROM `t_goods_desc_tpl` LIMIT 0,1";  
$desc_tpl = $db->get_one($sql);  

 
// ��ѯȫ�������б�
function son_cat($parent_id){
	global $db, $g_siteid;
  
	$sql = "SELECT `cat_id`,`cat_name`,`parent_id` FROM `t_goods_catalog` WHERE `parent_id`='$parent_id' AND site_id='$g_siteid' ORDER BY `order_id` ASC ";
	return $db->get_all($sql);
} 

// �Ƿ�����¼�����
function has_son_cat($parent_id){
	global $db, $g_siteid;
  
	$sql = "SELECT `cat_id` FROM `t_goods_catalog` WHERE `parent_id`='$parent_id' AND site_id='$g_siteid' LIMIT 0,1";
	$rs = $db->get_value($sql);

	if($rs!='') return true;
	else return false;
}  

/////////////////////////////////// ��Ʒ���� //////////////////////////////
$c_goods_type = req('goods_type');

// ǩ֤�����б�
$sql = "SELECT * FROM `t_visa_zone`  ORDER BY `zone_letter` ASC";  
$visa_zone_list = $db->get_all($sql); 


?> 

