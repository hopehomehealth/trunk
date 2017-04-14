<?  

$sql = "SELECT * FROM `t_local_store` WHERE `site_id`='$g_siteid' AND `state`='1' ORDER BY `order_id` ASC ";   
$local_store_rows = $db->get_all($sql); 
  
 
function seo(){
	global $g_sitename, $c_help;
?>
<title>оъобце╣Й_<?=$g_sitename?></title>
<?}?>