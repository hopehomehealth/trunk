<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}

$vcard_id = req('vcard_id');

$sql = "SELECT * FROM t_wx_vcard WHERE site_id='$g_siteid' AND vcard_id='".$vcard_id."' ";  
$detail = $db->get_one($sql);  
 
?> 