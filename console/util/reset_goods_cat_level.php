<?  
include('auth.php');

$sql = "SELECT * FROM t_goods_catalog WHERE site_id='$g_siteid' AND parent_id=0 ";  
$catalog1 = $db->get_all($sql);  
  
if(notnull($catalog1)){
	foreach ($catalog1 as $val1){  
		$sql = "update t_goods_catalog set level=1 WHERE cat_id='".$val1['cat_id']."'";  
		$db->query($sql); 

		/// 2
		$sql = "SELECT * FROM t_goods_catalog WHERE parent_id='".$val1['cat_id']."' ";  
		$catalog2 = $db->get_all($sql); 
		if(notnull($catalog2)){
			foreach ($catalog2 as $val2){  
				$sql = "update t_goods_catalog set level=2 WHERE cat_id='".$val2['cat_id']."'";  
				$db->query($sql);  

				/// 3
				$sql = "SELECT * FROM t_goods_catalog WHERE parent_id='".$val2['cat_id']."' ";  
				$catalog3 = $db->get_all($sql); 
				if(notnull($catalog3)){
					foreach ($catalog3 as $val3){  
						$sql = "update t_goods_catalog set level=3 WHERE cat_id='".$val3['cat_id']."'";  
						$db->query($sql);  

						/// 4
						$sql = "SELECT * FROM t_goods_catalog WHERE parent_id='".$val3['cat_id']."' ";  
						$catalog4 = $db->get_all($sql); 
						if(notnull($catalog4)){
							foreach ($catalog4 as $val4){  
								$sql = "update t_goods_catalog set level=4 WHERE cat_id='".$val4['cat_id']."'";  
								$db->query($sql);  
							}
						} 
					}
				} 
			}
		} 
	}
}



?> 