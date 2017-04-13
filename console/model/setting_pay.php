<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
} 

$sql = "SELECT pay_config FROM t_site_pay WHERE site_id='$g_siteid' ";  
$this_pay_config = $db->get_value($sql); 

$pay_config = unserialize($this_pay_config);
?>

