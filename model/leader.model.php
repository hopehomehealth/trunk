<?  

$sql = "SELECT * FROM `t_wx_vcard` WHERE `site_id`='$g_siteid' AND `state`='1' ORDER BY `order_id` ASC ";   
$vcard_rows = $db->get_all($sql); 
  
 
function seo(){
	global $g_sitename, $c_help;
?>
<title>оъобце╣Й_<?=$g_sitename?></title>
<?}?>