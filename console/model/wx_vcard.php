<?   
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 

if(req('kw')!=''){
	$qer .= " AND `profiles` LIKE '%".req('kw')."%'";
}
 
$sql = "SELECT * FROM t_wx_vcard WHERE site_id='$g_siteid' $qer ORDER BY vcard_id DESC";  
$rows = $db->get_all($sql); 
?>

