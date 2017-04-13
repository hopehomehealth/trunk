<?   
// д╛хоеепР  
$sql = "SELECT a.* FROM `t_goods_thread` a WHERE a.`site_id`='$g_siteid' AND a.is_sale=1 AND a.sale_type=1 ORDER BY a.`order_id` ASC ";    
$query_rows = $db->get_all($sql);  
  

/// SEOеДжц
function seo(){
	global $g_sitename, $c_goods_mode;
?>
<title>бцснме╧╨ - <?=$g_sitename?></title>  
<?
}
?>