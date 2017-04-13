<?  
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}

$sql = "SELECT * FROM t_article_catalog WHERE parent_id='0' AND site_id='$g_siteid' ORDER BY order_id ASC ";  
$parent_news_cat = $db->get_all($sql);  

?>

