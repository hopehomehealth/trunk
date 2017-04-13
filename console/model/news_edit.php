<? 
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}

$thread_id = req('thread_id');

$sql = "SELECT * FROM t_article_thread WHERE site_id='$g_siteid' AND thread_id='".$thread_id."' ";  
$news = $db->get_one($sql); 

$sql = "SELECT * FROM t_article_catalog WHERE site_id='$g_siteid' ORDER BY order_id ASC ";  
$news_cat = $db->get_all($sql); 
?>

