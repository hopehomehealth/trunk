<?php
require '../../config.php';

$pay_log_dir = dirname(dirname(dirname(__FILE__)))."/logs/pay/";

//��ȡ��վ��ĲƸ�֧ͨ������
$sql = "SELECT `pay_config` FROM `t_site_pay` WHERE `site_id`='".$g_siteid."'"; 
$this_pay_config = $db->get_value($sql); 

$pay_config = unserialize($this_pay_config);

// �Ƿ�����
$pay_state = $pay_config['tenpay']['state'];

if($pay_state!='Y'){
	die('<h1>�Բ���֧������δ����</h1>');
}

//�̻�ID��
$pay_mid = $pay_config['tenpay']['mid'];

//������Կ
$pay_sec = $pay_config['tenpay']['sec'];

//��������
$pay_guarantee = $pay_config['tenpay']['guarantee'];
if($pay_guarantee=='N'){
	$my_trade_mode = '1'; //N��ʱ����
}
if($pay_guarantee=='Y'){
	$my_trade_mode = '2'; //Y�������� 
}

//����ֱ��
$pay_direct = $pay_config['tenpay']['direct'];
if($pay_direct=='Y'){
	$pay_bank_type = req('bank_type');
} else {
	$pay_bank_type = '0';
}

$spname="�Ƹ�ͨ˫�ӿ�";
$partner = $pay_mid; 
$key = $pay_sec; 


$return_url = "http://".$_SERVER['HTTP_HOST']."/pay/tenpay/payReturnUrl.php";
$notify_url = "http://".$_SERVER['HTTP_HOST']."/pay/tenpay/payNotifyUrl.php";
?>