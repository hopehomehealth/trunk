<? 
include(dirname(__FILE__).'/auth.php');

include(dirname(__FILE__).'/config.php'); 

define('IN_CLOOTA', true);

$cmd		= base64_decode(req('cmd')); 

$model_file = dirname(__FILE__).'/model/'.$cmd;

$view_file	= dirname(__FILE__).'/view/'.$cmd;

// 加载公共模型
include(dirname(__FILE__).'/model/common.php');

if(req('modal') == 'true'){
	if(is_file($view_file) == true){  
		if(is_file($model_file) == true){
			include($model_file);
		}
		include($view_file);
	} 
	exit;
} else { 
	include(dirname(__FILE__).'/layout/index.php');
}
?>