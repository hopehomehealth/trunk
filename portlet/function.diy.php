<?

/// �����û�DIY�Զ�������
function load_user_diy($filename){
	global $g_root, $g_siteid, $g_tpl;

	$diyfile = $g_root."diy/$g_siteid/$g_tpl/$filename";

	if(substr($filename,0,4)=='diy.' && $_COOKIE['CLOOTA_B2B2C_DIY']=='Y'){

		$diy_id = str_replace('.','',$filename);
 
		echo "<a href='#diy_".md5($filename)."' style='position:absolute;color:red;font-weight:bold;background-color:#66ffff;padding-left:5px;padding:5px;cursor:pointer;z-index:90000000'> �� �༭HTML  </a>";
	}

	if(file_exists($diyfile)==true){ //���ȼ����û��Զ���ģ��
		return $diyfile;
	} else { //Ĭ��ģ��
		return $g_root."themes/$g_tpl/$filename";
	}
}  
?>