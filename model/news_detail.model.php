<?  
$sql = "SELECT * FROM `t_article_thread` WHERE `thread_id`='".req('id')."' AND `site_id`='$g_siteid'";  
$c_article = $db->get_one($sql);  

// ��ǰ����ID
$c_article_id = $c_article['thread_id'];

if($c_article_id==''){
	notfound();
}

// ��ǰ����ժҪ
$c_summary = $c_article['summary'];
if($c_summary == ''){
	$c_summary = show_substr(removehtml($c_article['content']),200);
} 

// ��ǰ����ID
$c_cat_id = $c_article['cat_id'];

// ��ǰ���µķ���
$sql = "SELECT * FROM `t_article_catalog` WHERE `cat_id`='$c_cat_id' AND `site_id`='$g_siteid'"; 
$c_cat = $db->get_one($sql); 
 

// ��ѯȫ�����·����б�
function get_all_catalog(){
	global $db, $g_siteid; 
 
	$sql = "SELECT * FROM `t_article_catalog` WHERE `parent_id`='0' AND `site_id`='$g_siteid' ORDER BY `order_id` ASC";  
	return $db->get_all($sql); 
} 

// ��ѯȫ�����·����б�
function get_hot_article($limit){
	global $db, $g_siteid, $c_cat_id; 
 
	$sql = "SELECT * FROM `t_article_thread` WHERE `cat_id`='$c_cat_id' AND `site_id`='$g_siteid' ORDER BY `order_id` ASC, `thread_id` DESC LIMIT 0, $limit";  
	return $db->get_all($sql); 
} 

// ��ѯȫ�����·����б�
function get_rel_goods_list($limit){
	global $db, $g_siteid, $c_article; 
 
	$sql = "SELECT * FROM `t_goods_thread` WHERE `cat_id`='".$c_article['goods_cat_id']."' AND `site_id`='$g_siteid' ORDER BY `order_id` ASC, `goods_id` DESC LIMIT 0, $limit";  
	return $db->get_all($sql); 
} 
?>