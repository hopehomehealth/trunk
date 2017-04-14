<?
set_time_limit(20);

/// TODO:建议在APACHE服务器之前增加NGINX缓存代理，提示静态文件访问性能

$cfg_file = dirname(__FILE__).'/cache/cfg/'.$_SERVER['HTTP_HOST'].'.php';

if(file_exists($cfg_file) == false){
	exit();
}

include($cfg_file);

$g_config	= unserialize($site_serialize);

$cmd				= addslashes($_GET['cmd']); 
$g_siteid			= $g_config['site_id'];
$g_tpl				= $g_config['tpl_name']; 
if($g_config['mobile_domain'] == $_SERVER['HTTP_HOST']){  
	$g_tpl = $g_config['mobile_tpl_name'];
}  
$file_name			= "$g_tpl".$_SERVER['REQUEST_URI'];
$default_file_name	= "themes/$file_name";
$diy_file_name		= "diy/$g_siteid/$file_name";

if(file_exists($diy_file_name) == true){
	$sendfile = $diy_file_name;
} else {
	$sendfile = $default_file_name;
} 

if(file_exists($sendfile) == false){
	exit();
}

if($cmd=='image'){   

	if(substr($sendfile,-3)=='css'){
		header("Content-type: text/css");
	}
	elseif(substr($sendfile,-3)=='png'){
		header("Content-type: image/png");
	}
	elseif(substr($sendfile,-3)=='gif'){
		header("Content-type: image/gif");
	}
	elseif(substr($sendfile,-3)=='jpg'){
		header("Content-type: image/jpeg");
	}
	elseif(substr($sendfile,-4)=='jpeg'){
		header("Content-type: image/jpeg");
	}
	elseif(substr($sendfile,-3)=='swf'){
		header("Content-type: application/x-shockwave-flash");
	}
	else {
		header("Content-type: application/octet-stream");
	}

	$fp = fopen($sendfile, 'rb');
	fpassthru($fp);
	exit();
}
if($cmd = 'js'){
	if(substr($sendfile,-2)=='js'){
		header("Content-type: application/x-javascript");
	} else {
		header("Content-type: application/octet-stream");
	}

	$fp = fopen($sendfile, 'rb'); 

	fpassthru($fp); 
	exit();
}
?>