<?
if(!defined('IN_CLOOTA')) {
    exit('Access Denied');
}

$arr['orderno'] = req('orderno');//¶©µ¥ºÅ
$orderno = $arr['orderno'];

$sql = "SELECT * FROM `t_user_order` WHERE `order_code` = '$orderno'";
$query_rows = $db->get_one($sql);








?>