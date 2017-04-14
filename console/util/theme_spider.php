<?  
include('auth.php');  

// 数据库的模板数量
$sql = "select count(*) from `t_tpl` ";   
$tpl_number = $db->get_value($sql); 

// 打开目录
$dir = $g_dir.'/themes/' ;
$dir_handle = opendir($dir);
  
if(1 == 1){ 

	// 清空数据库
	$sql = "TRUNCATE TABLE `t_tpl` ";  
	$db->query($sql);  

	// 重新统计
	$dir_handle = opendir($dir);

	if($dir_handle){
		while(($file=readdir($dir_handle))!==false){
			if($file==='.' || $file==='..'){
				continue;
			}

			$tmp = realpath($dir.'/'.$file);

			if(is_dir($tmp)){ 
				if($file=='default' || $file=='blank' || substr($file,0,1)=='m' || substr($file,0,1)=='s'){ 
					$tags = "通用"; 
					
					if($file=='default'){
						$order_id = 0;
					}
					if(substr($file,0,3)=='tpl'){
						$order_id = str_replace('tpl','',$file);
					}
			
					$readme = @file_get_contents($dir.$file.'/readme.txt');
					$readme_array = explode('|',$readme);
					if(sizeof($readme_array)>1){
						$readme = trim($readme_array[1]);
						$tags = trim($readme_array[0]);
					}  
					$sql = "INSERT INTO `t_tpl` (`tpl_name` , `tags` , `readme` , `order_id` ) VALUES ('$file', '$tags', '$tags|$readme', '$order_id');";  
					$db->query($sql);   
				}
			}
		}
		closedir($dir_handle);
	} 
}
?>   