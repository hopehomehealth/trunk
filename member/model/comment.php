<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
 
if(req('goods_id')==''){
	$sql = "SELECT a.*, b.goods_name FROM `t_goods_comment` a, `t_goods_thread` b WHERE a.goods_id=b.goods_id AND a.user_id='$g_userid' AND a.site_id='$g_siteid' ORDER BY a.comment_id DESC ";  
	$comments =  $db->get_all($sql);  
}
?> 