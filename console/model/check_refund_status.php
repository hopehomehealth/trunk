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

$sql = "SELECT * FROM `t_user_order_tourist` WHERE `order_code` = '$orderno'";
$info = $db->get_one($sql);

$user_name = $info['user_name'];
$user_phone = $info['user_phone'];
$user_credentials = $info['user_credentials'];


