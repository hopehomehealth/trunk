<? 
$vcard_id = req('vcard_id');

setcookies('WX_VCARD_UUID', $vcard_id); //������Դ����ID

// ��������
function index_leader($vcard_id){
	global $db, $g_siteid;

	$sql = "SELECT * FROM `t_wx_vcard` WHERE `site_id`='$g_siteid' AND `vcard_id`='$vcard_id' ";  
	return $db->get_one($sql);  
}

$vcard = index_leader($vcard_id);
$vcard_detail = unserialize($vcard['profiles']);


// PPT�б�
function index_ppt($ppt_type, $limit=0){
	global $db, $g_siteid;

	if($limit>0) $ler = "LIMIT 0, $limit";
  
	$sql = "SELECT * FROM `t_site_ppt` WHERE `site_id`='$g_siteid' AND ppt_type='$ppt_type' ORDER BY order_id ASC $ler ";  
	return $db->get_all($sql);       
}

// ��������
function index_link(){
	global $db, $g_siteid;

	$sql = "SELECT * FROM `t_friendlink` WHERE `site_id`='$g_siteid' ORDER BY `order_id` ASC ";  
	return $db->get_all($sql);  
}

// ΢����ҳͼ��
function index_weixin_nav(){
	global $db, $g_siteid;

	$sql = "SELECT * FROM `t_wx_home_nav` WHERE `site_id`='$g_siteid' AND `state`='1' ORDER BY `order_id` ASC ";  
	return $db->get_all($sql);  
}

// ΢����ҳͼ��
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

// ��ѯ����
function query_mode($mode_key, $mode_title='��ҳ�Ƽ����Զ���'){
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