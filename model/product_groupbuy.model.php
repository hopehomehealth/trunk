<?   
// Ĭ������  
$sql = "SELECT a.* FROM `t_goods_thread` a WHERE a.`site_id`='$g_siteid' AND a.is_sale=1 AND a.sale_type=1 AND sale_end>'".date('Y-m-d H:i:s')."' ORDER BY a.`order_id` ASC ";    
$query_rows = $db->get_all($sql);  
  

/// SEO����
function seo(){
	global $g_sitename, $c_goods_mode;
?>
<title>�Ź�_<?=$g_sitename?></title>  
<?
}
?>