<? 
$page_key = req('key');

$sql = "SELECT * FROM `t_shop_page` a WHERE a.`site_id`='$g_siteid' AND a.`shop_id`='$g_shopid' AND a.`key`='$page_key' "; 
$page = $db->get_one($sql);  

?>