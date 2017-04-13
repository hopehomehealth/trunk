<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}

$sql = "SELECT * FROM `t_shop_join` WHERE `user_id`='$g_userid' LIMIT 0,1";
$join = $db->get_one($sql);

$detail = unserialize($join['profiles']); 

$state = $join['state']; //״̬
?>
