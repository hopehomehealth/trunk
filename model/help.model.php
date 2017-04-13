<?  
$sql = "SELECT * FROM `t_help_thread` WHERE `help_id`='".req('id')."' AND `site_id`='$g_siteid'";  
$c_help = $db->get_one($sql);  

// 当前文章ID
$c_help_id = $c_help['help_id'];

// 当前文章摘要
$c_summary = $c_help['summary'];
if($c_summary == ''){
	$c_summary = show_substr(removehtml($c_help['content']),200);
} 

// 当前分类ID
$curr_cat_id = $c_help['cat_id'];

// 当前文章的分类
$sql = "SELECT * FROM `t_help_catalog` WHERE `cat_id`='$curr_cat_id' AND `site_id`='$g_siteid'"; 
$curr_cat = $db->get_one($sql); 
  
?>
<?
function seo(){
	global $g_sitename, $c_help;
?>
<title><?if($c_help['title']!=''){?><?=$c_help['title']?>_<?}?>帮助中心_<?=$g_sitename?></title>
<?}?>