<?
include(dirname(dirname(__FILE__)).'/config.php');
include(dirname(dirname(__FILE__)).'/model/common.model.php'); 
include(dirname(__FILE__).'/function.php');

define('IN_CLOOTA', true);

$g_userid		= $_COOKIE['CLOOTA_B2B2C_USER_UUID'];    
$g_sessionid	= get_client_id(); 
$g_member		= get_member();

$cmd			= base64_decode(req('cmd'));
//$cmd			= req('cmd');

$model_file		= dirname(__FILE__).'/model/'.$cmd;

if(is_file($model_file)){
	include($model_file);
}

include(dirname(__FILE__).'/model/common.php');
?>