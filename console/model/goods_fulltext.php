<?   
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}

set_time_limit(0);  
 
$sql = "select * from `t_goods_thread` where `ft`='' and site_id='$g_siteid' ";   

$query_rows = $db->get_all($sql);

if(notnull($query_rows)){ 
	foreach ($query_rows as $val){
		$str = $val['goods_id'].$val['goods_name'].$val['summary'].$val['dist_prov'].$val['dist_city'].$g_product_type[$val['goods_type']];  
 
		$goods_id = $val['goods_id'];  

		$ft_string = ft_split($str);

		$db->query("update `t_goods_thread` set `ft`='$ft_string' where `goods_id`='".$val['goods_id']."'");
	}
}

/// 删除索引并重建全文索引 ///

// 关联分类
$db->query("ALTER TABLE  `t_goods_thread` DROP INDEX  `catalogs`"); 
$db->query("ALTER TABLE  `t_goods_thread` ADD FULLTEXT (`catalogs`)");
// 搜索词
$db->query("ALTER TABLE  `t_goods_thread` DROP INDEX  `ft`"); 
$db->query("ALTER TABLE  `t_goods_thread` ADD FULLTEXT (`ft`)");
?> 

