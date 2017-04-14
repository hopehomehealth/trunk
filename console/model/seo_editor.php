<?
if(!defined('IN_CLOOTA')) {
	exit('Access Denied');
}
 
$primary_name  = req('primary_name');
$primary_value = req('primary_value');
$table_name    = req('table_name');
 

$sql = "SELECT * FROM $table_name WHERE $primary_name='$primary_value'";  
$row = $db->get_one($sql);  
 
?> 