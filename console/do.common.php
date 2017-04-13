<?  
include('auth.php');
include('config.php');
include($g_dir.'/libs/image_zoom.php');

$cmd = req('cmd');
$ymdhis = date('Y-m-d H:i:s');
$yyyymm = date('Ym');

/// 创建用户私有目录
$user_dir = $g_root."diy/$g_siteid/$g_tpl/";
if(file_exists($user_dir)==false){ 
	mkdir($user_dir, 0777, true);
}

/// 系统操作日志
system_log();
 
function upload_image($fn, $upload_dir='', $fname=''){
	global $g_dir;

	$img = $_FILES[$fn]['name'];

	if($img!=""){
		$img_temp = $_FILES[$fn]['tmp_name'];

		$this_file_size = filesize($img_temp)/1024; 

		if($this_file_size>2000){
			senderror("单个图片/附件不得超过2000KB");
		} 

		$temp_arrays = explode(".", $img);
		$img_type = $temp_arrays[sizeof($temp_arrays)-1]; 
		$img_type = strtolower($img_type);
		if($img_type=="jpg" || $img_type=="jpeg" || $img_type=="swf" || $img_type=="gif" || $img_type=="png"){
			if($fname==''){
				$upfile_path = date('Ymdhis').mt_rand(10000,99999).".".$img_type;
			} else {
				$upfile_path = $fname;
			}

			if(file_exists($upload_dir)==false){
				mkdir($upload_dir, 0777);
			} 
			move_uploaded_file($img_temp, $upload_dir.$upfile_path);  

		} else {
			senderror("图片格式不正确。");
		}
	}  
	return $upfile_path;
} 

function get_ym_upfile($field_name){
	global $g_root, $g_siteid, $yyyymm;

	$upload_dir = "$g_root/upfiles/$g_siteid/$yyyymm/";

	$image_path = upload_image($field_name, $upload_dir);
	
	if($image_path!=''){
		$image_path = "$yyyymm/$image_path";
	} 
	return $image_path;
}

function upload_attach($fn, $upload_dir, $fname=''){
	global $g_dir;

	$img = $_FILES[$fn]['name'];

	if($img!=""){
		$img_temp = $_FILES[$fn]['tmp_name'];
		$temp_arrays = explode(".", $img);
		$img_type = $temp_arrays[sizeof($temp_arrays)-1]; 
		$img_type = strtolower($img_type);
		if($img_type=="pdf" || $img_type=="doc" || $img_type=="xls" || $img_type=="ppt" || $img_type=="txt" || $img_type=="zip" || $img_type=="rar"){
			if($fname==''){
				$upfile_path = date('Ymdhis').mt_rand(10000,99999).".".$img_type;
			} else {
				$upfile_path = $fname;
			}

			if(file_exists($upload_dir)==false){
				mkdir($upload_dir, 0777);
			}
			move_uploaded_file($img_temp, $upload_dir.$upfile_path);  

		} else {
			senderror("附件格式不正确。");
		}
	}  
	return $upfile_path;
} 

function batch_upload_image($img_name, $img_tmp_name, $upload_dir, $file_dir){
	global $g_dir;

	$img = $img_name;

	if($img!=""){
		$img_temp = $img_tmp_name;
		$temp_arrays = explode(".", $img);
		$img_type = $temp_arrays[sizeof($temp_arrays)-1]; 
		$img_type = strtolower($img_type);
		if($img_type=="jpg" || $img_type=="jpeg" || $img_type=="swf" || $img_type=="gif" || $img_type=="png"){
			if($fname==''){
				$upfile_path = date('Ymdhis').mt_rand(10000,99999).".".$img_type;
			} else {
				$upfile_path = $fname;
			}

			if(file_exists($upload_dir)==false){
				mkdir($upload_dir, 0777);
			}
			move_uploaded_file($img_temp, $upload_dir.$upfile_path);  

		} else {
			senderror("图片格式不正确。");
		}
	}  

	if($upfile_path!=''){
		return $file_dir.'/'.$upfile_path;
	} else {
		return '';
	}
} 

// 检查重复值
function check_repeat_value($table, $field_name, $field_value, $pk_name='', $pk_value=''){
	global $db, $g_siteid;

	if($pk_name != ''){
		$qer = "AND $pk_name<>'$pk_value'";
	}

	$sql = "SELECT COUNT(*) FROM $table WHERE $field_name='$field_value' AND `site_id`='$g_siteid' AND $field_name<>'' $qer ";  
	$rs = $db->get_value($sql);
	
	if($rs > 0){  
		return true;	
	} else {
		return false;
	}
}
  
?>