<? 
include(dirname(__FILE__).'/config.php');
 
$cmd = req('cmd');

if($cmd==''){
	$cmd = 'index';
}

$tpl_file   = dirname(__FILE__).'/tpl/'.$g_shop['tpl_name'].'/'.$cmd.'.php';
$model_file = dirname(__FILE__).'/model/'.$cmd.'.model.php';

if(file_exists($tpl_file)){
	include(dirname(__FILE__).'/model/common.model.php'); 

	if(file_exists($model_file)){
		include($model_file); 
	}
	include($tpl_file);
} else {
	die('<h1>503 ERROR: TEMPLET IS NOT FOUND!</h1>');
}

?>