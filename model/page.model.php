<?
$page_key = req('key');

$sql = "SELECT * FROM `t_page` WHERE `site_id`='$g_siteid' AND `key`='$page_key' LIMIT 0,1 ";  
$page = $db->get_one($sql);   

/// 自动构建独立页面（管理员登录状态）
if($_COOKIE['CLOOTA_B2B2C_ADMIN_UUID'] != ''){
	if($page['page_id']==''){
		$sql = "INSERT INTO `t_page` (`site_id`, `key`, `title`, `content`, `order_id`) VALUES ('$g_siteid', '$page_key', '$page_key', '系统自动创建，请在后台设置！', '0')";
		$db->query($sql); 

		$sql = "SELECT * FROM `t_page` WHERE `site_id`='$g_siteid' AND `key`='$page_key' LIMIT 0,1 ";  
		$page = $db->get_one($sql); 
	}
}

function page_list(){
	global $db, $g_siteid;

	$sql = "SELECT * FROM `t_page` WHERE `site_id`='$g_siteid' ORDER BY `order_id` ASC ";  
	return $db->get_all($sql);  
} 
 
function seo(){
	global $g_sitename, $page; 
?>
	<?if($page['page_title']!=''){?>
	<title><?=$page['page_title']?>_<?=$g_sitename?></title>
	<meta name="keywords" content="<?=$page['page_keywords']?>" />
	<meta name="description" content="<?=$page['page_description']?>" />
	<?}else{?>
	<title><?=$page['title']?>_<?=$g_sitename?></title>
	<?}?>
<?}?>