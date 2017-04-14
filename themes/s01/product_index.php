<?
$view_file = dirname(__FILE__).'/'.$type_file_array[$c_goods_type].'.php';

if(is_file($view_file)){
	include($view_file);
} else{
	include('product_line.php'); //默认线路首页模板
}

?>