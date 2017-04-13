<?
include('config.php');  

if(in_array($cmd, array('buycart.php', 'customized.php'))==false){
	include('auth.php');
}
 
if($g_config['mobile_domain'] == $g_http_host){ 
	include(dirname(__FILE__).'/layout/mobile.php'); 
} else { 
	include(dirname(__FILE__).'/layout/pc.php'); 
}
?>
