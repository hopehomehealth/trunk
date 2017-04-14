<?  
$mode_key = req('mode_key');

$sql = "SELECT * FROM `t_goods_mode` WHERE `mode_key`='$mode_key' AND `site_id`='$g_siteid'";
$c_goods_mode = $db->get_one($sql);


$sql = "SELECT  a.*, c.`mode_name` FROM `t_goods_thread` a, `t_goods_join` b, `t_goods_mode` c WHERE b.`goods_id`=a.`goods_id` AND b.`mode_id`=c.`mode_id` AND b.`site_id`='$g_siteid' AND a.`is_sale`=1 AND c.`mode_key`='$mode_key' ORDER BY a.`order_id` ASC LIMIT 0,100";    
$query_rows = $db->get_all($sql);  
  

/// SEOÅäÖÃ
function seo(){
	global $g_sitename, $c_goods_mode;
?>
<title><?=$c_goods_mode['mode_name']?>_<?=$g_sitename?></title>  
<?
}
?>