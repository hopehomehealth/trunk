<?  
$oer = ' ORDER BY order_id ASC, goods_id DESC';

$visa_type = req('visa_type');

$sql = " SELECT * FROM `t_visa_zone`";  
$visa_zone_rows = $db->get_all($sql);  

if($visa_type!=''){
	$sqler = " AND visa_type='$visa_type' ";
}
$sql = " SELECT * FROM `t_goods_thread` WHERE `site_id`='$g_siteid' AND `is_sale`=1 AND `goods_type`='3' AND `is_hot`='1' $oer LIMIT 0,5";  
$hot_visa_rows = $db->get_all($sql);  

$sql = " SELECT COUNT(*) FROM `t_user_order` WHERE `site_id`='$g_siteid' AND `goods_type`='3' ";  
$count_visa_order = $db->get_value($sql);  
 
/// SEO����
function seo(){
	global $g_sitename, $g_start_city, $this_page_title, $this_catalog_key;
?>
<title><?if($this_page_title!=''){echo $this_page_title;} else {echo $g_start_city.'�����籨��';}?> - <?=$g_sitename?></title> 
<?if($this_catalog_key!=''){?>
<meta name="description" content="<?=$g_sitename?>Ϊ���ṩ��ѵ�<?=$this_page_title?>��Ʒ��100%Ʒ�ʱ�֤�������ײ�����ѡ��ȫ����ͼۣ���ǿ�ƹ������<?=$this_page_title?>��Ʒ����<?=$g_sitename?>��" /> 
<?}?>
<?}?>