<?
if(!defined('IN_CLOOTA')) {
    exit('Access Denied');
}

$arr['orderno'] = req('orderno');//������
$orderno = $arr['orderno'];

$sql = "SELECT * FROM `t_refund_fee_apply` WHERE `order_code` = '$orderno'";
$query_row = $db->get_one($sql);
$arr['payno'] = $query_row['gateway_order_code'];//֧����ˮ��
$arr['refundmoney'] = $query_row['refund_fee'];//�˿���
$arr['gatewayid'] = $query_row['gateway_id'];//����ID
$arr['totalPrice'] = $query_row['order_fee'];//�ܽ��

$sql = "SELECT * FROM `t_user_order` WHERE `order_code` = '$orderno'";
$query_rows = $db->get_one($sql);

$sql = "SELECT * FROM `t_user_order_tourist` WHERE `order_code` = '$orderno'";
$info = $db->get_one($sql);

$user_name = $query_rows['linker'];
$user_phone = $query_rows['mobile'];
$user_credentials = $info['user_credentials'];
