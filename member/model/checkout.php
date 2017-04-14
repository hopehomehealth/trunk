<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
 
$sql = "SELECT `pay_config` FROM `t_site_pay` WHERE `site_id`='$g_siteid'"; 
$this_pay_config = $db->get_value($sql); 

$pay_config = unserialize($this_pay_config);

$sql = "SELECT * FROM `t_user_order` WHERE `site_id`='$g_siteid' AND `user_id`='$g_userid' AND `linker`<>'' ORDER BY `order_id` DESC LIMIT 0,1"; 
$last_order = $db->get_one($sql); 

$goods_id   = req('goods_id');
$goods_type = req('goods_type');

if($goods_id!=''){
	$adult_num		= req('adult_num');
	$kid_num		= req('kid_num');
	$departdate		= date('Y-m-d', strtotime(req('departdate')));
	$goods_id		= req('goods_id');  
	$addtime		= date('Y-m-d H:i:s'); 

	if($adult_num=='') $adult_num='1';

	$sql = "SELECT * FROM `t_goods_thread` WHERE `goods_id`='$goods_id' AND site_id='$g_siteid'";
	$goods = $db->get_one($sql); 
 
	$goods_id		= $goods['goods_id'];
	$goods_name		= $goods['goods_name']; 
	$is_sale		= $goods['is_sale']; 
  
} else {
	js("alert('系统来源不正确');"); 
	exit();
}
?>