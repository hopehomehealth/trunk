<?  
$sql = "SELECT * FROM `t_page` WHERE `site_id`='$g_siteid' ";  
$aboutus = $db->get_all($sql); 
  
$sql = "SELECT * FROM `t_goods_catalog` WHERE `site_id`='$g_siteid' ORDER BY `cat_name` ASC";  
$catalog = $db->get_all($sql);  
  
?>
<?
function seo(){
	global $g_sitename, $c_help;
?>
<title>мЬу╬╣ьм╪_<?=$g_sitename?></title>
<?}?>