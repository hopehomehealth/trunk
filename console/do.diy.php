<?
////////////////////////////// DIY ////////////////////////////////


// ͼƬ�ռ䣺�Լ��ϴ�ͼƬ
if($cmd == 'image_upload'){     
	$upload_dir = "$g_root/upfiles/$g_siteid/myspace/";

	if(file_exists($upload_dir)==false){ 
		mkdir($upload_dir, 0777, true);
	}

	$myimage = upload_image('myimage', $upload_dir);   
  
	$url = "./?cmd=".base64_encode("imagebox.php")."&tabs_index=1";
	gourl($url);
}

// ͼƬ�ռ䣺ɾ���Լ��ϴ���ͼƬ
if($cmd == 'imagebox_del'){     
	$f = req('f');   
	
	unlink($g_root."upfiles/$g_siteid/myspace/$f"); 

	$url = "./?cmd=".base64_encode("imagebox.php")."&tabs_index=1";
	gourl($url);
}

// ͼƬ�ռ䣺�滻ͼƬ
if($cmd == 'image_replace'){  
	$f = req('f');
	$type = req('type');
	$tpl = req('tpl');

	$new_image = $_FILES['myimage']['name'];

	if(strtolower(substr($new_image,-3)) != strtolower(substr($f,-3))){
		senderror("�滻��ͼƬ��ʽ��һ�¡�");
	}

	if($type=='tpl'){
		$diy_dir	= $g_root."diy/$g_siteid/$tpl/";
		$upload_dir = $diy_dir."images/";

		if(!is_dir($diy_dir)){
			mkdir($diy_dir, 0777);
		}

		if(!is_dir($upload_dir)){
			mkdir($upload_dir, 0777);
		}

		if(is_file($upload_dir.$f)==true){
			unlink($upload_dir.$f);
		}

		$myimage = upload_image('myimage', $upload_dir, $f); 

		if(substr($tpl,0,1)=='m') $tabs_index=1;
		else $tabs_index=0;

		$url = "./?cmd=".base64_encode("imagebox.php")."&tabs_index=$tabs_index&rnd=".md5($ymdhis);
	}

	if($type=='my'){
		$upload_dir = "$g_root/upfiles/$g_siteid/";

		if(is_file($upload_dir.$f)==true){
			unlink($upload_dir.$f);
		}

		$myimage = upload_image('myimage', $upload_dir, $f); 

		$url = "./?cmd=".base64_encode("imagebox.php")."&tabs_index=2&rnd=".md5($ymdhis);
	} 
	
	gotourl($url);
}

// ͼƬ�ռ䣺��ԭԭʼģ��ͼƬ
if($cmd == 'image_reback'){     
	$f = req('f');   
	$tpl = req('tpl');
	
	unlink($g_root."diy/$g_siteid/$tpl/images/$f");

	if(substr($tpl,0,1)=='m') $tabs_index=1;
	else $tabs_index=0;

	$url = "./?cmd=".base64_encode("imagebox.php")."&tabs_index=$tabs_index";
	gourl($url);
}

 
 
// ����DIY�ļ�
if($cmd == 'diy_update'){  
	$g_tpl = req('tpl_name');
	$filename = req('filename'); 
	$content = $_POST['content'.md5($filename)];

	if (!empty($content)) {
		if (get_magic_quotes_gpc()) {
			$content = stripslashes($content);
		} else {
			$content = $content;
		}
	}

	// ��ȫ�Կ���
	$content = str_replace('<?','&lt;?',$content);
	$content = str_replace('?>','?&gt;',$content);
	$content = str_replace('<%','&lt;%',$content);
	$content = str_replace('%>','%&gt;',$content); 

	$thisdir = $g_root."diy/$g_siteid/$g_tpl/";

	if(file_exists($thisdir)==false) mkdir($thisdir);
   
	$thisfile = $thisdir.$filename;
	
    $fp=fopen($thisfile, "w+");
    fwrite($fp, $content);
    fclose($fp); 
	
	if(req('ref')!=''){
		$url = req('ref');
	} else {
		$url = "$g_host_console?cmd=".base64_encode("diy.php");
	}
	gourl($url);
}
/// �ָ�DIY�ļ�
if($cmd == 'diy_recovery'){  
	$filename = req('filename');  
	$g_tpl = req('tpl_name');
	$thisfile = $g_root."diy/$g_siteid/$g_tpl/$filename";

	if(file_exists($thisfile)){
		@unlink($thisfile);
	}

	if(req('ref')!=''){
		$url = req('ref');
	} else {
		$url = "$g_host_console?cmd=".base64_encode("diy.php");
	}
	gourl($url);
} 
?>